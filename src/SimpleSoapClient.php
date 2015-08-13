<?php

namespace aji\simplesoap;

use aji\simplesoap\config\SimpleSoapConfigInterface as ConfigInterface;

/**
 * Simple Soap Client Caller
 *
 * @author Aji Nurul Yakin <aji.yakin@redawning.com>
 */
class SimpleSoapClient
{
    private $soapClient;
    private $configuration;
    
    /**
     * Initalization need class that implement
     * aji\simplesoap\config\SimpleSoapConfigInterface
     * 
     * @param ConfigInterface $configuration Configuration interface
     */
    public function __construct(ConfigInterface $configuration)
    {
        $this->configuration = $configuration;
        $this->soapClient = new \SoapClient($this->configuration->getUrl());
    }
    
    /**
     * Execute SOAP caller to call function name that was specified in injected
     * Soap configuration
     * 
     * @return object Result from the SOAP request
     */
    public function execute()
    {
        $result = $this->soapClient->__soapCall(
                $this->configuration->getFunctionName(), 
                $this->configuration->getParams());
        
        return $result;
    }
}
