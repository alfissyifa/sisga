<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Login extends CI_Controller {

	public function __construct(){

		parent::__construct();


		/*-- untuk mengatasi error confirm form resubmission  --*/
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
		$this->load->model('login_model');
	}

	public function index(){

		if($this->session->userdata('level') == 'Admin'){
			redirect('admin');
		}elseif($this->session->userdata('level') == 'User'){
			redirect('aser');
		}
		$data['parent'] = "SISTEM INFORMASI KOPERASI";
		$data['page'] = "Login";
		$this->template->load('login/layout/login_template','login/login_login',$data);


	}

	public function login(){

		$this->form_validation->set_rules('username','Username','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');

		if($this->form_validation->run() == false){
			$data['page'] = "Login";
			$this->template->load('login/layout/login_template','login/login_login',$data);

		}else{

			$username = strip_tags($this->input->post('username'));
			$password = strip_tags($this->input->post('password'));

			$user = $this->db->get_where('tb_users',['username' => $this->db->escape_str($username)])->row();

			//Jika usernya Ada
			if($user){

				//jika usernya aktif
				if($user->status == 1){

					//cek password
					if(password_verify($this->db->escape_str($password), $user->password)){

						$data = [

							'username' => $user->username,
							'level' => $user->level,

						];

						$this->session->set_userdata($data);

						if($user->level == 'Admin'){

							redirect('admin');

						}elseif($user->level == 'User'){

							redirect('user');
						}
					}else{

						$this->toastr->error('Login Gagal, Username atau Password Salah!');
						redirect('login');

					}
				}else{

					$this->toastr->error('User Not Active!');
					redirect('login');
				}
			}else{

				$this->toastr->error('username Not Found!');
				redirect('login');
			}
		}
	}
	public function blocked(){

		$data['title'] = "Acces Forbidden";
		$this->load->view('login/layout/login_403',$data);
	}


	public function logout(){

		$this->session->unset_userdata('username');
		$this->session->unset_userdata('level');
		$this->toastr->success('Anda telah keluar dari SISGA OKU TIMUR.!');
		redirect(base_url());	

	}
}
