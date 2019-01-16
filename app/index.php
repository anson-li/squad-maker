<?php

  require_once('model/Player.php');
  require_once('model/SquadCalculator.php');
  require_once('model/WaitingList.php');
  require_once('model/JSONProcessor.php');
  require_once('model/SquadValidator.php');

  ini_set('display_errors', 1);
  session_start();

  # Object instantiation
  $JSONProcessor = new JSONProcessor();
  $squadValidator = new SquadValidator();
  $waitingList = new WaitingList();
  $squads = [];

  # Saves processing effort by saving the waiting list data in the session for reuse
  if (isset($_SESSION['players'])) {
    # Cloning in order to pass object data by value, not by reference
    $waitingList = clone $_SESSION['players'];
  } else {
    # Retrieve all the players and place them into the waiting list
    $decodedData = $JSONProcessor->processJson('./json/players.json');
    $playerData = $decodedData['players'];
    foreach ($playerData as $data) {
      $player = new Player($data);
      $waitingList->addPlayer($player);
    }
    $_SESSION['players'] = $waitingList;
  }

  # Validating the form data for number of squads
  if (!empty($_POST['numSquads'])) {
    $squadCount = $_POST['numSquads'];
    $error = $squadValidator->validate($squadCount, $waitingList);
  } else {
    $squadCount = 0;
  }

  # Depending on form data, either generates new squad configuration or resets squad configuration
  if (!isset($error) && strtoupper($_SERVER['REQUEST_METHOD']) == 'POST' && isset($_POST['action'])) {
    if (($squadCount) && ($_POST['action'] === 'Generate')) {
      $squadCalculator = new SquadCalculator();
      $squads = $squadCalculator->calculate($waitingList, $squadCount);
    }
    # Would add 'Reset' here, but it's not required as not running calculate() essentially guarantees the reset.
  }

  include_once('view/index.php');