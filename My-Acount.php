<?php
ob_start();
@session_start();

if(isset($_SESSION['username'])){
    $page_title = "Acount";
    include('includes/conect.php');
    include('includes/navbar.php');
    include('includes/header.php');
    global $con;
    $username = $_SESSION['username'];
    $query = "SELECT username,email FROM register WHERE username='$username'";
    $result = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($result);
?>


    <div class="card text-center" style="min-width:320px ;min-height:300px;margin:36px auto;">
        <?php
        $user = substr(strtoupper($_SESSION['username']), 0, 1);
        echo "<h4 class='user-frame'>$user</h4>";
        ?>
        <h3><?php echo $data['username']; ?></h3>
        <h3 style="margin: 2px 3px;"><?php echo $data['email']; ?></h3>
    </div>
    <div class="container text-satart">
    </div>
    <ul class="text-center">
        <li class="nav-item ">
            <a class="btn btn-danger w-50 " href="logout.php">Logout</a>
        </li>
    </ul>
<?php } else{
        include('login.php');
}
ob_end_flush();
?>

</body>

</html>