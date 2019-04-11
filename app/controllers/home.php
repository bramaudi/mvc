<?php

class Home extends Controllers {

	public function main($user = 'Brama Udi')
	{
		$data['param'] = $user;
		$data['plugin'] = $this->plugin->slugify($user);
		$data['user'] = $this->model('Users')->users;
		$this->view('home/index', $data);
	}
	
}