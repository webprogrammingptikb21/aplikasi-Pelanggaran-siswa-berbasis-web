<?php if (!defined("BASEPATH")) exit("No direct script access allowed");

function is_login(){

	$ci = get_instance();
	if (!$ci->session->userdata('username')){
		redirect('home');

	}
	else{

		$level = $ci->session->userdata('level');
		$parents = $ci->uri->segment(1);


		if($level !== ucfirst($parents)){
			redirect('home/blocked');
		}


	}


}