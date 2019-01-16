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

    // Import players to their appropriate model
    foreach ($playerData as $data) {
      $player = new Player($data);
      $waitingList->addPlayer($player);
    }
    $_SESSION['players'] = $waitingList;
  // }

  if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'Sort Squads') {
      // Add validation
      $squadCount = $_POST['numSquads'];
      $squadCalculator = new SquadCalculator();
      $squads = $squadCalculator->calculate($waitingList, $squadCount);
    } else if ($_POST['action'] === 'Clear') {
      // Add clear process
    }
  }

  include_once('view/main.php');