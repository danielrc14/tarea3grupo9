  <div class="row-fluid">
      <?php
        $row = $this->modelo->get_user($_SESSION['user']);
        $img_attributes=array('src'=>'avatars/'.$row->avatar, 'alt'=>'profile pic', 'class'=>'img-thumbnail img-responsive');
        echo "<div class='col-lg-3'>".img($img_attributes)."
        </div>
        <div class='col-lg-6'>
            <h2>".$row->nombre." ".$row->apellido."<br>
            <small>".$row->username."</small></h2>
            <span>".$row->email."</span><br>
        </div>

        <div class='col-lg-3' style=''>
            ".anchor('controlador/editar_perfil', '<button class="btn btn-default" style="float: right;">Editar perfil</button>', '')."</div>";
      ?>
  </div>
