<?php
  function isAdmin() {
    if ($_SERVER['REMOTE_ADDR']=='65.60.220.187') {
      return true;
    }
    
    return false;
  }
  
  function isLoggedIn() {
    return (strlen($_COOKIE['username'])>0);
  }
?>
