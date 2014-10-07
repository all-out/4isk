<?php

Pheal\Core\Config::getInstance()->access = new \Pheal\Access\StaticCheck();
Pheal\Core\Config::getInstance()->cache = new Pheal\Cache\FileStorage(app_path() . '/storage/cache/pheal/');

return array(

);