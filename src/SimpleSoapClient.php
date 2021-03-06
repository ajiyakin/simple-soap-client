<?php

namespace ajiyakin\simplesoapclient;

use ajiyakin\simplesoapclient\config\SimpleSoapConfigInterface as ConfigInterface;

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
     * ajiyakin\simplesoapclient\config\SimpleSoapConfigInterface
     * 
     * @param ConfigInterface $configuration Configuration interface
     */
    public function __construct(ConfigInterface $configuration)
    {
        $this->configuration = $configuration;
        $this->soapClient = new \SoapClient($this->configuration->getUrl());
    }
    
    /**
     * Set configuration
     * 
     * @param ConfigInterface $newConfiguration
     * @return SimpleSoapConfigInterface Current configuration
     */
    public function setConfiguration(ConfigInterface $newConfiguration)
    {
        return $this->configuration = $newConfiguration;
    }
    
    /**
     * Get current configuration
     * 
     * @return SimpleSoapConfigInterface
     */
    public function getConfiguration()
    {
        return $this->configuration;
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
