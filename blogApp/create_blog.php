<?php
$title = '';
$author = '';
$category = '';
$content = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $author = htmlspecialchars($_POST['author']);
    $category = htmlspecialchars($_POST['category']);
    $content = htmlspecialchars($_POST['content']);
    echo $title . ' ' . $author . ' ' . $category . ' ' . $content;
}
?>



<?php require 'nav.php' ?>
<div class="container col-md-5 border border-primary my-5 p-3">
    <form action="" method="POST">
        <h3 class="text-center">Create Post</h3>
        <input 
            type="text" 
            placeholder="Title" 
            class="form-control /shadow-none mb-2" 
            name="title" 
            value="<?php echo htmlspecialchars($title); ?>"
        >
        <input 
            type="text" 
            placeholder="Author" 
            class="form-control mb-2" 
            name="author"
            value="<?php echo htmlspecialchars($author); ?>"
        > 
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

        <textarea 
        name="content" 
        id="" 
        placeholder="Content" 
        class="form-control mb-2"

        ><?php echo htmlspecialchars($content); ?></textarea>

        <button class="btn btn-primary w-100 mb-2" type="submit">Post</button>
    </form>
</div>

    <!-- <script>
        window.location.href = "https://edu.sqi.ng";
    </script> -->

<?php require 'footer.php' ?>