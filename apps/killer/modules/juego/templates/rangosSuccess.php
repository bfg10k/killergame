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
    <li><a href="<?php echo url_for('juego/normas'); ?>"><i class="icon-align-justify"></i> Normativa</a></li>
    <li class="active"><a href="<?php echo url_for('juego/rangos'); ?>"><i class="icon-certificate icon-white"></i> Rango mafioso</a></li>
    </ul>
</div>
     
<div id="content-user">
  <div id="rangos">
    <dt>Don</dt><dl>Es el jefe de la familia.</dl>
    <dt>Sottocapo</dt><dl>Es la mano derecha del jefe. Hace de Don en caso de que esté incapacitado.</dl>
    <dt>Consigliere</dt><dl>Es el consejero del Don, le asesora en decisiones importantes.</dl>
    <dt>Caporegime</dt><dl>Es el superior al Capodecime.</dl>
    <dt>Capodecime</dt><dl>Dirige a una decena de hombres.</dl>
    <dt>Soldato</dt><dl>Son los conocidos sicarios de la mafia.</dl>
    <dt>Associato</dt><dl>Aspirantes a soldatto, aun no han sido admitidos en la familia.</dl>
  </div>
</div>
