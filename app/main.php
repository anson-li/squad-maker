<?php

  require_once('model/Player.php');
  require_once('model/SquadCalculator.php');
  require_once('model/WaitingList.php');

  ini_set('display_errors', 1);
  session_start();

  $waitingList = new WaitingList();
  // if (isset($_SESSION['players'])) {
  //   $waitingList = $_SESSION['players'];
  // } else {
    // TODO: Replace with JSONProcessor
    // Decoding and interpreting JSON
    $json = file_get_contents('./players.json');
    $decodedData = json_decode($json, 1);
    $playerData = $decodedData['players'];
    $squads = [];

    // Import players to their appropriate model
    foreach ($playerData as $data) {
      $player = new Player($data);
      $waitingList->addPlayer($player);
    }
    $_SESSION['players'] = $waitingList;
  // }

  if (!empty($_POST['numSquads'])) {
    $squadCount = $_POST['numSquads'];
    if (!is_numeric($squadCount)) {
      $error = 'Non numeric value added, please try again!';
    } else if ($squadCount < 2) {
      $error = 'Squad count submitted is too low, please try again!';
    } else if ($squadCount > count($waitingList->players)) {
      $error = 'Squad count is greater than the number of players actually available!';
    }
  }

  if (!isset($error) && isset($squadCount) && strtoupper($_SERVER['REQUEST_METHOD']) == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'Generate') {
      // Add validation
      $squadCalculator = new SquadCalculator();
      $squads = $squadCalculator->calculate($waitingList, $squadCount);
    } else if ($_POST['action'] === 'Reset') {
      // Add clear process
    }
  }

  include_once('view/main.php');