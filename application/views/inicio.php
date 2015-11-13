<?php
  //session_start();
  if (isset($_SESSION["user"])){
    header("location:./welcome2.php");
  }
?>
<html lang="es">
  <head>
    <title>Bienvenido</title>
    <meta charset="utf-8">
    <?php
    echo link_tag('css/bootstrap.min.css');
    echo link_tag('css/bootstrap-theme.min.css');
    ?>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <style>
        body{
            font-family: "Open Sans", sans-serif;
            text-align: center;
        }
    </style>
  </head>
  <body>
    <div class="login-container">
      <h1>Bienvenido a Tutomax</h1>
      <div class="container">
    <div class="row">
		<div class="span12">
      <?php
        $attributes_form = array('class'=>'form-horizontal');
        echo form_open('controlador/login', $attributes_form);
        echo '<fieldset>';
        echo '<div id="legend"><legend class="">Login</legend></div>';
        echo '<div class="control-group">';
        $attributes_label = array('class'=>'control-label');
        echo form_label('Usuario', 'username', $attributes_label);
        echo '<div class="controls">';
        $data= array('type'=>'text', 'id'=>'username', 'name'=>'username', 'placeholder'=>'Nombre de Usuario', 'class'=>'input-xlarge');
        echo form_input($data);
        echo '</div>';
        echo '</div>';
        echo '<div class="control-group">';
        echo form_label('Contraseña', 'password', $attributes_label);
        echo '<div class="controls">';
        $datap= array('type'=>'password', 'id'=>'password', 'name'=>'password', 'placeholder'=>'Contraseña', 'class'=>'input-xlarge');
        echo form_password($datap);
        echo '</div>';
        echo '</div>';
        echo '<div class="control-group">';
        echo '<div class="controls">';
        echo form_submit('', 'Iniciar Sesión');
        echo '</div>';
        echo '</div>';
        echo '</fieldset>';
        echo form_close();
			?>
		</div>
	</div>
    <!-- Cambiar esto a otra hueá -->
    <a href="registro.php">Regístrate</a>
</div>
      <?php
        $error = '<span>Fallo en el inicio de sesión.</span>';

        if (isset($_SESSION["error"]) && $_SESSION["error"]==="error"){
          echo $error;
          session_destroy();
        }
      ?>
    </div>
  </body>
</html>
