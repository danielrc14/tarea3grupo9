  <div class="row-fluid">
      <div class="col-lg-3">
          <?php
            echo "<h1> Bienvenido ".$_SESSION['nombre']." ".$_SESSION['apellido']."</h1>";
            echo "<p>Última sesión hace ".$_SESSION['days']." días</p>";
          ?>
      </div>
      <div class="col-lg-6" style="border: 1px solid #ccc; height: 100%;">

      </div>
    </div>
  </body>
</html>
