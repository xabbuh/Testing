<?php

$config = array(
    'session' => array(
        'backend' =>  '%phpcr_backend%',
        'workspace' => '%phpcr_workspace%',
        'username' => '%phpcr_user%',
        'password' => '%phpcr_pass%',
    ),
    'odm' => array(
        'auto_mapping' => true,
        'auto_generate_proxy_classes' => '%kernel.debug%',
        'locales' => array(
            'en' => array('de', 'fr'),
            'de' => array('en', 'fr'),
            'fr' => array('en', 'de'),
        ),
        'mappings' => array(
            'test_default' => array(
                'type' => 'annotation',
                'prefix' => 'Symfony\Cmf\Component\Testing\Document',
                'dir' => CMF_TEST_ROOT_DIR.'/src/Symfony/Cmf/Component/Testing/Document',
                'is_bundle' => false,
            ),
        ),
    ),
);

$kernelRootDir = $container->getParameter('kernel.root_dir');
$bundleFQN = $container->getParameter('cmf_testing.bundle_fqn');
$phpcrOdmDocDir = sprintf('%s/../Document', $kernelRootDir);
$phpcrOdmDocPrefix = sprintf('%s\Tests\Resources\Document', $bundleFQN);

if (file_exists($phpcrOdmDocDir)) {

    $config['odm']['mappings']['test_additional'] = array(
        'type' => 'annotation',
        'prefix' => $phpcrOdmDocPrefix,
        'dir' => $phpcrOdmDocDir,
        'is_bundle' => false,
    );
}

$container->loadFromExtension('doctrine_phpcr', $config);
