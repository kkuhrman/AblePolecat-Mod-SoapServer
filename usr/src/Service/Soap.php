<?php
/**
 * @file      AblePolecat-Mod-SoapServer/usr/src/Service/Soap.php
 * @brief     Interface for any class encapsulating inbound or outbound SOAP message.
 *
 * @author    Karl Kuhrman
 * @copyright [BDS II License] (https://github.com/kkuhrman/AblePolecat/blob/master/LICENSE.md)
 * @version   0.6.3
 */

require_once(ABLE_POLECAT_CORE . DIRECTORY_SEPARATOR . 'CacheObject.php');
require_once(implode(DIRECTORY_SEPARATOR, array(ABLE_POLECAT_CORE, 'Exception', 'Service.php')));

interface AblePolecat_Service_SoapInterface extends AblePolecat_AccessControl_ResourceInterface, AblePolecat_CacheObjectInterface {
  /**
   * Return full path to WSDL.
   *
   * @return string Full path to WSDL or null.
   */
  public function getWsdlFullPath();
}

/**
 * Base class for service initiators (respond to request, initiate service, return response).
 */
abstract class AblePolecat_Service_SoapAbstract extends AblePolecat_CacheObjectAbstract implements AblePolecat_Service_SoapInterface {
  
  /**
   * @var string Full path to WSDL.
   */
  private $wsdlFullPath;
  
  /********************************************************************************
   * Implementation of AblePolecat_AccessControl_ArticleInterface.
   ********************************************************************************/
  
  /**
   * General purpose of object implementing this interface.
   *
   * @return string.
   */
  public static function getScope() {
    return 'SERVICE';
  }
  
  /********************************************************************************
   * Implementation of AblePolecat_Service_SoapInterface.
   ********************************************************************************/
  
  /**
   * Return full path to WSDL.
   *
   * @return string Full path to WSDL or null.
   */
  public function getWsdlFullPath() {
    return $this->wsdlFullPath;
  }
  
  /********************************************************************************
   * Helper functions.
   ********************************************************************************/
  
  /**
   * Set full path to WSDL.
   *
   * @param string $wsdlFullPath Full path to WSDL.
   */
  protected function setWsdlFullPath($wsdlFullPath) {
    $this->wsdlFullPath = $wsdlFullPath;
  }
  
  /**
   * Extends __construct().
   */
  protected function initialize() {
    //
    // Class member initialization.
    //
    $this->wsdlFullPath = NULL;
  }
}