<?php require 'nav.php' ?>
<?php 
    require 'getBlog.php';
    $cart = $_SESSION['cart'] ?? [];

    function actualPrice($index){
        global $cart;
        global $products;

        $product_id = $cart[$index]['product_id'];
        $filterdProducts = array_filter($products, function($product) use ($product_id) {
            return $product['id'] == $product_id;
            });
        $product = reset($filterdProducts);
        // print_r($product);
        return $product['price'];

    }

    if (isset($_GET['action']) && $_GET['index']){
        $index = $_GET['index'];
        $action = $_GET['action'];

        if ($action == 'increase'){
            
            $cart[$index]['quantity']++;
            $cart[$index]['price'] = actualPrice($index) * $cart[$index]['quantity'];
            
        }else{

        }
        $_SESSION['cart'] = $cart;
        header('location: /phpClass/blogApp/viewCart.php');
        exit;
    }


?>

<section>
    <h2 class="text-center mt-3">Cart Page</h2>
    <div class="container mt-5">
        <div class="row">
            <?php if (count($cart) <= 0) { ?>
                <h2>Empty Cart</h2>
            <?php } ?>
            <?php foreach ($cart as $index => $item) { ?>
                <div class="col-md-4">
                    <p>
                        <h3><?php echo $item['title']; ?></h3>
                        <p>Price: $<?php echo $item['price']; ?></p>
                        <a href="/phpclass/blogApp/viewCart.php/?action=increase&index=<?php echo $index ?>" class="btn btn-dark">+</a>
                        <b><?php echo $item['quantity']; ?></b>
                        <a href="" class="btn btn-dark">-</a>
                    </p>
                </div>
            <?php }?>

        
        </div>
    </div>
</section>

