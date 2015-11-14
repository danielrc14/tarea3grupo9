<html lang="es">
  <head>
    <title>Bienvenido</title>
    <meta charset="utf-8">
    <?php
    echo link_tag('css/bootstrap.min.css');
    echo link_tag('css/bootstrap-theme.min.css');
    ?>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  </head>
  <style type="text/css">
    body{
        font-family: 'Open Sans', sans-serif;
    }
  </style>
  <body>
  <!-- NAVBAR -->
  <nav class="navbar navbar-default">
      <div class="navbar-header">
          <?php
          echo anchor('controlador/index', '<span class="glyphicon glyphicon-home" aria-hidden="true"></span>', 'class="navbar-brand"');
          ?>
      </div>
      <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
              <li><?php echo anchor('controlador/profile', 'Perfil', ''); ?></li>
              <li><?php echo anchor('controlador/lista_tutorias', 'Tutorías', ''); ?></li>
              <li><?php echo anchor('controlador/quienes_somos', 'Quienes somos', ''); ?></li>
              <li><?php echo anchor('controlador/contacto', 'Contacto', ''); ?></li>
          </ul>
          <form class="navbar-form navbar-right" role="search">
              <div class="form-group">
                  <input type="text" class="form-control" placeholder="Buscar Tutorías">
              </div>
              <button type="submit" class="btn btn-default">
                  <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
              </button>
          </form>
          <ul class="nav navbar-nav navbar-right">
            <li>
              <?php
              echo anchor('controlador/close_session', 'Cerrar sesión', '');
              ?></li>
          </ul>
      </div>
  </nav>
