<?php
    // require 'getBlog.php';
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
        $id = $_GET['id'];
        $sql = "SELECT * FROM blog WHERE id = $id";
        $query = mysqli_query($conn, $sql);
        $blog = mysqli_fetch_assoc($query);


        if ($blog['favorite'] == true){
            $sql = "UPDATE blog SET favorite = false WHERE id = $id";
            $query = mysqli_query($conn, $sql);

        }else{
            $sql = "UPDATE blog SET favorite = true WHERE id = $id";
            $query = mysqli_query($conn, $sql);

        }
    }
?>

<?php require 'nav.php' ?>


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
                        <h6 class="card-subtitle mb-2 text-body-secondary">By <?php echo $blog['author']; ?></h6>
                        <p class="card-text mb-1"><?php echo $blog['content'] ?></p>
                        <small class="fw-medium mb-4"><?php echo $blog['date_created'] ?></small>
                        
                        <a href="single_blog.php/?id=<?php echo $blog['id'] ?>" class="d-block card-link">Read more</a>
                        <?php if($blog['favorite'] == true){ ?>
                            <a href="/phpclass/blogApp/index.php?id=<?php echo $blog['id'] ?>"><p><i class="bi bi-heart-fill text-danger"></i></p></a>
                        <?php }?>
                        <?php if($blog['favorite'] ==false){ ?>
                            <a href="/phpclass/blogApp/index.php?id=<?php echo $blog['id'] ?>"><p><i class="bi bi-heart text-danger"></i></p></a>
                        <?php }?>
                         
                        
                    </div>
                </div>
            </div>

            <?php } ?>    
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
    
