  <?php
  $row = $this->modelo->get_user($_SESSION['user']);

  echo "<div class='col-lg-6'>";
    echo form_open('controlador/editar_usuario');
    echo "
      <h1>Editar datos usuario</h1>
      <br>
      <table class='table'>
      <tr>
      <td>  <div class='form-group'>
       ".form_label('Nombre:', 'nombre')."</td>
      <td>";
      $data_nombre= array('type'=>'text', 'name'=>'nombre', 'value'=>$row->nombre, 'class'=>'form-control');
      echo form_input($data_nombre);
      echo "</div></td>
      <td></td>
      </tr>

      <tr>
      <td>  <div class='form-group'>
        ".form_label('Apellido:', 'apellido')."</td>
      <td>";
      $data_apellido= array('type'=>'text', 'name'=>'apellido', 'value'=>$row->apellido, 'class'=>'form-control');
      echo form_input($data_apellido);
      echo "</div></td>
      <td></td>
      </tr>

      <tr>
      <td>  <div class='form-group'>
      ".form_label('Email:', 'email')."</td>
      <td>";
      $data_email= array('type'=>'text', 'name'=>'email', 'value'=>$row->email, 'class'=>'form-control');
      echo form_input($data_email);
      echo "</div></td>
      <td></td>
      </tr>

      <tr>
      <td>  <div class='form-group'>
      ".form_label('Avatar:', 'avatar')."</td>
      <td>";
      $data_avatar= array('type'=>'file', 'name'=>'avatar', 'class'=>'form-control');
      echo form_input($data_avatar);
      echo "</div></td>
      <td></td>
      </tr>

      <tr>
      <td>  <div class='form-group'>
       ".form_label('Username:', 'username')."</td>
      <td>";
      $data_username= array('type'=>'text', 'name'=>'username', 'value'=>$row->username, 'class'=>'form-control');
      echo form_input($data_username);
      echo "</div></td>
      <td></td>
      </tr>

      <tr>
      <td>  <div class='form-group'>
       ".form_label('Password:', 'password')."</td>
      <td>";
      $data_password= array('type'=>'password', 'name'=>'password', 'value'=>$row->password, 'class'=>'form-control');
      echo form_input($data_password);
      echo "</div></td>
      <td></td>
      </tr>

      <tr>
      <td></td>
      <td></td>
      <td><div class='form-group'>
                          ".form_submit('', 'Enviar')."</div></td>
      </tr>
      </table>
    </form>
  </div>";
?>
