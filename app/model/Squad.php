<?php

/**
 * Squad object. A squad is basically a hockey scrim team for a tournament. As a result, 
 * it contains a list of players attached, the skill averages, the team name and the team color 
 * (used for differentiation between teams).
 */
class Squad
{

    public $players, $idealAverage, $teamName, $teamColor = null;

    /**
     * Generates an empty Squad object, to fill with players.
     *
     * @param array  $idealAverage The ideal average skillset to make the squads with.
     * @param string $teamName     The squad name.
     */
    function __construct(array $idealAverage, string $teamName) 
    {
        $this->players = [];
        $this->idealAverage = $idealAverage;
        $this->teamName = $teamName;
        $this->teamColor = $this->generateRandomTeamColor();
    }

    /**
     * Generates a random team color.
     * We need team color to be a bright color, so we're forcing one primary color and two secondary (lighter) colors.
     *
     * @return string Color in hexadecimal, eg. #ff0000
     */
    function generateRandomTeamColor() : string
    {
        $colors[] = rand(200, 255);
        $colors[] = rand(120, 200);
        $colors[] = rand(100, 180);
        shuffle($colors);
        return sprintf("#%02x%02x%02x", $colors[0], $colors[1], $colors[2]);
    }
    
    /**
     * Adds a player to the squad's roster.
     *
     * @param Player $player The player to add to the squad.
     */
    function addPlayer(Player $player) 
    {
        $this->players[] = $player;
    }

    /** 
     * Gets the 'best' average for the squad. 
     * If there are currently no members in the squad, that is just the calculated average from before. 
     * However, if there are members in the squad, the function calculates what member 
     * would be most suitable to 'balance out' the team. Eg. If the squad has a higher amount of 'shooting'
     * skill, find a team member who is weaker in 'shooting'.
     *
     * @param  string $param The parameter to find the average for.
     * @return int The ideal value for a player skill to be in that specific category.
     */
    function getIdealAverage(string $param) : int 
    {
        // If no players are in the squad, return the ideal average.
        if (count($this->players) === 0) {
            return $this->idealAverage[$param];
        }
        // Find the average skill of all players in the squad.
        $total = 0;
        foreach ($this->players as $player) {
            $total += $player->{$param};
        }
        $average = (int) $total / count($this->players);
        // If $average is greater than the set average, 
        // then find the value that would 'balance' out the current average.
        $difference = $average - $this->idealAverage[$param];
        return $this->idealAverage[$param] - $difference;
    }

    /**
     * Get the final averages of the squad, using only player skill.
     *
     * @return array An array containing averages for all three player skills.
     */
    function getPlayerAverages() : array
    {
        $average['shooting'] = 0;
        $average['skating'] = 0;
        $average['checking'] = 0;
        foreach ($this->players as $player) {
                $average['shooting'] += $player->shooting;
                $average['skating'] += $player->skating;
                $average['checking'] += $player->checking;
        }
        // Checks if zero players are on a squad to prevent division by zero
        if (count($this->players) !== 0) {
            $average['shooting'] = (int) ($average['shooting'] / count($this->players));
            $average['skating'] = (int) ($average['skating'] / count($this->players));
            $average['checking'] = (int) ($average['checking'] / count($this->players));
        }
        return $average;
    }

}