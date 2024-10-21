<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}


	/*-----------------------------------*/
	/*--  Server Side List Pelanggaran --*/
	/*-----------------------------------*/

	/*-- nama tabel dari database  --*/
	var $table = 'tb_pelanggaran';
	/*-- field yang ada di table user yang akan ditampilkan --*/
	var $column_order = array(null, 'nisn','student_id','class_id','note');
	/*-- field yang diizin untuk pencarian --*/
	var $column_search = array('nisn','note');
	/*-- Default Order --*/
	var $order = array('id' => 'desc');



	private function _get_pelanggaran_query(){

		$this->db->from($this->table);

		$i = 0;
		/*-- looping awal  --*/
		foreach ($this->column_search as $item){

			/*-- jika datatable mengirimkan pencarian dengan metode POST   --*/
			if($_POST['search']['value']) {

				/*-- looping awal  --*/
				if($i===0){

					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);

				}else{

					$this->db->or_like($item, $_POST['search']['value']);

				}

				if(count($this->column_search) - 1 == $i) 
					$this->db->group_end(); 
			}

			$i++;
		}

		if(isset($_POST['order'])){

			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

		}else if(isset($this->order)){

			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);

		}
	}

	function get_pelanggaran(){

		$this->_get_pelanggaran_query();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();

	}


	function count_filtered_pelanggaran(){

		$this->_get_pelanggaran_query();
		$query = $this->db->get();
		return $query->num_rows();

	}


	function count_all_pelanggaran(){

		$this->db->from($this->table);
		return $this->db->count_all_results();

	}



	/*-----------------------------------*/
	/*--  Server Side Data Siswa --------*/
	/*-----------------------------------*/

	/*-- nama tabel dari database  --*/
	var $tableSiswa = 'tb_siswa';
	/*-- field yang ada di table user yang akan ditampilkan --*/
	var $column_orderSiswa = array(null, 'nisn','std_name','class_id');
	/*-- field yang diizin untuk pencarian --*/
	var $column_searchSiswa = array('nisn','std_name');
	/*-- Default Order --*/
	var $orderSiswa = array('id' => 'desc');



	private function _get_siswa_query(){

		$this->db->from($this->tableSiswa);

		$i = 0;
		/*-- looping awal  --*/
		foreach ($this->column_searchSiswa as $item){

			/*-- jika datatable mengirimkan pencarian dengan metode POST   --*/
			if($_POST['search']['value']) {

				/*-- looping awal  --*/
				if($i===0){

					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);

				}else{

					$this->db->or_like($item, $_POST['search']['value']);

				}

				if(count($this->column_searchSiswa) - 1 == $i) 
					$this->db->group_end(); 
			}

			$i++;
		}

		if(isset($_POST['order'])){

			$this->db->order_by($this->column_orderSiswa[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

		}else if(isset($this->orderSiswa)){

			$orderSiswa = $this->orderSiswa;
			$this->db->order_by(key($orderSiswa), $orderSiswa[key($orderSiswa)]);

		}
	}

	function get_siswa(){

		$this->_get_siswa_query();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();

	}


	function count_filtered_siswa(){

		$this->_get_siswa_query();
		$query = $this->db->get();
		return $query->num_rows();

	}


	function count_all_siswa(){

		$this->db->from($this->tableSiswa);
		return $this->db->count_all_results();

	}


	public function fetch_subNamakelas($kelas){
		$this->db->where('sub_class', $kelas);
		$this->db->order_by('class_name', 'ASC');
		$query = $this->db->get('tb_kelas');
		if($query->num_rows() > 0){

			$output = '<option value="A">Pilih Nama Kelas</option>';
			foreach($query->result() as $row){

				$output .= '<option value="'.$row->id.'">'.$row->class_name.'</option>';

			}
		}elseif($query->num_rows() == 0){
			$output = '<option value="A" selected="selected">Pilih Kategori Kelas Terlebih Dahulu</option>';
		}

		return $output;
	}

	public function fetch_subNamaSiswa($namaKelas){
		$this->db->where('class_id', $namaKelas);
		$this->db->order_by('std_name', 'ASC');
		$query = $this->db->get('tb_siswa');
		if($query->num_rows() > 0){

			$output = '<option value="">Pilih Nama Siswa</option>';
			foreach($query->result() as $row){
				if($row->is_main_menu == 0){
					$output .= '<option value="'.$row->id.'">'.$row->std_name.'</option>';
				}
			}
		}elseif($query->num_rows() == 0){

			$output = '<option selected="selected">Pilih Nama Kelas Terlebih Dahulu</option>';
		}

		return $output;
	}




	/*-----------------------------------*/
	/*--  Server Side Data Siswa --------*/
	/*-----------------------------------*/

	/*-- nama tabel dari database  --*/
	var $tablePengguna = 'tb_users';
	/*-- field yang ada di table user yang akan ditampilkan --*/
	var $column_orderPengguna = array(null, 'full_name','username','level','status');
	/*-- field yang diizin untuk pencarian --*/
	var $column_searchPengguna = array('full_name','username');
	/*-- Default Order --*/
	var $orderPengguna = array('id' => 'desc');



	private function _get_pengguna_query(){

		$this->db->from($this->tablePengguna);

		$i = 0;
		/*-- looping awal  --*/
		foreach ($this->column_searchPengguna as $item){

			/*-- jika datatable mengirimkan pencarian dengan metode POST   --*/
			if($_POST['search']['value']) {

				/*-- looping awal  --*/
				if($i===0){

					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);

				}else{

					$this->db->or_like($item, $_POST['search']['value']);

				}

				if(count($this->column_searchPengguna) - 1 == $i) 
					$this->db->group_end(); 
			}

			$i++;
		}

		if(isset($_POST['order'])){

			$this->db->order_by($this->column_orderPengguna[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

		}else if(isset($this->orderPengguna)){

			$orderPengguna = $this->orderPengguna;
			$this->db->order_by(key($orderPengguna), $orderPengguna[key($orderPengguna)]);

		}
	}

	function get_pengguna(){

		$this->_get_pengguna_query();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();

	}


	function count_filtered_pengguna(){

		$this->_get_pengguna_query();
		$query = $this->db->get();
		return $query->num_rows();

	}


	function count_all_pengguna(){

		$this->db->from($this->tablePengguna);
		return $this->db->count_all_results();

	}


	function seacrhSiswaLaporan($id,$awal,$akhir){

		$this->db->select('*');
		$this->db->select('tb_pelanggaran.id as id_pelanggaran');
		$this->db->select('tb_siswa.id as id_siswa');
		$this->db->select('tb_kelas.id as id_kelas');
		$this->db->select('tb_guru.id as id_guru');
		$this->db->select('tb_wali.id as id_wali');
		$this->db->select('tb_tipe_pelanggaran.id as id_tipe_pelanggaran');
		$this->db->from('tb_pelanggaran');
		$this->db->join('tb_siswa','tb_pelanggaran.student_id = tb_siswa.id');
		$this->db->join('tb_kelas','tb_pelanggaran.class_id = tb_kelas.id');
		$this->db->join('tb_guru','tb_pelanggaran.teacher_id = tb_guru.id');
		$this->db->join('tb_wali','tb_pelanggaran.wali_id = tb_wali.id');
		$this->db->join('tb_tipe_pelanggaran','tb_pelanggaran.type_id = tb_tipe_pelanggaran.id');
		$this->db->where('tb_siswa.id', $id);
		$query = $this->db->get();
		return $query->row();


	}


}