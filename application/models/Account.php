<?php

class Account extends CI_Model {

	/**
	 * DOCU: This function will process the login form
	 * Created at: Nov 1 2022
	 * @author: v88jet
    */
	public function process_login($data){
        $result = ['status' => true, 'result' => null, 'message' => ''];
        try{
            foreach($data as $key => $value){
                if ($this->security->xss_clean($value, TRUE) === FALSE){
                    throw new Exception('You enterned a suspicious input');
                }
            }
            
            if($data['email'] === ''){
                throw new Exception('Email is missing');
            }
            if(!preg_match(EMAIL_REGEX, $data['email'])){
                throw new Exception('Invalid email format');
            }
            if($data['password'] === ''){
                throw new Exception('Password is missing');
            }

            $query = "SELECT id, password FROM users WHERE email = ?";
            $query_result = $this->db->query($query, [$data['email']])->row_array();

            if(!$query_result){
                throw new Exception('No user account found');
            }
            if($query_result['passowrd'] !== md5($data['password'].SECRET_KEY)){
                throw new Exception('Incorrect password');
            }

            $user_id = $query_result['id'];
            $result['result'] = $user_id;
        }catch(Exception $e){   
            $result['status']   = false;
            $result['message']  = $e->getMessage();
        }finally{
            return $result;
        }
	}

    /**
	 * DOCU: This function will process the signup form
	 * Created at: Nov 1 2022
	 * @author: v88jet
    */
	public function process_signup($data){
        $result = ['status' => true, 'result' => null, 'message' => ''];
        try{
            foreach($data as $key => $value){
                if ($this->security->xss_clean($value, TRUE) === FALSE){
                    throw new Exception('You enterned a suspicious input');
                }
            }
            if($data['fname'] === '' || strlen($data['fname']) < 2){
                throw new Exception('First name is missing or too short, at least 2 chars is required');
            }
            if($data['lname'] === '' || strlen($data['lname']) < 2){
                throw new Exception('Last name is missing or too short, at least 2 chars is required');
            }
            if($data['password'] === '' || strlen($data['password']) < 9){
                throw new Exception('Password is missing or too short, at least 8 chars is required');
         
            }
            if($data['confirm_password'] === '' || strlen($data['confirm_password']) < 9){
                throw new Exception('Confirm password is missing, at least 8 chars is required');
            }
            if($data['confirm_password'] === $data['password']){
                throw new Exception('Confirm password and password must match');
            }
            if($data['email'] === ''){
                throw new Exception('Email is missing');
            }
            if(!preg_match(EMAIL_REGEX, $data['email'])){
                throw new Exception('Invalid email format');
            }
            if(!preg_match(NAME_REGEX, $data['fname']) || !preg_match(NAME_REGEX, $data['lname'])){
                throw new Exception('Invalid email format');
            }
            $user_id = 1;
            $result['result'] = $user_id;
        }catch(Exception $e){   
            $result['status']   = false;
            $result['message']  = $e->getMessage();
        }finally{
            return $result;
        }
	}
}