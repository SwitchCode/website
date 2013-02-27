<?php

	require_once '../vendor/autoload.php';
	
	$loader = new Twig_Loader_Filesystem('../src');
	$twig = new Twig_Environment($loader, array(
		'debug' => 'true',
		'cache' => '../cache',
	));
	
	// TODO : Add protection with Regex
	
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
		echo $template->render(array('the' => 'variables', 'go' => 'here'));
	}
	catch(Twig_Error_Loader $e)
	{
		echo '404 <br />';
		echo $url . ' not found';
	}