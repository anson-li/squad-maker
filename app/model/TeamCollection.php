<?php

class TeamCollection {

  public $squads, $waitinglist = null;

  function __construct($waitingList) {
    $this->squads = [];
    $this->waitingList = $waitingList;
  }

}