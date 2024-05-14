<?php
     
session_start();

include "db.php";

if(isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $error = [];

    empty($email) ? $error[] = "Email is required" : '';
    empty($password) ? $error[] = "Password is required" : '';
    
    if(!$error) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $query);

        if($result) {
            if(mysqli_num_rows($result) == 0) {
                $error[] = "Email or Password is wrong";
            } else {
                $user = mysqli_fetch_assoc($result);
                $_SESSION['auth'] = true;
                $_SESSION['name'] = $user['name'];
                header("location: index.php");
            }
        } else {
            echo mysqli_connect_error();
        }
    }
}

?>

<?php include "component/header.php" ?>

<div class="shadow p-5 w-50 rounded-4 mx-auto">
    <h1 class="mb-5 text-center">Login</h1>
    <form action="" method="post">
        <?php include "component/error.php"; ?>
        <input type="email" placeholder="Email" name="email" class="form-control mb-3">
        <input type="password" placeholder="********" name="password"  class="form-control mb-3">
        <input type="submit" name="login" value="Login" class="btn btn-outline-info d-block mx-auto w-25">
        <p class="text-center text-secondary my-3">No account? <a href="register.php">Register</a></p>
    </form>
</div>

<?php include "component/footer.php" ?>



