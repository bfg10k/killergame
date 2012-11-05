<?php

/**
 * juego actions.
 *
 * @package    killer
 * @subpackage juego
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class juegoActions extends sfActions
{
 /**
  * Página de inicio de la parte privada
  *
  * @param sfRequest $request A request object
  */    
  public function executeIndex(sfWebRequest $request)
  {
    $id_jugador = $this->getUser()->getAttribute('user_id',null);
    if(is_null($id_jugador)) $this->redirect('visitas/index');

    $c = new Criteria();
    $c->add(KillJugadoresPeer::ID,$id_jugador);
    $jugador = KillJugadoresPeer::doSelectOne($c);
    if(!($jugador instanceof KillJugadores))
    {
      $this->redirect('visitas/index');
    }
   
    
    $victima = $jugador->getKillJugadoresRelatedByIdVictima();
    if($victima instanceof KillJugadores)
    {
      $victima->getActivo();

      while(!$victima->getActivo())
      {
        $victima = $victima->getKillJugadoressRelatedByIdVictima();
      }     
    }
    else
    {//No se ha realizado el sorteo todavía. Instanciamos un Jugador anónimo.
      $victima = new KillJugadores();
      $victima->setNombre("?????");
      $victima->setAlias("?????");
      $victima->setDescripcion("");
      $victima->setFoto("killer_misterioso_peq.jpg");
    }
    
    $this->jugador=$jugador;
    $this->nombre = $jugador->getNombre();
    $this->victima=$victima;
  

  }
  
  public function executeSortear(sfWebRequest $request)
  {
    $id_jugador = $this->getUser()->getAttribute('user_id',null);
    if(is_null($id_jugador)) $this->redirect('visitas/index');

    $c = new Criteria();
    $c->add(KillJugadoresPeer::ID,$id_jugador);
    $jugador = KillJugadoresPeer::doSelectOne($c);
    if(!($jugador instanceof KillJugadores))
    {
      $this->redirect('visitas/index');
    }
    
    if($jugador->getIdVictima()==0)
    {//Solamente en este caso se realiza el sorteo
      $todos = KillJugadoresPeer::doSelect(new Criteria());
      foreach($todos as $asesino)
      {
        $arrayasesinos[$asesino->getId()]=$asesino->getIdDepartamento();
      }
      
      do {
        $arraysorteado = $this->ashuffle($arrayasesinos);
      } while(!$this->comprobar($arraysorteado));
      
      $orden = array_keys($arraysorteado);
      foreach($orden as $pos => $idJugador)
      {
        $jugador = KillJugadoresPeer::retrieveByPK($idJugador);
        $jugador->setIdVictima($orden[($pos+1)%count($orden)]);
        $jugador->save();
      }
      
    }
    
    $this->redirect('juego/index');
    
  }
  
  private function ashuffle($array)
  { 
    $keys = array_keys($array); 
    shuffle($keys); 
    $random = array(); 
    foreach ($keys as $key) 
      $random[$key] = $array[$key]; 
    return $random;
  }
  
  private function comprobar($array)
  { 
    $salida = true;
    $value_ant = end($array);
    foreach($array as $value)
    {
      if($value === $value_ant) return false;
      $value_ant = $value;
    }
    return $salida;
  }

  /**
  * Presenta informe de objetivo cumplido
  *
  * @param sfRequest $request A request object
  */
  public function executeRellenarInforme(sfWebRequest $request)
  {
    $id_jugador = $this->getUser()->getAttribute('user_id',null);
    if(is_null($id_jugador)) $this->redirect('visitas/index');

    $c = new Criteria();
    $c->add(KillJugadoresPeer::ID,$id_jugador);
    $jugador = KillJugadoresPeer::doSelectOne($c);
    if(!($jugador instanceof KillJugadores))
    {
      $this->redirect('visitas/index');
    }
    $this->nombre = $jugador->getNombre();
    
  }

  /**
  * Guarda el informe y redirige al mensaje de info de espera de confirmación
  * 
  * No tiene vista
  *
  * @param sfRequest $request A request object
  */
  public function executeGuardarInforme(sfWebRequest $request)
  {
    //Guardar el informe. 
    //Si va mal -> volver a presentar executeRellenarInforme
    $this->redirect('juego/rellenarInforme');
    //Si va bien -> redirigir a executeInformeEnviado
    $this->redirect('juego/informeEnviado');
  }

  /**
  * Presenta un aviso de espera de confirmación
  *
  * @param sfRequest $request A request object
  */
  public function executeInformeEnviado(sfWebRequest $request)
  {
    $id_jugador = $this->getUser()->getAttribute('user_id',null);
    if(is_null($id_jugador)) $this->redirect('visitas/index');

    $c = new Criteria();
    $c->add(KillJugadoresPeer::ID,$id_jugador);
    $jugador = KillJugadoresPeer::doSelectOne($c);
    if(!($jugador instanceof KillJugadores))
    {
      $this->redirect('visitas/index');
    }
    $this->nombre = $jugador->getNombre();
  }

  /**
  * Página de inicio de la parte privada
  *
  * @param sfRequest $request A request object
  */
  public function executeRueda(sfWebRequest $request)
  {
    $id_jugador = $this->getUser()->getAttribute('user_id',null);
    if(is_null($id_jugador)) $this->redirect('visitas/index');

    $c = new Criteria();
    $c->add(KillJugadoresPeer::ID,$id_jugador);
    $jugador = KillJugadoresPeer::doSelectOne($c);
    if(!($jugador instanceof KillJugadores))
    {
      $this->redirect('visitas/index');
    }
    
    $this->nombre = $jugador->getNombre();
    
    //Antes del sorteo vale esta consulta
    $this->jugadores = KillJugadoresPeer::doSelect(new Criteria());
    $this->numJugadores = count($this->jugadores);
    $this->setTemplate('ruedaNoSorteo');
    return "Success"; 

    //Para después del sorteo la rueda se tiene que dibujar en orden
    $id_jugador = $this->getUser()->getAttribute('user_id',null);
    if(is_null($id_jugador)) $this->redirect('visitas/index');

    $c = new Criteria();
    $c->add(KillJugadoresPeer::ID,$id_jugador);
    $jugador = KillJugadoresPeer::doSelectOne($c);
    if(!($jugador instanceof KillJugadores))
    {
      $this->redirect('visitas/index');
    }

    do {
      $this->jugadores[] = array('id'=>$jugador->getId(),'alias'=>$jugador->getAlias(),'foto'=>$jugador->getFoto());
      $jugador = $jugador->getKillJugadoresRelatedByIdVictima();
    } while($jugador->getId()!=$id_jugador);
    
  }

  /**
  * Página de inicio de la parte privada
  *
  * @param sfRequest $request A request object
  */
  public function executeBlog(sfWebRequest $request)
  {
    $id_jugador = $this->getUser()->getAttribute('user_id',null);
    if(is_null($id_jugador)) $this->redirect('visitas/index');

    $c = new Criteria();
    $c->add(KillJugadoresPeer::ID,$id_jugador);
    $jugador = KillJugadoresPeer::doSelectOne($c);
    if(!($jugador instanceof KillJugadores))
    {
      $this->redirect('visitas/index');
    }
    
    $this->nombre = $jugador->getNombre();
    
    
    $criteria = new Criteria();
    $criteria->addDescendingOrderByColumn(KillNoticiasPeer::ID);
    $this->noticias = KillNoticiasPeer::doSelect($criteria);
  }
  
  public function executeNormas(sfWebRequest $request)
  {
    $id_jugador = $this->getUser()->getAttribute('user_id',null);
    if(is_null($id_jugador)) $this->redirect('visitas/index');

    $c = new Criteria();
    $c->add(KillJugadoresPeer::ID,$id_jugador);
    $jugador = KillJugadoresPeer::doSelectOne($c);
    if(!($jugador instanceof KillJugadores))
    {
      $this->redirect('visitas/index');
    }
    
    $this->nombre = $jugador->getNombre();
  }

  public function executeEditar(sfWebRequest $request)
  {
    $id_jugador = $this->getUser()->getAttribute('user_id',null);
    if(is_null($id_jugador)) $this->redirect('visitas/index');

    $c = new Criteria();
    $c->add(KillJugadoresPeer::ID,$id_jugador);
    $jugador = KillJugadoresPeer::doSelectOne($c);
    if(!($jugador instanceof KillJugadores))
    {
      $this->redirect('visitas/index');
    }
    
    $criteria = new Criteria();
    $this->departamentos = KillDepartamentosPeer::doSelect($criteria);
      
    $this->aviso = $this->getUser()->getFlash('notice');

    $this->nombre = $jugador->getNombre();
    $this->departamento = $jugador->getIdDepartamento();
    $this->alias = $jugador->getAlias();
    $this->biografia = $jugador->getDescripcion();
    $this->email = $jugador->getEmail();
    $this->foto = $jugador->getFoto();
    
  }
  
  public function executeGrabarDatos(sfWebRequest $request)
  {
    $forward = "juego/editar";
    $id_jugador = $this->getUser()->getAttribute('user_id',null);
    if(is_null($id_jugador)) $this->redirect('visitas/index');

    $c = new Criteria();
    $c->add(KillJugadoresPeer::ID,$id_jugador);
    $jugador = KillJugadoresPeer::doSelectOne($c);
    if(!($jugador instanceof KillJugadores))
    {
      $this->redirect($forward);
    }
    
    $nombre = $request->getParameter('nombre');
    if(empty($nombre)) 
    {
        $this->getUser()->setFlash('notice','El nombre es obligatorio');
        $this->redirect($forward);
    }
        
    $departamento = $request->getParameter('departamento');
    if(empty($departamento)) 
    {
        $this->getUser()->setFlash('notice','El departamento es obligatorio');
        $this->redirect($forward);
    }
    
    $alias = $request->getParameter('alias');
    if(empty($alias)) 
    {
        $this->getUser()->setFlash('notice','El alias es obligatorio');
        $this->redirect($forward);
    }
    
    $biografia = $request->getParameter('biografia');
    if(empty($biografia)) 
    {
        $this->getUser()->setFlash('notice','La biografía es obligatoria');
        $this->redirect($forward);
    }
  
    $email = $request->getParameter('email');
    if(empty($email)) 
    {
        $this->getUser()->setFlash('notice','El email es obligatorio');
        $this->redirect($forward);
    }
        
    $fileName = $request->getFiles('foto');
    //print_r($fileName);exit;

    if(!empty($fileName['name']))
    {//Solamente si han subido foto nueva haremos algo
    
      $fileSize = $fileName['size'];
      if($fileSize <= 0)
      {
          $this->getUser()->setFlash('notice','La foto es obligatoria');
          $this->redirect($forward);
      }

      switch($fileName['type'])
      {
        case 'image/jpeg':
          $ext = 'jpg';
          break;
        case 'image/png':
          $ext = 'png';
          break;
        case 'image/gif':
          $ext = 'gif';
          break;
        default: 
          $this->getUser()->setFlash('notice','La foto debe tener extensión jpg, gif o png');
          $this->redirect($forward);
          break;
      }

      if($fileSize > 100000)
      {
          $this->getUser()->setFlash('notice','La foto no puede superar los 100 KB');
          $this->redirect($forward);
      }

      $fileType = $fileName['type'];
      $theFileName = $fileName['name'];
      $uploadDir = sfConfig::get("sf_web_dir");
      $fotosDir = $uploadDir.'/images/fotos';

      if(!is_dir($fotosDir))
          mkdir($fotosDir, 0777);
    }

    //Comprobar que el alias no está repetido
    $c = new Criteria();
    $c->add(KillJugadoresPeer::ALIAS,$alias);
    $c->add(KillJugadoresPeer::ID,$jugador->getId(),CRITERIA::NOT_EQUAL);
    $otro_jugador = KillJugadoresPeer::doSelectOne($c);
    if($otro_jugador instanceof KillJugadores)
    {
        $this->getUser()->setFlash('notice','Ese alias ya existe.');
        $this->redirect($forward);
    }

    $jugador->setNombre($nombre);
    $jugador->setIdDepartamento($departamento);
    $jugador->setAlias($alias);
    $jugador->setDescripcion($biografia);
    $jugador->setEmail($email);
   
    $jugador->save();
    $this->getUser()->setFlash('notice','Datos modificados ;)');
    
    $idjugador = $jugador->getId();
    
    if(!empty($fileName['name']))
    {
      move_uploaded_file($fileName['tmp_name'], "$fotosDir/foto$idjugador.$ext");
      $jugador->setFoto("foto$idjugador.$ext");
      $jugador->save();
    }
    $this->redirect($forward);
  }

  
  public function executeRangos(sfWebRequest $request)
  {
    $id_jugador = $this->getUser()->getAttribute('user_id',null);
    if(is_null($id_jugador)) $this->redirect('visitas/index');

    $c = new Criteria();
    $c->add(KillJugadoresPeer::ID,$id_jugador);
    $jugador = KillJugadoresPeer::doSelectOne($c);
    if(!($jugador instanceof KillJugadores))
    {
      $this->redirect('visitas/index');
    }
    
    $this->nombre = $jugador->getNombre();
  }
  
  public function executeRanking(sfWebRequest $request)
  {
    $id_jugador = $this->getUser()->getAttribute('user_id',null);
    if(is_null($id_jugador)) $this->redirect('visitas/index');

    $c = new Criteria();
    $c->add(KillJugadoresPeer::ID,$id_jugador);
    $jugador = KillJugadoresPeer::doSelectOne($c);
    if(!($jugador instanceof KillJugadores))
    {
      $this->redirect('visitas/index');
    }
    
    $this->nombre = $jugador->getNombre();
    
    
  }

  /**
  * Destruye la sesión y redirige al módulo de visitas
  *
  * @param sfRequest $request A request object
  */
  public function executeSalir(sfWebRequest $request)
  {
    //Borrar la sesión
    $this->getUser()->setAuthenticated(false);
    $this->getUser()->setAttribute('user_id',null);

    //Ir a visitas/index
    $this->redirect('visitas/index');
  }

}
