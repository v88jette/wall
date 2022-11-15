<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends Sessions {

	public function __construct(){
		parent::__construct();

		//$this->session->set_userdata('user_id', 1);
		$this->user = $this->session->userdata('user_id');

		if (!$this->user){
			redirect('/');
		}
	}

	public function index(){
		$result = [];
		$this->load_view('posts/index', ['posts' => $result]);
	}


}
