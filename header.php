<?php
require_once 'common/includes/db_connect.php';

$query = "SELECT id, title FROM categories";
$result = $conn->query($query);

define('URLBASE', 'http://bookshop.local');
?>

<?php
session_start();

if(isset($_POST['add'])){
    // print_r($_POST['product_id']);
    if(isset($_SESSION['cart'])){

        $item_array_id=array_column($_SESSION['cart'], "product_id");
        //print_r($item_array_id);
        //print_r($_SESSION['cart']);
        if(in_array($_POST['product_id'],$item_array_id)){
            echo "<script> alert('Product is already added in the cart!')</script>";
            echo "<script> window.location='cart-view.php'</script>";
        }else{
            $count=count($_SESSION['cart']);
            $item_array=array(
                'product_id'=>$_POST['product_id'],
                'product_qty'=>1
            );
            $_SESSION['cart'][$count]=$item_array;
            //print_r($_SESSION['cart']);
        }
    }else{
        $item_array=array(
            'product_id'=>$_POST['product_id'],
            'product_qty'=>1
        );
        $_SESSION['cart'][0] = $item_array;
        print_r($_SESSION['cart']);
    }
}?>

<!-- Vertical navbar -->
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta naame="viewport" content="width=drivice-width, initial=scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<!-- theme CSS -->
<!-- font-awesome -->
<link rel="stylesheet" href="common/assets/vendor/font-awesome/css/font-awesome.min.css">
    
<link rel="stylesheet" href="common/assets/libs/css/style.css">
<!-- Bootstrap bundel js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<!-- jquery 3.0.6 -->
<script src="common/assets/vendor/jquery/jquery-3.6.0.min.js"> </script>
<!-- jassor  -->
<script src="common/assets/vendor/jssor/jssor.slider-28.1.0.min.js"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg fixed-top navbar-light" style="background-color: #e3f2fd;">
  <div class="container-fluid">
  <img src="backend/includes/logo.png" alt="..." width="45" class="mr-3 rounded-circle img-thumbnail shadow-sm">
    <!-- <a class="navbar-brand" href="#">Златно ключе</a> -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        
          <a class="nav-link active" aria-current="page" href="index.php">Начало</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Книги
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result -> fetch_assoc()) {
                                    ?>
                                        <li><a href="view-category.php?id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['title']);?></a></li>
                                    <?php
                                }
                            }
                            ?>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="<?php echo URLBASE?>/contact.php" >Контакти</a>

        </li>
      </ul>

      <a href="<?php echo URLBASE?>/cart-view.php" class="right-nav">
          
          <i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
          <?php 
                                    if(isset($_SESSION['cart'])){
                                        $count = count($_SESSION['cart']);
                                        echo"<span>$count</span>";
                                    } else{
                                        echo"<span>0</span>";
                                    }
                                ?></p>
        </a>
      <a href="#"class="right-nav">
      <li class="nav-item dropdown">
      <a class="nav-link active dropdown-toggle profil-dropdown" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           <i class="fa fa-user fa-2x" aria-hidden="true"></i> 
          </a>
          
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="<?php echo URLBASE?>/login.php">Вход</a></li>
            <li><a class="dropdown-item" href="#" id="btn-logout">Изход</a></li>

          </ul>
      </li>    
    </a>
    </div>
  </div>
</nav>


        </body>
        <script>
  $('#btn-logout').unbind().bind('click', function (e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      cache: false,
      url: 'backend/includes/user/logout.php',
      success: function (dataResult){
          var dataResult = JSON.parse(dataResult);
          if(dataResult.statusCode == 200){
                window.location = "./login.php";
                } else if (dataResult.statusCode == 201) {
                    alert('Error');
                      } 
      }
    });
    });
</script>