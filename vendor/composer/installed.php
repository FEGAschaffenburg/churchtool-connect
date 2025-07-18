<?php return array(
    'root' => array(
        'name' => 'kai-naumann/churchtool-connect',
        'pretty_version' => 'dev-main',
        'version' => 'dev-main',
        'reference' => '488fce04900e1af7fbed2756dad86052caaee699',
        'type' => 'project',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => true,
    ),
    'versions' => array(
        'composer/installers' => array(
            'pretty_version' => 'v2.3.0',
            'version' => '2.3.0.0',
            'reference' => '12fb2dfe5e16183de69e784a7b84046c43d97e8e',
            'type' => 'composer-plugin',
            'install_path' => __DIR__ . '/./installers',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'kai-naumann/churchtool-connect' => array(
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'reference' => '488fce04900e1af7fbed2756dad86052caaee699',
            'type' => 'project',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'twbs/bootstrap' => array(
            'pretty_version' => 'v5.3.7',
            'version' => '5.3.7.0',
            'reference' => 'e0032ae6a5a628a51a8552091816cec09b6434df',
            'type' => 'library',
            'install_path' => __DIR__ . '/../twbs/bootstrap',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'twitter/bootstrap' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => 'v5.3.7',
            ),
        ),
    ),
);
