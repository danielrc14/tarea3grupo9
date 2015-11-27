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

	function agregar($nombre, $apellido, $email, $username, $password, $status){
		$now=date('Y:m:d');
		$data=array('nombre'=>$nombre, 'apellido'=>$apellido, 'email'=>$email,'username'=>$username,
    'password'=>$password, 'status'=>$status, 'registro'=>$now, 'ultima_sesion'=>$now);
		$this->db->insert('users', $data);
		return TRUE;
	}

	function usuario_disponible($username){
		$this -> db ->select('username');
		$this -> db -> from('users');
		$this -> db -> where('username', $username);
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1){
			return FALSE;
		}
		else{
			return TRUE;
		}
	}

	function get_user($username){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('username', $username);
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->first_row();
	}

	function get_user_by_id($id){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $id);
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->first_row();
	}

	function edit_user($data){
		if($_SESSION['user']!=$data['username']){
			$this -> db -> select('username');
			$this -> db -> from('users');
			$this -> db -> where('username', $data['username']);
			$this -> db -> limit(1);
			$query = $this -> db -> get();
			if($query -> num_rows() == 1)
				return FALSE;
		}
		$this->db->where('username', $_SESSION['user']);
		$this->db->update('users', $data);

		return TRUE;
	}

	function set_ultima_sesion($username){
		$now=date('Y:m:d');
		$data = array('ultima_sesion' => $now);
		$this->db->where('username', $username);
		$this->db->update('users', $data);
	}

	function get_dias_ultima_sesion($username){
		$now=time();

		$this->db->select('ultima_sesion');
		$this->db->from('users');
		$this->db->where('username', $username);
		$this->db->limit(1);
		$query = $this->db->get();
		$row = $query->first_row();
		$last = $row->ultima_sesion;

		//return (strtotime($now)-strtotime($last))/86400;
		return floor(($now-strtotime($last))/86400);
	}

	function set_avatar($username, $avatar){
		$data=array('avatar' => $avatar);
		$this->db->where('username', $username);
		$this->db->update('users', $data);
	}

	function get_tutoria($id){
		$this->db->select('*');
		$this->db->from('tutorias');
		$this->db->where('id', $id);
		$query=$this->db->get();
		if($query->num_rows()==0){
			return false;
		}
		else {
			return $query->first_row();
		}
	}

	function get_reviews($id){
		$this->db->select('*');
		$this->db->from('reviews');
		$this->db->where('tutoria', $id);
		return $query=$this->db->get();
	}

	function add_review($tutoria, $texto, $user_id){
		$now=date('Y:m:d');
		$data=array('review'=>$texto, 'fecha'=>$now, 'poster'=>$user_id, 'tutoria'=>$tutoria);
		$this->db->insert('reviews', $data);
	}
}
?>
