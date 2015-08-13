<?php

namespace aji\simplesoap\config;

/**
 *
 * @author Aji Nurul Yakin <aji.yakin@redawning.com>
 */
interface SimpleSoapConfigInterface
{
    public function setUrl($newUrl);
    public function getUrl();
    
    public function setUsername($newUsername);
    public function getUsername();
    
    public function setPassword($newPassword);
    public function getPassword();
    
    public function setParams($newParams);
    public function getParams();
    
    public function setFunctionName($newFunctionName);
    public function getFunctionName();
}
