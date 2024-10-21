<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Admin extends CI_Controller {

	public function __construct(){

		parent::__construct();
		/*-- Check Session  --*/
		is_login();
		/*-- untuk mengatasi error confirm form resubmission  --*/
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
		$this->load->model('admin_model');
	}

	public function index(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['ttlSiswa'] = $this->admin_model->getCountSiswa();
		$data['ttlTipePelanggaran'] = $this->admin_model->getCountTipePelanggaran();
		$data['ttlUsers'] = $this->admin_model->getCountUsers();
		$data['ttlGuru'] = $this->admin_model->getCountGuru();

		$data['murid'] = $this->admin_model->TopMurid();
		$data['pelanggaran'] = $this->admin_model->TopPelanggaran();

		$data['title'] = $this->admin_model->website();
		$data['parent'] = "Dashbord";
		$data['page'] = "Dashboard";
		$this->template->load('admin/layout/admin_template','admin/admin_dashboard',$data);

	}

	public function dashboardDetail($id){

		if (count($this->uri->segment_array()) > 3) {
			redirect('admin');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Hanya Bisa Menggunakan Enkripsi');
			redirect('admin');
		} 

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['onePelanggaranAll'] = $this->admin_model->getOnePelanggaranByID($this->encrypt->decode($id));
		$data['oneSiswa'] = $this->admin_model->getOneSiswa($this->encrypt->decode($id));
		$data['pelanggaranTotal'] = $this->admin_model->getCountPelanggaran($this->encrypt->decode($id));
		$data['pelanggaran'] = $this->admin_model->getPelanggaranByID($this->encrypt->decode($id));

		$data['title'] = $this->admin_model->website();
		$data['parent'] = "Dashboard";
		$data['page'] = "Detail Pelanggaran";
		$this->template->load('admin/layout/admin_template','admin/admin_dashboardDetail',$data);

	}


	public function dataKategoriKategoriPelanggaran(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['tipePelanggaran'] = $this->admin_model->getKategoriPelanggaran();

		$data['title'] = $this->admin_model->website();
		$data['parent'] = "Data Kategori";
		$data['page'] = "Kategori Pelanggaran";
		$this->template->load('admin/layout/admin_template','admin/modul_dataKategori/admin_kategoriPelanggaran',$data);

	}

	public function dataKategoriKategoriPelanggaranAdd(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['tipePelanggaran'] = $this->admin_model->getKategoriPelanggaran();

		$this->form_validation->set_rules('nama','Nama Kategori Pelanggaran','required');
		$this->form_validation->set_rules('point','Jumlah Point','required|trim|is_natural',[
			'is_natural' => 'Jumlah Point hanya berisi Angka'
		]);

		if($this->form_validation->run() == false){

			$data['title'] = $this->admin_model->website();
			$data['parent'] = "Data Kategori";
			$data['page'] = "Kategori Pelanggaran Add";
			$this->template->load('admin/layout/admin_template','admin/modul_dataKategori/admin_kategoriPelanggaran',$data);

		}else{

			$data = [

				'violation_name' => htmlspecialchars($this->input->post('nama')),
				'get_point' => $this->input->post('point')

			];

			$this->db->insert('tb_tipe_pelanggaran', $data);
			$this->toastr->success('Kategori Pelanggaran '.$this->input->post('nama').' Telah Ditambahkan!');
			redirect('admin/dataKategoriKategoriPelanggaran');

		}

	}


	public function dataKategoriKategoriPelanggaranEdit(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['tipePelanggaran'] = $this->admin_model->getKategoriPelanggaran();

		$this->form_validation->set_rules('nama','Nama Kategori Pelanggaran','required');
		$this->form_validation->set_rules('point','Jumlah Point','required|trim|is_natural',[
			'is_natural' => 'Jumlah Point hanya berisi Angka'
		]);

		if($this->form_validation->run() == false){

			$data['title'] = $this->admin_model->website();
			$data['parent'] = "Data Kategori";
			$data['page'] = "Kategori Pelanggaran Edit";
			$this->template->load('admin/layout/admin_template','admin/modul_dataKategori/admin_kategoriPelanggaran',$data);

		}else{

			$data = [

				'violation_name' => htmlspecialchars($this->input->post('nama')),
				'get_point' => $this->input->post('point')

			];

			$this->db->where('id', $this->input->post('z'));
			$this->db->update('tb_tipe_pelanggaran',$data);
			$this->toastr->success('Kategori Pelanggaran '.$this->input->post('nama').' Telah Di Update!');
			redirect('admin/dataKategoriKategoriPelanggaran');

		}

	}


	public function dataKategoriKategoriPelanggaranDelete(){

		$id = $this->input->post("id");
		$this->db->delete('tb_tipe_pelanggaran',['id' => $id]);
		$sukses = "Deleted successfully.";
		echo json_encode($sukses);

	}

	public function dataKategoriListPelanggaran(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['title'] = $this->admin_model->website();
		$data['parent'] = "Data Kategori";
		$data['page'] = "List Pelanggaran";
		$this->template->load('admin/layout/admin_template','admin/modul_dataKategori/admin_listPelanggaran',$data);

	}

	public function dataKategoriListPelanggaranAdd(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();


		$data['guruAll'] = $this->admin_model->getGuru();
		$data['pelanggaranAll'] = $this->admin_model->getKategoriPelanggaran();

		$this->form_validation->set_rules('kelas','Kelas','required');
		$this->form_validation->set_rules('namaKelas','Nama Kelas','required');
		$this->form_validation->set_rules('namaSiswa','Nama Siswa','required');
		$this->form_validation->set_rules('pelapor','Pelapor','required');
		$this->form_validation->set_rules('pelanggaran','Kategori Pelanggaran','required');
		$this->form_validation->set_rules('catatan','Catatan','required');

		if($this->form_validation->run() == false){

			$data['title'] = $this->admin_model->website();
			$data['parent'] = "List Pelanggaran";
			$data['page'] = "List Pelanggaran Add";
			$this->template->load('admin/layout/admin_template','admin/modul_dataKategori/admin_listPelanggaranAdd',$data);

		}else{

			$data = [

				'class_id' => $this->input->post('namaKelas'),
				'teacher_id' => $this->input->post('pelapor'),
				'student_id' => $this->input->post('namaSiswa'),
				'nisn' => $this->admin_model->getOneSiswa($this->input->post('namaSiswa'))->nisn,
				'wali_id' => $this->admin_model->getOneWali($this->input->post('namaSiswa'))->id,
				'type_id' => $this->input->post('pelanggaran'),
				'point' => $this->admin_model->getOneKategoriPelanggaran($this->input->post('pelanggaran'))->get_point,
				'note' => $this->input->post('catatan'),
				'reported_on' => date('Y-m-d H:i:s')

			];


			$this->db->insert('tb_pelanggaran', $data);


			$kelasPoint = $this->db->get_where('tb_kelas',['id' => $this->input->post('namaKelas')])->row()->total_poin;

			$point = array($kelasPoint, $this->admin_model->getOneKategoriPelanggaran($this->input->post('pelanggaran'))->get_point);

			$totalPoint = array_sum($point);

			$data1 = [

				'total_poin' => $totalPoint
			];

			$this->db->where('id', $this->input->post('namaKelas'));
			$this->db->update('tb_kelas',$data1);

			$this->toastr->success('Pelanggaran Siswa '.$this->admin_model->getOneSiswa($this->input->post('namaSiswa'))->std_name.' Telah Ditambahkan!');
			redirect('admin/dataKategoriListPelanggaran');

		}

	}

	public function dataKategoriListPelanggaranPrint($id){

		if (count($this->uri->segment_array()) > 3) {
			redirect('admin');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dataKategoriListPelanggaran');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Hanya Bisa Menggunakan Enkripsi');
			redirect('admin/dataKategoriListPelanggaran');
		} 

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		$data['oneWeb'] = $this->admin_model->getOneWebsite($this->session->userdata('school_name'));
		$data['onepel'] = $this->admin_model->getOnePelanggaran($this->encrypt->decode($id)); /*-- Load One Data Administrator --*/
		$data['oneSis'] = $this->admin_model->getOneSiswa($this->admin_model->getOnePelanggaran($this->encrypt->decode($id))->student_id);

		$data['title'] = "List Pelanggaran Detail";
		$data['parent'] = "List Pelanggaran";
		$data['page'] = "List Pelanggaran Detail";
		$this->load->view('admin/modul_dataKategori/admin_listPelanggaranPrint',$data);
		// $name = "List Pelanggaran Print";
		// $html = $this->load->view('admin/modul_dataKategori/admin_listPelanggaranprint',$data, true);
		// $filename = $name;
		// $orientation = 'portait';
		// $this->mypdf->generate($html,$filename, $orientation);

	}


	public function dataKategoriListPelanggaranDetail($id = null){

		if (count($this->uri->segment_array()) > 3) {
			redirect('admin');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dataKategoriListPelanggaran');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Hanya Bisa Menggunakan Enkripsi');
			redirect('admin/dataKategoriListPelanggaran');
		} 

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['onepel'] = $this->admin_model->getOnePelanggaran($this->encrypt->decode($id)); /*-- Load One Data Administrator --*/

		$data['title'] = $this->admin_model->website();
		$data['parent'] = "List Pelanggaran";
		$data['page'] = "List Pelanggaran Detail";
		$this->template->load('admin/layout/admin_template','admin/modul_dataKategori/admin_listPelanggaranDetail',$data);

	}


	public function dataKategoriListPelanggaranEdit($id = null){

		if (count($this->uri->segment_array()) > 3) {
			redirect('admin');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dataKategoriListPelanggaran');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Hanya Bisa Menggunakan Enkripsi');
			redirect('admin/dataKategoriListPelanggaran');
		} 

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['onepel'] = $this->admin_model->getOnePelanggaran($this->encrypt->decode($id)); /*-- Load One Data Administrator --*/
		$data['pelanggaranAll'] = $this->admin_model->getKategoriPelanggaran();
		$data['guruAll'] = $this->admin_model->getGuru();

		$this->form_validation->set_rules('kelas','Kelas','required');
		$this->form_validation->set_rules('namaKelas','Nama Kelas','required');
		$this->form_validation->set_rules('namaSiswa','Nama Siswa','required');
		$this->form_validation->set_rules('pelapor','Pelapor','required');
		$this->form_validation->set_rules('pelanggaran','Kategori Pelanggaran','required');
		$this->form_validation->set_rules('catatan','Catatan','required');

		if($this->form_validation->run() == false){

			$data['title'] = $this->admin_model->website();
			$data['parent'] = "List Pelanggaran";
			$data['page'] = "List Pelanggaran Edit";
			$this->template->load('admin/layout/admin_template','admin/modul_dataKategori/admin_listPelanggaranEdit',$data);

		}else{

			$data = [

				'class_id' => $this->input->post('namaKelas'),
				'teacher_id' => $this->input->post('pelapor'),
				'student_id' => $this->input->post('namaSiswa'),
				'nisn' => $this->admin_model->getOneSiswa($this->input->post('namaSiswa'))->nisn,
				'wali_id' => $this->admin_model->getOneWali($this->input->post('namaSiswa'))->id,
				'type_id' => $this->input->post('pelanggaran'),
				'point' => $this->admin_model->getOneKategoriPelanggaran($this->input->post('pelanggaran'))->get_point,
				'note' => $this->input->post('catatan'),
				'reported_on' => date('Y-m-d H:i:s')

			];

			$this->db->where('id', $this->input->post('z'));
			$this->db->update('tb_pelanggaran',$data);
			$this->toastr->success('List Pelanggarn Data Siswa  '.$this->input->post('namaSiswa').' Telah Di Update!');
			redirect('admin/dataKategoriListPelanggaran');

		}
	}

	public function dataKategoriListPelanggaranDelete(){

		$id = $this->input->post("id");

		$dataPelanggaran = $this->db->get_where('tb_pelanggaran',['id' => $id])->row();
		$dataKelas = $this->db->get_where('tb_kelas',['id' => $dataPelanggaran->class_id])->row();
		$pengurangan = $dataKelas->total_poin - $dataPelanggaran->point;
		$data = [

			'total_poin' => $pengurangan

		];

		$this->db->where('id', $dataPelanggaran->class_id);
		$this->db->update('tb_kelas',$data);

		$this->db->delete('tb_pelanggaran',['id' => $id]);

		$sukses = "Deleted successfully.";
		echo json_encode($sukses);

	}


	public function dataMasterGuru(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['guruAll'] = $this->admin_model->getGuru();

		$data['title'] = $this->admin_model->website();
		$data['parent'] = "Data Master";
		$data['page'] = "Data Semua Guru";
		$this->template->load('admin/layout/admin_template','admin/modul_dataMaster/admin_guru',$data);

	}

	public function dataMasterGuruAdd(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['guruAll'] = $this->admin_model->getGuru();

		$this->form_validation->set_rules('nik','NIK','required|trim|is_natural|is_unique[tb_guru.nik]',[
			'is_natural' => 'NIK Hanya Berisi Angka',
			'is_unique' => 'NIk Yang Anda Masukkan Sudah Terpakai!',
		]);
		$this->form_validation->set_rules('nama','Nama Guru','required');
		$this->form_validation->set_rules('mapel','Mata Pelajaran','required');

		if($this->form_validation->run() == false){

			$data['title'] = $this->admin_model->website();
			$data['parent'] = "Data Guru";
			$data['page'] = "Add Data Guru";
			$this->template->load('admin/layout/admin_template','admin/modul_dataMaster/admin_guruAdd',$data);

		}else{

			$data = [

				'nik' => $this->input->post('nik'),
				'teacher_name' => $this->input->post('nama'),
				'subject' => $this->input->post('mapel')

			];

			$this->db->insert('tb_guru', $data);
			$this->toastr->success('Data Guru '.$this->input->post('nama').' Telah Ditambahkan!');
			redirect('admin/dataMasterGuru');


		}

	}


	public function dataMasterGuruDetail($id = null){

		if (count($this->uri->segment_array()) > 3) {
			redirect('admin');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dataMasterGuru');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Hanya Bisa Menggunakan Enkripsi');
			redirect('admin/dataMasterGuru');
		} 

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['oneGuru'] = $this->admin_model->getOneGuru($this->encrypt->decode($id)); /*-- Load One Data Administrator --*/

		$data['title'] = $this->admin_model->website();
		$data['parent'] = "Data Guru";
		$data['page'] = "Detail Data Guru";
		$this->template->load('admin/layout/admin_template','admin/modul_dataMaster/admin_guruDetail',$data);

	}


	public function dataMasterGuruEdit($id = null){

		if (count($this->uri->segment_array()) > 3) {
			redirect('admin');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dataMasterGuru');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Hanya Bisa Menggunakan Enkripsi');
			redirect('admin/dataMasterGuru');
		} 

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['oneGuru'] = $this->admin_model->getOneGuru($this->encrypt->decode($id)); /*-- Load One Data Administrator --*/


		$this->form_validation->set_rules('nik','NIK','required|trim|is_natural',[
			'is_natural' => 'NIK Hanya Berisi Angka'
		]);
		$this->form_validation->set_rules('nama','Nama Guru','required');
		$this->form_validation->set_rules('mapel','Mata Pelajaran','required');

		if($this->form_validation->run() == false){

			$data['title'] = $this->admin_model->website();
			$data['parent'] = "Data Guru";
			$data['page'] = "Edit Data Guru";
			$this->template->load('admin/layout/admin_template','admin/modul_dataMaster/admin_guruEdit',$data);

		}else{

			$data = [

				'nik' => $this->input->post('nik'),
				'teacher_name' => $this->input->post('nama'),
				'subject' => $this->input->post('mapel')

			];

			$this->db->where('id', $this->input->post('z'));
			$this->db->update('tb_guru',$data);
			$this->toastr->success('Data Guru  '.$this->input->post('nama').' Telah Di Update!');
			redirect('admin/dataMasterGuru');

		}

	}


	public function dataMasterGuruDelete(){

		$id = $this->input->post("id");
		$this->db->delete('tb_guru',['id' => $id]);
		$sukses = "Deleted successfully.";
		echo json_encode($sukses);

	}


	public function dataMasterKelas(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['kelasAll'] = $this->admin_model->getKelas();

		$data['title'] = $this->admin_model->website();
		$data['parent'] = "Data Master";
		$data['page'] = "Data Semua Kelas";
		$this->template->load('admin/layout/admin_template','admin/modul_dataMaster/admin_kelas',$data);

	}


	public function dataMasterKelasAdd(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['kelasAll'] = $this->admin_model->getKelas();
		$data['guruAll'] = $this->admin_model->getGuru();

		$this->form_validation->set_rules('kelas','Kelas','trim|required');
		$this->form_validation->set_rules('nama','Nama Kelas','trim|required|is_unique[tb_kelas.class_name]',[
			'is_unique' => 'Nama Kelas Yang Anda Masukkan Sudah Ada!',
		]);
		$this->form_validation->set_rules('jumlah','Jumlah Murid','required|trim|is_natural',[
			'is_natural' => 'NIK Hanya Berisi Angka',
		]);
		$this->form_validation->set_rules('wali','Wali Kelas','required');

		if($this->form_validation->run() == false){

			$data['title'] = $this->admin_model->website();
			$data['parent'] = "Data Kelas";
			$data['page'] = "Add Data Kelas";
			$this->template->load('admin/layout/admin_template','admin/modul_dataMaster/admin_kelasAdd',$data);

		}else{

			$data = [

				'sub_class' => $this->input->post('kelas'),
				'class_name' => $this->input->post('nama'),
				'total_students' => $this->input->post('jumlah'),
				'wali_name' => $this->input->post('wali')

			];

			$this->db->insert('tb_kelas', $data);
			$this->toastr->success('Data Kelas '.$this->input->post('nama').' Telah Ditambahkan!');
			redirect('admin/dataMasterKelas');


		}

	}

	public function dataMasterKelasDetail($id = null){

		if (count($this->uri->segment_array()) > 3) {
			redirect('admin');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dataMasterKelas');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Hanya Bisa Menggunakan Enkripsi');
			redirect('admin/dataMasterKelas');
		} 

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['oneKelas'] = $this->admin_model->getOneKelas($this->encrypt->decode($id)); /*-- Load One Data Administrator --*/

		$data['title'] = $this->admin_model->website();
		$data['parent'] = "Data Kelas";
		$data['page'] = "Detail Data Kelas";
		$this->template->load('admin/layout/admin_template','admin/modul_dataMaster/admin_kelasDetail',$data);

	}

	public function dataMasterKelasEdit($id = null){

		if (count($this->uri->segment_array()) > 3) {
			redirect('admin');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dataMasterKelas');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Hanya Bisa Menggunakan Enkripsi');
			redirect('admin/dataMasterKelas');
		} 

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['guruAll'] = $this->admin_model->GetGuru();
		$data['oneKelas'] = $this->admin_model->getOneKelas($this->encrypt->decode($id)); /*-- Load One Data Administrator --*/

		$this->form_validation->set_rules('kelas','Kelas','trim|required');
		$this->form_validation->set_rules('nama','Nama Kelas','trim|required');
		$this->form_validation->set_rules('jumlah','Jumlah Murid','required|trim|is_natural',[
			'is_natural' => 'NIK Hanya Berisi Angka',
		]);
		$this->form_validation->set_rules('wali','Wali Kelas','required');

		if($this->form_validation->run() == false){

			$data['title'] = $this->admin_model->website();
			$data['parent'] = "Data Kelas";
			$data['page'] = "Edit Data Kelas";
			$this->template->load('admin/layout/admin_template','admin/modul_dataMaster/admin_kelasEdit',$data);

		}else{

			$data = [

				'sub_class' => $this->input->post('kelas'),
				'class_name' => $this->input->post('nama'),
				'total_students' => $this->input->post('jumlah'),
				'wali_name' => $this->input->post('wali')

			];

			$this->db->where('id', $this->input->post('z'));
			$this->db->update('tb_kelas',$data);
			$this->toastr->success('Data Kelas  '.$this->input->post('nama').' Telah Di Update!');
			redirect('admin/dataMasterKelas');

		}

	}


	public function dataMasterKelasDelete(){

		$id = $this->input->post("id");
		$this->db->delete('tb_kelas',['id' => $id]);
		$sukses = "Deleted successfully.";
		echo json_encode($sukses);

	}


	public function dataMasterSiswa(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['title'] = $this->admin_model->website();
		$data['parent'] = "Data Master";
		$data['page'] = "Data Semua Siswa";
		$this->template->load('admin/layout/admin_template','admin/modul_dataMaster/admin_siswa',$data);

	}

	public function dataMasterSiswaAdd(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();


		$this->form_validation->set_rules('nisn','NISN','trim|required|is_natural|is_unique[tb_siswa.nisn]',[
			'is_natural' => 'NISN Hanya Berisi Angka',
			'is_unique' => 'NISN Yang Anda Masukkan Sudah Terpakai!'
		]);
		$this->form_validation->set_rules('nama','Nama Siswa','required');
		$this->form_validation->set_rules('addnamaKelas','Kelas Siswa','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('telepon','No Telepon','trim|required|min_length[5]|max_length[14]|is_natural',[
			'is_natural' => 'Input Nomor HP Hanya Berisi Angka'
		]);
		$this->form_validation->set_rules('wali','Orang Tua / Wali','required');


		if($this->form_validation->run() == false){

			$data['title'] = $this->admin_model->website();
			$data['parent'] = "Data Siswa";
			$data['page'] = "Add Data Siswa";
			$this->template->load('admin/layout/admin_template','admin/modul_dataMaster/admin_siswaAdd',$data);

		}else{

			$data = [

				'nisn' => $this->input->post('nisn'),
				'std_name' => htmlspecialchars($this->input->post('nama')),
				'class_id' => $this->input->post('addnamaKelas'),
				'address' => $this->input->post('alamat'),
				'phone_number' => str_replace("-","",$this->input->post('telepon'))

			];

			$this->db->insert('tb_siswa', $data);

			$id_siswa = $this->db->insert_id();

			$data1 = [

				'student_id' => $id_siswa,
				'parent_name' => htmlspecialchars($this->input->post('wali')),
				'phone_number' => str_replace("-","",$this->input->post('telepon'))

			];

			$this->db->insert('tb_wali', $data1);
			$this->toastr->success('Data Siswa '.$this->input->post('nama').' dan Wali Siswa Tersebut Telah Ditambahkan!');
			redirect('admin/dataMasterSiswa');

		}

	}


	public function dataMasterSiswaDetail($id = null){

		if (count($this->uri->segment_array()) > 3) {
			redirect('admin');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dataMasterSiswa');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Hanya Bisa Menggunakan Enkripsi');
			redirect('admin/datamMsterSiswa');
		} 

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['oneKelas'] = $this->admin_model->getOneKelas($this->admin_model->getOneSiswa($this->encrypt->decode($id))->class_id);
		$data['oneSiswa'] = $this->admin_model->getOneSiswa($this->encrypt->decode($id)); /*-- Load One Data Administrator --*/

		$data['title'] = $this->admin_model->website();
		$data['parent'] = "Data Siswa";
		$data['page'] = "Detail Data Siswa";
		$this->template->load('admin/layout/admin_template','admin/modul_dataMaster/admin_siswaDetail',$data);

	}


	public function dataMasterSiswaEdit($id = null){

		if (count($this->uri->segment_array()) > 3) {
			redirect('admin');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dataMasterSiswa');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Hanya Bisa Menggunakan Enkripsi');
			redirect('admin/dataMasteSiswas');
		} 

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['oneSiswa'] = $this->admin_model->getOneSiswa($this->encrypt->decode($id)); /*-- Load One Data Administrator --*/

		$this->form_validation->set_rules('nisn','NISN','trim|required|is_natural',[
			'is_natural' => 'NISN Hanya Berisi Angka',
		]);
		$this->form_validation->set_rules('nama','Nama Siswa','required');
		$this->form_validation->set_rules('addnamaKelas','Kelas Siswa','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('telepon','No Telepon','trim|required|min_length[5]|max_length[14]|is_natural',[
			'is_natural' => 'Input Nomor HP Hanya Berisi Angka'
		]);
		$this->form_validation->set_rules('wali','Orang Tua / Wali','required');

		if($this->form_validation->run() == false){

			$data['title'] = $this->admin_model->website();
			$data['parent'] = "Data Siswa";
			$data['page'] = "Edit Data Siswa";
			$this->template->load('admin/layout/admin_template','admin/modul_dataMaster/admin_siswaEdit',$data);

		}else{

			$data = [

				'nisn' => $this->input->post('nisn'),
				'std_name' => htmlspecialchars($this->input->post('nama')),
				'class_id' => $this->input->post('addnamaKelas'),
				'address' => $this->input->post('alamat'),
				'phone_number' => str_replace("-","",$this->input->post('telepon'))

			];

			$this->db->where('id', $this->input->post('z'));
			$this->db->update('tb_siswa',$data);

			$data1 = [

				'parent_name' => htmlspecialchars($this->input->post('wali')),
				'phone_number' => str_replace("-","",$this->input->post('telepon'))

			];

			$this->db->where('student_id', $this->input->post('z'));
			$this->db->update('tb_wali',$data1);

			$this->toastr->success('Data Siswa  '.$this->input->post('nama').' dan Wali Telah Di Update!');
			redirect('admin/dataMasterSiswa');

		}

	}


	public function dataMasterSiswaDelete(){

		$id = $this->input->post("id");
		$this->db->delete('tb_siswa',['id' => $id]);
		$this->db->delete('tb_wali',['student_id' => $id]);
		$sukses = "Deleted successfully.";
		echo json_encode($sukses);

	}


	public function pengaturanPengguna(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['title'] = $this->admin_model->website();
		$data['parent'] = "Pengguna";
		$data['page'] = "Data Pengguna";
		$this->template->load('admin/layout/admin_template','admin/modul_pengaturan/admin_pengguna',$data);

	}


	public function pengaturanPenggunaAdd(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['usersAll'] = $this->admin_model->getUsers();

		$data['guruAll'] = $this->admin_model->getGuru();
		$data['siswaAll'] = $this->admin_model->getSiswa();


		if($this->input->post('level') == 'Admin'){

			$this->form_validation->set_rules('fullnameAdmin','FullName','required');
			// $this->form_validation->set_rules('emailAdmin','Email','trim|required|valid_email');
			$this->form_validation->set_rules('usernameAdmin','Username','required|is_unique[tb_users.username]',[
				'is_unique' => 'Username Sudah Dipakai!'
			]);
			$this->form_validation->set_rules('passwordAdmin','Password','required');

		}elseif($this->input->post('level') == 'Guru'){

			$this->form_validation->set_rules('fullnameGuru','FullName','required');
			// $this->form_validation->set_rules('emailGuru','Email','trim|required|valid_email');
			$this->form_validation->set_rules('usernameGuru','Username','required|is_unique[tb_users.username]',[
				'is_unique' => 'Username Sudah Dipakai!'
			]);
			$this->form_validation->set_rules('passwordGuru','Password','required');

		}elseif($this->input->post('level') == 'Wali'){
			$this->form_validation->set_rules('fullnameWali','FullName','required');
			// $this->form_validation->set_rules('emailWali','Email','trim|required|valid_email');
			$this->form_validation->set_rules('usernameWali','Username','required|is_unique[tb_users.username]',[
				'is_unique' => 'Username Sudah Dipakai!'
			]);
			$this->form_validation->set_rules('passwordWali','Password','required');

		}elseif($this->input->post('level') == 'Siswa'){
			$this->form_validation->set_rules('fullnameSiswa','FullName','required');
			// $this->form_validation->set_rules('emailSiswa','Email','trim|required|valid_email');
			$this->form_validation->set_rules('usernameSiswa','Username','required|is_unique[tb_users.username]',[
				'is_unique' => 'Username Sudah Dipakai!'
			]);
			$this->form_validation->set_rules('passwordSiswa','Password','required');

		}

		$this->form_validation->set_rules('level','Level','required');


		if($this->form_validation->run() == false){

			$data['title'] = $this->admin_model->website();
			$data['parent'] = "Data Pengguna";
			$data['page'] = "Data Pengguna Add";
			$this->template->load('admin/layout/admin_template','admin/modul_pengaturan/admin_penggunaAdd',$data);

		}else{

			if($this->input->post('level') == 'Admin'){

				$data = [

					'full_name' => $this->input->post('fullnameAdmin'),
					'email' => $this->input->post('emailAdmin'),
					'username' => $this->input->post('usernameAdmin'),
					'password' => password_hash($this->input->post('passwordAdmin'), PASSWORD_DEFAULT),
					'level' => $this->input->post('level')

				];

			}elseif($this->input->post('level') == 'Guru'){

				$data = [

					'full_name' => $this->input->post('fullnameGuru'),
					'email' => $this->input->post('emailGuru'),
					'username' => $this->input->post('usernameGuru'),
					'password' => password_hash($this->input->post('passwordGuru'), PASSWORD_DEFAULT),
					'level' => $this->input->post('level')

				];

			}elseif($this->input->post('level') == 'Wali'){

				$data = [

					'full_name' => $this->input->post('fullnameWali'),
					'email' => $this->input->post('emailWali'),
					'username' => $this->input->post('usernameWali'),
					'password' => password_hash($this->input->post('passwordWali'), PASSWORD_DEFAULT),
					'level' => $this->input->post('level')

				];

			}elseif($this->input->post('level') == 'Siswa'){

				$data = [

					'full_name' => $this->input->post('fullnameSiswa'),
					'email' => $this->input->post('emailSiswa'),
					'username' => $this->input->post('usernameSiswa'),
					'password' => password_hash($this->input->post('passwordSiswa'), PASSWORD_DEFAULT),
					'level' => $this->input->post('level')

				];

			}

			$this->db->insert('tb_users', $data);
			$this->toastr->success('Data User Telah Ditambahkan!');
			redirect('admin/pengaturanPengguna');

		}

	}


	public function pengaturanPenggunaDetail($id = null){

		if (count($this->uri->segment_array()) > 3) {
			redirect('admin');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/pengaturanPengguna');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Hanya Bisa Menggunakan Enkripsi');
			redirect('admin/pengaturanPengguna');
		} 

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['oneUsers'] = $this->admin_model->getOneUsers($this->encrypt->decode($id)); /*-- Load One Data Administrator --*/

		$data['title'] = $this->admin_model->website();
		$data['parent'] = "Data Pengguna";
		$data['page'] = "Data Pengguna Detail";
		$this->template->load('admin/layout/admin_template','admin/modul_pengaturan/admin_penggunaDetail',$data);

	}


	public function pengaturanPenggunaEdit($id = null){

		if (count($this->uri->segment_array()) > 3) {
			redirect('admin');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/pengaturanPengguna');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Hanya Bisa Menggunakan Enkripsi');
			redirect('admin/pengaturanPengguna');
		} 

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['oneUsers'] = $this->admin_model->getOneUsers($this->encrypt->decode($id)); /*-- Load One Data Administrator --*/

		$this->form_validation->set_rules('fullname','FullName','required');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('username','Userame','required');
		// $this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('level','Level','required');


		if($this->form_validation->run() == false){

			$data['title'] = $this->admin_model->website();
			$data['parent'] = "Data Pengguna";
			$data['page'] = "Data Pengguna Edit";
			$this->template->load('admin/layout/admin_template','admin/modul_pengaturan/admin_penggunaEdit',$data);

		}else{

			$data = [

				'full_name' => $this->db->escape_str($this->input->post('fullname', true)),
				'email' => $this->db->escape_str($this->input->post('email', true)),
				'username' => $this->db->escape_str($this->input->post('username', true)),
				'password' => $this->db->escape_str(password_hash($this->input->post('password', true), PASSWORD_DEFAULT)),
				'level' => $this->db->escape_str($this->input->post('level', true))

			];

			$this->db->where('id', $this->input->post('z'));
			$this->db->update('tb_users',$data);
			$this->toastr->success('Data Users  '.$this->input->post('fullname').' dan Wali Telah Di Update!');
			redirect('admin/pengaturanPengguna');

		}

	}


	public function pengaturanPenggunaDelete(){

		$id = $this->input->post("id");
		$this->db->delete('tb_users',['id' => $id]);
		$sukses = "Deleted successfully.";
		echo json_encode($sukses);

	}


	public function pengaturanWebsite(){



		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['oneWeb'] = $this->admin_model->getOneWebsite($this->session->userdata('school_name'));


		$this->form_validation->set_rules('sekolah','Nama Sekolah','required');
		$this->form_validation->set_rules('point','Point','trim|required|is_natural',[
			'is_natural' => 'Point Hanya Berisi Angka'
		]);

		if($this->form_validation->run() == false){

			$data['title'] = $this->admin_model->website();
			$data['parent'] = "Website";
			$data['page'] = "Data Website";
			$this->template->load('admin/layout/admin_template','admin/modul_pengaturan/admin_website',$data);

		}else{

			$data = [

				'school_name' => $this->input->post('sekolah'),
				'point' => $this->input->post('point'),

			];

			$this->db->where('id', $this->input->post('z'));
			$this->db->update('tb_website',$data);
			$this->toastr->success('Data Website'.$this->input->post('username').' Telah Ditambahkan!');
			redirect('admin/pengaturanWebsite');

		}

	}

	public function laporanAll(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['siswaAll'] = $this->admin_model->getSiswa();
		$data['kelasAll'] = $this->admin_model->getKelas();

		

		if($this->input->post('pencarian') == 'siswa'){

			$this->form_validation->set_rules('siswa','Nama Siswa','required');

		}elseif($this->input->post('pencarian') == 'kelas'){

			$this->form_validation->set_rules('kelas','Nama Kelas','required');

		}

		$this->form_validation->set_rules('pencarian','Tipe Pencarian','required');
		// $this->form_validation->set_rules('search','Silahkan Mengisi Inputan di Atas','required');
		$this->form_validation->set_rules('awal','Awal Periode','required');
		$this->form_validation->set_rules('akhir','Akhir Periode','required');

		if($this->form_validation->run() == false){


			$data['tipe'] = NULL;

			$data['title'] = $this->admin_model->website();
			$data['parent'] = "Data Laporan";
			$data['page'] = "Laporan";
			$this->template->load('admin/layout/admin_template','admin/modul_laporan/admin_laporan',$data);
			//sample
			// $this->template->load('admin/layout/admin_template','admin/modul_laporan/admin_laporan_sample',$data);

		}else{


			$pencarian = $this->input->post('pencarian');
			$siswa = $this->input->post('siswa');
			$kelas = $this->input->post('kelas');
			$awal = $this->input->post('awal');
			$akhir = $this->input->post('akhir');

			if($pencarian == 'siswa'){

				$query = "SELECT *,
				tb_pelanggaran.id AS id_pelanggaran,
				tb_siswa.id AS id_siswa,
				tb_guru.id AS id_guru,
				tb_wali.id AS id_wali,
				tb_wali.phone_number AS phone_number_wali,
				tb_tipe_pelanggaran.id AS id_tipe_pelanggaran
				FROM tb_pelanggaran 
				JOIN tb_siswa ON tb_pelanggaran.student_id = tb_siswa.id
				JOIN tb_kelas ON tb_pelanggaran.class_id = tb_kelas.id 
				JOIN tb_guru ON tb_pelanggaran.teacher_id = tb_guru.id
				JOIN tb_wali ON tb_pelanggaran.wali_id = tb_wali.id
				JOIN tb_tipe_pelanggaran ON tb_pelanggaran.type_id = tb_tipe_pelanggaran.id
				WHERE (tb_pelanggaran.reported_on BETWEEN '$awal' AND '$akhir') AND tb_siswa.id = $siswa";

				$queryTotal = "SELECT COUNT(type_id) AS total_pelanggaran, SUM(point) AS total_point FROM tb_pelanggaran WHERE student_id = $siswa";

			}elseif($pencarian == 'kelas'){

				$query = "SELECT *,
				tb_pelanggaran.id AS id_pelanggaran,
				tb_siswa.id AS id_siswa,
				tb_guru.id AS id_guru,
				tb_wali.id AS id_wali,
				tb_wali.phone_number AS phone_number_wali,
				tb_tipe_pelanggaran.id AS id_tipe_pelanggaran
				FROM tb_pelanggaran
				JOIN tb_siswa ON tb_pelanggaran.student_id = tb_siswa.id 
				JOIN tb_kelas ON tb_pelanggaran.class_id = tb_kelas.id 
				JOIN tb_guru ON tb_pelanggaran.teacher_id = tb_guru.id
				JOIN tb_wali ON tb_pelanggaran.wali_id = tb_wali.id
				JOIN tb_tipe_pelanggaran ON tb_pelanggaran.type_id = tb_tipe_pelanggaran.id
				WHERE (tb_pelanggaran.reported_on BETWEEN '$awal' AND '$akhir') AND tb_kelas.id = '$kelas'";

				$queryTotal = "SELECT COUNT(type_id) AS total_pelanggaran, SUM(point) AS total_point FROM tb_pelanggaran WHERE class_id = $kelas";

			};

			$data['hasilOne'] = $this->db->query($query)->row();
			$data['hasilAll'] = $this->db->query($query)->result();
			$data['hasilTotal'] = $this->db->query($queryTotal)->row();

			$data['tipe'] = $pencarian;
			// $data['siswa'] = $siswa;
			// // $data['kelas'] = $kelas;
			// $data['awal'] = $awal;
			// $data['akhir'] = $akhir;


			$data['title'] = $this->admin_model->website();
			$data['parent'] = "Data Laporan";
			$data['page'] = "Laporan Data Surat";
			$this->template->load('admin/layout/admin_template','admin/modul_laporan/admin_laporan',$data);

		}
	}

	public function laporanPdf(){

		$this->load->library('mypdf');

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['siswaAll'] = $this->admin_model->getSiswa();
		$data['kelasAll'] = $this->admin_model->getKelas();
		$data['oneWeb'] = $this->admin_model->getOneWebsite($this->session->userdata('school_name'));
		

		if($this->input->post('pencarianPdf') == 'siswa'){

			$this->form_validation->set_rules('siswaPdf','Nama Siswa','required');

		}elseif($this->input->post('pencarianPdf') == 'kelas'){

			$this->form_validation->set_rules('kelasPdf','Nama Kelas','required');

		}

		$this->form_validation->set_rules('pencarianPdf','Tipe Pencarian','required');
		// $this->form_validation->set_rules('search','Silahkan Mengisi Inputan di Atas','required');
		$this->form_validation->set_rules('awalPdf','Awal Periode','required');
		$this->form_validation->set_rules('akhirPdf','Akhir Periode','required');

		if($this->form_validation->run() == false){

			$data['title'] = $this->admin_model->website();
			$data['parent'] = "Data Laporan";
			$data['page'] = "Laporan";
			$this->template->load('admin/layout/admin_template','admin/modul_laporan/admin_laporan',$data);
			//sample
			// $this->template->load('admin/layout/admin_template','admin/modul_laporan/admin_laporan_sample',$data);

		}else{


			$pencarian = $this->input->post('pencarianPdf');
			$siswa = $this->input->post('siswaPdf');
			$kelas = $this->input->post('kelasPdf');
			$awal = $this->input->post('awalPdf');
			$akhir = $this->input->post('akhirPdf');

			if($pencarian == 'siswa'){

				$query = "SELECT *,
				tb_pelanggaran.id AS id_pelanggaran,
				tb_siswa.id AS id_siswa,
				tb_guru.id AS id_guru,
				tb_wali.id AS id_wali,
				tb_wali.phone_number AS phone_number_wali,
				tb_tipe_pelanggaran.id AS id_tipe_pelanggaran
				FROM tb_pelanggaran 
				JOIN tb_siswa ON tb_pelanggaran.student_id = tb_siswa.id
				JOIN tb_kelas ON tb_pelanggaran.class_id = tb_kelas.id 
				JOIN tb_guru ON tb_pelanggaran.teacher_id = tb_guru.id
				JOIN tb_wali ON tb_pelanggaran.wali_id = tb_wali.id
				JOIN tb_tipe_pelanggaran ON tb_pelanggaran.type_id = tb_tipe_pelanggaran.id
				WHERE (tb_pelanggaran.reported_on BETWEEN '$awal' AND '$akhir') AND tb_siswa.id = $siswa";

				$queryTotal = "SELECT COUNT(type_id) AS total_pelanggaran, SUM(point) AS total_point FROM tb_pelanggaran WHERE student_id = $siswa";

			}elseif($pencarian == 'kelas'){

				$query = "SELECT *,
				tb_pelanggaran.id AS id_pelanggaran,
				tb_siswa.id AS id_siswa,
				tb_guru.id AS id_guru,
				tb_wali.id AS id_wali,
				tb_wali.phone_number AS phone_number_wali,
				tb_tipe_pelanggaran.id AS id_tipe_pelanggaran
				FROM tb_pelanggaran
				JOIN tb_siswa ON tb_pelanggaran.student_id = tb_siswa.id 
				JOIN tb_kelas ON tb_pelanggaran.class_id = tb_kelas.id 
				JOIN tb_guru ON tb_pelanggaran.teacher_id = tb_guru.id
				JOIN tb_wali ON tb_pelanggaran.wali_id = tb_wali.id
				JOIN tb_tipe_pelanggaran ON tb_pelanggaran.type_id = tb_tipe_pelanggaran.id
				WHERE (tb_pelanggaran.reported_on BETWEEN '$awal' AND '$akhir') AND tb_kelas.id = '$kelas'";

				$queryTotal = "SELECT COUNT(type_id) AS total_pelanggaran, SUM(point) AS total_point FROM tb_pelanggaran WHERE class_id = $kelas";

			};


			$data['hasilOne'] = $this->db->query($query)->row();
			$data['hasilAll'] = $this->db->query($query)->result();
			$data['hasilTotal'] = $this->db->query($queryTotal)->row();
			
			$data['tipe'] = $pencarian;

			$data['title'] = $this->admin_model->website();
			$data['parent'] = "Data Laporan";
			$data['page'] = "Laporan Pelanggaran Siswa ";
			$this->load->view('admin/modul_laporan/admin_laporanPdf',$data);

		}
	}

	public function Profile(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['title'] = $this->admin_model->website();
		$data['parent'] = "Profile";
		$data['page'] = "Profile";
		$this->template->load('admin/layout/admin_template','admin/admin_profile',$data);
	}

	public function editProfile(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		
		$this->form_validation->set_rules('fullname','Fullname','required');

		if($this->form_validation->run() == false){

			$data['title'] = $this->admin_model->website();
			$data['parent'] = "Profile";
			$data['page'] = "Profile";
			$this->template->load('admin/layout/admin_template','admin/admin_profile',$data);

		}else{

			//check jika ada gmabar yang akan diupload, "f" itu nama inputnya
			// $upload_image = $_FILES['photo']['name'];
			$filename = $this->session->userdata('username');

			$config['allowed_types'] = 'png';
				$config['max_size']     = '5120'; // dalam hitungan kilobyte(kb), aslinya 1mb itu 1024kb
				$config['upload_path'] = './assets/sips/img/admin/';
				$config['overwrite'] = "TRUE";
				$config['file_name'] = $filename;

				$this->load->library('upload', $config);
				$this->upload->overwrite = true;
				if(! $this->upload->do_upload('photo')){

					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
					redirect('Admin/profile');

				}else{

					$data = [

						'full_name' => $this->input->post('fullname'),
						'email' => $this->input->post('email'),
					];

					$this->db->where('id', $this->input->post('z'));
					$this->db->update('tb_users',$data);
					$this->toastr->success('Profile Telah Di Update!');
					redirect('Admin/profile');
				}

			}
		}


		public function changePassword(){

			$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

			$this->form_validation->set_rules('bb', 'New Password','required|trim|min_length[4]|matches[cc]');
			$this->form_validation->set_rules('cc', 'Confirm New Password','required|trim|min_length[4]|matches[bb]');

			if($this->form_validation->run() == false){

				$data['title'] = $this->admin_model->website();
				$data['parent'] = "Profile";
				$data['page'] = "Profile";
				$this->template->load('admin/layout/admin_template','admin/admin_profile',$data);

			}else{


				$new_password = $this->input->post('bb');


				$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

				$this->db->set('password', $password_hash);
				$this->db->where('id', $this->input->post('dd'));
				$this->db->update('tb_users');

				$this->toastr->success('password Berahasil Di Ubah!');
				redirect('Admin/profile');
			}

		}
	}