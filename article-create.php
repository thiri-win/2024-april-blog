<?php

include "db.php";

if (isset($_POST['add-article'])) {
    $title = htmlspecialchars(trim($_POST['title']));
    $about = htmlspecialchars(trim($_POST['about']));
    $image = $_FILES['image'];
    $error = [];

    empty($title) ? ($error[] = 'Please Enter Your Title') : '';
    empty($about) ? ($error[] = 'Please Enter About') : '';
    is_uploaded_file($image['tmp_name']) ? '' : ($error[] = 'Please Upload Image');

    if(!$error) {
        $image_path = "photo/".$image['name'];
        move_uploaded_file($image['tmp_name'], $image_path);
        $query = "INSERT INTO articles (title, about, image, posted_at) 
                    VALUES ('$title', '$about', '$image_path', now())";
        $result = mysqli_query($conn, $query);
        if($result) {
            header('location: index.php');
        } else {
            echo mysqli_connect_error();
        }

    }
}
?>

<?php include 'component/header.php'; ?>

<h1 class="mb-3">New Article</h1>

<form action="" method="post" enctype="multipart/form-data">
    <!-- error -->
    <?php include "component/error.php" ?>
    
    <div class="my-3">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" class="form-control" placeholder="Enter Your Title ... ">
    </div>
    <div class="my-3">
        <label for="about">About:</label>
        <textarea name="about" id="about" class="form-control" placeholder="About Your Post ... " rows="5"></textarea>
    </div>
    <div class="my-3">
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" class="form-control">
    </div>
    <div class="my-3">
        <button type="submit" class="btn btn-outline-primary" name="add-article">Add Article</button>
    </div>
</form>

<?php include 'component/footer.php'; ?>
