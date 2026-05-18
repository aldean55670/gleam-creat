<?php
$page_title = "Register";
include(__DIR__ . "/includes/header.php");
include(__DIR__ . "/includes/navbar.php");
include(__DIR__ . "/includes/conect.php");
if ($_POST) {
    global $con;
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $query = "INSERT INTO  `register` (username,email,password) VALUES ('$username','$email','$password')";
    $result = mysqli_query($con, $query);
    if ($result) echo "<div class='alert alert-success text-center'>YOUR SIGN IN IN THE GLEAM-CREAT</div>";
    if (!$result) echo "<div class='alert alert-danger text-center'>YOUR <span class'red'>NOT<span> SIGN IN>";
}

?>




<div class="head-register">
    <h3 class="text-center margin-top-30 blueviolet">SIGN IN GLEAM CREAT</h3>
</div>
<div class="container margin-top-30 ">
    <form action="" method="post" class="styForm blueviolet">
        <input type="text" name="username" id="" class="" placeholder="username" required>
        <input type="email" name="email" id="" class="" placeholder="your email" required>
        <input type="password" name="password" class="" id="password" placeholder="password" required>
        <input type="password" name="conf-pas" class="" id="conf-pas" placeholder="conf.password" required>
        <p id="wrong" class="alert alert-danger">password is not equal</p>
        <input type="submit" class="btn btn-success" value="Send">
    </form>
</div>
<script>
    let password = document.getElementById('password');
    let confPass = document.getElementById('conf-pas');
    let wrong = document.getElementById('wrong');
    wrong.style.display = 'none';

    confPass.addEventListener('input', function() {
        if (this.value !== password.value) {
            wrong.style.display = 'block';
        } else {
            wrong.style.display = 'none';
        }
    }, 1000)
    password.addEventListener('input', function() {
        if (this.value !== confPass.value) {
            wrong.style.display = 'block';
        } else {
            wrong.style.display = 'none';
        }
    }, 1000)
</script>

<body>

</body>

</html>