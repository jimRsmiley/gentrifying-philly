<?php

return array(
    'modules' => array(
        'DoctrineModule',
        'DoctrineORMModule',
        'PermitHeatMapper',
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            '../config/autoload/local.php',
        ),
        'module_paths' => array(
            'module',
            'vendor',
        ),
    ),
);
?>
