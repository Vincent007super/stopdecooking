<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['usertype'] != 1) {
    // Als de gebruiker niet ingelogd is of geen admin is, doorsturen naar de loginpagina
    header("Location: login.php");
    exit;
}

include 'views/admin_view.php';
