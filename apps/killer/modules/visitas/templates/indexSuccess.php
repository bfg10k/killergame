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
 <div style="float:left; margin: 50px 0 0 0;  width:140px; height: 120px;">
   <img id="<?php echo $jugador->getId(); ?>" width="70" style="padding:0 30px 0 10px;" src="<?php echo image_path('fotos/'.$jugador->getFoto()); ?>" />
   <div style="text-align: left;"><?php echo $jugador->getAlias(); ?></div>
 </div>	
<?php endforeach ?>

</div>

<div id="ficha_ajax" style="position: absolute; z-index: 20; background-color: whitesmoke; width: 500px;">
  
</div>

<script>
$(document).ready(function(){
  $("img").click(function(eventData,handler){
    $("#ficha_ajax").load("<?php echo url_for('visitas/fichaAjax'); ?>?id="+this.id);
    $('#ficha_ajax').css('top', eventData.pageY).css('left',eventData.pageX).show();
  });
});
</script>






