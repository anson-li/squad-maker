<?php

/**
 * JSONProcessor parses a json item and decodes it. 
 * Once it decodes the json item, it returns the completed array back for further use.
 */
class JSONProcessor {

  function __construct() {}

  /**
   * Processes and validates JSON.
   * @param  string $jsonPath Path to JSON file
   * @return array            Array of cleaned JSON entities, or an empty array if an error occured while processing.
   */
  function processJson(string $jsonPath) : array 
  {
    try {
      $json = file_get_contents($jsonPath);
      return json_decode($json, 1);
    } catch (Exception $e) {
      error_log($e->getMessage());
      return [];
    }
    
  }

}