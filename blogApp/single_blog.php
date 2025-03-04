<?php require 'nav.php' ?>
<?php
// echo $_GET['id']
require 'database.php';

$is_admin = $_SESSION['is_admin'] ?? false;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // echo $id;

    $sql = "SELECT * FROM blog WHERE id = $id ";
    $result = mysqli_query($conn, $sql);
    $post = mysqli_fetch_assoc($result);
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $id = $_GET['id'];
   
    $sql = "UPDATE blog SET title = '$title', content = '$content', category = '$category' WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "Data updated successfully";
    }else{
        echo "Error updating data";
    }
}

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    $sql = "DELETE FROM blog WHERE id = $post_id ";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header('Location: /phpclass/blogApp/index.php');
        exit;
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}


function getUsername($id)
{
    require 'database.php';
    $sql = "SELECT * FROM user_table WHERE id = $id";
    $query = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($query);
    return $user['first_name'] . ' ' . $user['last_name'];
}


?>

<style>
    img {
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
        <small>By <b><?php echo getUsername($post['created_by']) ?> </b></small>
        <p class="mt-3 mb-1"><?php echo $post['content'] ?></p>
        <em><?php echo $post['date_created'] ?></em>
        <?php if($is_admin) { ?>
        <div class="mt-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal_edit">Edit</button>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
        </div>
        <?php } ?>

        <!-- Delete Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        Are you sure?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <a href="/phpclass/blogApp/single_blog.php/?post_id=<?php echo $post['id'] ?>" type="button" class="btn btn-primary">Yes</a>
                    </div>
                </div>
            </div>
        </div>


        <!-- Edit Modal -->

        <div class="modal fade" id="exampleModal_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">

                            <input
                                type="text"
                                placeholder="Title"
                                class="form-control /shadow-none mb-2"
                                name="title"
                                value="<?php echo $post['title']; ?>">

                            <select
                                name="category"
                                id=""
                                class="form-control mb-2"
                                
                            >
                                <option value="<?php echo $post['category']; ?>"> <?php echo $post['category']; ?> </option>
                                <option value="programming">Programming</option>
                                <option value="fashion">Fashion</option>
                                <option value="sport">Sport</option>
                            </select>

                            <textarea
                                name="content"
                                id=""
                                placeholder="Content"
                                class="form-control mb-2"><?php echo htmlspecialchars($post['content']); ?></textarea>

                            <button type="submit" class="btn btn-primary d-block my-2" data-bs-dismiss="modal">Save changes</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>


<?php require 'footer.php' ?>