<?php

  require_once('model/Player.php');

  ini_set('display_errors', 1);
  session_start();

  $players = [];
  if (isset($_SESSION['players'])) {
    $players = $_SESSION['players'];
    $txt = 'you have reached this';
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
    $txt = 'this is new';
  }

  // Stub out the squad length


  

  include_once('view/main.php');