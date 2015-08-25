<?php
require_once('./library/Api.php');
$api = new Api;
$request = '';
if (array_key_exists('PATH_INFO', $_SERVER))
{
	$request = $_SERVER['PATH_INFO'];
}
$uri = explode('/', $request);
foreach ($uri as $key=>&$bit)
{
	if (empty($bit))
	{
		unset($uri[$key]);
	}
}
$uri = array_values($uri);

if (!array_key_exists(0, $uri))
{
	$uri[0] = 'index';
}

switch ($uri[0])
{
	case 'avatar':
		$controller = 'avatar.php';
		break;
	case 'skin':
		$controller = 'skin.php';
		break;
	case 'hat':
		$controller = 'hat.php';
		break;
	case 'body':
		$controller = 'body.php';
		break;
	case 'index':
		$controller = 'index.php';
		break;
}