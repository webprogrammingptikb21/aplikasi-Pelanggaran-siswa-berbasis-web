<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}


	public function website(){

		$query = "SELECT * FROM tb_website";
		return $this->db->query($query)->row()->school_name;


	}
}