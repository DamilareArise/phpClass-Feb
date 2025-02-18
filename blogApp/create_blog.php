<?php
require 'database.php';

$errors = [
    'title'=>"",
    'author'=>"",
    'category'=>'',
    'content'=> ''
];

$alert =  '';

$title = "";
$author = '';
$category = '';
$content = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    // echo $title . ' ' . $author . ' ' . $category . ' ' . $content;

    if(empty($title)){
        $errors['title']  = 'Title required';
    }
    else if (empty($author)){
        $errors['author']  = 'Author required';
    }
    else if (empty($category)){
        $errors['category']  = 'Category required';
    }
    else if(empty($content)){
        $errors['content']  = 'Content required';
    }
    else{

        $sql = "INSERT INTO blog(title, author, category, content) VALUES('$title', '$author', '$category', '$content')";
    
        $query = mysqli_query($conn, $sql);
        if($query){
            $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Blog added successfully!</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

            $title = '';
            $author = '';
            $category = '';
            $content = '';

        }else{
            echo 'Failed to add blog';
            $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Failed to add blog!</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

        }
    }
}
?>



<?php require 'nav.php' ?>
<div class="container col-md-5 border border-primary my-5 p-3">
    <form action="" method="POST">
        <?php echo $alert ?>
        <h3 class="text-center">Create Post</h3>
        <input 
            type="text" 
            placeholder="Title" 
            class="form-control /shadow-none mb-2" 
            name="title" 
            value="<?php echo ($title); ?>"
        >
        <small class="d-block mb-2 text-danger"> <?php echo htmlspecialchars($errors['title']) ?></small>
        <input 
            type="text" 
            placeholder="Author" 
            class="form-control mb-2" 
            name="author"
            value="<?php echo htmlspecialchars($author); ?>"
        > 
        <small class="d-block mb-2 text-danger"> <?php echo htmlspecialchars($errors['author']) ?> </small>
        <select 
            name="category" 
            id="" 
            class="form-control mb-2"
        >
            <option value="">Select Category</option>
            <option value="programming">Programming</option>
            <option value="fashion">Fashion</option>
            <option value="sport">Sport</option>
        </select>
        <small class="d-block mb-2 text-danger"><?php echo htmlspecialchars($errors['category']) ?></small>

        <textarea 
        name="content" 
        id="" 
        placeholder="Content" 
        class="form-control mb-2"

        ><?php echo htmlspecialchars($content); ?></textarea>
        <small class="d-block mb-2 text-danger"><?php echo htmlspecialchars($errors['content']) ?></small>

        <button class="btn btn-primary w-100 mb-2" type="submit">Post</button>
    </form>
</div>

    <!-- <script>
        window.location.href = "https://edu.sqi.ng";
    </script> -->

<?php require 'footer.php' ?>