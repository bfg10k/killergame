<div id="nav">
          <ul class="nav nav-tabs">
            <li class="active"><a href="<?php echo url_for('visitas/index'); ?>">Jugadores</a></li>
            <li><a href="<?php echo url_for('visitas/blog'); ?>">Killer News</a></li>
            <li><a href="<?php echo url_for('visitas/normas'); ?>">Normativa</a></li>
                      
          </ul>
</div>

<div id="main_content">
<h1>Jugadores</h1>

<?php foreach($jugadores as $jugador): ?>  
 <div id="jugador">
   <img width="70" class="foto_visitas" id="<?php echo $jugador->getId(); ?>" src="<?php echo image_path('fotos/'.$jugador->getFoto()); ?>" title="<?php echo $jugador->getAlias(); ?>" />
   <p><?php echo $jugador->getAlias(); ?></p>
 </div>	
<?php endforeach ?>

</div>

<div id="ficha_ajax">
  
</div>

<script>
$(document).ready(function(){
  $(".foto_visitas").click(function(eventData,handler){
    $("#ficha_ajax").load("<?php echo url_for('visitas/fichaAjax'); ?>?id="+this.id);
    $('#ficha_ajax').css('top', eventData.pageY).css('left',eventData.pageX).show();
  });
  $("#ficha_ajax").mouseleave(function(eventData,handler){
    $('#ficha_ajax').hide();
  });
});
</script>






