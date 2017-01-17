<?php

namespace AppBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\Config\FileLocator;

/**
 * Description of AppExtension
 *
 * @author Arturas
 */
class AppExtension implements ExtensionInterface
{
    /**
     * 
     * @param array $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yml');
    }

    /**
     * 
     * @return string
     */
    public function getAlias() 
    {
        return 'app';
    }

    public function getNamespace() {
        
    }

    public function getXsdValidationBasePath() {
        
    }

}
