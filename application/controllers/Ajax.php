<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Ajax extends CI_Controller {

	public function __construct(){

		parent::__construct();


		/*-- untuk mengatasi error confirm form resubmission  --*/
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
		$this->load->model('ajax_model');
		$this->load->model('admin_model');
	}

	/*-- Server-side Data Pelanggaran --*/
	public function pelanggaranData(){

		$kelas = $this->admin_model->getKelas(); 	/*-- Load Semua Data Kelas --*/
		$siswa = $this->admin_model->getSiswa(); 	/*-- Load Semua Data Siswa --*/
		$list = $this->ajax_model->get_pelanggaran();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nisn;

			foreach ($siswa as $sis ) {

				if ($sis->id == $field->student_id) {

					$row[] =  $sis->std_name;

				}
			};

			foreach ($kelas as $kel ) {

				if ($kel->id == $field->class_id) {

					$row[] =  $kel->class_name;

				}
			};
			$row[] = $field->note;

			if($this->session->userdata('level') == 'Admin'){

				$row[] = '
				<a class="btn btn-sm btn-primary" style="margin-right:10px; width: 32px; height: 32px;" href="../Admin/dataKategoriListPelanggaranPrint/'.$this->encrypt->encode($field->id).'" target="blank" title="Print"><i class="fas fa-print"></i></a>
				<a class="btn btn-sm btn-info" style="margin-right:10px; height:32px; width:32px;" href="../Admin/dataKategoriListPelanggaranDetail/'.$this->encrypt->encode($field->id).'" title="Detail"><i class="fas fa-info"></i></a>
				<a class="btn btn-sm btn-warning" style="margin-right:10px; height:32px; width:32px;" href="../Admin/dataKategoriListPelanggaranEdit/'.$this->encrypt->encode($field->id).'" title="Edit"><i class="fas fa-edit text-light"></i></a>
				<a class="btn btn-sm btn-danger" style="margin-right:10px; height:32px; width:32px;"  id="'.$field->id.'" onclick="deleteDataPel('.$field->id.')" title="Delete"><i class="fas fa-trash text-white"></i></a>
				';

			}elseif($this->session->userdata('level') == 'Guru'){

				$row[] = '
				<a class="btn btn-sm btn-primary" style="margin-right:10px; width: 32px; height: 32px;" href="../Guru/listPelanggaranPrint/'.$this->encrypt->encode($field->id).'" target="blank" title="Print"><i class="fas fa-print"></i></a>
				<a class="btn btn-sm btn-info" style="margin-right:10px; height:32px; width:32px;" href="../Guru/listPelanggaranDetail/'.$this->encrypt->encode($field->id).'" title="Detail"><i class="fas fa-info"></i></a>
				<a class="btn btn-sm btn-warning" style="margin-right:10px; height:32px; width:32px;" href="../Guru/listPelanggaranEdit/'.$this->encrypt->encode($field->id).'" title="Edit"><i class="fas fa-edit text-light"></i></a>
				<a class="btn btn-sm btn-danger" style="margin-right:10px; height:32px; width:32px;" id="'.$field->id.'" onclick="deleteDataPel('.$field->id.')" title="Delete"><i class="fas fa-trash text-white"></i></a>
				';

			}

			$data[] = $row;

		}

		$output = array(

			"draw" => $_POST['draw'],
			"recordsTotal" => $this->ajax_model->count_all_pelanggaran(),
			"recordsFiltered" => $this->ajax_model->count_filtered_pelanggaran(),
			"data" => $data,

		);

		/*-- Output Dalam Format JSON --*/
		echo json_encode($output);

	}

	public function fetch_subNamakelas(){
		if($this->input->post('kelas')){
			echo $this->ajax_model->fetch_subNamakelas($this->input->post('kelas'));
		}
	}

	public function fetch_subNamaSiswa(){
		if($this->input->post('namaKelas')){
			echo $this->ajax_model->fetch_subNamaSiswa($this->input->post('namaKelas'));
		}
	}

	/*-- Server-side Data Siswa --*/
	public function siswaData(){

		$kelas = $this->admin_model->getKelas(); 	/*-- Load Semua Data Kelas --*/
		$list = $this->ajax_model->get_siswa();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nisn;
			$row[] = $field->std_name;

			foreach ($kelas as $kel ) {

				if ($kel->id == $field->class_id) {

					$row[] =  $kel->class_name;

				}
			};

			if($this->session->userdata('level') == 'Admin'){

				$row[] = '
				<a class="btn btn-sm btn-info" style="margin-right:10px; height:32px; width:32px;" href="../Admin/dataMasterSiswaDetail/'.$this->encrypt->encode($field->id).'" title="Detail"><i class="fas fa-info"></i></a>
				<a class="btn btn-sm btn-warning" style="margin-right:10px; height:32px; width:32px;" href="../Admin/dataMasterSiswaEdit/'.$this->encrypt->encode($field->id).'" title="Edit"><i class="fas fa-edit text-light"></i></a>
				<a class="btn btn-sm btn-danger" style="margin-right:10px; height:32px; width:32px;" id="'.$field->id.'" onclick="deleteDataSiswa('.$field->id.')" title="Delete"><i class="fas fa-trash text-white"></i></a>
				';

			}elseif($this->session->userdata('level') == 'Guru'){

				$row[] = '
				<a class="btn btn-sm btn-info" style="margin-right:10px; height:32px; width:32px;" href="../Guru/listSiswaDetail/'.$this->encrypt->encode($field->id).'" title="Detail"><i class="fas fa-info"></i></a>
				<a class="btn btn-sm btn-warning" style="margin-right:10px; height:32px; width:32px;" href="../Guru/listSiswaEdit/'.$this->encrypt->encode($field->id).'" title="Edit"><i class="fas fa-edit text-light"></i></a>
				<a class="btn btn-sm btn-danger" style="margin-right:10px; height:32px; width:32px;" id="'.$field->id.'" onclick="deleteDataSiswa('.$field->id.')" title="Delete"><i class="fas fa-trash text-white"></i></a>
				';

			}

			$data[] = $row;

		}

		$output = array(

			"draw" => $_POST['draw'],
			"recordsTotal" => $this->ajax_model->count_all_siswa(),
			"recordsFiltered" => $this->ajax_model->count_filtered_siswa(),
			"data" => $data,

		);

		/*-- Output Dalam Format JSON --*/
		echo json_encode($output);

	}


	/*-- Server-side Data Pengguna --*/
	public function penggunaData(){

		$list = $this->ajax_model->get_pengguna();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->full_name;
			$row[] = $field->username;
			$row[] = $field->level;

			if($field->status == 1){
				$row[] = '<button class="btn btn-sm btn-success" title="Detail" readonly >Active</button>';
			}else{
				$row[] = '<button class="btn btn-sm btn-danger" title="Detail" readonly >Not Active</button>';
			};
			$row[] = '
			<a class="btn btn-sm btn-info" style="margin-right:10px; height:32px; width:32px;" href="../Admin/pengaturanPenggunaDetail/'.$this->encrypt->encode($field->id).'" title="Detail"><i class="fas fa-info"></i></a>
			<a class="btn btn-sm btn-warning" style="margin-right:10px; height:32px; width:32px;" href="../Admin/pengaturanPenggunaEdit/'.$this->encrypt->encode($field->id).'" title="Edit"><i class="fas fa-edit text-light"></i></a>
			<a class="btn btn-sm btn-danger" style="margin-right:10px; height:32px; width:32px;" id="'.$field->id.'" onclick="deleteDataPengguna('.$field->id.')"  title="Delete"><i class="fas fa-trash text-white"></i></a>
			';

			$data[] = $row;

		}

		$output = array(

			"draw" => $_POST['draw'],
			"recordsTotal" => $this->ajax_model->count_all_pengguna(),
			"recordsFiltered" => $this->ajax_model->count_filtered_pengguna(),
			"data" => $data,

		);

		/*-- Output Dalam Format JSON --*/
		echo json_encode($output);

	}



	public function fetch_nikGuru(){

		if($this->input->post('idGuru')){

			$dataGuru = $this->db->get_where('tb_guru',['id' => $this->input->post('idGuru')])->row();
			$data['nama'] = $dataGuru->teacher_name;
			$data['nik'] = "guru$dataGuru->nik";
			echo json_encode($data);
		}
	}


	public function fetch_nisnWali(){
		
		if($this->input->post('nisnWali')){

			$dataNISNWali = $this->db->get_where('tb_siswa',['id' => $this->input->post('nisnWali')])->row();
			$dataWali = $this->db->get_where('tb_wali',['student_id' => $this->input->post('nisnWali')])->row();
			$data['nama'] = $dataWali->parent_name;
			$data['nisn'] = "wali$dataNISNWali->nisn";
			echo json_encode($data);
		}
	}

	public function fetch_nisnSiswa(){
		if($this->input->post('nisnSiswa')){

			$dataNISSiswa = $this->db->get_where('tb_siswa',['id' => $this->input->post('nisnSiswa')])->row();
			$data['nama'] = $dataNISSiswa->std_name;
			$data['nisn'] = "siswa$dataNISSiswa->nisn";
			echo json_encode($data);
		}
	}

}