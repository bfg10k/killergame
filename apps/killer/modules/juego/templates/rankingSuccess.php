<div id="user"> 
    <div class="btn-group">
    <a class="btn btn-info" href="<?php echo url_for('juego/index'); ?>"><i class="icon-user icon-white"></i> <?php echo $nombre ?></a>
    <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
    <ul class="dropdown-menu">
    <li><a href="<?php echo url_for('juego/editar'); ?>"><i class="icon-pencil"></i> Editar perfil</a></li>
    <li><a href="<?php echo url_for('juego/salir'); ?>"><i class="icon-ban-circle"></i> Salir</a></li>
    <li class="divider"></li>
    <li><a href="<?php echo url_for('juego/rellenarInforme'); ?>"><i class="i"></i> Certifica la muerte de tu objetivo</a></li>
    </ul>
    </div>

</div>

<div id="nav-user">
    <ul class="nav nav-list">
    <li><a href="<?php echo url_for('juego/index'); ?>"><i class="icon-home"></i> Inicio</a></li>
    <li><a href="<?php echo url_for('juego/rueda'); ?>"><i class="icon-screenshot"></i> Rueda de objetivos</a></li>
    <li><a href="<?php echo url_for('juego/blog'); ?>"><i class="icon-eye-open"></i> Killer News</a></li>  
    <li><a href="<?php echo url_for('juego/nuevoPost'); ?>"><i class="icon-pencil"></i>Escribe en el blog</a></li> 
    <li><a href="<?php echo url_for('juego/normas'); ?>"><i class="icon-align-justify"></i> Normativa</a></li>
    <li class="active"><a href="<?php echo url_for('juego/rangos'); ?>"><i class="icon-certificate icon-white"></i> Rango mafioso</a></li>
    </ul>
</div>
     
<div id="content-user">
  <h1>Hall of Fame</h1>
  <?php foreach($ranking as $jugador): ?>
    <?php if($jugador->getActivo() === 1): ?>
      <div>
        <img width="70" class="foto_visitas foto" src="<?php echo image_path('fotos/killer_misterioso_peq.jpg'); ?>" />
        <p style="position: relative; bottom: 0px;">(<?php echo $jugador->countKillMuertessRelatedByIdAsesino(); ?>)</p>
      </div>
    <?php else: ?>
      <div>
        <img width="70" class="foto_visitas foto" id="<?php echo $jugador->getId(); ?>" src="<?php echo image_path('fotos/' . $jugador->getFoto()); ?>" title="<?php echo $jugador->getAlias(); ?>" />
        <p style="position: relative; bottom: 0px;"><?php echo $jugador->getAlias(); ?>(<?php echo $jugador->countKillMuertessRelatedByIdAsesino(); ?>)</p>
      </div>
    <?php endif ?>
  <?php endforeach; ?>
</div>
