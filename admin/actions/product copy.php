<?php

include("../db/connection.php");

$response = [];
$response['errors'] = true;
$response['message'] = [];


if(!empty($_POST['id']) && $_SERVER['REQUEST_METHOD'] == 'PUT'){

  $filename = '';
  if(!empty($_FILES["image"])){
    
    $filename = $GLOBALS['product_'] . basename($_FILES["image"]["name"]);

    $target_dir =  dirname(__DIR__)."/uploads/";
    $target_file = $target_dir. $filename;

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // echo $imageFileType;
    // exit;

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["image"]["tmp_name"]);
      if($check !== false) {
        $response['errors'] = false;
      } else {
        $response['errors'] = true;
        $response['message'] = "File is not an image.";
        echo json_encode($response);
        exit;
      }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
      $response['errors'] = true;
      $response['message'] = "Sorry, file already exists.";
      echo json_encode($response);
      exit;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
      $response['errors'] = true;
      $response['message'] = "Sorry, your file is too large.";
      echo json_encode($response);
      exit;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      $response['errors'] = true;
      $response['message'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      echo json_encode($response);
      exit;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      $response['errors'] = true;
      $response['message'] = "Sorry, your file was not uploaded.";
      echo json_encode($response);
      exit;
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $response['errors'] = false;
      } else {
        $response['errors'] = true;
        $response['message'] = "Sorry, there was an error uploading your file.";
        echo json_encode($response);
        exit;
      }
    }

  }

  if(!empty($_FILES["image"])){
    $sqlInsert = "UPDATE products SET ll_product_id='".$_POST["ll_product_id"]."',
                  image='".$filename."',
                  product_name='".$_POST["product_name"]."',
                  product_price='".$_POST["product_price"]."',
                  product_headline='".$_POST["product_headline"]."',
                  products_detail='".$_POST["description"]."'";
  }else{
    $sqlInsert = "UPDATE products SET ll_product_id='".$_POST["ll_product_id"]."',
                  product_name='".$_POST["product_name"]."',
                  product_price='".$_POST["product_price"]."',
                  product_headline='".$_POST["product_headline"]."',
                  products_detail='".$_POST["description"]."'";
  }

  // Execute the SQL query
  try {
    if (mysqli_query($conn, $sqlInsert)) {
      $response['errors'] = false;
      $response['message'] = "Update record successfully";
    } else {
        $response['errors'] = true;
        $response['message'] = "Somthing went wrong in DataBase.";
    }
  } catch (\Throwable $th) {
    $response['errors'] = true;
    $response['message'] = "Somthing went wrong in DataBase.";
  }
  
  echo json_encode($response);
  exit;
  

}

