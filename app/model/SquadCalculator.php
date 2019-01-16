<?php 

require_once('Squad.php');
require_once('Player.php');
require_once('WaitingList.php');

class SquadCalculator {

  function __construct() {}

  function calculate(WaitingList $waitingList, int $squadCount) : array
  {

    $playerCount = count($waitingList->players);
    $averageValues = $waitingList->getAverageValues();

    $squads = [];
    for ($i = 0; $i < $squadCount; $i++) {
      $squads[] = new Squad($averageValues);
    }

    # If the count of players is less than the count of squads, place a player in each available squad and return.
    if ($playerCount <= $squadCount) {
      foreach ($squads as $key => $squad) {
        $squads[$key]->addPlayer($waitingList->popPlayer());
      }
      return $squads;
    }

    # Given the number of squads, calculate the number of players that have to be attached to each squad, as well as the maximum/average value for each of the three skills (skating, shooting, checking).
    $numberOfPlayers = $this->getPlayerCountPerSquad($playerCount, $squadCount);
    $playersLeftOver = $playerCount % $squadCount;


    # Sort the pool of players from least to most, calculating the average of all three components.
    usort($waitingList->players, [__CLASS__, 'playerComparison']);
    # For each, take the pool of players and insert them into each squad, attempting to minimize the amount of impact applied to each one. 
    while (count($waitingList->players) > $playersLeftOver) {
      foreach ($squads as $key => $squad) {
        $player = $this->getBestMatchForSquad($squad, $waitingList->players);
        $squads[$key]->addPlayer($player);
        $waitingList->players = $this->removePlayerByID($player, $waitingList->players);
      }
      # Continue iterating over squad count  
    }

    return $squads;
  }

  // Check for three conditions: 
  // If shooting exceeds variance
  // If skating exceeds variance
  // If checking exceeds variance
  function getBestMatchForSquad(Squad $squad, array $players, int $variance = 0)
  {
    foreach ($players as $player) {
      $checkShooting = (($player->shooting <= ($squad->getIdealShooting() + $variance)) && ($player->shooting >= ($squad->getIdealShooting() - $variance)));
      $checkSkating = (($player->skating <= ($squad->getIdealSkating() + $variance)) && ($player->skating >= ($squad->getIdealSkating() - $variance)));
      $checkChecking = (($player->checking <= ($squad->getIdealChecking() + $variance)) && ($player->checking >= ($squad->getIdealChecking() - $variance)));
      if ($checkShooting && $checkSkating && $checkChecking) {
        return $player;
      }
    }

    $variance += 2;
    return $this->getBestMatchForSquad($squad, $players, $variance);
  }

  function removePlayerByID(Player $needle, array $players) : array
  {
    foreach ($players as $key => $player) {
      if ($player->id === $needle->id) {
        unset($players[$key]);
      }
    }
    return $players;
  }

  // Used by usort to compare items according to the sum value of all three components, ascending.
  private static function playerComparison(Player $a, Player $b) {
    $comparatorA = $a->shooting + $a->skating + $a->checking;
    $comparatorB = $a->shooting + $a->skating + $a->checking;
    return ($comparatorA <=> $comparatorB);
  }

  function getPlayerCountPerSquad(int $playerCount, int $squadCount) : int 
  {
    return (int) floor($playerCount / $squadCount);
  }

}