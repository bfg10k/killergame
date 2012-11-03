<div id="nav">
          <ul class="nav nav-tabs">
            <li ><a href="<?php echo url_for('visitas/index'); ?>">Jugadores</a></li>
            <li class="active"><a href="<?php echo url_for('visitas/blog'); ?>">Killer News</a></li>
            <li><a href="<?php echo url_for('visitas/normas'); ?>">Normativa</a></li>
                      
          </ul>
</div>

<div id="main_content">

<h1>Killer News</h1>

<?php foreach($sf_data->getRaw('noticias') as $noticia): ?>
    <div class="span8">
        <h1><?php echo $noticia->getTitulo(); ?></h1>
        <?php $foto = $noticia->getFotoNoticia(); if(!empty($foto)):?><img src="<?php echo image_path('../uploads/news/'.$noticia->getFotoNoticia()); ?> " /><?php endif ?>
        <p><?php echo $noticia->getNoticia(); ?></p>
        <div>
            <span class="badge badge-success">Publicado <?php echo $noticia->getFecha('d-m-Y H:i'); ?></span>
        </div> 
        <hr>
    </div>
<?php endforeach ?>


</div>


