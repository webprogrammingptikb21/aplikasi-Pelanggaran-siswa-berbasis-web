<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Home extends CI_Controller {

	public function __construct(){

		parent::__construct();


		/*-- untuk mengatasi error confirm form resubmission  --*/
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
		$this->load->model('home_model');
	}

	public function index(){

		if($this->session->userdata('level') == 'Admin'){
			redirect('Admin');
		}elseif($this->session->userdata('level') == 'Guru'){
			redirect('Guru');
		}elseif($this->session->userdata('level') == 'Wali'){
			redirect('Wali');
		}elseif($this->session->userdata('level') == 'Siswa'){
			redirect('Siswa');
		}

		$data['title'] = $this->home_model->website();
		$data['parent'] = "SIPS";
		$data['page'] = "Login";
		$this->template->load('home/layout/home_template','home/home_login',$data);


	}

	public function login(){

		$this->form_validation->set_rules('username','Username','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');

		if($this->form_validation->run() == false){

			$data['title'] = $this->home_model->website();
			$data['parent'] = $this->home_model->website();
			$data['page'] = "Login";
			$this->template->load('home/layout/home_template','home/home_login',$data);

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
							'school_name' => '1',

						];

						$this->session->set_userdata($data);

						if($user->level == 'Admin'){

							redirect('Admin');

						}elseif($user->level == 'Guru'){

							redirect('Guru');

						}elseif($user->level == 'Siswa'){

							redirect('Siswa');

						}elseif($user->level == 'Wali'){

							redirect('Wali');
						}
					}else{

						$this->toastr->error('Wrong Password!');
						redirect('Home');

					}
				}else{

					$this->toastr->error('User Not Active!');
					redirect('Home');
				}
			}else{

				$this->toastr->error('username Not Found!');
				redirect('Home');
			}
		}
	}
	public function blocked(){

		$data['title'] = "Acces Forbidden";
		$this->load->view('home/layout/home_403',$data);
	}


	public function logout(){

		$this->session->unset_userdata('username');
		$this->session->unset_userdata('level');
		$this->session->unset_userdata('school_name');
		$this->toastr->success('You have been logged out!');
		redirect(base_url());	

	}
}
