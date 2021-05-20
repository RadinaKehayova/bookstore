<?php
require_once 'header.php';
$product_id = $_GET['id'];
$query = "SELECT books.*, authors.name, categories.title , categories.id  AS category_id FROM books INNER JOIN authors ON books.author_id = authors.id INNER JOIN categories ON books.category_id = categories.id WHERE books.id=$product_id";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
        $category_id = $row['category_id'];
        ?>
        <body>
            <div class="container">
                <div class="card card-wrapper ">
                    <div class="container-fliud">
                        <div class="wrapper row">
                            <div class="preview col-md-6">
                                <div class=" tab-content">
                                    <div class="tab-pane active" id="pic-1"> <img class="img-rounded" style="width: 100px height:300px !important;" src="<?php echo URLBASE . "/backend/uploads/" . $row['image'] ?> "> </div>
                                </div>
                            </div>
                            <div class="details col-md-6">
                                <h3 class="product-title"><?php echo $row['title']; ?></h3>
                                <h5 class="author"><?php echo $row['name']; ?></h4>
                                    <p class="product-description"><?php echo $row['description']; ?></p>
                                    <h5 class="isbn">ISBN: <span><?php echo $row['isbn']; ?></span></h5>
                                    <h5 class="title">Категория: <span><?php echo $row['title']; ?></span></h5>
                                    <h4 class="price">Цена: <span><?php echo $row['price']; ?></span></h4>
                                    <div class="action">
                                        <button class="add-to-cart btn btn-default" type="button"><i class="fa fa-shopping-cart " style="margin-right: 20px;" aria-hidden="true"></i>КУПИ</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    // MDB Lightbox Init
                    $(function() {
                        $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
                    });
                });
            </script>




    <div>



     <div class="home-category">
        <div class="products d-flex justify-content-center">
            <!-- <div class="row"> -->
            <?php
                $row_id = $row['id'];
                $query_products = "SELECT id, title, image , price FROM books WHERE category_id=$category_id LIMIT 4";
                $result_products = $conn->query($query_products);

                if($result_products->num_rows > 0) {
                    while ($row_product = $result_products->fetch_assoc()) {
            ?>
            <div class="wrapper " style="margin-top: 10px;">
            <div class="container ">
                <div class=" g-1  ">
                    <div class="col-md-3 w-100">
                        <div class="card p-2 ">
                            <div class="text-center">
                            <a href="<?php echo URLBASE;?>/view-book.php?id=<?php echo $row_product['id'];?> ">
                            <img src="<?php echo URLBASE ."/backend/uploads/" . $row_product['image']?> "width="200">
                        </a>
                                </div>
                            <div class="product-details"> <span class="font-weight-bold d-block"><?php echo htmlspecialchars($row_product['price']);?>лв.</span> <span><a class="book-price" href="<?php echo URLBASE;?>/view-book.php?id=<?php echo $row_product['id'];?>">
                            <?php echo htmlspecialchars($row_product['title']); ?> </a></span>
                                <div class="buttons d-flex flex-row">
                                    <div class="cart"><i class="fa fa-shopping-cart"></i></div> <button class="btn btn-success cart-button btn-block"><span class="dot">1</span>Добавяне</button>
                                </div>
                                <input type="hidden" value="<?php echo $row_product['id']?>">
                            </div>
                        </div>
                    </div>

        </div>
    </div>
</div>
                <?php
                    }
                }
            ?>
        </div>
    </div>
    <?php
        }
        }
        ?>


<script>
    document.addEventListener("DOMContentLoaded", function(event) {


const cartButtons = document.querySelectorAll('.cart-button');

cartButtons.forEach(button => {

button.addEventListener('click',cartClick);

});

function cartClick(){
let button =this;
button.classList.add('clicked');
}



});
</script>
</body>