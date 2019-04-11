<?php

class Users extends Database {
	
	public $users;

	public function __construct(Type $var = null)
	{
		$this->users = array(
			array(
				'id'			=> 1,
				'name'		=> 'John'
			),
			array(
				'id'			=> 2,
				'name'		=> 'Doe'
			),
			array(
				'id'			=> 3,
				'name'		=> 'Oddy'
			)
		);
	}

}