if(empty($_POST['id']) && $_SERVER['REQUEST_METHOD'] == 'POST'){

  $filenameArr = [];
  // Loop through each file
  foreach ($_FILES['image']['name'] as $i => $name) {
    $filename = $GLOBALS['product_'] . basename($_FILES["image"]["name"][$i]);
    array_push($filenameArr,$filename);

    $target_dir =  dirname(__DIR__)."/uploads/";
    $target_file = $target_dir. $filename;

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // echo $imageFileType;
    // exit;

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["image"]["tmp_name"][$i]);
      if($check !== false) {
        $response['errors'] = false;
      } else {
        $response['errors'] = true;
        $response['message'] = "File is not an image.";
        echo json_encode($response);
        exit;
      }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
      $response['errors'] = true;
      $response['message'] = "Sorry, file already exists.";
      echo json_encode($response);
      exit;
    }

    // Check file size
    if ($_FILES["image"]["size"][$i] > 500000) {
      $response['errors'] = true;
      $response['message'] = "Sorry, your file is too large.";
      echo json_encode($response);
      exit;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      $response['errors'] = true;
      $response['message'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      echo json_encode($response);
      exit;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      $response['errors'] = true;
      $response['message'] = "Sorry, your file was not uploaded.";
      echo json_encode($response);
      exit;
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["image"]["tmp_name"][$i], $target_file)) {
        $response['errors'] = false;
      } else {
        $response['errors'] = true;
        $response['message'] = "Sorry, there was an error uploading your file.";
        echo json_encode($response);
        exit;
      }
    }
  }
  // echo "<pre>";
  // print_r($_FILES["image"]);
  // exit;

  // $filename = $GLOBALS['product_'] . basename($_FILES["image"]["name"]);

  // $target_dir =  dirname(__DIR__)."/uploads/";
  // $target_file = $target_dir. $filename;

  // $uploadOk = 1;
  // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // // echo $imageFileType;
  // // exit;

  // // Check if image file is a actual image or fake image
  // if(isset($_POST["submit"])) {
  //   $check = getimagesize($_FILES["image"]["tmp_name"]);
  //   if($check !== false) {
  //     $response['errors'] = false;
  //   } else {
  //     $response['errors'] = true;
  //     $response['message'] = "File is not an image.";
  //     echo json_encode($response);
  //     exit;
  //   }
  // }

  // // Check if file already exists
  // if (file_exists($target_file)) {
  //   $response['errors'] = true;
  //   $response['message'] = "Sorry, file already exists.";
  //   echo json_encode($response);
  //   exit;
  // }

  // // Check file size
  // if ($_FILES["image"]["size"] > 500000) {
  //   $response['errors'] = true;
  //   $response['message'] = "Sorry, your file is too large.";
  //   echo json_encode($response);
  //   exit;
  // }

  // // Allow certain file formats
  // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  // && $imageFileType != "gif" ) {
  //   $response['errors'] = true;
  //   $response['message'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  //   echo json_encode($response);
  //   exit;
  // }

  // // Check if $uploadOk is set to 0 by an error
  // if ($uploadOk == 0) {
  //   $response['errors'] = true;
  //   $response['message'] = "Sorry, your file was not uploaded.";
  //   echo json_encode($response);
  //   exit;
  // // if everything is ok, try to upload file
  // } else {
  //   if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
  //     $response['errors'] = false;
  //   } else {
  //     $response['errors'] = true;
  //     $response['message'] = "Sorry, there was an error uploading your file.";
  //     echo json_encode($response);
  //     exit;
  //   }
  // }

  $filenameArr = json_encode($filenameArr);
  
  $sqlInsert = "INSERT INTO products (ll_product_id, image, product_name,product_price,product_headline,products_detail) VALUES ('".$_POST["ll_product_id"]."', '".$filenameArr."', '".$_POST["product_name"]."', '".$_POST["product_price"]."', '".$_POST["product_headline"]."', '".$_POST["description"]."')";

  // Execute the SQL query
  try {
    if (mysqli_query($conn, $sqlInsert)) {
      $response['errors'] = false;
      $response['message'] = "New record created successfully";
    } else {
        $response['errors'] = true;
        $response['message'] = "Somthing went wrong in DataBase.";
    }
  } catch (\Throwable $th) {
    $response['errors'] = true;
    $response['message'] = "Somthing went wrong in DataBase.";
  }
  
  echo json_encode($response);
  exit;

}

if($_SERVER['REQUEST_METHOD'] == 'GET'){

  // print_r($_GET['id']);
  // exit;
  $sql = 'SELECT * FROM products WHERE id='.$_GET['id'].'';

  $product = getDataFun($conn,$sql);
  echo json_encode($product);
  exit;

}

if($_SERVER['REQUEST_METHOD'] == 'DELETE'){

  // print_r($_GET);
  // exit;
  $sql = 'DELETE FROM products WHERE id='.$_GET['id'].'';

  // Execute the SQL query
  try {
    if (mysqli_query($conn, $sql)) {
      $response['errors'] = false;
      $response['message'] = "Record delete successfully";
    } else {
        $response['errors'] = true;
        $response['message'] = "Somthing went wrong in DataBase.";
    }
  } catch (\Throwable $th) {
    $response['errors'] = true;
    $response['message'] = "Somthing went wrong in DataBase.";
  }
  
  echo json_encode($response);
  exit;

}

?>