<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "id19456629_database";

session_start();

$data = mysqli_connect($host, $user, $password, $db);

if ($data === false) {
    die("connection error");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "select * from admin where username='" . $username . "' AND password='" . $password . "' ";

    $result = mysqli_query($data, $sql);
    $row = mysqli_fetch_array($result);
    $count = mysqli_num_rows($result);  
    
        if ($count == 1){

        header("location:responce.php");
        }
    
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>login</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>

<body>
    
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SIES-GST</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="a_login.php">Admin Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../faculty/f_login.php">Faculty Login</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../index.php">Student Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    
    <section class="vh-100">
        <h1 style="text-align: center;">Login Form For Admin</h1>
        <form action="#" method="POST">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-2-strong p-2" style="border-radius: 1rem;">
                            <center>
                                <h2>Sign In</h2>
                            </center>
                            <div class="card-body text-center">
                                <div class="form-outline mb-4">
                                    <label class="form-label float-left">EDU ID :</label>
                                    <input type="text" name="username" required class="form-control form-control-lg" placeholder="Username" />
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label float-left">Password :</label>
                                    <input type="password" name="password" required class="form-control form-control-lg" placeholder="Password" />
                                </div>
                                <hr class="my-4">
                                <button class="btn btn-primary btn-lg btn-block" value="Login" type="submit">Login</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</body>

</html>