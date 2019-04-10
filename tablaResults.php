<?php
require_once __DIR__.'/includes/comun/config.php';
require_once __DIR__.'/includes/Torneos/results.php';
?>
<div class="tabla">
<?php
   MostrarResults::getResults(16);
  ?>
</div>
<div class="podium">
   <?php
   MostrarResults::getResults(3);
  ?>
</div>
