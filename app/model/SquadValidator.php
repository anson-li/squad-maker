<?php

require_once 'WaitingList.php';

/**
 * Validator object to check 'number of squads' form data upon submission.
 */
class SquadValidator
{

    function __construct() 
    {
    }

    /**
   * Checks the number of squads requested by several metrics: 
   * whether or not the number is actually a number, 
   * whether or not it is less than 2 (no tournament if only 1 team is available!)
   * and whether or not there's more squads than players.
   *
   * @param  string      $squadCount  Squads requested, in string since it's parsed from form data.
   * @param  WaitingList $waitingList Waiting list, containing the total number of players to be added.
   * @return string|null              Error response if validator fails.
   */
    function validate(string $squadCount, WaitingList $waitingList)
    {
        if (!is_numeric($squadCount)) {
            return 'Non numeric value added, please try again!';
        } else if ($squadCount < 2) {
            return 'Squad count submitted is too low, please try again!';
        } else if ($squadCount > count($waitingList->players)) {
            return 'Squad count is greater than the number of players actually available!';
        }
        return null;
    }

}