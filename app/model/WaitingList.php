<?php

class WaitingList {

  public $players;

  function __construct() {
    $this->players = [];
  }

  function addPlayer(Player $player) {
    $this->players[] = $player;
  }

  function popPlayer() {
    return array_pop($this->players);
  }

  function getPlayer(int $id) {
    foreach ($players as $player) {
      if ($player->id === $id) {
        return $player;
      }
    }
    return false;
  }

  function getAverageValues() : array
  {
    $playerCount = count($this->players);
    $average = [];

    $average['shooting'] = 0;
    $average['skating'] = 0;
    $average['checking'] = 0;

    // Edge case, if 0 players are presented
    if ($playerCount === 0) {
      return $average;
    }

    foreach ($this->players as $player) {
      $average['shooting'] += $player->shooting;
      $average['skating'] += $player->skating;
      $average['checking'] += $player->checking;
    }

    $average['shooting'] = (int) ($average['shooting'] / $playerCount);
    $average['skating'] = (int) ($average['skating'] / $playerCount);
    $average['checking'] = (int) ($average['checking'] / $playerCount);

    return $average;
  }

}