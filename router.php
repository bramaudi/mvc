<?php
/**
 * URL Scheme
 * host/{controller}/{method}/{params @array}
 */

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
$path = './controllers/'.$controller.'.php';

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
			echo '<span style="color: black;background: yellow; font-weight: bold">ERR</span>: method "<span style="background:#ddd;"><code>'.$method.'</code></span>" required <span style="background:#f0f0f0;"><code><b>"'.$requiredParams.'"</b> parameter(s)</code></span>.';
		}
	}
	
	else {	
		if (empty($method)) {
			echo '<span style="color: black;background: yellow; font-weight: bold">ERR</span>: method is empty.';
		} else {
			echo '<span style="color: black;background: yellow; font-weight: bold">ERR</span>: method "<span style="background:#f0f0f0;"><code>'.$method.'</code></span>" not found.';
		}
	}

}

else {
	if (empty($controller)) {
		echo '<span style="color: red; font-weight: bold">ERR</span>: controller is empty.';
	}
	else {
		echo '<span style="color: red; font-weight: bold">ERR</span>: controller "<span style="background:#f0f0f0;"><code>'.$controller.'</code></span>" not found.';
	}
}