<?php
    require 'getBlog.php'
?>

<?php require 'nav.php' ?>

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
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $blog['title']; ?></h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">By <?php echo $blog['author']; ?></h6>
                        <p class="card-text mb-1"><?php echo $blog['content'] ?></p>
                        <small class="fw-medium mb-4"><?php echo $blog['date'] ?></small>
                        <a href="#" class="d-block card-link">Read more</a>
                    </div>
                </div>
            </div>

            <?php } ?>    
        </div>

    </section>
    

<?php require 'footer.php' ?>
    