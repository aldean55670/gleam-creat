<?php
ob_start();
@session_start();
$page_title = "login";
include('includes/header.php');
include('includes/navbar.php');
include('includes/conect.php');

if ($_POST) {
    global $con;
    $username = htmlspecialchars($_POST['username'], ENT_QUOTES);
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES);

    $query = "SELECT username,password,email FROM register WHERE username = '$username'";
    $result = mysqli_query($con, $query);
    // =======================================
    // chick username and password
    // =======================================
    if ($data = mysqli_fetch_assoc($result)) {
        $email = $data['email'];
        if (password_verify($password, $data['password'])) {
            $_SESSION['username'] = $username;
            header("Location:index.php");
        }else{echo "<h4 class='alert alert-danger'>Password Is Wrong</h4>";}
    }else{echo "<h4 class='alert alert-danger'>User Name Is Wrong</h4>";}
}
?>
<div class="container center-center">
    <div class="card login-card shadow p-4" style="width: 50%;margin:auto;">
        <h3 class="text-center mb-4">Login</h3>
        <form method="POST"> <!-- Email -->
            <div class="mb-3"> <label class="form-label">UserName</label> <input type="text" name="username" class="form-control" required> </div> <!-- Password -->
            <div class="mb-3"> <label class="form-label">Password</label> <input type="password" name="password" class="form-control" required> </div> <!-- Error Message -->
            <div id="error" class="text-danger mb-2" style="display:none;">Wrong email or password</div> 
            <!-- Button --> 
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <div class='link-signIn'><a href="register.php">signIn</a></div>
        </form>
    </div>
</div>
<?php
    ob_end_flush();
?>
</body>

</html>