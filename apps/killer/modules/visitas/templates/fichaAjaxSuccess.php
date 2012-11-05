<dl class="dl-horizontal">
  <dt>Nombre</dt><dd><?php echo $jugador->getAlias();?></dd>
  <dt>Asesinatos</dt><dd><?php echo $jugador->countKillMuertessRelatedByIdAsesino(); ?></dd>
  <dt>Rango</dt><dd><?php echo $jugador->getRango(); ?></dd>
  <dt>Biografía</dt><dd><?php echo $sf_data->getRaw('jugador')->getDescripcion(); ?></dd>
</dl>