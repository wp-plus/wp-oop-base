<?php return array(
    'root' => array(
        'name' => 'wp-plus/wp-oop-base',
        'pretty_version' => 'dev-main',
        'version' => 'dev-main',
        'reference' => 'afd4e5930945b1f947921ffe27fcafda5d7d488f',
        'type' => 'wordpress-plugin',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(
            0 => '1.x-dev',
        ),
        'dev' => true,
    ),
    'versions' => array(
        'php-stubs/wordpress-stubs' => array(
            'pretty_version' => 'v6.4.3',
            'version' => '6.4.3.0',
            'reference' => '6105bdab2f26c0204fe90ecc53d5684754550e8f',
            'type' => 'library',
            'install_path' => __DIR__ . '/../php-stubs/wordpress-stubs',
            'aliases' => array(),
            'dev_requirement' => true,
        ),
        'wp-plus/wp-oop-base' => array(
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'reference' => 'afd4e5930945b1f947921ffe27fcafda5d7d488f',
            'type' => 'wordpress-plugin',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(
                0 => '1.x-dev',
            ),
            'dev_requirement' => false,
        ),
    ),
);
