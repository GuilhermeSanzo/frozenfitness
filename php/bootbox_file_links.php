


<?php

  if (strpos($_SERVER['REQUEST_URI'], "php") !== false){
?>
  <link rel="stylesheet" href="../FrozenFitness/cms/js/bootstrap/css/bootstrap2.css">
  <script type="text/javascript" src="../FrozenFitness/cms/js/jquery.min.js"></script>
  <script type="text/javascript" src="../FrozenFitness/cms/js/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../FrozenFitness/cms/js/bootbox/bootbox.min.js"></script>
<?php
  } else {
?>
  <link rel="stylesheet" href="/FrozenFitness/cms/js/bootstrap/css/bootstrap2.css">
  <script type="text/javascript" src="/FrozenFitness/cms/js/jquery.min.js"></script>
  <script type="text/javascript" src="/FrozenFitness/cms/js/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/FrozenFitness/cms/js/bootbox/bootbox.min.js"></script>
<?php
  }
?>
