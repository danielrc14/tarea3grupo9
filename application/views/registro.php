<html lang="es">
    <head>
        <title>Registro</title>
        <meta charset="utf-8">
        <?php
        echo link_tag('css/bootstrap.min.css');
        echo link_tag('css/bootstrap-theme.min.css');
        ?>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <style>
            body{
                font-family: "Open Sans", sans-serif;
            }
        </style>
    </head>
    <body>
        <h1 style="text-align: center;">Formulario de registro</h1>
        <div class="col-lg-4">
            <?php
            echo form_open('controlador/agregar_usuario');
            echo '<div class="control-group">';
            echo form_label('Nombre:', 'nombre');
            $data_nombre= array('type'=>'text', 'name'=>'nombre', 'class'=>'form-control');
            echo form_input($data_nombre);
            echo '</div>';

            echo br(1);

            echo '<div class="control-group">';
            echo form_label('Apellido:', 'apellido');
            $data_apellido= array('type'=>'text', 'name'=>'apellido', 'class'=>'form-control');
            echo form_input($data_apellido);
            echo '</div>';

            echo br(1);

            echo '<div class="control-group">';
            echo form_label('Email:', 'email');
            $data_email= array('type'=>'text', 'name'=>'email', 'class'=>'form-control');
            echo form_input($data_email);
            echo '</div>';

            echo br(1);

            echo '<div class="control-group">';
            echo form_label('Avatar:', 'avatar');
            $data_avatar= array('type'=>'file', 'name'=>'avatar');
            echo form_input($data_avatar);
            echo '</div>';

            echo br(1);

            echo '<div class="control-group">';
            echo form_label('Username:', 'username');
            $data_username= array('type'=>'text', 'name'=>'username', 'class'=>'form-control');
            echo form_input($data_username);
            echo '</div>';

            echo br(1);

            echo '<div class="control-group">';
            echo form_label('Password:', 'password');
            $data_password= array('type'=>'password', 'name'=>'password', 'class'=>'form-control');
            echo form_input($data_password);
            echo '</div>';

            echo br(1);

            echo '<div class="control-group">';
            echo form_submit('', 'Registrarse');
            echo '</div>';
            echo form_close();
            ?>
        </div>
        <div class="col-lg-4">
          <?php
          echo anchor('controlador/index', 'Volver al inicio', '');
          ?>
        </div>
    </body>
</html>
