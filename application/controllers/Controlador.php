<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controlador extends CI_Controller {

	 function __construct(){
		parent::__construct();
		$this->load->model('modelo');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->library('form_validation');
		$this->load->database();
	}

	public function index(){
		$this->load->view('inicio');
	}

	public function agregar_usuario(){
		$this->form_validation->set_rules('nombre', 'Nombre', 'required', array('required' => 'Debe ingresar un %s.'));
		$this->form_validation->set_rules('username', 'Nombre de usuario', 'required', array('required' => 'Debe ingresar un %s.'));
		$this->form_validation->set_rules('password', 'Contraseña', 'required', array('required' => 'Debe ingresar una %s.'));
		$this->form_validation->set_rules('email', 'Correo electrónico', 'required', array('required' => 'Debe ingresar un %s.'));
		if($this->form_validation->run() == FALSE){
			//Agregar mensaje de error
			$this->load->view('header');
			$this->load->view('inicio');
		}
		else{
			//$data=array('nombre'=>$nombre, 'apellido'=>$apellido, 'avatar'=>$avatar, 'email'=$email,'username'=>$username,
      //'password'=>$password, 'status'=>$status, 'registro'=>'NOW()', 'ultima_sesion'=>'NOW()');
			$nombre = $this-> input ->post('nombre');
			$apellido = $this-> input ->post('apellido');
			$avatar = $this-> input ->post('avatar');
			$email = $this-> input ->post('email');
			$username = $this-> input ->post('username');
			$password = $this-> input ->post('password');
			$status = 0;
			if($this->modelo->agregar($nombre, $apellido, $avatar, $email, $username, $password, $status)){
				$this->load->view('header');
				//Ver qué views usar
				$data=array('username'=>$username);
				$this->load->view('ingresado', $data);
			}
			else{
				//Ver qué views usar
				$this->load->view('header');
				$this->load->view('fallo');
				$this->load->view('inicio');
			}
		}
	}

	public function login(){
		$this->form_validation->set_rules('username', 'Nombre de usuario', 'required', array('required' => 'Debe ingresar un %s.'));
		$this->form_validation->set_rules('password', 'Contraseña', 'required', array('required' => 'Debe ingresar una %s.'));
		if($this->form_validation->run() == FALSE){
			//Mensaje de fallo
			$this->load->view('header');
			$this->load->view('inicio');
		}
		else{
			$username = $this-> input ->post('username');
			$password = $this-> input ->post('password');
			$resultado = $this->modelo->login($username,$password);
			if($resultado != FALSE){
				$data = array('nombre' => $resultado->nombre, 'apellido' => $resultado->apellido);
				//Ver qué views
				$this->load->view('base');
				$this->load->view('welcome2', $data);
			}
			else{
				//Ver qué views
				echo "holi";
				$this->load->view('inicio');
			}
		}
	}
}
