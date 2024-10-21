<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Guru extends CI_Controller {

	public function __construct(){

		parent::__construct();
		is_login();

		/*-- untuk mengatasi error confirm form resubmission  --*/
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
		$this->load->model('guru_model');
	}

	public function index(){
		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['murid'] = $this->guru_model->TopMurid();
		$data['pelanggaran'] = $this->guru_model->TopPelanggaran();


		$data['title'] = $this->guru_model->website();
		$data['parent'] = "Dashbord";
		$data['page'] = "Dashboard";
		$this->template->load('guru/layout/guru_template','guru/guru_dashboard',$data);

	}

	public function dashboardDetail($id){

		if (count($this->uri->segment_array()) > 3) {
			redirect('guru');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('guru');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Hanya Bisa Menggunakan Enkripsi');
			redirect('guru');
		} 
		
		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['onePelanggaranAll'] = $this->guru_model->getOnePelanggaranByID($this->encrypt->decode($id));
		$data['oneSiswa'] = $this->guru_model->getOneSiswa($this->encrypt->decode($id));
		$data['pelanggaranTotal'] = $this->guru_model->getCountPelanggaran($this->encrypt->decode($id));
		$data['pelanggaran'] = $this->guru_model->getPelanggaranByID($this->encrypt->decode($id));

		$data['title'] = $this->guru_model->website();
		$data['parent'] = "Data Kategori";
		$data['page'] = "Detail Pelanggaran";
		$this->template->load('guru/layout/guru_template','guru/guru_dashboardDetail',$data);

	}


	public function listPelanggaran(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['tipePelanggaran'] = $this->guru_model->getKategoriPelanggaran();

		$data['title'] = $this->guru_model->website();
		$data['parent'] = "List Pelangaran";
		$data['page'] = "List Pelangaran";
		$this->template->load('guru/layout/guru_template','guru/modul_listPelanggaran/guru_listPelanggaran',$data);

	}

	public function listPelanggaranAdd(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		$data['guruAll'] = $this->guru_model->getGuru();

		$data['pelanggaranAll'] = $this->guru_model->getKategoriPelanggaran();

		$this->form_validation->set_rules('kelas','Kelas','required');
		$this->form_validation->set_rules('namaKelas','Nama Kelas','required');
		$this->form_validation->set_rules('namaSiswa','Nama Siswa','required');
		$this->form_validation->set_rules('pelapor','Pelapor','required');
		$this->form_validation->set_rules('pelanggaran','Kategori Pelanggaran','required');
		$this->form_validation->set_rules('catatan','Catatan','required');

		if($this->form_validation->run() == false){

			$data['title'] = $this->guru_model->website();
			$data['parent'] = "List Pelanggaran";
			$data['page'] = "List Pelanggaran Add";
			$this->template->load('guru/layout/guru_template','guru/modul_listPelanggaran/guru_listPelanggaranAdd',$data);

		}else{

			$data = [

				'class_id' => $this->input->post('namaKelas'),
				'teacher_id' => $this->input->post('pelapor'),
				'student_id' => $this->input->post('namaSiswa'),
				'nisn' => $this->guru_model->getOneSiswa($this->input->post('namaSiswa'))->nisn,
				'wali_id' => $this->guru_model->getOneWali($this->input->post('namaSiswa'))->id,
				'type_id' => $this->input->post('pelanggaran'),
				'point' => $this->guru_model->getOneKategoriPelanggaran($this->input->post('pelanggaran'))->get_point,
				'note' => $this->input->post('catatan'),
				'reported_on' => date('Y-m-d H:i:s')

			];


			$this->db->insert('tb_pelanggaran', $data);


			$kelasPoint = $this->db->get_where('tb_kelas',['id' => $this->input->post('namaKelas')])->row()->total_poin;

			$point = array($kelasPoint, $this->guru_model->getOneKategoriPelanggaran($this->input->post('pelanggaran'))->get_point);

			$totalPoint = array_sum($point);

			$data1 = [

				'total_poin' => $totalPoint
			];

			$this->db->where('id', $this->input->post('namaKelas'));
			$this->db->update('tb_kelas',$data1);

			$this->toastr->success('Pelanggaran Siswa '.$this->guru_model->getOneSiswa($this->input->post('namaSiswa'))->std_name.' Telah Ditambahkan!');
			redirect('guru/listPelanggaran');

		}

	}

	public function listPelanggaranPrint($id){

		if (count($this->uri->segment_array()) > 3) {
			redirect('Guru');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('Guru/listPelanggaran');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Hanya Bisa Menggunakan Enkripsi');
			redirect('Guru/listPelanggaran');
		} 
		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['oneWeb'] = $this->guru_model->getOneWebsite($this->session->userdata('school_name'));
		$data['onepel'] = $this->guru_model->getOnePelanggaran($this->encrypt->decode($id)); /*-- Load One Data Administrator --*/
		$data['oneSis'] = $this->guru_model->getOneSiswa($this->guru_model->getOnePelanggaran($this->encrypt->decode($id))->student_id);

		$data['title'] = "List Pelanggaran Detail";
		$data['parent'] = "List Pelanggaran";
		$data['page'] = "List Pelanggaran Detail";
		$this->load->view('guru/modul_listPelanggaran/guru_listPelanggaranPrint',$data);

	}


	public function listPelanggaranDetail($id = null){

		if (count($this->uri->segment_array()) > 3) {
			redirect('guru');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('guru/listPelanggaran');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Hanya Bisa Menggunakan Enkripsi');
			redirect('guru/listPelanggaran');
		} 

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['onepel'] = $this->guru_model->getOnePelanggaran($this->encrypt->decode($id)); /*-- Load One Data Administrator --*/

		$data['title'] = $this->guru_model->website();
		$data['parent'] = "List Pelanggaran";
		$data['page'] = "List Pelanggaran Detail";
		$this->template->load('guru/layout/guru_template','guru/modul_listPelanggaran/guru_listPelanggaranDetail',$data);

	}


	public function listPelanggaranEdit($id = null){

		if (count($this->uri->segment_array()) > 3) {
			redirect('Guru');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('Guru/listPelanggaran');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Hanya Bisa Menggunakan Enkripsi');
			redirect('Guru/listPelanggaran');
		} 

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['onepel'] = $this->guru_model->getOnePelanggaran($this->encrypt->decode($id)); /*-- Load One Data Administrator --*/
		$data['pelanggaranAll'] = $this->guru_model->getKategoriPelanggaran();
		$data['guruAll'] = $this->guru_model->getGuru();

		$this->form_validation->set_rules('kelas','Kelas','required');
		$this->form_validation->set_rules('namaKelas','Nama Kelas','required');
		$this->form_validation->set_rules('namaSiswa','Nama Siswa','required');
		$this->form_validation->set_rules('pelapor','Pelapor','required');
		$this->form_validation->set_rules('pelanggaran','Kategori Pelanggaran','required');
		$this->form_validation->set_rules('catatan','Catatan','required');

		if($this->form_validation->run() == false){

			$data['title'] = $this->guru_model->website();
			$data['parent'] = "List Pelanggaran";
			$data['page'] = "List Pelanggaran Edit";
			$this->template->load('guru/layout/guru_template','guru/modul_listPelanggaran/guru_listPelanggaranEdit',$data);

		}else{

			$data = [

				'class_id' => $this->input->post('namaKelas'),
				'teacher_id' => $this->input->post('pelapor'),
				'student_id' => $this->input->post('namaSiswa'),
				'nisn' => $this->guru_model->getOneSiswa($this->input->post('namaSiswa'))->nisn,
				'wali_id' => $this->guru_model->getOneWali($this->input->post('namaSiswa'))->id,
				'type_id' => $this->input->post('pelanggaran'),
				'point' => $this->guru_model->getOneKategoriPelanggaran($this->input->post('pelanggaran'))->get_point,
				'note' => $this->input->post('catatan'),
				'reported_on' => date('Y-m-d H:i:s')

			];

			$this->db->where('id', $this->input->post('z'));
			$this->db->update('tb_pelanggaran',$data);
			$this->toastr->success('List Pelanggarn Data Siswa  '.$this->input->post('namaSiswa').' Telah Di Update!');
			redirect('Guru/listPelanggaran');

		}
	}

	public function listPelanggaranDelete(){

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


	public function listSiswa(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['title'] = $this->guru_model->website();
		$data['parent'] = "List Siswa";
		$data['page'] = "List Siswa";
		$this->template->load('guru/layout/guru_template','guru/modul_listSiswa/guru_listSiswa',$data);

	}


	public function listSiswaAdd(){

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

			$data['title'] = $this->guru_model->website();
			$data['parent'] = "List Siswa";
			$data['page'] = "Data Siswa Add";
			$this->template->load('guru/layout/guru_template','guru/modul_listSiswa/guru_listSiswaAdd',$data);

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
			redirect('Guru/listSiswa');

		}

	}


	public function listSiswaDetail($id = null){

		if (count($this->uri->segment_array()) > 3) {
			redirect('Guru');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('Guru/listSiswa');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Hanya Bisa Menggunakan Enkripsi');
			redirect('Guru/listSiswa');
		} 

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['oneKelas'] = $this->guru_model->getOneKelas($this->guru_model->getOneSiswa($this->encrypt->decode($id))->class_id);
		$data['oneSiswa'] = $this->guru_model->getOneSiswa($this->encrypt->decode($id)); /*-- Load One Data Administrator --*/

		$data['title'] = $this->guru_model->website();
		$data['parent'] = "Data Siswa";
		$data['page'] = "Data Siswa Detail";
		$this->template->load('guru/layout/guru_template','guru/modul_listSiswa/guru_listSiswaDetail',$data);

	}


	public function listSiswaEdit($id = null){

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

		$data['oneSiswa'] = $this->guru_model->getOneSiswa($this->encrypt->decode($id)); /*-- Load One Data Administrator --*/

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

			$data['title'] = $this->guru_model->website();
			$data['parent'] = "Data Siswa";
			$data['page'] = "Data Siswa Edit";
			$this->template->load('guru/layout/guru_template','guru/modul_listSiswa/guru_listSiswaEdit',$data);

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

			$id_siswa = $this->db->insert_id();

			$data1 = [

				'parent_name' => htmlspecialchars($this->input->post('wali')),
				'phone_number' => str_replace("-","",$this->input->post('telepon'))

			];

			$this->db->where('student_id', $this->input->post('z'));
			$this->db->update('tb_wali',$data1);

			$this->toastr->success('Data Siswa  '.$this->input->post('nama').' dan Wali Telah Di Update!');
			redirect('Guru/listSiswa');

		}

	}


	public function listSiswaDelete(){

		$id = $this->input->post("id");
		$this->db->delete('tb_siswa',['id' => $id]);
		$this->db->delete('tb_wali',['student_id' => $id]);
		$sukses = "Deleted successfully.";
		echo json_encode($sukses);

	}


	public function Profile(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();

		$data['title'] = $this->admin_model->website();
		$data['parent'] = "Profile";
		$data['page'] = "Profile";
		$this->template->load('guru/layout/guru_template','guru/guru_profile',$data);
	}

	public function editProfile(){

		$data['user'] = $this->db->get_where('tb_users',['username' => $this->session->userdata('username')])->row();
		
		$this->form_validation->set_rules('fullname','Fullname','required');

		if($this->form_validation->run() == false){

			$data['title'] = $this->admin_model->website();
			$data['parent'] = "Profile";
			$data['page'] = "Profile";
			$this->template->load('guru/layout/guru_template','guru/guru_profile',$data);

		}else{

			//check jika ada gmabar yang akan diupload, "f" itu nama inputnya
			// $upload_image = $_FILES['photo']['name'];
			$filename = $this->session->userdata('username');

			$config['allowed_types'] = 'png';
				$config['max_size']     = '5120'; // dalam hitungan kilobyte(kb), aslinya 1mb itu 1024kb
				$config['upload_path'] = './assets/sips/img/guru/';
				$config['overwrite'] = "TRUE";
				$config['file_name'] = $filename;

				$this->load->library('upload', $config);
				$this->upload->overwrite = true;
				if(! $this->upload->do_upload('photo')){

					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
					redirect('Guru/profile');

				}else{

					$data = [

						'full_name' => $this->input->post('fullname'),
						'email' => $this->input->post('email'),
					];

					$this->db->where('id', $this->input->post('z'));
					$this->db->update('tb_users',$data);
					$this->toastr->success('Profile Telah Di Update!');
					redirect('Guru/profile');
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
				$this->template->load('guru/layout/guru_template','guru/guru_profile',$data);

			}else{


				$new_password = $this->input->post('bb');


				$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

				$this->db->set('password', $password_hash);
				$this->db->where('id', $this->input->post('dd'));
				$this->db->update('tb_users');

				$this->toastr->success('password Berahasil Di Ubah!');
				redirect('Guru/profile');
			}

		}

	}
