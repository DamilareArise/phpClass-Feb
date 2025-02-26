<?php require 'nav.php' ?>

<?php
require 'database.php';

$id = $_SESSION['user'] ?? 'not logged in';
echo $id;

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
$image_path = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $image = $_FILES['image'];
   

    if(isset($image) && $image['error'] === UPLOAD_ERR_OK ){
        
        if ($image['size'] > 10000000){
            $alert = '<div class="alert alert-danger">The image size is too large</div>';
        }
        elseif(!in_array($image['type'], ['image/jpeg', 'image/png', 'image/gif'])){
            $alert = '<div class="alert alert-danger">The image type is not allowed</div>';
        }
        else{
            // print_r($image);
            $image_name = basename($image['name']); // img.jpeg
            $tmp_name = $image['tmp_name'];

            // $file_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION)); // To extract the file extension e.g jpeg

            $new_image_name = time().'-'.$image_name;
            // echo $new_image_name;
            $image_path = "uploads/".$new_image_name;
            move_uploaded_file($tmp_name, $image_path);
    
        }
    }else{
        $alert = '<div class="alert alert-danger">Error occured while uploading file or no file uuploaded</div>';
        // switch ($_FILES['image']['error']) {
        //     case UPLOAD_ERR_INI_SIZE:
        //         exit('File exceeds the upload_max_filesize limit.');
        //         break;
        //     case UPLOAD_ERR_FORM_SIZE:
        //         exit('File exceeds MAX_FILE_SIZE in the HTML form.');
        //         break;
        //     case UPLOAD_ERR_NO_FILE:
        //         exit('No file uploaded.');
        //         break;
        //     default:
        //         exit('An unknown error occurred.');
        //         break;
        // }
    }

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

        $sql = "INSERT INTO blog(title, author, category, content, `image`) VALUES('$title', '$author', '$category', '$content', '$image_path')";
    
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




<div class="container col-md-5 border border-primary my-5 p-3">
    <form action="" method="POST" enctype="multipart/form-data">
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

        <label for="image"> Upload Image:</label>
        <input type="file" name="image" class="form-control mb-2" >

        <button class="btn btn-primary w-100 mb-2" type="submit">Post</button>
    </form>
</div>

    <!-- <script>
        window.location.href = "https://edu.sqi.ng";
    </script> -->

<?php require 'footer.php' ?>