<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controlador extends CI_Controller {

	 function __construct(){
		parent::__construct();
		date_default_timezone_set('America/Santiago');
		$this->load->model('modelo');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('date');
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
			$data=array('mensaje'=>'', 'color'=>'green');
			$this->load->view('mensaje', $data);
		}
	}

	public function registro(){
		$this->load->view('registro');
		$data=array('mensaje'=>'', 'color'=>'green');
		$this->load->view('mensaje', $data);
	}

	public function profile(){
		if($this->session->userdata('user')){
			$this->load->view('base');
			$this->load->view('profile');
			$data=array('mensaje'=>'', 'color'=>'green');
			$this->load->view('mensaje', $data);
		}
		else {
			$this->load->view('inicio');
			$data=array('mensaje'=>'Para acceder a esta página, debe iniciar sesión', 'color'=>'red');
			$this->load->view('mensaje', $data);
		}
	}

	public function editar_perfil(){
		if($this->session->userdata('user')){
			$this->load->view('base');
			$this->load->view('editar_perfil');
			$data=array('mensaje'=>'', 'color'=>'green');
			$this->load->view('mensaje', $data);
		}
		else {
			$this->load->view('inicio');
			$data=array('mensaje'=>'Para acceder a esta página, debe iniciar sesión', 'color'=>'red');
			$this->load->view('mensaje', $data);
		}
	}

	public function quienes_somos(){
		if($this->session->userdata('user')){
			$this->load->view('base');
			$this->load->view('quienes_somos');
		}
		else {
			$this->load->view('inicio');
			$data=array('mensaje'=>'Para acceder a esta página, debe iniciar sesión', 'color'=>'red');
			$this->load->view('mensaje', $data);
		}
	}

	public function contacto(){
		if($this->session->userdata('user')){
			$this->load->view('base');
			$this->load->view('contacto');
		}
		else {
			$this->load->view('inicio');
			$data=array('mensaje'=>'Para acceder a esta página, debe iniciar sesión', 'color'=>'red');
			$this->load->view('mensaje', $data);
		}
	}

	public function lista_tutorias(){
		if($this->session->userdata('user')){
			$this->load->view('base');
			$this->load->view('lista_tutorias');
		}
		else {
			$this->load->view('inicio');
			$data=array('mensaje'=>'Para acceder a esta página, debe iniciar sesión', 'color'=>'red');
			$this->load->view('mensaje', $data);
		}
	}

	public function agregar_usuario(){
		$this->form_validation->set_rules('nombre', 'Nombre', 'required', array('required' => 'Debe ingresar un %s.'));
		$this->form_validation->set_rules('apellido', 'Apellido', 'required', array('required' => 'Debe ingresar un %s.'));
		$this->form_validation->set_rules('email', 'Correo electrónico', 'required', array('required' => 'Debe ingresar un %s.'));
		$this->form_validation->set_rules('avatar', 'Avatar', 'required', array('required' => 'Debe ingresar un %s.'));
		$this->form_validation->set_rules('username', 'Nombre de usuario', 'required', array('required' => 'Debe ingresar un %s.'));
		$this->form_validation->set_rules('password', 'Contraseña', 'required', array('required' => 'Debe ingresar una %s.'));
		if($this->form_validation->run() == FALSE){
			$this->load->view('registro');
			$data=array('mensaje'=>'Debe ingresar todos los campos', 'color'=>'red');
			$this->load->view('mensaje', $data);
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
				$data=array('mensaje'=>'Registro exitoso', 'color'=>'green');
				$this->load->view('mensaje', $data);
			}
			else{
				$this->load->view('registro');
				$data=array('mensaje'=>'Nombre de usuario ya existente', 'color'=>'red');
				$this->load->view('mensaje', $data);
			}
		}
	}

	public function editar_usuario(){
		$this->form_validation->set_rules('nombre', 'Nombre', 'required', array('required' => 'Debe ingresar un %s.'));
		$this->form_validation->set_rules('apellido', 'Apellido', 'required', array('required' => 'Debe ingresar un %s.'));
		$this->form_validation->set_rules('email', 'Correo electrónico', 'required', array('required' => 'Debe ingresar un %s.'));
		$this->form_validation->set_rules('avatar', 'Avatar', 'required', array('required' => 'Debe ingresar un %s.'));
		$this->form_validation->set_rules('username', 'Nombre de usuario', 'required', array('required' => 'Debe ingresar un %s.'));
		$this->form_validation->set_rules('password', 'Contraseña', 'required', array('required' => 'Debe ingresar una %s.'));
		if($this->form_validation->run()==FALSE){
			$this->load->view('base');
			$this->load->view('editar_perfil');
			$data=array('mensaje'=>'No se pueden dejar los campos en blanco', 'color'=>'red');
			$this->load->view('mensaje', $data);
		}
		else{
			$data = array(
				'nombre' => $this-> input ->post('nombre'),
				'apellido' => $this-> input ->post('apellido'),
				'avatar' => $this-> input ->post('avatar'),
				'email' => $this-> input ->post('email'),
				'username' => $this-> input ->post('username'),
				'password' => $this-> input ->post('password')
			);
			if($this->modelo->edit_user($data)!=FALSE){
				$newdata = array('user'=>$data['username'], 'pass'=>$data['password'], 'nombre'=>$data['nombre'], 'apellido'=>$data['apellido']);
				$this->session->set_userdata($newdata);
				$this->load->view('base');
				$this->load->view('profile');
				$data=array('mensaje'=>'Datos actualizados', 'color'=>'green');
				$this->load->view('mensaje', $data);
			}
			else{
				$this->load->view('base');
				$this->load->view('editar_perfil');
				$data=array('mensaje'=>'Nombre de usuario en uso', 'color'=>'red');
				$this->load->view('mensaje', $data);
			}
		}
	}

	public function login(){
		$this->form_validation->set_rules('username', 'Nombre de usuario', 'required', array('required' => 'Debe ingresar un %s.'));
		$this->form_validation->set_rules('password', 'Contraseña', 'required', array('required' => 'Debe ingresar una %s.'));
		if($this->form_validation->run() == FALSE){
			$this->load->view('inicio');
			$data=array('mensaje'=>'Debe ingresar usuario y contraseña', 'color'=>'red');
			$this->load->view('mensaje', $data);
		}
		else{
			$username = $this-> input ->post('username');
			$password = $this-> input ->post('password');
			$resultado = $this->modelo->login($username,$password);
			if($resultado != FALSE){
				//Iniciar sesión
				$days = $this->modelo->get_dias_ultima_sesion($username);
				$newdata = array('user'=>$username, 'pass'=>$password, 'nombre' => $resultado->nombre, 'apellido' => $resultado->apellido, 'days' => $days);
				$this->session->set_userdata($newdata);
				//Actualizar última sesión
				$this->modelo->set_ultima_sesion($username);
				//Cargar vistas
				$this->load->view('base');
				$this->load->view('welcome2');
			}
			else{
				//Ver qué views
				$this->load->view('inicio');
				$data=array('mensaje'=>'Nombre de usuario o contraseña incorrectos', 'color'=>'red');
				$this->load->view('mensaje', $data);
			}
		}
	}

	public function close_session(){
		$this->session->unset_userdata('user');
		$this->session->unset_userdata('pass');
		$this->session->unset_userdata('nombre');
		$this->session->unset_userdata('apellido');
		$this->load->view('inicio');
		$data=array('mensaje'=>'', 'color'=>'green');
		$this->load->view('mensaje', $data);
	}
}
