
<link rel="stylesheet" href="js/bootstrap/css/bootstrap2.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootbox/bootbox.min.js"></script>

<?php

  require_once('php/geral.php');

  function AutenticaLinks($tipo_usuario_id) {
    if ($tipo_usuario_id == 2 || $tipo_usuario_id == 3 || $tipo_usuario_id == 4 || $tipo_usuario_id == 5 ||
        $tipo_usuario_id == 6 || $tipo_usuario_id == 7) {

      switch($tipo_usuario_id) {
        case 3:
        echo "
          <script>
            $(document).ready(function(){
              $('.menu').find('a').filter(':not(.administrativo)').attr('href', 'javascript: void(0)').css('cursor', 'default');
            });
          </script>
        ";
        break;
        case 4:
        echo "
          <script>
            $(document).ready(function(){
              $('.menu').find('a').filter(':not(.marketing)').attr('href', 'javascript: void(0)').css('cursor', 'default');
            });
          </script>
        ";
        break;
        case 5:
        echo "
          <script>
            $(document).ready(function(){
              $('.menu').find('a').filter(':not(.diretoria)').attr('href', 'javascript: void(0)').css('cursor', 'default');
            });
          </script>
        ";
        break;
        case 6:
        echo "
          <script>
            $(document).ready(function(){
              $('.menu').find('a').filter(':not(.gerenciador_usuarios)').attr('href', 'javascript: void(0)').css('cursor', 'default');
            });
          </script>
        ";
        break;
        case 7:
        echo "
          <script>
            $(document).ready(function(){
              $('.menu').find('a').filter(':not(.sac)').attr('href', 'javascript: void(0)').css('cursor', 'default');
            });
          </script>
        ";
        break;
      }



    } /*else {
      echo "
      <script>
        $(document).ready(function(){
          bootbox.alert('".ucfirst(strtolower($_SESSION['nome'])).", você está tentando acessar uma página restrita!', function() {
            $(location).attr('href', '../home.php');
          });
        });
      </script>";
    }*/

  }

  // Função que verifica se o usuário é funcionário do setor administrativo ou se é administrator
  function AutenticaAdministrativo($tipo_usuario_id) {
    if ($tipo_usuario_id != 2 && $tipo_usuario_id != 3) {
      // Verificando se o usuário é cliente
      if ($tipo_usuario_id < 2) {
        // echo "<script> alert('".ucfirst(strtolower($_SESSION['nome'])).", você está tentando acessar uma página restrita!'); location = '../home.php' </script>";
        echo "
        <script>
          $(document).ready(function(){
            bootbox.alert('".ucfirst(strtolower($_SESSION['nome'])).", você está tentando acessar uma página restrita!', function() {
              $(location).attr('href', '../home.php');
            });
          });
        </script>";
      // Verificando se o usuário é funcionário
      } else if($tipo_usuario_id > 2) {
        // echo "<script> alert('".ucfirst(strtolower($_SESSION['nome'])).", você está tentando acessar uma página na qual não tem acesso!'); location = 'index.php' </script>";
        echo "
        <script>
          $(document).ready(function(){
            bootbox.alert('".ucfirst(strtolower($_SESSION['nome'])).", você está tentando acessar uma página na qual não tem acesso!', function() {
              $(location).attr('href', 'index.php');
            });
          });
        </script>";
      // Verificando se o usuário quer burlar o sistema
      } else if(empty($tipo_usuario_id)) {
        //  echo "<script> alert('Você está tentando acessar uma página restrita!'); location = '../home.php' </script>";
        echo "
        <script>
          $(document).ready(function(){
            bootbox.alert('Você está tentando acessar uma página restrita!', function() {
              $(location).attr('href', '../home.php');
            });
          });
        </script>";
      }
    }
  }

  // Função que verifica se o usuário é funcionário do setor de marketing ou se é administrator
  function AutenticaMarketing($tipo_usuario_id) {
    if ($tipo_usuario_id != 2 && $tipo_usuario_id != 4) {
      // Verificando se o usuário é cliente
      if ($tipo_usuario_id < 2) {
        // echo "<script> alert('".ucfirst(strtolower($_SESSION['nome'])).", você está tentando acessar uma página restrita!'); location = '../home.php' </script>";
        echo "
        <script>
          $(document).ready(function(){
            bootbox.alert('".ucfirst(strtolower($_SESSION['nome'])).", você está tentando acessar uma página restrita!', function() {
              $(location).attr('href', '../home.php');
            });
          });
        </script>";
      // Verificando se o usuário é funcionário
      } else if($tipo_usuario_id > 2) {
        // echo "<script> alert('".ucfirst(strtolower($_SESSION['nome'])).", você está tentando acessar uma página na qual não tem acesso!'); location = 'index.php' </script>";
        echo "
        <script>
          $(document).ready(function(){
            bootbox.alert('".ucfirst(strtolower($_SESSION['nome'])).", você está tentando acessar uma página na qual não tem acesso!', function() {
              $(location).attr('href', 'index.php');
            });
          });
        </script>";
      // Verificando se o usuário quer burlar o sistema
      } else if(empty($tipo_usuario_id)) {
        //  echo "<script> alert('Você está tentando acessar uma página restrita!'); location = '../home.php' </script>";
        echo "
        <script>
          $(document).ready(function(){
            bootbox.alert('Você está tentando acessar uma página restrita!', function() {
              $(location).attr('href', '../home.php');
            });
          });
        </script>";
      }
    }
  }

  // Função que verifica se o usuário é funcionário do setor de diretoria ou se é administrator
  function AutenticaDiretoria($tipo_usuario_id) {
    if ($tipo_usuario_id != 2 && $tipo_usuario_id != 5) {
      // Verificando se o usuário é cliente
      if ($tipo_usuario_id < 2) {
        // echo "<script> alert('".ucfirst(strtolower($_SESSION['nome'])).", você está tentando acessar uma página restrita!'); location = '../home.php' </script>";
        echo "
        <script>
          $(document).ready(function(){
            bootbox.alert('".ucfirst(strtolower($_SESSION['nome'])).", você está tentando acessar uma página restrita!', function() {
              $(location).attr('href', '../home.php');
            });
          });
        </script>";
      // Verificando se o usuário é funcionário
      } else if($tipo_usuario_id > 2) {
        // echo "<script> alert('".ucfirst(strtolower($_SESSION['nome'])).", você está tentando acessar uma página na qual não tem acesso!'); location = 'index.php' </script>";
        echo "
        <script>
          $(document).ready(function(){
            bootbox.alert('".ucfirst(strtolower($_SESSION['nome'])).", você está tentando acessar uma página na qual não tem acesso!', function() {
              $(location).attr('href', 'index.php');
            });
          });
        </script>";
      // Verificando se o usuário quer burlar o sistema
      } else if(empty($tipo_usuario_id)) {
        //  echo "<script> alert('Você está tentando acessar uma página restrita!'); location = '../home.php' </script>";
        echo "
        <script>
          $(document).ready(function(){
            bootbox.alert('Você está tentando acessar uma página restrita!', function() {
              $(location).attr('href', '../home.php');
            });
          });
        </script>";
      }
    }
  }

  // Função que verifica se o usuário é funcionário do setor de gerenciamento de usuários ou se é administrator
  function AutenticaGerenciadorUsuarios($tipo_usuario_id) {
    if ($tipo_usuario_id != 2 && $tipo_usuario_id != 6) {
      // Verificando se o usuário é cliente
      if ($tipo_usuario_id < 2) {
        // echo "<script> alert('".ucfirst(strtolower($_SESSION['nome'])).", você está tentando acessar uma página restrita!'); location = '../home.php' </script>";
        echo "
        <script>
          $(document).ready(function(){
            bootbox.alert('".ucfirst(strtolower($_SESSION['nome'])).", você está tentando acessar uma página restrita!', function() {
              $(location).attr('href', '../home.php');
            });
          });
        </script>";
      // Verificando se o usuário é funcionário
      } else if($tipo_usuario_id > 2) {
        // echo "<script> alert('".ucfirst(strtolower($_SESSION['nome'])).", você está tentando acessar uma página na qual não tem acesso!'); location = 'index.php' </script>";
        echo "
        <script>
          $(document).ready(function(){
            bootbox.alert('".ucfirst(strtolower($_SESSION['nome'])).", você está tentando acessar uma página na qual não tem acesso!', function() {
              $(location).attr('href', 'index.php');
            });
          });
        </script>";
      // Verificando se o usuário quer burlar o sistema
      } else if(empty($tipo_usuario_id)) {
        //  echo "<script> alert('Você está tentando acessar uma página restrita!'); location = '../home.php' </script>";
        echo "
        <script>
          $(document).ready(function(){
            bootbox.alert('Você está tentando acessar uma página restrita!', function() {
              $(location).attr('href', '../home.php');
            });
          });
        </script>";
      }
    }
  }

  // Função que verifica se o usuário é funcionário do setor de sac ou se é administrator
  function AutenticaSAC($tipo_usuario_id) {
    if ($tipo_usuario_id != 2 && $tipo_usuario_id != 7) {
      // Verificando se o usuário é cliente
      if ($tipo_usuario_id < 2) {
        // echo "<script> alert('".ucfirst(strtolower($_SESSION['nome'])).", você está tentando acessar uma página restrita!'); location = '../home.php' </script>";
        echo "
        <script>
          $(document).ready(function(){
            bootbox.alert('".ucfirst(strtolower($_SESSION['nome'])).", você está tentando acessar uma página restrita!', function() {
              $(location).attr('href', '../home.php');
            });
          });
        </script>";
      // Verificando se o usuário é funcionário
      } else if($tipo_usuario_id > 2) {
        // echo "<script> alert('".ucfirst(strtolower($_SESSION['nome'])).", você está tentando acessar uma página na qual não tem acesso!'); location = 'index.php' </script>";
        echo "
        <script>
          $(document).ready(function(){
            bootbox.alert('".ucfirst(strtolower($_SESSION['nome'])).", você está tentando acessar uma página na qual não tem acesso!', function() {
              $(location).attr('href', 'index.php');
            });
          });
        </script>";
      // Verificando se o usuário quer burlar o sistema
      } else if(empty($tipo_usuario_id)) {
        //  echo "<script> alert('Você está tentando acessar uma página restrita!'); location = '../home.php' </script>";
        echo "
        <script>
          $(document).ready(function(){
            bootbox.alert('Você está acessando!', function() {
              $(location).attr('href', '../home.php');
            });
          });
        </script>";
      }
    }
  }

?>
