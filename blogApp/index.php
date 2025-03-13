<?php require 'nav.php' ?>
<?php
    require 'getBlog.php';
    require 'database.php';

    $sql = 'SELECT * FROM blog';
    $query = mysqli_query($conn, $sql);
    $blogs = mysqli_fetch_all($query, MYSQLI_ASSOC);
    


    $errors = [
        'email'=>''
    ];

    $email = '';
    if($_SERVER['REQUEST_METHOD'] === 'POST' ){
        $email =  htmlspecialchars($_POST['email']);
        if(empty($email)){
            $errors['email'] = 'Please enter your email';
        }else{
            echo $email;
        }

    }

    if(isset($_GET['id'])){

        $id = mysqli_real_escape_string( $conn,$_GET['id']);
        $sql = "SELECT * FROM blog WHERE id = $id";
        $query = mysqli_query($conn, $sql);
        $blog = mysqli_fetch_assoc($query);


        echo $id;
        if($blog){
            $newfavorite = $blog['favorite']? 0: 1;
            $sql = "UPDATE blog SET favorite = $newfavorite WHERE id = $id";
            $query = mysqli_query($conn, $sql);
            header('Location: /phpclass/blogApp/index.php');
        }
    }


    function getUsername($id){
        require 'database.php';
        $sql = "SELECT * FROM user_table WHERE id = $id";
        $query = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($query);
        return $user['first_name'] . ' ' . $user['last_name'];
    }

    // ADD TO CART FUNCTIONALITY
    if(isset($_GET['prod_id']) && isset($_GET['index'])){
        $product_id = $_GET['prod_id'];

        $product = $products[
            $_GET['index']
        ];

        $cart = $_SESSION['cart'];

        if(isset($cart[$product_id])){
            $cart[$product_id]['quantity'] = $cart[$product_id]['quantity'] + 1;
        }

        else{
            $cart[$product_id] = [
                'quantity' => 1,
                "price" => $product['price'],
                "title" => $product['title']
            ];

            $_SESSION['cart'] = $cart;
            print_r($_SESSION['cart']);
            header('location: /phpclass/blogApp/index.php');
        }

                
        // $cart = [
        //     $product_id =>[
        //         'quantity' => 1,
        //         "price" => 200,
        //         "name" => "Product 1",
        //     ], 

        //     ];
    }



?>



    <style>
        .card-img-top{
            width: 100%;
            height: auto;
            max-height: 200px;
            object-fit: cover;
        }
    </style>

    <section class="container" style="height: 40dvh;">
        <div class="container col-md-5 h-100 align-content-center">
            <h3 class="text-center">Welcome to MyBlog 👋</h3>
            <p class="text-center">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Hic possimus sequi non, sit eius aut rem suscipit</p>
        </div>
    </section>
    <section class="container" style="min-height: 40dvh;">
        <div class="row">
            <?php foreach ($blogs as $blog) { ?>

            <div class="blog-card col-md-4 align-content-center">
                <div class="card m-auto">
                    <img src="<?php echo $blog['image'] ?>" alt="blog-img" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $blog['title']; ?></h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">By <?php echo getUsername($blog['created_by']) ?></h6>
                        <p class="card-text mb-1"><?php echo $blog['content'] ?></p>
                        <small class="fw-medium mb-4"><?php echo $blog['date_created'] ?></small>
                        
                        <a href="single_blog.php/?id=<?php echo $blog['id'] ?>" class="d-block card-link">Read more</a>
                        
                            <a href="/phpclass/blogApp/index.php?id=<?php echo $blog['id'] ?>">
                                <p>
                                    <i class="text-danger bi bi-heart<?php echo $blog['favorite']?'-fill': 
                                    ''; ?> "></i>
                                </p>
                            </a>
                        
                  
                    </div>
                </div>
            </div>

            <?php } ?>    
        </div>

    </section>

    <section class="container">
        <h2 class="text-center mt-4">Our Product</h2>
        <div>
            <div class="row">
                <?php foreach ($products as $index => $product) { ?>
                <div class="col-md-4">
                    <div class="container border py-3">
                        <img src="<?php echo $product['image'] ?>" alt="product-img" class="card-img-top" >
                        <h5 class="card-title" style="height: 50px;"><?php echo $product['title']; ?></h5>
                        <p class="card-text mb-1">Price: $<?php echo $product['price'] ?></p>
                        <a href="/phpclass/blogApp/index.php/?prod_id=<?php echo $product['id'] ?>&?index=<?php echo $index ?>" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
                <?php } ?> 
            </div>
            
        </div>

    </section>





    <section class="container my-5" style="min-height: 40dvh;">
            <form action="" method="POST">
                <input type="text" placeholder="Email" name="email" value="<?php echo $email ?>">
                <small><?php echo htmlspecialchars($errors['email']) ?></small>

                <button type="submit"> Subscribe</button>
            </form>
    </section>
    

<?php require 'footer.php' ?>
    
