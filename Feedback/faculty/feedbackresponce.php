<?php

include( 'dbcon.php' );
session_start();


$sql = " select f_subject , (sum(q1)/(count(q1)*5))*100 as q1, (sum(q2)/(count(q2)*5))*100 as q2, (sum(q3)/(count(q3)*5))*100 as q3, (sum(q4)/(count(q4)*5))*100 as q4, (sum(q5)/(count(q5)*5))*100 as q5 from feedback WHERE f_empid1='".$_SESSION['f_empid1']."' GROUP by f_subject ";

$result = $con->query($sql);
$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<meta charset="UTF-8">
</head>

<body>
    
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SIES-GST</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="feedbackresponce.php">Response</a>
                    </li>
                </ul>

                <span class="navbar-text">
                    <?php echo $_SESSION["f_eduid"] ?>
                    <button onclick="document.location='logout.php'" class="btn btn-outline-success me-2" type="button">
                        Logout
                    </button>
                </span>

            </div>
        </div>
    </nav>
    
    
    <div class="container">
        <section>
            <h1 style="text-align: center">Responses</h1>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>q1</th>
                        <th>q2</th>
                        <th>q3</th>
                        <th>q4</th>
                        <th>q5</th>
                    </tr>
                </thead>    
                <?php
                    while($rows=$result->fetch_assoc())
                    {
                ?>
                <tr>
                    <td><?php echo $rows['f_subject'];?></td>
                    <td><?php echo $rows['q1'];?></td>
                    <td><?php echo $rows['q2'];?></td>
                    <td><?php echo $rows['q3'];?></td>
                    <td><?php echo $rows['q4'];?></td>
                    <td><?php echo $rows['q5'];?></td>
                </tr>
                <?php
                    }
                ?>
            </table>
        </section>
    </div>    
</body>

</html>
