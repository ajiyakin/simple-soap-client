<?php

use ajiyakin\simplesoapclient\config\SimpleSoapConfigInterface as ConfigInterface;
use ajiyakin\simplesoapclient\SimpleSoapClient as SoapClient;

/**
 * Description of SimpleSoapClientTest
 *
 * @author Aji Nurul Yakin <aji.yakin@redawning.com>
 */
class SimpleSoapClientTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function tryToSendSoapRequest()
    {
        $config = new SoapConfig();
        $config->setFunctionName('UnitDescriptiveInfo');
        
        $unitDescInfoParams = array(
            'UnitDescriptiveInfos' => array(
                'UnitDescriptiveInfo' => array(
                    'UnitCode' => '1956-91226',     // 1726-74839
                    '_' => '',
                ),
            ),
        );
        
        $config->setParams($unitDescInfoParams);
        
        $soapClient = new SoapClient($config);
        $result = $soapClient->execute();
        print_r($result);
    }
}

class SoapConfig implements ConfigInterface
{
    const TARGET_TEST = 'Test';
    const TARGET_PRODUCTION = 'Production';

    private $url = 'https://api.escapia.com/EVRNService.svc?wsdl';
    private $username = 'RedAwning';
    private $password = 'qie08!diomm!';
    private $functionName = NULL;
    private $params = NULL;
    private $target = self::TARGET_TEST;
    private $version = '1.000';

    /**
     * Set Escapia's SOAP URL
     * 
     * @param str $newUrl Escapia's SOAP URL
     * @return str URL (method chaining)
     */
    public function setUrl($newUrl) 
    {
        return $this->url = $newUrl;
    }

    /**
     * Get current Escapia's SOAP URL
     * 
     * @return str URL
     */
    public function getUrl() 
    {
        return $this->url;
    }

    /**
     * Set username for Escapia's SOAP authentication
     * 
     * @param str $newUsername
     * @return str Username
     */
    public function setUsername($newUsername) 
    {
        return $this->username = $newUsername;
    }

    /**
     * Get current Username for Escapia's SOAP authentication
     * 
     * @return str Username
     */
    public function getUsername() 
    {
        return $this->username;
    }

    /**
     * Set password for Escapia's SOAP authentication
     * 
     * @param str $newPassword
     * @return str Password
     */
    public function setPassword($newPassword) 
    {
        return $this->password = $newPassword;
    }

    /**
     * Get current password for Escapia's SOAP authentication
     * 
     * @return str Password
     */
    public function getPassword() 
    {
        return $this->password;
    }

    /**
     * Set function name who will call by SOAP Client
     * 
     * @param str $newFunctionName Escapia's SOAP function name
     * @return str (Method chaining)
     */
    public function setFunctionName($newFunctionName) 
    {
        return $this->functionName = $newFunctionName;
    }

    /**
     * Get function name that will be call on Escapia's SOAP
     * 
     * @return str
     */
    public function getFunctionName() 
    {
        return $this->functionName;
    }

    /**
     * Set params who will be sent to Escapia's SOAP.<br/>
     * There are 3 params that automatically attach by default (or you can set it
     * manually by call setter and getter method) to SOAP params.<br/>
     * There is POS, Target and Version params.<br/>
     * Remember, You <b>MUST</b> attach params from level 0<br/>
     * 
     * For more info about Escapia's SOAP params, see
     * https://customer.escapia.com/distribution/api/evrn-api-documentation
     * 
     * @param array $newParams Escapia's SOAP params (Except POS, Target and Version params)
     * @return array Params who will be sent to escapia's SOAP
     */
    public function setParams($newParams) 
    {
        /**
         * This is the default params who will be sent to escapia's SOAP
         */
        $baseParams = array(
            'POS' => array(                         // Level 0
                'Source' => array(                  // Level 1
                    'RequestorID' => array(         // Level 2
                        '_' => '',                  // Level 3
                        'ID' => $this->username,
                        'MessagePassword' => $this->password,
                    ),
                ),
            ),
            'Target' => $this->target,
            'Version' => $this->version,
        );

        $tempParams = array_merge($baseParams, $newParams);

        $finalParams = array(
            '_' => $tempParams,
        );

        return $this->params = $finalParams;
    }

    public function getParams() 
    {
        return $this->params;
    }
    
    public function setVersion($newVersion)
    {
        $this->version = $newVersion;
    }
    
    public function getVersion()
    {
        return $this->version;
    }
}