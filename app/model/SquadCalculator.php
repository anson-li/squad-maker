<?php 

require_once 'Squad.php';
require_once 'Player.php';
require_once 'WaitingList.php';
require_once 'JSONProcessor.php';

/**
 * Squad calculator object. Contains the major processes used 
 * for calculating best squad fit.
 */
class SquadCalculator
{

    function __construct() 
    {
    }

    /**
   * Given a waitinglist full of players, find the best setup of squads so 
   * that all squads balance out relatively equally with respect to players' average 
   * skills in shooting, skating and checking.
   *
   * @param  WaitingList $waitingList A waiting list full of players to sort.
   * @param  int         $squadCount  The number of squads to fill.
   * @return array                    The array of squads with completed player lists.
   */
    function calculate(WaitingList $waitingList, int $squadCount) : array
    {
        // Get the number of players to use, and the 'ideal average' of the squads
        $playerCount = count($waitingList->players);
        $idealAverages = $waitingList->getAverageValues();

        // Generate the squad names
        $JSONProcessor = new JSONProcessor();
        $animalNames = $JSONProcessor->processJson('./json/animals.json');
        $teamNames = array_rand($animalNames, $squadCount);

        // Generate all squads (replete with team colors and team names)
        $squads = [];
        for ($i = 0; $i < $squadCount; $i++) {
            $squads[] = new Squad($idealAverages, $animalNames[$teamNames[$i]]);
        }

        // If the count of players is less than the count of squads, place a player in each available squad and return.
        if ($playerCount <= $squadCount) {
            foreach ($squads as $key => $squad) {
                $squads[$key]->addPlayer($waitingList->popPlayer());
            }
            return $squads;
        }

        // Given the number of squads, calculate the number of players that have to be attached to each squad, as well as the maximum/average value for each of the three skills (skating, shooting, checking).
        $numberOfPlayers = $this->getPlayerCountPerSquad($playerCount, $squadCount);
        $playersLeftOver = $playerCount % $squadCount;

        // Sort the pool of players from least to most, calculating the average of all three components.
        usort($waitingList->players, [__CLASS__, 'playerComparison']);

        // For each, take the pool of players and insert them into each squad, attempting to minimize the amount of impact applied to each one. 
        while (count($waitingList->players) > $playersLeftOver) {
            foreach ($squads as $key => $squad) {
                $player = $this->getBestMatchForSquad($squad, $waitingList->players);
                $squads[$key]->addPlayer($player);
                $waitingList->players = $this->removePlayerByID($player, $waitingList->players);
            }
        }
        return $squads;
    }

    /**
   * Finds the best match for a squad given three conditions: if shooting is within range, 
   * if skating is within range, and if checking is within range. If any one of these conditions is not satisfied,
   * the function is rerun with a wider variance.
   *
   * @param  Squad       $squad    Squad to add a player to.
   * @param  array       $players  An array of players to select from.
   * @param  int|integer $variance The applicable variance for the 'ideal value' for the attribute.
   * @return Player                The player object to add to that squad.
   */
    function getBestMatchForSquad(Squad $squad, array $players, int $variance = 0) : Player
    {
        foreach ($players as $player) {
            $checkShooting = (($player->shooting <= ($squad->getIdealAverage('shooting') + $variance)) && ($player->shooting >= ($squad->getIdealAverage('shooting') - $variance)));
            $checkSkating = (($player->skating <= ($squad->getIdealAverage('skating') + $variance)) && ($player->skating >= ($squad->getIdealAverage('skating') - $variance)));
            $checkChecking = (($player->checking <= ($squad->getIdealAverage('checking') + $variance)) && ($player->checking >= ($squad->getIdealAverage('checking') - $variance)));
            if ($checkShooting && $checkSkating && $checkChecking) {
                return $player;
            }
        }
        // When reached here, no player is applicable, so rerun with higher variance.
        $variance += 2;
        return $this->getBestMatchForSquad($squad, $players, $variance);
    }

    /**
   * Remove player from an array of players given ID, thereby guaranteeing uniqueness.
   *
   * @param  Player $needle  Player to search for.
   * @param  array  $players Array of players to search from.
   * @return array           Array of players with the needle removed.
   */
    function removePlayerByID(Player $needle, array $players) : array
    {
        foreach ($players as $key => $player) {
            if ($player->id === $needle->id) {
                unset($players[$key]);
            }
        }
        return $players;
    }

    /**
   * Used by usort to compare items according to the sum value of all three components.
   * Results in ascending array.
   *
   * @param  Player $a Comparator player A.
   * @param  Player $b Comparator player B.
   * @return int       Response used for usort (either -1, 0, or 1).
   */
    private static function playerComparison(Player $a, Player $b) : int 
    {
        $comparatorA = $a->shooting + $a->skating + $a->checking;
        $comparatorB = $a->shooting + $a->skating + $a->checking;
        return ($comparatorA <=> $comparatorB);
    }

    /**
   * Gets the maximum amount of players to fit into each squad. Additional players
   * are left to the waiting list.
   *
   * @param  int $playerCount The number of players to be added to squads.
   * @param  int $squadCount  The number of squads to add to.
   * @return int                 The ideal number of players per squad.
   */
    function getPlayerCountPerSquad(int $playerCount, int $squadCount) : int 
    {
        return (int) floor($playerCount / $squadCount);
    }

}