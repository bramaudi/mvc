<?php

class Users extends Database {
	
	public $users;

	public function __construct(Type $var = null)
	{
		$this->users = array(
			array(
				'nama'		=> 'Brama Udi',
				'alamat'	=> 'Mendalan'
			),
			array(
				'nama'		=> 'Brama Udi',
				'alamat'	=> 'Mendalan'
			),
			array(
				'nama'		=> 'Brama Udi',
				'alamat'	=> 'Mendalan'
			)
		);
	}

	public function get()
	{
		$this->stmt = $this->db->prepare('SELECT * FROM users');
		$this->stmt->execute();

		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}

}