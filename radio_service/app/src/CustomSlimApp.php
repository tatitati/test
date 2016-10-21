<?php
namespace Bbc\Radio\App\Src;

class CustomSlimApp extends \Slim\App{
    private $servicesContainer;

    public function __construct($container)
    {
        parent::__construct($container);
    }

    public function setServicesContainer($serviceContainer)
    {
        $this->servicesContainer = $serviceContainer;
    }

    public function getServicesContainer()
    {
        return $this->servicesContainer;
    }
}



