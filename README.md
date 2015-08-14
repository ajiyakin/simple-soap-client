# simple-soap-client
Simple Soap Client Using PHP

## How to Install

### Using composer

        {
            ...
            "repositories": [
                {
                    "type": "vcs",
                    "url": "https://github.com/ajiyakin/simple-soap-client"
                }
            ],
            "require": {
                "ajiyakin/simplesoapclient": "1.0"
            }
            ...
        }

## How to Use

1. Create class that implementing `ajiyakin\simplesoapclient\config\SimpleSoapConfigInterface` for your custom configuration
2. Instantiate `ajiyakin\simplesoapclient\SimpleSoapClient` and inject your configuration object (from step 1 above)
3. Call `execute` function from that object (from step 2)


## Example

### Unit Testing Example

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

            public function setUrl($newUrl) 
            {
                return $this->url = $newUrl;
            }

            public function getUrl() 
            {
                return $this->url;
            }

            public function setUsername($newUsername) 
            {
                return $this->username = $newUsername;
            }

            public function getUsername() 
            {
                return $this->username;
            }

            public function setPassword($newPassword) 
            {
                return $this->password = $newPassword;
            }

            public function getPassword() 
            {
                return $this->password;
            }

            public function setFunctionName($newFunctionName) 
            {
                return $this->functionName = $newFunctionName;
            }

            public function getFunctionName() 
            {
                return $this->functionName;
            }

            public function setParams($newParams) 
            {
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
