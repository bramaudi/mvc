<?php

class Home extends Controllers {

	public function main($user = 'Guest')
	{
		$data['param'] = $user;
		$data['user'] = $this->model('Users')->users;
		$this->view('home/index', $data);
	}
	
}