<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>The HTML5 Herald</title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>

<body>
  <h1>Hockey Squad Calculator</h1>
  <br>
  <form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
    Number of Squads: <input type='number' name='numSquads' value='2'>
    <br><br>
    <input type='submit' name='action' value='Sort Squads' />  
    <br><br>
    <input type='submit' name='action' value='Clear' />  
  <br><br>
  </form> 
  <hr> 
  <?php foreach ($squads as $key => $squad) { ?>
  <h2>Squad <?php print_r($key + 1) ?></h2>
  <table class='table'>
    <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Shooting</th>
      <th>Skating</th>
      <th>Checking</th>
    </tr>
    <?php foreach ($squad->players as $player) { ?>
      <tr>
        <td><?php print_r($player->firstName) ?></td>
        <td><?php print_r($player->lastName) ?></td>
        <td><?php print_r($player->shooting) ?></td>
        <td><?php print_r($player->skating) ?></td>
        <td><?php print_r($player->checking) ?></td>
      </tr>
    <?php } ?>
    <tr>
      <td>Average:</td>
      <td></td>
      <td><?php print_r($squad->getFinalAverages()['shooting']); ?></td>
      <td><?php print_r($squad->getFinalAverages()['skating']); ?></td>
      <td><?php print_r($squad->getFinalAverages()['checking']); ?></td>
    </tr>
  </table>
  <?php } ?>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>