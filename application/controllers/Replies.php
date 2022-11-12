<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Replies extends Sessions {

	/**
	 * DOCU: This function will process the creation of a new reply/comment record
	 * Created at: Nov 1 2022
	 * @author: v88jet
	 */
	public function create($post_id){
		$result = $this->reply->create([]);
		$this->load->view('partials/_reply', ['reply' => $result]);
	}
}
