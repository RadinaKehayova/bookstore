
<?php
require_once 'header.php';


if(isset($_POST['remove'])){
    if($_GET['action']=='remove'){
        foreach($_SESSION['cart'] as $key=>$value){
            echo "<pre>";
            print_r($key);
            echo "</pre>";
            if($value["product_id"]==$_GET['id']){
                var_dump($_SESSION['cart'][$key]);
                unset($_SESSION['cart'][$key]);

            }
        }
    }
}
?>  

<section class="shopping-cart">
    <h2 class="cart-title">Моята количка</h2>
    <div class="home-category">
        <div class="products d-flex justify-content-center">
            <?php
            $total = 0;

            if(isset($_SESSION['cart'])){
            $product_id=array_column($_SESSION['cart'], 'product_id');
            $query = "SELECT books.*, authors.name FROM books INNER JOIN authors ON books.author_id = authors.id";
            $result = $conn->query($query);

            if($result->num_rows > 0){
            while($row = $result -> fetch_assoc()){
                foreach($product_id as $id){
                    if($row['id'] == $id){
            ?>
                
                
                <div class="wrapper " style="margin-top: 10px;">
            <div class="container ">
                <div class=" g-1  ">
                
                    <div class="col-md-3 w-100">
                    
                        <div class="card p-2 ">
                            <div class="text-center">
                            <a href="<?php echo URLBASE;?>/view-book.php?id=<?php echo $row_product['id'];?> ">
                            <img src="<?php echo URLBASE . '/backend/uploads/' . $row['image']; ?>"width="200"></a>
                                </div>

                            
                            <form class="home-categories-number-table-item-price" method="post">
                            <div class="product-details"> <span class="font-weight-bold d-block"><?php echo htmlspecialchars($row['price']);?>лв.</span> <span><a class="book-price" href="<?php echo URLBASE?>/view-book.php?id=<?php echo $row_product['id'];?>">
                            <?php echo htmlspecialchars($row['title']);?> 
                            <br>
                            <?php echo htmlspecialchars($row['name']);?></a></span>
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
                    }
                }
            } else{
                echo "<h5>Cart is empty</h5>";
            }
            ?>

        </div>
            
    <div class="order-details">
        <h4>Детайли за поръчката</h4>
        <?php
        if (isset($_SESSION['cart'])) {
            $count = count($_SESSION['cart']);
            echo "<h6>Брой книги ($count items)</h6>";
        } else {
            echo "<h6>Брой книги  (0 items)</h6>";
        }

            //cqlata vena
            // echo $total;
        ?>
        <div class="">
            <div class="">
                <h6>Общо сума<?php echo $total  ?></h6>
                <a href="chek_out.php">Финализиране</a>
            </div>
        </div>
    </div>
          


       
        
    

    
</section>

