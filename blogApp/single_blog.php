<?php
    // echo $_GET['id']
    require 'database.php';

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        // echo $id;
        
        $sql = "SELECT * FROM blog WHERE id = $id ";
        $result = mysqli_query($conn, $sql);
        $post = mysqli_fetch_assoc($result);

    }
?>



<?php require 'nav.php' ?>
    <style>
        img{
            width: 50%;
            height: auto;
            max-height: 400px;
            object-fit: cover;
        }
    </style>

    <section class="container my-5" style="min-height: 40dvh;">
        <div>
            <img src="/phpclass/blogApp/<?php echo $post['image'] ?>" alt="blog-img">
            <h2><?php echo $post['title']; ?></h2>
            <small>By <b><?php echo $post['author'] ?> </b></small>
            <p class="mt-3 mb-1"><?php echo $post['content'] ?></p>
            <em><?php echo $post['date_created'] ?></em>
            <div class="mt-3">
                <button class="btn btn-primary">Edit</button>
                <button class="btn btn-danger">Delete</button>
            </div>

        </div>

    </section>


<?php require 'footer.php' ?>