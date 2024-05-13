<?php
    include "db.php";
    $id = $_GET['id'];
    $query = "SELECT * FROM articles WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    if($result) {
        $article = mysqli_fetch_assoc($result);
    } else {
        echo mysqli_connect_error();
    }
?>

<?php include "component/header.php" ?>

<h2 class="mb-2"><?= $article['title'] ?></h2>
<p class="mb-2"><?= $article['about'] ?></p>
<img src="<?= $article['image'] ?>" alt="" height="300rem" class="mb-2">
<p>post at <i><?= $article['posted_at'] ?></i></p>

<?php include "component/footer.php" ?>