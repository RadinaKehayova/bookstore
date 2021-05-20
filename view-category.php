<?php
require_once 'header.php';
$category_id = $_GET['id'];
$query = "SELECT id, title, description FROM bookshop.categories WHERE id = $category_id";
$result = $conn->query($query);

if (!$result) die("Fatal error");
?>

<?php
      if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
    ?>

    <div class="home-category " style="margin-top:100px !important ">
        <h2 style="padding-top: 30px; margin-bottom: 0; margin-left: 90px; "><?php echo htmlspecialchars($row['title']); ?></h2>
        <div class="products d-flex justify-content-center">
            <?php
                $row_id = $row['id'];
                $query_products = "SELECT id, title, image , price FROM books WHERE category_id=$row_id ";
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

                            
                            <form class="home-categories-number-table-item-price" method="post">
                            <div class="product-details"> <span class="font-weight-bold d-block"><?php echo htmlspecialchars($row_product['price']);?>лв.</span> <span><a class="book-price" href="<?php echo URLBASE;?>/view-book.php?id=<?php echo $row_product['id'];?>">
                            <?php echo htmlspecialchars($row_product['title']); ?> </a></span>
                                <div class="buttons d-flex flex-row">
                                    <div class="cart"> <a href="<?php echo URLBASE?>/cart-view.php" ><i class="fa fa-shopping-cart"></i></a></div> 
                                    <button class="btn btn-success cart-button btn-block" type="submit" name="add"><span class="dot">1</span>Добавяне</button>
                                </div>
                                <input type="hidden"  name="product_id" value="<?php echo $row_product['id']?>">
                            </div>

                                        </form>
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
