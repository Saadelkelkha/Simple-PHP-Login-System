<?php
    session_start();
    $_SESSION['conn'] = false;
    header('Location: login.php');
?>
