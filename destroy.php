

<?php
    require_once("header.php");
?>


<?php
    try
    {   
        session_unset();
        session_destroy();
        echo "<p> Destroyed! </p>";
    }
    catch(Exception $e)
    {
        $msg = $e->getMessage();
        echo $msg;
    }
    

    //header("Location: index.php");
?>
