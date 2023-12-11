<?php
   session_start();
   unset($_SESSION['user']);

   header('Location: ../pagesAccueil/Entete.php');
?>