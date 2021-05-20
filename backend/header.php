<?php
require_once '../common/includes/db_connect.php';
require_once '../backend/includes/user/check.php';
define('URLBASE', 'http://bookshop.local');
?>
<!-- Vertical navbar -->
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta naame="viewport" content="width=drivice-width, initial=scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="../common/assets/vendor/bootstrap/css/bootstrap.min.css">
<!-- theme CSS -->
<link rel="stylesheet" href="includes/libs/css/style.css">

<!-- Bootstrap bundel js -->
<script scr="../common/assets/vendor/bootstrap/js/bootsrap.bundle.js"></script>
<!-- jquery 3.0.6 -->
<script src="../common/assets/vendor/jquery/jquery-3.6.0.min.js"> </script>
</head>
<body>
<div class="vertical-nav bg-white" id="sidebar">
  <div class="py-4 px-3 mb-4 bg-light">
    <div class="media d-flex align-items-center"><img src="includes/logo.png" alt="..." width="65" class="mr-3 rounded-circle img-thumbnail shadow-sm">
      <div class="media-body">
        <h4 class="m-0">Книжарница</h4>
        <p class="font-weight-light text-muted mb-0">Златно ключе</p>
        <a href="#" id="btn-logout" style="color: #000;">Изход</a>
      </div>
    </div>
  </div>
<div class=" mb-0">
  <a href="<?php echo URLBASE?>/backend" class="nav-link text-dark font-italic bg-light py-2 ">
                <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                Hачало
            </a>
</div>
  <p class="text-gray font-weight-bold text-uppercase px-3 small pb-2 mb-0 pt-4">Преглед</p>

  <ul class="nav flex-column bg-white mb-0">
    <li class="nav-item">
      <a href="<?php echo URLBASE?>/backend/all_books.php" class="nav-link text-dark font-italic">
                <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
                Книги
            </a>
    </li>

    <li class="nav-item">
      <a href="<?php echo URLBASE;?>/backend/all_authors.php" class="nav-link text-dark font-italic">
                <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
                Автори
            </a>
    </li>
    <li class="nav-item">
      <a href="<?php echo URLBASE;?>/backend/all_categories.php" class="nav-link text-dark font-italic">
                <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
                Категории
            </a>
    </li>
    <li class="nav-item">
      <a href="<?php echo URLBASE;?>/backend/all_orders.php" class="nav-link text-dark font-italic">
                <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
                Поръчки
            </a>
    </li>
    <li class="nav-item">
      <a href="<?php echo URLBASE;?>/backend/all_customers.php" class="nav-link text-dark font-italic">
                <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
                Клиенти
            </a>
    </li>

  </ul>

  <p class="text-gray font-weight-bold text-uppercase px-3 small py-2 mb-0 pt-4">Добавяне</p>

  <ul class="nav flex-column bg-white mb-0">
  <li class="nav-item">
      <a href="<?php echo URLBASE;?>/backend/add_book.php" class="nav-link text-dark font-italic">
                <i class="fa fa-cubes mr-3 text-primary fa-fw"></i>
                Добавяне на книга
            </a>
    </li>

  </ul>
</div>
<div class="page-content p-5" id="content">

<script>
  $('#btn-logout').unbind().bind('click', function (e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      cache: false,
      url: 'includes/user/logout.php',
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

















