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

    $s_prn = $_POST["s_prn"];

    $sql = "select * from student where s_prn='" . $s_prn . "' ";

    $result = mysqli_query($data, $sql);
    $row = mysqli_fetch_array($result);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION["s_siesid"] = $s_siesid;
        $_SESSION["s_prn"] = $s_prn;
        header("location:student/feedback.php");
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
                        <a class="nav-link" aria-current="page" href="admin/a_login.php">Admin Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="faculty/f_login.php">Faculty Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="">Student Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <section class="vh-100">
        <h1 style="text-align: center;">Student Feedback 2022</h1>
        <form action="#" method="POST">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-2-strong p-2" style="border-radius: 1rem;">
                            <center>
                                <h2></h2>
                            </center>
                            <div class="card-body text-center">
                                <div class="form-outline mb-4">
                                    <!-- <label class="form-label float-left">Username:</label>
                                    <input type="text" name="s_siesid" class="form-control form-control-lg" placeholder="Username" />
                                </div> -->
                                <div class="form-outline mb-4">
                                    <label class="form-label float-left">Enter PRN:</label>
                                    <input type="text" name="s_prn" required class="form-control form-control-lg" placeholder="PRN Number" />
                                </div>
                                <!-- <div class="form-outline mb-4">
                                    <label class="form-label float-left">Year :</label>
                                    <input type="text" name="s_year" required class="form-control form-control-lg" placeholder="input year" />
                                </div> -->
                                <!-- <div class="form-outline mb-4">
                                    <label class="form-label float-left">DLO :</label>
                                    <input type="text" id="s_dlo1" name="s_dlo1" required class="form-control form-control-lg" placeholder="input your dlo" />
                                </div> -->
                                <hr class="my-4">
                                <button class="btn btn-primary btn-lg btn-block" id="mySelect" value="Login" type="submit">Login</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <?php
    $con = mysqli_connect("localhost", "root", "", "id19456629_database");
    $query = mysqli_query($con, "select status from status WHERE id=1  ") or die(mysqli_error($conexion));
    $row = mysqli_fetch_array($query);
    
    if ($row['status'] == 1) {
    ?>
        <script>
            document.getElementById("mySelect").disabled = true;
        </script>
        <h1 style="text-align: center;">Form Is Currently Closed.</h1>
    <?php
    } else {
    ?>
        <script>
            document.getElementById("mySelect").disabled = false;
        </script>
    <?php
    }
    ?>
</body>

</html>