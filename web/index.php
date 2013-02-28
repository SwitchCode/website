<?php

	require_once __DIR__ . '/../vendor/autoload.php';
	
	$loader = new Twig_Loader_Filesystem('../src');
	$twig = new Twig_Environment($loader, array(
		'debug' => 'true',
		'cache' => '../cache',
	));
	
	// TODO : Add protection with Regex
	
	$css_dir = '/SwitchCode/web/stylesheets/';
	$url = "";
	if(isset($_GET['cat']))
	{
		$url .= $_GET['cat'];
		if(isset($_GET['file']))
		{
			$url .= '/views/' . $_GET['file'];
		}
		else
		{
			$url .= '/views/' . "index";
		}
	}
	else
	{
		$url .= "site";
		if(isset($_GET['file']))
		{
			$url .= '/views/' . $_GET['file'];
		}
		else
		{
			$url .= '/views/' . "index";
		}
	}
	
	$url .= ".html";
	
	try
	{
		$template = $twig->loadTemplate($url);
		echo $template->render(array('css_dir' => $css_dir));
	}
	catch(Twig_Error_Loader $e)
	{
		echo '404 <br />';
		echo $url . ' not found';
	}