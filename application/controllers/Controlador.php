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
		$this->load->library('session');
		$this->load->database();
	}

	public function index(){
		if($this->session->userdata('user')){
			$this->load->view('base');
			$this->load->view('welcome2');
		}
		else {
			$this->load->view('inicio');
		}
	}

	public function registro(){
		$this->load->view('registro');
	}

	public function profile(){
		if($this->session->userdata('user')){
			$this->load->view('base');
			$this->load->view('profile');
		}
		else {
			$this->load->view('inicio');
			echo "Para acceder a esta página, debe iniciar sesión";
		}
	}

	public function agregar_usuario(){
		$this->form_validation->set_rules('nombre', 'Nombre', 'required', array('required' => 'Debe ingresar un %s.'));
		$this->form_validation->set_rules('username', 'Nombre de usuario', 'required', array('required' => 'Debe ingresar un %s.'));
		$this->form_validation->set_rules('password', 'Contraseña', 'required', array('required' => 'Debe ingresar una %s.'));
		$this->form_validation->set_rules('email', 'Correo electrónico', 'required', array('required' => 'Debe ingresar un %s.'));
		if($this->form_validation->run() == FALSE){
			//Agregar mensaje de error
			$this->load->view('registro');
			echo "Registro fallido";
		}
		else{
			$nombre = $this-> input ->post('nombre');
			$apellido = $this-> input ->post('apellido');
			$avatar = $this-> input ->post('avatar');
			$email = $this-> input ->post('email');
			$username = $this-> input ->post('username');
			$password = $this-> input ->post('password');
			$status = 0;
			if($this->modelo->agregar($nombre, $apellido, $avatar, $email, $username, $password, $status)){
				$this->load->view('inicio');
				echo "Registro exitoso";
			}
			else{
				$this->load->view('registro');
				echo "Registro fallido";
			}
		}
	}

	public function login(){
		$this->form_validation->set_rules('username', 'Nombre de usuario', 'required', array('required' => 'Debe ingresar un %s.'));
		$this->form_validation->set_rules('password', 'Contraseña', 'required', array('required' => 'Debe ingresar una %s.'));
		if($this->form_validation->run() == FALSE){
			//Mensaje de fallo
			$this->load->view('inicio');
			echo "Debe ingresar usuario y contraseña";
		}
		else{
			$username = $this-> input ->post('username');
			$password = $this-> input ->post('password');
			$resultado = $this->modelo->login($username,$password);
			if($resultado != FALSE){
				//Iniciar sesión
				$newdata = array('user'=>$username, 'pass'=>$password, 'nombre' => $resultado->nombre, 'apellido' => $resultado->apellido);
				$this->session->set_userdata($newdata);
				//Cargar vistas
				$this->load->view('base');
				$this->load->view('welcome2');
			}
			else{
				//Ver qué views
				$this->load->view('inicio');
				echo "Nombre de usuario o contraseña incorrectos";
			}
		}
	}

	public function close_session(){
		$this->session->unset_userdata('user');
		$this->session->unset_userdata('pass');
		$this->session->unset_userdata('nombre');
		$this->session->unset_userdata('apellido');
		$this->load->view('inicio');
	}
}
