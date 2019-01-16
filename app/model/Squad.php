<?php

class Squad {

    public $players, $average = null;

    function __construct(array $average) {
        $this->players = [];
        $this->average = $average;
    }
    
    // Gets the 'best' average for the squad. If there are currently no members in the squad, that is just the calculated average from before. However, if there are members in the squad, the function calculates what member would be most suitable to 'balance out' the team.
    function getIdealSkating() : int 
    {
        if (count($this->players) === 0) {
            return $this->average['skating'];
        }
        $totalSkating = 0;
        foreach ($this->players as $player) {
            $totalSkating += $player->skating;
        }
        $averageSkating = (int) $totalSkating / count($this->players);
        // If $averageSkating is greater than the set average, than find the opposite corresponding value
        $differenceSkating = $averageSkating - $this->average['skating'];
        return $this->average['skating'] - $differenceSkating;
    }

    function addPlayer(Player $player) {
        $this->players[] = $player;
    }

    function getIdealShooting() {
        if (count($this->players) === 0) {
            return $this->average['shooting'];
        }
        $totalShooting = 0;
        foreach ($this->players as $player) {
            $totalShooting += $player->shooting;
        }
        $averageShooting = (int) $totalShooting / count($this->players);
        $differenceShooting = $averageShooting - $this->average['shooting'];
        return $this->average['shooting'] - $differenceShooting;
    }

    function getIdealChecking() {
        if (count($this->players) === 0) {
            return $this->average['checking'];
        }
        $totalChecking = 0;
        foreach ($this->players as $player) {
            $totalChecking += $player->checking;
        }
        $averageChecking = (int) $totalChecking / count($this->players);
        $differenceChecking = $averageChecking - $this->average['checking'];
        return $this->average['checking'] - $differenceChecking;
    }

    function getFinalAverages() : array
    {
        $average['shooting'] = 0;
        $average['skating'] = 0;
        $average['checking'] = 0;
        foreach ($this->players as $player) {
                $average['shooting'] += $player->shooting;
                $average['skating'] += $player->skating;
                $average['checking'] += $player->checking;
        }

        $average['shooting'] = (int) ($average['shooting'] / count($this->players));
        $average['skating'] = (int) ($average['skating'] / count($this->players));
        $average['checking'] = (int) ($average['checking'] / count($this->players));

        return $average;
    }

}