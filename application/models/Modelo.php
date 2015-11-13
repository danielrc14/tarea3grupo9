<?php
Class Modelo extends CI_Model{
	function __construct(){
			parent::__construct();
			$this->load->database();
	}

	function login($username, $password){
		$this -> db -> select('nombre, apellido, username, password');
		$this -> db -> from('users');
		$this -> db -> where('username', $username);
		$this -> db -> where('password', $password);
		$this -> db -> limit(1);

		$query = $this -> db -> get();

		if($query -> num_rows() == 1){
			return $query->first_row();
		}
		else{
			return false;
		}
	}
	function agregar($nombre, $apellido, $avatar, $email, $username, $password, $status){
		$this -> db ->select('username');
		$this -> db -> from('users');
		$this -> db -> where('username', $username);
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1){
			return FALSE;
		}
		else{
			$data=array('nombre'=>$nombre, 'apellido'=>$apellido, 'avatar'=>$avatar, 'email'=>$email,'username'=>$username,
      'password'=>$password, 'status'=>$status, 'registro'=>'NOW()', 'ultima_sesion'=>'NOW()');
			$this->db->insert('users', $data);
			return TRUE;
		}
	}
}
?>
