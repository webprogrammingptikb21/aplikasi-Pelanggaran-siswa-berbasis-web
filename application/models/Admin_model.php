<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function website(){

		$query = "SELECT * FROM tb_website";
		return $this->db->query($query)->row()->school_name;

	}

	public function getCountSiswa(){

		$query = "SELECT COUNT(std_name) as siswa FROM tb_siswa";
		return $this->db->query($query)->row()->siswa;

	}

	public function getCountTipePelanggaran(){

		$query = "SELECT COUNT(violation_name) as nmPelanggaran FROM tb_tipe_pelanggaran";
		return $this->db->query($query)->row()->nmPelanggaran;

	}

	public function getCountUsers(){

		$query = "SELECT COUNT(username) as username FROM tb_users";
		return $this->db->query($query)->row()->username;

	}

	public function getCountGuru(){

		$query = "SELECT COUNT(nik) as nik FROM tb_guru";
		return $this->db->query($query)->row()->nik;

	}

	public function TopMurid(){

		$this->db->select('SUM(tb_pelanggaran.point) as total_poin');
		$this->db->select('count(tb_pelanggaran.id) as total_pelanggaran');
		$this->db->select('tb_siswa.id as id_siswa');
		$this->db->select('tb_pelanggaran.type_id');
		$this->db->select('tb_siswa.std_name');
		$this->db->select('tb_siswa.nisn');
		$this->db->from('tb_pelanggaran');
		$this->db->join('tb_siswa','tb_pelanggaran.student_id = tb_siswa.id', 'left');
		$this->db->group_by('tb_pelanggaran.student_id');
		$this->db->order_by('total_poin', 'desc');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result();

	}

	public function TopPelanggaran(){

		$this->db->select('tb_pelanggaran.id');
		$this->db->select('count(tb_pelanggaran.id) as total_pelanggaran');
		$this->db->select('tb_pelanggaran.type_id');
		$this->db->select('tb_tipe_pelanggaran.violation_name');
		$this->db->from('tb_pelanggaran');
		$this->db->join('tb_tipe_pelanggaran','tb_pelanggaran.type_id = tb_tipe_pelanggaran.id');
		$this->db->group_by('tb_pelanggaran.type_id');
		$this->db->order_by('total_pelanggaran', 'desc');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result();

	}

	public function getPelanggaranByID($id){

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
		return $query->result();

	}
	public function getOnePelanggaranByID($id){


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

	public function getCountPelanggaran($id){

		$query = "SELECT COUNT(type_id) AS total_pelanggaran, SUM(point) AS total_point FROM tb_pelanggaran WHERE student_id = $id";
		return $this->db->query($query)->row();

	}


	public function getKategoriPelanggaran(){

		$query = "SELECT * FROM tb_tipe_pelanggaran";
		return $this->db->query($query)->result();

	}

	public function getOneKategoriPelanggaran($id){

		$query = "SELECT * FROM tb_tipe_pelanggaran WHERE id = '$id' ";
		return $this->db->query($query)->row();

	}

	public function getKelas(){

		$query = "SELECT * FROM tb_kelas ";
		return $this->db->query($query)->result();

	}

	public function getOneKelas($id){

		$query = "SELECT * FROM tb_kelas WHERE id = '$id'";
		return $this->db->query($query)->row();

	}

	public function getSiswa(){

		$query = "SELECT * FROM tb_siswa";
		return $this->db->query($query)->result();

	}

	public function getOneSiswa($id){

		$this->db->select('*');
		$this->db->select('tb_siswa.id as id_siswa');
		$this->db->select('tb_kelas.id as id_kelas');
		$this->db->select('tb_wali.id as id_wali');
		$this->db->select('tb_wali.phone_number as phone_number_wali');
		$this->db->from('tb_siswa');
		$this->db->join('tb_kelas','tb_siswa.class_id = tb_kelas.id');
		$this->db->join('tb_wali','tb_siswa.id = tb_wali.student_id');
		$this->db->where('tb_siswa.id', $id);
		$query = $this->db->get();
		return $query->row();

	}

	public function getGuru(){

		$query = "SELECT * FROM tb_guru";
		return $this->db->query($query)->result();

	}

	public function getOneGuru($id){

		$query = "SELECT * FROM tb_guru WHERE id = '$id' ";
		return $this->db->query($query)->row();

	}

	public function getOneWali($id){

		$query = "SELECT * FROM tb_wali WHERE student_id = '$id' ";
		return $this->db->query($query)->row();

	}

	public function getOnePelanggaran($id){


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
		$this->db->where('tb_pelanggaran.id', $id);
		$query = $this->db->get();
		return $query->row();

	}

	public function getUsers(){

		$query = "SELECT * FROM tb_users";
		return $this->db->query($query)->result();

	}


	public function getOneUsers($id){

		$query = "SELECT * FROM tb_users WHERE id = '$id' ";
		return $this->db->query($query)->row();

	}

	public function getOneWebsite($id){

		$query = "SELECT * FROM tb_website WHERE id = '$id' ";
		return $this->db->query($query)->row();

	}

}