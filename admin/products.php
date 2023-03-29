<?php 

include('db/connection.php');

session_start();

include('./actions/authChecker.php');

is_logedIn();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        
        <!-- Spinner Start -->
            <?php include('layouts/spinner.php'); ?>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
            <?php include('layouts/sidebar.php'); ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">

            <!-- Navbar Start -->
              <?php include('layouts/header.php'); ?>
            <!-- Navbar End -->


            <!-- Products List here Start -->

            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Products</h6>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProduct">
                          Add Products
                        </button>
                    </div>
                    <div class="table-responsive">

                      <?php 


                        $sql = "SELECT * FROM products";
                        $stmt = mysqli_prepare($conn, $sql);
                        // $sql = "SELECT * FROM products";
                        $products = getDataFun($stmt);
                      
                      ?>
                    
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col"><input class="form-check-input" type="checkbox"></th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Headline</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php 
                              
                              if(empty($products)){?>
                              <tr>
                                <td colspan="6">
                                  <h4 class="text-center mb-0">No Products found..</h4>
                                </td>
                              </tr>

                              <?php  }else{?>
                                
                                <?php 
                                    foreach ($products as $product) { ?>
                                      <tr>

                                        <td><input class="form-check-input" name="select" value="<?php echo $product['id']; ?>" type="checkbox"></td>
                                        <td><?php echo $product['product_name']; ?></td>
                                        <td>$<?php echo $product['product_price']; ?></td>
                                        <td><?php echo $product['products_detail']; ?></td>
                                        <td><?php echo $product['product_headline']; ?></td>
                                        <td>
                                          <button class="btn btn-small btn-primary" data-bs-toggle="modal" data-bs-target="#editProduct" rel="<?php echo $product['id']; ?>">
                                            Edit
                                          </button>
                                          <button class="btn btn-small btn-primary" data-bs-toggle="modal" data-bs-target="#delProduct" rel="<?php echo $product['id']; ?>">
                                            Delete
                                          </button>
                                        </td>

                                      </tr>
                                  <?php } ?>
                                    
                                    
                              <?php   }?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Products List here End -->


            <!-- Footer Start -->
              <?php include('layouts/footer.php'); ?>
            <!-- Footer End -->
            
        </div>
        <!-- Content End -->

        <!-- Modals Start -->

          <?php include('layouts/product_modals.php'); ?>
        
        <!-- Modals End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script>
      // Add product to db
      $("#addProductForm").on("submit",function(e){
        e.preventDefault();

        let form = $(this);
        let formData = new FormData(form[0]);

        $("#addFormError").addClass("d-none")
        $("#addFormError").text('')

        $.ajax({
          type: "POST",
          url: "actions/product.php",
          contentType: false,
          processData:false,
          cache: false,
          data: formData,
          success: (resp) => {
            let data = JSON.parse(resp);

            if(data.errors){

              $("#addFormError").removeClass("d-none")
              $("#addFormError").text(data.message)

            }else{

              window.location.reload();

            }
            
          }
        })

      })

      // Update product in db
      
      $("#editProductForm").on("submit",function(e){
        e.preventDefault();

        let form = $(this);
        let formData = new FormData(form[0]);
        console.log(formData);

        $("#editFormError").addClass("d-none")
        $("#editFormError").text('')

        $.ajax({
          type: "POST",
          url: "actions/product.php",
          contentType: false,
          processData:false,
          cache: false,
          data: formData,
          success: (resp) => {
            let data = JSON.parse(resp);

            if(data.errors){

              $("#editFormError").removeClass("d-none")
              $("#editFormError").text(data.message)

            }else{

              window.location.reload();

            }
            
          }
        })

      })

      $(document).on("click","button[data-bs-target='#editProduct']",function() {
        // $('#editProductForm input[name="id"]').val($(this).attr("rel"))
        let id = $(this).attr("rel");

        $.ajax({
          type: "GET",
          url: "actions/product.php?id="+id,
          success: (resp) => {
            let data = JSON.parse(resp);
            
            data = data[0]
            
            $('#editProduct input[name="id"]').val(data.id)
            $('#editProduct input[name="ll_product_id"]').val(data.ll_product_id)
            $('#editProduct input[name="product_name"]').val(data.product_name)
            $('#editProduct input[name="product_price"]').val(data.product_price)
            $('#editProduct input[name="product_headline"]').val(data.product_headline)
            // $('input[name="image"]').val(data.image)
            $('#editProduct textarea[name="description"]').val(data.products_detail)

              
          }
        })
        
      })

      $('button[data-bs-target="#delProduct"]').on("click",function(){
        $('#delProduct input[name="id"]').val($(this).attr('rel'))
      })

      $('#deleteProduct').on("submit",function(e){
        e.preventDefault();
        let formData = $(this).serializeArray();

        $("#delFormError").addClass("d-none")
        $("#delFormError").text('')

        $.ajax({
          type: "DELETE",
          url: "actions/product.php?id="+formData[0].value,
          success: (resp) => {
            let data = JSON.parse(resp);
            
            if(data.errors){

              $("#delFormError").removeClass("d-none")
              $("#delFormError").text(data.message)

            }else{

              window.location.reload();

            }
            
          }
        })
        
      })
      
    </script>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>


    
    
</body>

</html>