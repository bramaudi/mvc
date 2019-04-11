<?php
/**
 * URL Scheme
 * host/{controller}/{method}/{params @array}
 */

class Core extends Controllers {

	protected $controller = 'home';
	protected $method = 'main';
	protected $params = [];
	protected $url;
	protected $path;
	protected $debug = 0;

	public function __construct($debug = 0)
	{
		$url = explode('/', rtrim($_SERVER['REQUEST_URI'], '/'));

		$params = array();
		if (count($url) > 3)
		{
			for ($i = 3; $i < count($url); $i++) {
				array_push($params, $url[$i]);
			}
		}

		$controller = isset($url[1]) ? $url[1] : 'home';
		$method = isset($url[2]) ? $url[2] : 'main';
		$path = './app/controllers/'.$controller.'.php';

		// send to debug()
		$this->controller = $controller;
		$this->method	= $method;
		$this->params	= $params;
		$this->url = $url;
		$this->path = $path;
		$this->debug = $debug;

		if (file_exists($path))
		{
			require $path;
			$c = new $controller;

			if (method_exists($c, $method))
			{
				$mtd = new ReflectionMethod($c, $method);
				$requiredParams = $mtd->getNumberOfRequiredParameters();
				$numParams = count($params) > 0 ? count($params) : 0;

				if ($numParams >= $requiredParams)
				{
					call_user_func_array(array($c, $method), $params);
				}
				else {
					if ($debug) {
						// method required parameter
						echo '<span style="background: #ffd; font-weight: bold">WARN</span>: method "<span style="background:#ddd;"><code>'.$method.'</code></span>" required <span style="background:#f0f0f0;"><code><b>"'.$requiredParams.'"</b> parameter(s)</code></span>.';
					}
				}
			}
			
			else {	
				if ($debug)
				{
					if (empty($method)) {
						// method is empty
						echo '<span style="background: #ffd; font-weight: bold">WARN</span>: method is empty.';
					} else {
						// method % not found
						echo '<span style="background: #ffd; font-weight: bold">WARN</span>: method "<span style="background:#f0f0f0;"><code>'.$method.'</code></span>" not found.';
					}
				}
			}

		}

		else
		{
			
			if ($debug)
			{
				if (empty($controller)) {
					// controller is empty
					echo '<span style="background: #fdd; font-weight: bold">ERR</span>: controller is empty.';
				} else {
					// controller % not found
					echo '<span style="background: #fdd; font-weight: bold">ERR</span>: controller "<span style="background:#f0f0f0;"><code>'.$controller.'</code></span>" not found.';
				}
			}

		}
	}


	public function debug()
	{
		echo '<hr/><pre style="padding: 10px; background: #f0f0f0; border: 1px solid #333; display: inline-block">';
		print_r($this);
		echo '</pre>';
	}
}