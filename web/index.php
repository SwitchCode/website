<?php

	require_once __DIR__ . '/../vendor/autoload.php';
	
	define('ROOT', '/' . basename(dirname(__DIR__)) . '/');
	
	$loader = new Twig_Loader_Filesystem('../src');
	$twig = new Twig_Environment($loader, array(
		'cache' => false,//'../cache', // replace that if you want to have a cache
	));
	
	$url = "";
	if(isset($_GET['f']))
	{
		$tabs = explode('/', $_GET['f']);
		$i = 0;
		foreach($tabs as $tab)
		{
			if($tab != NULL)
			{
				if($i == 0)
				{
					$url .= $tab;
				}
				else
				{
					$url .= '/views/' . $tab;
				}
				$i++;
			}
		}
		if($i == 1)
		{
			$url2 = 'site/views/' . $url . '.html';
			$url .= '/views/index';
		}
	}
	
	$url .= ".html";
	
	try
	{
		$template = $twig->loadTemplate($url);
		echo $template->render(array('root' => ROOT));
	}
	catch(Twig_Error_Loader $e)
	{
		if(isset($url2))
		{
			try
			{
				$template = $twig->loadTemplate($url2);
				echo $template->render(array('root' => ROOT));
			}
			catch(Twig_Error_Loader $e)
			{
				$template = $twig->loadTemplate('404.html');
				echo $template->render(array('root' => ROOT));
			}
		}
		else
		{
			$template = $twig->loadTemplate('404.html');
			echo $template->render(array('root' => ROOT));
		}
	}