<div id="nav">
          <ul class="nav nav-tabs">
            <li ><a href="<?php echo url_for('visitas/index'); ?>">Jugadores</a></li>
            <li class="active"><a href="<?php echo url_for('visitas/blog'); ?>">Killer News</a></li>
            <li><a href="<?php echo url_for('visitas/normas'); ?>">Normativa</a></li>
                      
          </ul>
</div>

<div id="main_content">

<h1>Killer News</h1>

<?php foreach($noticias as $noticia): ?>
    <div class="span8">
        <h1><?php echo $noticia->getTitulo(); ?></h1>
        <p><?php echo $noticia->getNoticia(); ?></p>
        <div>
            <span class="badge badge-success">Posted 2012-08-02 20:47:04</span>
        </div> 
        <hr>
    </div>
<?php endforeach ?>


</div>


