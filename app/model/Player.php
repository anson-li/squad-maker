<?php

class Player {

    public $id, $firstName, $lastName, $shooting, $skating, $checking = null;

    function __construct($object) {
        $this->id = $object['_id'];
        $this->firstName = $object['firstName'];
        $this->lastName = $object['lastName'];
        $this->shooting = $object['skills']['0']['rating'];
        $this->skating = $object['skills']['1']['rating'];
        $this->checking = $object['skills']['2']['rating'];
    }

}