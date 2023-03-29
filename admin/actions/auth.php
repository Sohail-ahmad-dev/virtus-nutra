<?php

include("../db/connection.php");


$response = [];
$response['errors'] = true;
$response['message'] = [];


if(!empty($_POST['formType']) && $_POST['formType'] == 'logout'){

  session_start();
  unset($_SESSION['loggedIn']);
  unset($_SESSION['auth']);
  header('Location: https://localhost/github/cart/admin/signin.php');
  exit;
}


// if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['formType'] == 'register'){

//   // echo "<pre>";
//   // print_r($_POST);
//   // exit;
//   $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

//   $sqlInsert = "INSERT INTO users (name, email, password) VALUES (?,?,?)";

//   $stmt = mysqli_prepare($conn, $sqlInsert);

//   mysqli_stmt_bind_param($stmt, "sss", $_POST['name'], $_POST['email'], $password);

//   // Execute the SQL query
//   try {
//     if (mysqli_stmt_execute($stmt)) {
//       $response['errors'] = false;
//       $response['message'] = "New record created successfully";
//     } else {
//         $response['errors'] = true;
//         $response['message'] = "Somthing went wrong in DataBase.";
//     }
//   } catch (\Throwable $th) {
//     $response['errors'] = true;
//     $response['message'] = "Somthing went wrong in DataBase.";
//   }

  
//   // Close the statement and connection
//   mysqli_stmt_close($stmt);
//   mysqli_close($conn);

//   if($response['errors'] == false){
//     header('Location: https://localhost/github/cart/admin/signup.php');
//   }

  
//   echo json_encode($response);
//   exit;
  
  
// }

if($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST['formType'])){
  session_start();
  // echo "<pre>";
  // print_r($_POST);
  // exit;
  
  $sql = 'SELECT * FROM users WHERE email=?';
  $stmt = mysqli_prepare($conn, $sql);

  // Bind parameters to the statement
  mysqli_stmt_bind_param($stmt, "s", $_POST['email']);

  $product = getDataFun($stmt);
  $product = !empty($product) ? $product[0] : [];

  if(!empty($product)){

    // Verify the password
    if (password_verify($_POST['password'], $product['password'])) {
      unset($_SESSION['auth']);
      $_SESSION['loggedIn'] = 'true';
      header('Location: https://localhost/github/cart/admin/index.php');
    } else {
      unset($_SESSION['loggedIn']);
      $_SESSION['auth'] = [
        'formData' => $_POST,
        'message' => 'Please provide valid credentials'
      ];
      header('Location: https://localhost/github/cart/admin/signin.php');
    }
    
  }else{

    $_SESSION['auth'] = [
      'formData' => $_POST,
      'message' => 'Please provide valid credentials'
    ];
    header('Location: https://localhost/github/cart/admin/signin.php');

  }

  // echo "<pre>";
  // print_r($product);
  // exit;
  return true;
  
  
}




?>