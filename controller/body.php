<?php
$hat = false;
$name = '';
$size = 100;
$parts = array();
$numParts = 0;
if (array_key_exists(1, $uri))
{
	++$numParts;
	$parts1 = explode('.', $uri[1]);
	if ($parts1[0] == 'hat') $hat = true;
}
if (array_key_exists(2, $uri))
{
	++$numParts;
	$parts2 = explode('.', $uri[2]);
}
if (array_key_exists(3, $uri))
{
	++$numParts;
	$parts3 = explode('.', $uri[3]);
}
if ($numParts > 0)
{
	if (!$hat) $name = $parts1[0];
}
if ($numParts > 1)
{
	if (!$hat)
	{
		$size = $parts2[0];
	}
	else
	{
		$name = $parts2[0];
	}
}
if ($numParts > 2)
{
	if ($hat) $size = $parts3[0];
}
if ($size > 300) $size = 300;
if ($size < 8) $size = 8;

$skinBase64 = $api->getSkin($name);

require_once('library/Render.php');
$render = new Render;

$render->renderBody($skinBase64, $size, $hat);