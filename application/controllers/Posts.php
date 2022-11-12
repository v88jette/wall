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

	/**
	 * DOCU: This function will render the home page when the user is logged in
	 * Created at: Nov 1 2022
	 * @author: v88jet
	 */
	public function index(){
		$result = $this->post->get_all_records();
		$this->load_view('posts/index', ['posts' => $result]);
	}

	/**
	 * DOCU: This function will process the creation of a new post/message record
	 * Created at: Nov 1 2022
	 * @author: v88jet
	 */
	public function create(){
		$result = $this->post->create(['user_id' => $this->session->userdata('user_id'), 'content' => $this->input->post('form')['content']]);
		$this->load->view('partials/_post', ['post' => $result]); 
	}
}
