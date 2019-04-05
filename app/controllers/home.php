<?php

class Home extends Controllers {

	public function main($user = 'guest')
	{
		$data['user'] = $this->model('Users')->users;
		$this->view('home/index', $data);
	}
	
}