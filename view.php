<?php require_once('header.php');
  
 ?>
<body class="view">
<div class="container inner">
<header class="masthead mb-auto">
    <div class="inner">
      <h3 class="masthead-brand">TuneShare</h3>
      <nav class="nav nav-masthead justify-content-center">
        <a class="nav-link" href="index.php">Home</a>
        <a class="nav-link" href="add.php">Share Your Tune</a>
        <a class="nav-link" href="view.php">View Playlists</a>
      </nav>
    </div>
  </header>
  <form action="destroy.php" method="post" enctype="multipart/form-data" class="form">
    <input type="submit" name="submit" value="Destroy session" class="btn">
  </form>
    <?php
    try {
    //connect to our db 
    require_once('connect.php'); 

    //set up SQL statement 
    $sql = "SELECT * FROM songs;"; 

    //prepare the query 
    $statement = $db->prepare($sql);

    //execute 
    $statement->execute(); 

    //use fetchAll to store the results 
    $records = $statement->fetchAll(); 

    // echo out the top of the table 
    
    echo "<br> <br><br>";
    echo "<p>Firstname:   {$_SESSION["firstname"]}  </p>";
    echo "<p> Last Name:   {$_SESSION["lastname"]}  </p>";
    echo "<p> Genre:   {$_SESSION["genre"]}  </p>";
    echo "<p> Age:   {$_SESSION["age"]}  </p>";
    echo "<p> Location:   {$_SESSION["location"]}  </p>";
    echo "<p> Email:   {$_SESSION["email"]}  </p>";
    echo "<p> Favourite Song:  {$_SESSION["favsong"]}  </p>";
    //echo "<p> Profile Pic:  {$_SESSION["profilepic"]}  </p>"; we can just assume profile pic will be broken for now
    echo "<p> Link:   {$_SESSION["link"]}  </p>";


    echo "<table class='table'>";

    

    foreach ($records as $record) {
        echo "<tr><td><img src='images/". $record['photo']. "' alt='" . $record['photo'] . "'></td><td>"
        . $record['first_name'] . "</td><td>" . $record['last_name'] . "</td><td>" . $record['genre'] . "</td><td>" . $record['location'] . "</td><td>" . $record['email'] . "</td><td>" . $record['favsong']. "</td><td><a href='" . $record['link']. "' target='_blank'> Listen Now </a></td><td><a href='delete.php?id=" . $record['user_id'] . "'> Delete </a></td><td><a href='add.php?id=" . $record['user_id'] . "'>Edit </a></td></tr>";
        }
     echo "</tbody></table>"; 

     $statement->closeCursor(); 
    }
    catch(PDOException $e) {
        $error_message = $e->getMessage(); 
        echo "<p> $error_message message </p>"; 
    }
    ?>
    </main>
    <?php require_once('footer.php'); ?>