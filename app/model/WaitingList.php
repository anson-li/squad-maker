<?php

/**
 * Waiting list object. Originally contains all players (as all players begin on the waiting list). 
 * After processing, contains only the players left over.
 */
class WaitingList {

  public $players;

  /**
   * Instantiates an empty waiting list with no players.
   */
  function __construct() {
    $this->players = [];
  }

  /**
   * Adds a player to the waiting list.
   * @param Player $player
   */
  function addPlayer(Player $player) {
    $this->players[] = $player;
  }

  /**
   * Removes player from the waiting list.
   * Used when moving a player from waiting list to squad.
   * @return [type] [description]
   */
  function popPlayer() {
    return array_pop($this->players);
  }

  /**
   * Gets a player from the waiting list with an ID that matches the input ID.
   * @param  int    $id   The ID to search for.
   * @return Player|bool  The first player that matches the ID, or false if none are found.
   */
  function getPlayer(int $id) {
    foreach ($players as $player) {
      if ($player->id === $id) {
        return $player;
      }
    }
    return false;
  }

  /**
   * Gets the ideal averages for all players in the waiting list. 
   * Used for ensuring squad skill averages are about the same as the ideal skill averages.
   * @return array An array containing the average skill values in the waiting list.
   */
  function getAverageValues() : array
  {
    $playerCount = count($this->players);
    $average = [];
    $average['shooting'] = 0;
    $average['skating'] = 0;
    $average['checking'] = 0;
    # Generates averages by calculating all players' total skills, then dividing by count.
    foreach ($this->players as $player) {
      $average['shooting'] += $player->shooting;
      $average['skating'] += $player->skating;
      $average['checking'] += $player->checking;
    }
    if ($playerCount !== 0) {
      $average['shooting'] = (int) ($average['shooting'] / $playerCount);
      $average['skating'] = (int) ($average['skating'] / $playerCount);
      $average['checking'] = (int) ($average['checking'] / $playerCount);
    }
    return $average;
  }

}