<?php

class RaiseNowSignature {
    private static $defaultSignParameters = array(
    'EPP_TRANSACTION_ID', // response only
    'HMAC', // response only
    'AMOUNT',
    'CURRENCY',
    'TEST_MODE',
    'EPAYMENT_STATUS', // response only
    'STORED_CUSTOMER*', // * will be replaced with a regex below
    'STORED_PRODUCT*', // * will be replaced with a regex below
    'STORED_TRANSACTION_TIME',
  );

  /**
   *@param string $secret
   */
  private $secret;
  /**
   * @param string $algorithm
   */
  private $algorithm;
  /**
   * @param array $signature_parameters
   *   The names of the parameters that are be used to generate the signature.
   */
  private $signParameters;

  public function __construct($secret, $algorithm) {
    $this->secret = $secret;
    $this->algorithm = $algorithm;
    $this->signParameters = self::$defaultSignParameters;
  }

  public function getSignParameters() {
    return $this->signParameters;
  }

  public function setSignParameters($signParameters) {
    $this->signParameters = $signParameters;
  }

  /**
   * Signs payment message data.
   *
   * @param array $data
   *   Keys are POST parameter names, values are values.
   *
   * @return string
   *   The signature.
   */
  function signData(array $data) {
    // Filter parameters that are not needed for the signature.
    ksort($data); // note that the parameters need to be sorted alphabetically
    $signature_data_string = '';
    foreach ($this->signParameters as $parameter) {
      $signature_parameter_pattern = '/^' . str_replace('*', '\d+?', $parameter) . '$/i';
      foreach ($data as $data_parameter => $value) {
        if (strlen($value) && preg_match($signature_parameter_pattern, $data_parameter)) {
          $signature_data_string .= $value;
        }
      }
    }

    return hash_hmac($this->algorithm, $signature_data_string, $this->secret);
  }
}
