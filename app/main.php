<?php

  require_once('model/Player.php');
  require_once('model/SquadCalculator.php');

  ini_set('display_errors', 1);
  session_start();

  $players = [];
  if (isset($_SESSION['players'])) {
    $players = $_SESSION['players'];
  } else {
    // TODO: Replace with JSONProcessor
    // Decoding and interpreting JSON
    $json = file_get_contents('./players.json');
    $decodedData = json_decode($json, 1);
    $playerData = $decodedData['players'];

    // Import players to their appropriate model
    foreach ($playerData as $data) {
      $player = new Player($data);
      $players[] = $player;
    }
    $_SESSION['players'] = $players;
  }

  // Stub out the squad length
  $squadCalculator = new SquadCalculator();
  $squads = $squadCalculator->calculate($players, 4);

  include_once('view/main.php');