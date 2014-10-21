<?php


$base_url = str_replace(realpath ($_SERVER["DOCUMENT_ROOT"])."\\", "", realpath (dirname(__FILE__)));

define("OPCOLORWORKINGFOLDER", str_replace('\\','/',$base_url));


Object::add_extension('CMSSettingsController', 'OpColorExtension');