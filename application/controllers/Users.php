<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Sessions {

	public function __construct(){
		parent::__construct();

		$this->user = $this->session->userdata('user_id');

		if ($this->user){
			redirect('/home');
		}
	}


	/**
	 * DOCU: This function will render the login page
	 * Created at: Nov 1 2022
	 * @author: v88jet
	 */
	public function index(){
		$this->load_view('users/index');
	} 

	/**
	 * DOCU: This function will render the signup page
	 * Created at: Nov 1 2022
	 * @author: v88jet
	 */
	public function signup(){
		$this->load_view('users/signup');
	}

	/**
	 * DOCU: This function will process the login form
	 * Created at: Nov 1 2022
	 * @author: v88jet
	 */
	public function process_login(){
		$result = $this->account->process_login(['email' => $this->input->post('form')['email'], 'password' => $this->input->post('form')['password']]);
		if(!$result['status']){
			$this->session->set_flashdata('error', $result['message']);
		}else{
			$this->session->set_userdata('user_id', $result['result']);
		}
		redirect('/');
	}

	/**
	 * DOCU: This function will process the signup form
	 * Created at: Nov 1 2022
	 * @author: v88jet
	 */
	public function process_signup(){
		$result = $this->account->process_signup([
			'fname' 			=> $this->input->post('form')['fname'], 
			'lname' 			=> $this->input->post('form')['lname'], 
			'email' 			=> $this->input->post('form')['email'], 
			'password' 			=> $this->input->post('form')['password'],
			'confirm_password' 	=> $this->input->post('form')['confirm_password']]);
		if(!$result['status']){
			$this->session->set_flashdata('error', $result['message']);
		}else{
			$this->session->set_userdata('user_id', $result['result']);
		}
		redirect('/signup');
	}
}
