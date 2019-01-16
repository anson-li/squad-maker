<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>The HTML5 Herald</title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">

  <link rel="stylesheet" href="css/styles.css?v=1.0">

</head>

<body>
  <h1>Hockey Squad Calculator</h1>
  <table>
    <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Shooting</th>
      <th>Skating</th>
      <th>Checking</th>
    </tr>
    <?php foreach ($players as $player) { ?>
      <tr>
        <td><?php print_r($player->firstName) ?></td>
        <td><?php print_r($player->lastName) ?></td>
        <td><?php print_r($player->shooting) ?></td>
        <td><?php print_r($player->skating) ?></td>
        <td><?php print_r($player->checking) ?></td>
      </tr>
    <?php } ?>
  </table>


</body>
</html>