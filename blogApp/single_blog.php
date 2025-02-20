<?php
    // echo $_GET['id']

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        // echo $id;
        
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
            <img src="" alt="blog-img">
            <h2>Blog Title</h2>
            <small>By <b>John Doe</b></small>
            <p class="mt-3 mb-1">Blog Description</p>
            <em>date</em>
            <div class="mt-3">
                <button class="btn btn-primary">Edit</button>
                <button class="btn btn-danger">Delete</button>
            </div>

        </div>

    </section>


<?php require 'footer.php' ?>