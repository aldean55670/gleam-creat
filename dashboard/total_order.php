<?php
session_start();
if($_SESSION['admin'] !== 'admin'){
    header('Location:../index.php');
    exit();
    }