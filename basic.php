<?php 

    // Get variables from the configs file
    // in the configs folder that we use in our
    // connection string.
    require "./assets/configs/config.php";

  // Change this variable to select a different
  // database. 
  $dbname = "dbcourse";


  try {

    $dsn = "mysql:host=$host;dbname=" . $dbname;
    // Create a variable that will perform our connection.
    $connection = new PDO($dsn, $username, $password, $options);

    $args = array('like' => '%ELF%', 'level' => 5);

    // Create a variable that contains our first SQL
    // statement, getting data from the `characters`
    // table.
    $sql = "SELECT primary_class, subclass, feats FROM characters WHERE UPPER(race) LIKE :like AND char_level >= :level";

    // Tells the database to get the data ready, 'cause
    // we're going to be asking for it.
    $statement = $connection->prepare($sql);

    // Asks the database to return the data.
    $statement->execute($args);

    // Get all the rows returned by the database,
    // and put them in a variable called '$result'.
    $result = $statement->fetchAll();
  } catch (PDOException $error) {
    // If something goes wrong, show the SQL statement
    // and the error message.
    echo $sql . "<br>" . $error->getMessage();

  }
?>

<!doctype html>
<html lang="">

<head>
  <meta charset="utf-8">
  <title><?php echo $sql ?></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      max-width: 600px;
      min-height: calc(100vh - 8rem);
      margin: 0 auto;
      padding: 4rem 0;
      background-color: #fafafa;
      color: #010101;
      font-family: sans-serif;
      font-size: 16px;
    }
    tr:nth-child(odd) td {
      background: #d3d3d3;
    }
    tr:nth-child(odd) td:empty {
      background: none;
    }
    td {
      padding: .5rem;
      vertical-align: top;
    }
    td:first-child {
        font-weight: bold;
        color: #164747;
    }
    td:nth-child(2) {
      color: #4b2077;
    }
    td:nth-child(3) {
      color: #940606;
      font-style: italic;
    }
  </style>
</head>

<body>
  <h1>Criminal elves</h1>
  <table>
  <?php foreach ($result as $character) { ?>
    <tr>
      <td><?php echo str_replace("|", " / ",  $character[primary_class]); ?></td>
      <td><?php echo str_replace("|", " / ",  $character[subclass]); ?></td>
      <td><?php echo str_replace("|", " / ",  $character[feats]); ?></td>
    </tr>
  <?php } ?>
  </table>
</body>

</html>
