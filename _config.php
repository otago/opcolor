<?php

// this allows you to put your module in the /mysite folder, as well as 
// installing via composer.
$base_url = str_replace(BASE_PATH, "", dirname(__FILE__));
$base_url_unix = str_replace('\\','/',$base_url);
$base_url_clean = ltrim($base_url_unix, '/');

define("OPCOLORWORKINGFOLDER", $base_url_clean);

Object::add_extension('CMSSettingsController', 'OpColorExtension');