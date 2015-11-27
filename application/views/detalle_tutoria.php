<div class="row-fluid">
    <?php
      $usuario_tutoria=$this->modelo->get_user_by_id($user);
      $reviews=$this->modelo->get_reviews($id);
      echo "</div>
      <div class='container'>
        <h1>".$titulo."</h1><br>
        <ul class='list-group col-lg-9'>
          <li class='list-group-item'>Descripción: ".$texto."</li>
          <li class='list-group-item'>Fecha: ".$fecha."</li>
          <li class='list-group-item'>Cupos: ".$cupos."</li>
          <li class='list-group-item'>Tag: ".$tag."</li>
          <li class='list-group-item'>Usuario: ".$usuario_tutoria->username."</li>
          <li class='list-group-item'>Email: ".$usuario_tutoria->email."</li>
        </ul>
        <br>
      </div>
      <div class='container'>
        <h3>Reviews</h3>";
        if($reviews->num_rows()==0){
          echo "<p>No hay ningún review para esta tutoría</p>";
        }
        else{
          echo"<ul class='list-group col-lg-9'>";
          foreach ($reviews->result() as $review) {
            $usuario_review=$this->modelo->get_user_by_id($review->poster);
            echo
            "<li class='list-group-item'>
              <font color='gray'>Por <i>".$usuario_review->username."</i> el ".$review->fecha."</font>
              <p>".$review->review."</p>
            </li>";
          }
          echo "</ul>";
        }

      echo "</div>";

      echo
      "<div class='container'>
        <h3>Escribir un review</h3>";
      echo form_open('controlador/agregar_review/'.$id);
      echo
        "<textarea class='form-control' name='review_text' cols='10' rows='10'></textarea>
        <button class='btn btn-default' type='submit'>Enviar review</button>
      </div>"
    ?>
</div>
</body>
</html>
