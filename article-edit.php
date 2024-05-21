<?php

include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM articles WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $article = mysqli_fetch_assoc($result);
    } else {
        echo mysqli_connect_error();
    }
}

if (isset($_POST['update-article'])) {
    $title = htmlspecialchars(trim($_POST['title']));
    $about = htmlspecialchars(trim($_POST['about']));
    $image = $_FILES['image'];
    $error = [];

    empty($title) ? ($error[] = 'Name is required') : '';
    empty($about) ? ($error[] = 'About is required') : '';

    $id = $_GET['id'];

    if (!$error) {
        if (is_uploaded_file($image['tmp_name'])) {
            $image_path = 'photo/' . $image['name'];
            move_uploaded_file($image['tmp_name'], $image_path);
            $query = "UPDATE articles SET title='$title', about='$about', image='$image_path', posted_at=now() WHERE id = '$id'";
        } else {
            $query = "UPDATE articles SET title='$title', about='$about', posted_at=now() WHERE id = '$id'";
        }
        $result = mysqli_query($conn, $query);
        if ($result) {
            header('location: article-view.php?id=' . $id);
        } else {
            echo mysqli_connect_error();
        }
    }
}

?>

<?php include 'component/header.php'; ?>

<?php if(isset($_SESSION['auth'])): ?>

<?php if(isset($article)):  ?>

<h1 class="mb-3">Update Article</h1>

<form action="" method="post" enctype="multipart/form-data">

    <!-- error -->
    <?php include 'component/error.php'; ?>

    <div class="my-3">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" class="form-control" placeholder="Enter Your Title ... "
            value="<?= $article['title'] ?>">
    </div>
    <div class="my-3">
        <label for="about">About:</label>
        <textarea name="about" id="about" class="form-control" placeholder="About Your Post ... " rows="5"><?= htmlspecialchars_decode($article['about']) ?></textarea>
    </div>
    <div class="my-3">
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" class="form-control">
        <img src="<?= $article['image'] ?>" alt="this is pic" height="150rem" class="border">
    </div>
    <div class="my-3">
        <button type="submit" class="btn btn-outline-warning" name="update-article">Update Article</button>
    </div>
</form>
<?php else: ?>

<p class="fs-2 text-center">No Matching article.</p>

<?php endif; ?>

<?php else: ?>

    <p class="fs-2 text-center">
        <i class="bi bi-exclamation-triangle-fill text-danger"></i>
        You are not authorized.
    </p>

<?php endif; ?>

<?php include 'component/footer.php'; ?>
