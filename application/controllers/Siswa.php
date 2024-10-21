<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Siswa extends CI_Controller {

	public function __construct(){

		parent::__construct();
		is_login();

		/*-- untuk mengatasi error confirm form resubmission  --*/
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
		$this->load->model('siswa_model');
	}

	public function index(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		

		$data['oneSiswa'] = $this->siswa_model->getOneSiswa(substr($this->session->userdata('username'), 5));

		$data['title'] = $this->siswa_model->website();
		$data['parent'] = "Profile Siswa";
		$data['page'] = "Profile Siswa";
		$this->template->load('siswa/layout/siswa_template','siswa/siswa_profile',$data);

	}

	public function profile(){



		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		

		$data['oneSiswa'] = $this->siswa_model->getOneSiswa(substr($this->session->userdata('username'), 5));


		$this->form_validation->set_rules('nama','Nama Lengkap','required|trim');
		$this->form_validation->set_rules('wali','Nama Wali','required');
		$this->form_validation->set_rules('alamat','Alamat','required');		
		$this->form_validation->set_rules('telepon','No Telp / HP','required');

		if($this->form_validation->run() == false){

			$data['title'] = $this->siswa_model->website();
			$data['parent'] = "Profile Siswa";
			$data['page'] = "Profile Siswa";
			$this->template->load('siswa/layout/siswa_template','siswa/siswa_profile',$data);

		}else{

			//check jika ada gmabar yang akan diupload, "f" itu nama inputnya
			// $upload_image = $_FILES['photo']['name'];
			$filename = substr($this->session->userdata('username'), 5);

			$config['allowed_types'] = 'png';
			$config['max_size']     = '5120'; // dalam hitungan kilobyte(kb), aslinya 1mb itu 1024kb
			$config['upload_path'] = './assets/sips/img/siswa/';
			$config['overwrite'] = "TRUE";
			$config['file_name'] = $filename;


			$this->load->library('upload', $config);
			$this->upload->overwrite = true;

			if(! $this->upload->do_upload('picture')){

				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
				redirect('Siswa');


			}else{

				$data = [

					'std_name' => htmlspecialchars($this->input->post('nama')),
					'address' => $this->input->post('alamat'),
					'phone_number' => str_replace("-","",$this->input->post('telepon'))

				];

				$this->db->where('nisn', $this->input->post('z'));
				$this->db->update('tb_siswa',$data);

				$data1 = [

					'parent_name' => htmlspecialchars($this->input->post('wali')),
					'phone_number' => str_replace("-","",$this->input->post('telepon'))

				];

				$student_id = $this->siswa_model->getOneSiswa(substr($this->session->userdata('username'), 5))->id_siswa;

				$this->db->where('student_id', $student_id);
				$this->db->update('tb_wali',$data1);

				$this->toastr->success('Data Siswa  '.$this->input->post('nama').' dan Wali Telah Di Update!');
				redirect('Siswa');

			}

		}

	}


	public function listPelanggaran(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['oneSiswa'] = $this->siswa_model->getOneSiswa(substr($this->session->userdata('username'), 5));

		$data['pelanggaran'] = $this->siswa_model->getPelanggaranByNiSN(substr($this->session->userdata('username'), 5));
		$data['pelanggaranTotal'] = $this->siswa_model->getCountPelanggaran($this->siswa_model->getOneSiswa(substr($this->session->userdata('username'), 5))->id_siswa);
		$data['onepel'] = $this->siswa_model->getOnePelanggaran($this->siswa_model->getOneSiswa(substr($this->session->userdata('username'), 5))->id_siswa);

		$data['title'] = $this->siswa_model->website();
		$data['parent'] = "List Pelanggaran";
		$data['page'] = "List Pelanggaran";
		$this->template->load('siswa/layout/siswa_template','siswa/siswa_listPelanggaran',$data);

	}

	public function listPelanggaranDetail(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['oneSiswa'] = $this->siswa_model->getOneSiswa(substr($this->session->userdata('username'), 5));
		$data['onepel'] = $this->siswa_model->getOnePelanggaran($this->siswa_model->getOneSiswa(substr($this->session->userdata('username'), 5))->id_siswa);
		$data['title'] = $this->siswa_model->website();
		$data['parent'] = "List Pelanggaran Detail";
		$data['page'] = "List Pelanggaran Detail";
		$this->template->load('siswa/layout/siswa_template','siswa/siswa_listPelanggaranDetail',$data);

	}
}
