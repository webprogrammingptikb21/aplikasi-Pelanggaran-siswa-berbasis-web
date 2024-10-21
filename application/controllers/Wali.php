<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Wali extends CI_Controller {

	public function __construct(){

		parent::__construct();
		is_login();

		/*-- untuk mengatasi error confirm form resubmission  --*/
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
		$this->load->model('wali_model');
	}

	public function index(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		
		$data['oneSiswa'] = $this->wali_model->getOneSiswa(substr($this->session->userdata('username'), 4));

		$data['title'] = $this->wali_model->website();
		$data['parent'] = "Profile Anak";
		$data['page'] = "Profile Anak";
		$this->template->load('wali/layout/wali_template','wali/wali_profileAnak',$data);

	}

	public function pelanggaranAnak(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		
		$data['oneSiswa'] = $this->wali_model->getOneSiswa(substr($this->session->userdata('username'), 4));

		$data['pelanggaran'] = $this->wali_model->getPelanggaranByNiSN(substr($this->session->userdata('username'), 4));
		$data['pelanggaranTotal'] = $this->wali_model->getCountPelanggaran($this->wali_model->getOneSiswa(substr($this->session->userdata('username'), 4))->id_siswa);
		$data['onepel'] = $this->wali_model->getOnePelanggaran($this->wali_model->getOneSiswa(substr($this->session->userdata('username'), 4))->id_siswa);

		$data['title'] = $this->wali_model->website();
		$data['parent'] = "Pelanggaran Anak";
		$data['page'] = "Pelanggaran Anak";
		$this->template->load('wali/layout/wali_template','wali/wali_pelanggaranAnak',$data);

	}

	public function pelanggaranAnakOnePrint(){


		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		$data['oneWeb'] = $this->wali_model->getOneWebsite($this->session->userdata('school_name'));
		$data['onepel'] = $this->wali_model->getOnePelanggaran($this->wali_model->getOneSiswa(substr($this->session->userdata('username'), 4))->id_siswa);
		$data['oneSis'] = $this->wali_model->getOneSiswa(substr($this->session->userdata('username'), 4));

		$data['title'] = "List Pelanggaran Print";
		$data['parent'] = "List Pelanggaran";
		$data['page'] = "List Pelanggaran Print";
		$this->load->view('wali/wali_pelanggaranAnakonePrint',$data);

	}

	public function pelanggaranAnakAllPrint(){
		$this->load->library('mypdf');

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['oneWeb'] = $this->admin_model->getOneWebsite($this->session->userdata('school_name'));

		$data['hasilOne'] = $this->wali_model->getOneSiswa(substr($this->session->userdata('username'), 4));
		$data['hasilAll'] = $this->wali_model->getPelanggaranByNiSN(substr($this->session->userdata('username'), 4));
		$data['hasilTotal'] = $this->wali_model->getCountPelanggaran($this->wali_model->getOneSiswa(substr($this->session->userdata('username'), 4))->id_siswa);


		$data['title'] = $this->admin_model->website();
		$data['page'] = "Laporan Pelanggaran Anak ";
		$this->load->view('wali/wali_pelanggaranAnakAllPrint',$data);




	}


public function pelanggaranAnakDetail(){

	$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

	$data['oneSiswa'] = $this->wali_model->getOneSiswa(substr($this->session->userdata('username'), 4));
	$data['onepel'] = $this->wali_model->getOnePelanggaran($this->wali_model->getOneSiswa(substr($this->session->userdata('username'), 4))->id_siswa);

	$data['title'] = $this->wali_model->website();
	$data['parent'] = "List Pelanggaran Detail";
	$data['page'] = "List Pelanggaran Detail";
	$this->template->load('wali/layout/wali_template','wali/wali_pelanggaranAnakDetail',$data);

}
}
