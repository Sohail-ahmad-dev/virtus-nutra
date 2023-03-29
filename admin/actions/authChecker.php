<?php

function redirectDashboard(){

  // session_start();
  if(isset($_SESSION['loggedIn'])){
    header('Location: https://localhost/github/cart/admin/index.php');
  }else{
    return 0;
  }
}

function is_logedIn(){

  // echo "<pre>";
  // print_r($_SESSION);
  // exit;
  if(!isset($_SESSION['loggedIn'])){
    header('Location: https://localhost/github/cart/admin/signin.php');
  }else{
    return true;
  }
  
}


?>