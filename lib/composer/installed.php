<?php return array(
    'root' => array(
        'name' => 'wp-plus/wp-oop-base',
        'pretty_version' => 'dev-main',
        'version' => 'dev-main',
        'reference' => '673a74505367bc6cea46426e32d1c6d89a33b7cd',
        'type' => 'wordpress-plugin',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(
            0 => '1.x-dev',
        ),
        'dev' => true,
    ),
    'versions' => array(
        'php-stubs/wordpress-stubs' => array(
            'pretty_version' => 'v6.5.2',
            'version' => '6.5.2.0',
            'reference' => '379f17a90c01498d4c99a0d15aab6e7aa6a2c840',
            'type' => 'library',
            'install_path' => __DIR__ . '/../php-stubs/wordpress-stubs',
            'aliases' => array(),
            'dev_requirement' => true,
        ),
        'wp-plus/wp-oop-base' => array(
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'reference' => '673a74505367bc6cea46426e32d1c6d89a33b7cd',
            'type' => 'wordpress-plugin',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(
                0 => '1.x-dev',
            ),
            'dev_requirement' => false,
        ),
    ),
);
