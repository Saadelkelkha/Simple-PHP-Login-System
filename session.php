<?php
    session_start();
    if (!isset($_SESSION['conn']) || $_SESSION['conn'] == false) {
        header('Location: login.php');
    } else {
        $nom = $_SESSION['nom'];
        $fonction = $_SESSION['fonction'];
?>
    <nav style="display:flex;text-decoration:none;flex-direction:row;background-color:black;padding-right:2%">
        <ul style="list-style-type:none;display:flex;justify-content:space-between;align-content: center;width:100%;color:white;">
            <li><a href="deconnexion.php" style="text-decoration:none;color:white;">Sign out</a></li>
        </ul>
    </nav>
    <p>connected successfully</p>
<?php   
    }
?>
