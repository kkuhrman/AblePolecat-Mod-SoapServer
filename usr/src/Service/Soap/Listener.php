<?php
/**
 * @file      polecat/core/Service/Soap/Listener.php
 * @brief     Interface for any class which accepts incoming SOAP message.
 *
 * @author    Karl Kuhrman
 * @copyright [BDS II License] (https://github.com/kkuhrman/AblePolecat/blob/master/LICENSE.md)
 * @version   0.6.3
 */

require_once(implode(DIRECTORY_SEPARATOR, array(ABLE_POLECAT_CORE, 'Service', 'Listener.php')));
require_once(implode(DIRECTORY_SEPARATOR, array(ABLE_POLECAT_CORE, 'Service', 'Soap.php')));

interface AblePolecat_Service_Soap_ListenerInterface extends AblePolecat_Service_ListenerInterface, AblePolecat_Service_SoapInterface {
}

/**
 * Base class for SOAP listener.
 */
abstract class AblePolecat_Service_Soap_ListenerAbstract extends AblePolecat_Service_SoapAbstract implements AblePolecat_Service_Soap_ListenerInterface {
  
  /********************************************************************************
   * Implementation of AblePolecat_Service_ListenerInterface.
   ********************************************************************************/
  
  /**
   * Handle incoming service request.
   *
   * @return mixed.
   */
  public function handleServiceRequest() {
    //
    // Create instance of SOAP server.
    //
    $SoapServer = new SoapServer($this->getWsdlFullPath()); 
    $SoapServer->setClass(AblePolecat_Data::getDataTypeName($this)); 
    $SoapServer->setPersistence(SOAP_PERSISTENCE_SESSION);
    $SoapServer->handle();
  }
  
  /********************************************************************************
   * Implementation of AblePolecat_Service_Soap_ListenerInterface.
   ********************************************************************************/
  
  /********************************************************************************
   * Helper functions.
   ********************************************************************************/
  
  /**
   * Extends __construct().
   */
  protected function initialize() {
    
    parent::initialize();
    
    //
    // Disable the PHP WSDL caching feature. 
    //
    ini_set("soap.wsdl_cache_enabled", 0);
    ini_set('soap.wsdl_cache_ttl', 0);
  }
}