<?php

/**
 * Hockey player object, containing all useful descriptions (eg. name, id),
 * as well as quantitative details used for squad calculations.
 */
class Player {

  public $id, $firstName, $lastName, $shooting, $skating, $checking = null;

  /**
   * Converts an object (structured in decoded JSON format) into a Player object.
   * @param array $object Parsed JSON object to pull values from.
   */
  public function __construct(array $object) {
    $this->id = $object['_id'];
    $this->firstName = $object['firstName'];
    $this->lastName = $object['lastName'];
    $this->shooting = $object['skills']['0']['rating'];
    $this->skating = $object['skills']['1']['rating'];
    $this->checking = $object['skills']['2']['rating'];
  }

}