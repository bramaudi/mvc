<?php

class Controllers {

	private $tpl;
	public $plugin;

	public function __construct()
	{
		$this->tpl = new tinyTemplate();
		$this->plugin = new Plugin();
	}


	public function view($view, $data = [])
	{
		$path = './app/views/' .$view. '.html';
		if (file_exists($path)) {
			foreach ($data as $key => $value) {
				$this->tpl->set($key, $value);
			}
			echo $this->tpl->fetch($path);
			// $file = file_get_contents($path);
			// foreach ($data as $key => $value) {
			// 	$file = str_replace('{$'.$key.'}', $value, $file);
			// }
			// echo $file;
		}
		else {
			if (DEBUG_MODE) {
				// views % not found
				echo '<span style="background: #dfd; font-weight: bold">INFO</span>: views "<span style="background:#f0f0f0;"><code>'.$view.'</code></span>" not found.';
			}
			else {
				require_once './app/views/errors/404.html';
			}
		}
	}


	public function model($model)
	{
		$path = './app/models/' .$model. '.php';
		if (file_exists($path)) {
			require_once $path;
			return new $model;
		}
		else {
			if (DEBUG_MODE) {
				// views % not found
				echo '<span style="background: #dfd; font-weight: bold">INFO</span>: models "<span style="background:#f0f0f0;"><code>'.$model.'</code></span>" not found.';
			}
			else {
				require_once './app/views/errors/404.html';
			}
		}
	}
	
}