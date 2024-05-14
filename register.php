<?php

include 'db.php';

if (isset($_POST['register'])) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $cpassword = trim($_POST['cpassword']);
    $error = [];

    empty($name) ? ($error[] = 'Name is required') : '';
    empty($email) ? ($error[] = 'Email is required') : '';
    empty($password) ? ($error[] = 'Password is requried') : '';
    empty($cpassword) ? ($error[] = 'Confirm Password is required') : '';
    $password != $cpassword ? ($error[] = 'Passwords do not match') : '';

    if (!$error) {
        $password = md5($password);

        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $error[] = 'Email already taken.';
            } else {
                $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    header('location: login.php');
                } else {
                    echo mysqli_connect_error();
                }
            }
        } else {
            echo mysqli_connect_error();
        }
    }
}

?>

<?php include 'component/header.php'; ?>

<div class="shadow p-5 w-50 rounded-4 mx-auto">
    <h1 class="mb-5 text-center">Register</h1>
    <form action="" method="post">
        <?php include 'component/error.php'; ?>
        <input type="text" placeholder="Name" name="name" class="form-control mb-3">
        <input type="email" placeholder="Email" name="email" class="form-control mb-3">
        <input type="password" placeholder="********" name="password" class="form-control mb-3">
        <input type="password" placeholder="********" name="cpassword" class="form-control mb-4">
        <input type="submit" name="register" value="Register" class="btn btn-outline-success d-block mx-auto w-25">
        <p class="text-center text-secondary my-3">Already have an account? <a href="login.php">Login</a></p>
    </form>
</div>

<?php include 'component/footer.php'; ?>
