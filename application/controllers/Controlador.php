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

	public function detalle_tutoria(){
		if($this->session->userdata('user')){
			$id=intval($this->uri->segment(3, 0));
			$row = $this->modelo->get_tutoria($id);
			if($row==false){
				$this->load->view('base');
				$this->load->view('welcome2');
			}
			else{
				$this->load->view('base');
				$this->load->view('detalle_tutoria', $row);
			}
		}
		else {
			$this->load->view('inicio');
			$data=array('mensaje'=>'Para acceder a esta página, debe iniciar sesión', 'color'=>'red');
			$this->load->view('mensaje', $data);
		}
	}

	public function agregar_review(){
		if($this->session->userdata('user')){
			$tutoria=intval($this->uri->segment(3, 0));
			$review_text=$this->input->post('review_text');
			$user=$this->modelo->get_user($_SESSION['user']);
			$this->modelo->add_review($tutoria, $review_text, $user->id);

			$this->load->view('base');
			$row = $this->modelo->get_tutoria($tutoria);
			$this->load->view('detalle_tutoria', $row);
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
			$email = $this-> input ->post('email');
			$username = $this-> input ->post('username');
			$password = $this-> input ->post('password');
			$status = 0;
			if($this->modelo->usuario_disponible($username)){
				$config['upload_path']='./avatars/';
				$config['allowed_types']='gif|jpg|png';
				$config['file_name']='test';
				$this->load->library('upload', $config);
				if ( !$this->upload->do_upload('avatar')){
					$this->load->view('registro');
					$data=array('mensaje'=>$this->upload->display_errors(), 'color'=>'red');
					$this->load->view('mensaje', $data);
					return;
	      }
				$this->modelo->agregar($nombre, $apellido, $email, $username, $password, $status);
				$row=$this->modelo->get_user($username);
				unlink(glob('./avatars/test.*')[0]);
				$config['file_name']='avatar'.$row->id;
				$this->upload->initialize($config);
				$this->upload->do_upload('avatar');
				$this->modelo->set_avatar($username, $this->upload->file_name);

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
		$this->form_validation->set_rules('username', 'Nombre de usuario', 'required', array('required' => 'Debe ingresar un %s.'));
		$this->form_validation->set_rules('password', 'Contraseña', 'required', array('required' => 'Debe ingresar una %s.'));
		if($this->form_validation->run()==FALSE){
			$this->load->view('base');
			$this->load->view('editar_perfil');
			$data=array('mensaje'=>'No se pueden dejar los campos en blanco', 'color'=>'red');
			$this->load->view('mensaje', $data);
		}
		else{
			$row=$this->modelo->get_user($_SESSION['user']);
			if(sizeof(glob('./avatars/avatar'.$row->id.'.*'))!=0)
				unlink(glob('./avatars/avatar'.$row->id.'.*')[0]);
			$config['upload_path']='./avatars/';
			$config['allowed_types']='gif|jpg|png';
			$config['file_name']='avatar'.$row->id;
			$this->load->library('upload', $config);
			if ( !$this->upload->do_upload('avatar')){
				$this->load->view('base');
				$this->load->view('editar_perfil');
				$data=array('mensaje'=>$this->upload->display_errors(), 'color'=>'red');
				$this->load->view('mensaje', $data);
				return;
      }

			$data = array(
				'nombre' => $this-> input ->post('nombre'),
				'apellido' => $this-> input ->post('apellido'),
				'avatar' => $this->upload->file_name,
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
		if($this->session->userdata('user')){
			$this->load->view('base');
			$this->load->view('welcome2');
		}
		else{
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
					$this->load->view('inicio');
					$data=array('mensaje'=>'Nombre de usuario o contraseña incorrectos', 'color'=>'red');
					$this->load->view('mensaje', $data);
				}
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
