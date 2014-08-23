<?php

Pheal\Core\Config::getInstance()->cache = new Pheal\Cache\FileStorage(app_path() . '/storage/cache/pheal/');
Pheal\Core\Config::getInstance()->http_ssl_certificate_file = app_path() . '/config/certs/GeoTrustGlobalCA.crt';

return array(

    // Overwrite in environment specific settings (eg. app/config/production/phealng.php) to prevent these being saved
    // in the repo
    'keyID' => '',
    'vCode' => '',

);