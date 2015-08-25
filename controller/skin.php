<?php
$name = '';
if (array_key_exists(1, $uri))
{
	$parts = explode('.', $uri[1]);
	$name = strtolower($parts[0]);
}

$skinBase64 = $api->getSkin($name);

require_once('library/Render.php');
$render = new Render;

$render->renderSkin($skinBase64);