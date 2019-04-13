<?php
session_start();

if (isset($_SESSION['response'])) {
    if (isset($_SESSION['response']['message'])) {
        $success = true;
        $message = $_SESSION['response']['message'];
    } else if (isset($_SESSION['response']['error'])) {
        $success = false;
        $message = $_SESSION['response']['error'];
    }
    
    if (isset($success)){
      if ($success) {
          require('success.php');
      } else if (!$success){
          require('error.php');
      }
    }
}
?>