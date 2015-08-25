<?php
require('./library/library.php');

if (isset($controller))
{
	require_once('./controller/'.$controller);
}