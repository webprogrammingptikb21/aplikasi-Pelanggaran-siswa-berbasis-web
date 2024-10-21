<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}


	public function website(){

		$query = "SELECT * FROM tb_website";
		return $this->db->query($query)->row()->school_name;

	}

	public function getOneSiswa($nisn){

		$this->db->select('*');
		$this->db->select('tb_siswa.id as id_siswa');
		$this->db->select('tb_kelas.id as id_kelas');
		$this->db->select('tb_wali.id as id_wali');
		$this->db->select('tb_wali.phone_number as phone_number_wali');
		$this->db->from('tb_siswa');
		$this->db->join('tb_kelas','tb_siswa.class_id = tb_kelas.id');
		$this->db->join('tb_wali','tb_siswa.id = tb_wali.student_id');
		$this->db->where('tb_siswa.nisn', $nisn);
		$query = $this->db->get();
		return $query->row();

	}

	public function getPelanggaranByNiSN($nisn){


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
		$this->db->where('tb_siswa.nisn', $nisn);
		$query = $this->db->get();
		return $query->result();

	}

	public function getCountPelanggaran($id){

		$query = "SELECT COUNT(type_id) AS total_pelanggaran, SUM(point) AS total_point FROM tb_pelanggaran WHERE student_id = $id";
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
		$this->db->where('tb_siswa.id', $id);
		$query = $this->db->get();
		return $query->row();

	}
	
}