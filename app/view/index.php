<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Squad Maker</title>
  <meta name="description" content="Generate any squad for your tournament!">
  <meta name="author" content="Anson Li">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:900" rel="stylesheet">
  <link href="web/main.css" rel="stylesheet">
</head>

<body class="bg-pattern">
  <div class="container col-md-3 container-padding">
    <h1>Squad Maker</h1>
    <p>Let’s make a tournament!<br>Give me your squad count, and I’ll give you the perfect squad composition for any situation.</p>
    <?php if (isset($error)) : ?>
      <div class="alert alert-warning" role="alert">
        <?php print_r($error); ?>
      </div>
    <?php endif; ?>
    <?php if (isset($success)) : ?>
      <div class="alert alert-success" role="alert">
        <?php print_r($success); ?>
      </div>
    <?php endif; ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="form-group">
        <label for="numSquads">Number of Squads</label>
        <input type="number" class="form-control" id="numSquads" name="numSquads" value="3" min="2">
      </div>
      <input type="submit" class="btn btn-generate" name="action" value="Generate" /> &nbsp;
      <input type="submit" class="btn btn-reset" name="action" value="Reset" />  
    <br><br>
    </form>
  </div> 
  <div class="container-fluid col-md-9 container-padding">
    <?php if (!empty($waitingList->players)) : ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseWaitingList">Waiting List (<?php print_r($waitingPlayerCount); ?>)</a>
      </div>
      <div id="collapseWaitingList" class="panel-collapse collapse <?php print_r($expandedWaitingList); ?>">
        <div class="panel panel-body">
          <table class="table">
            <tr>
              <th class="text-center">First Name</th>
              <th class="text-center">Last Name</th>
              <th class="text-center">Shooting</th>
              <th class="text-center">Skating</th>
              <th class="text-center">Checking</th>
            </tr>
            <?php foreach ($waitingList->players as $player): ?>
              <tr>
                <td class="text-center"><?php print_r($player->firstName); ?></td>
                <td class="text-center"><?php print_r($player->lastName); ?></td>
                <td class="text-center"><?php print_r($player->shooting); ?></td>
                <td class="text-center"><?php print_r($player->skating); ?></td>
                <td class="text-center"><?php print_r($player->checking); ?></td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
    </div>
    <?php endif; ?>
    <?php foreach ($squads as $key => $squad): ?>
    <div class="panel panel-default">
      <div class="panel-heading" style="background-color: <?php print_r($squad->teamColor); ?>">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php print_r($key); ?>"><?php print_r($squad->teamName); ?> Squad</a>
      </div>
      <div id="collapse<?php print_r($key); ?>" class="panel-collapse collapse in">
        <div class="panel panel-body">
          <table class="table">
            <tr>
              <th class="text-center">First Name</th>
              <th class="text-center">Last Name</th>
              <th class="text-center">Shooting</th>
              <th class="text-center">Skating</th>
              <th class="text-center">Checking</th>
            </tr>
            <?php foreach ($squad->players as $player): ?>
              <tr>
                <td class="text-center"><?php print_r($player->firstName); ?></td>
                <td class="text-center"><?php print_r($player->lastName); ?></td>
                <td class="text-center"><?php print_r($player->shooting); ?></td>
                <td class="text-center"><?php print_r($player->skating); ?></td>
                <td class="text-center"><?php print_r($player->checking); ?></td>
              </tr>
            <?php endforeach; ?>
            <tr>
              <td class="text-center"><b>Average</b></td>
              <td></td>
              <td class="text-center"><b><?php print_r($squad->getPlayerAverages()['shooting']); ?></b></td>
              <td class="text-center"><b><?php print_r($squad->getPlayerAverages()['skating']); ?></b></td>
              <td class="text-center"><b><?php print_r($squad->getPlayerAverages()['checking']); ?></b></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>