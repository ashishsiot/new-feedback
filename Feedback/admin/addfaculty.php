<?php
include( 'dbcon.php' );
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                        <a class="nav-link active" aria-current="page" href="addfaculty.php">Faculty</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="responce.php">Responce</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="f_responce.php">Feedback</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    
                    <button onclick="document.location='../logout.php'" class="btn btn-outline-success me-2" type="button">
                        Logout
                    </button>
                </span>
            </div>
        </div>
    </nav>

    <div class="container ">
        <div class="d-flex justify-content-center">
            <div class="col-md-12 justify-content-center mt-4">
                <div class="card">

                    <div class="card-body">
                        <form action="action.php" method="POST" autocomplete="off">

                            <div class="container ">

                                <div class="row">
                                    <div class="col">
                                        <div class="form-outline mb-4">
                                            <label class="form-label float-left">Emp id:</label>
                                           <input type="text" name="f_empid" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-outline mb-4">
                                            <label class="form-label float-left">Name:</label>
                                            <input type="text" name="f_name" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-outline mb-4">
                                            <label class="form-label float-left">Edu id:</label>
                                            <input type="text" name="f_eduid" required class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3 text-center">
                                    <button type="submit" id="btSubmit" name="add_faculty" class="btn btn-primary">Add Faculty</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php

include( 'dbcon.php' );
session_start();


$sql = " select * from faculty";

$result = $con->query($sql);
$con->close();
?> 
    
    
    
    <div class="container">
    	<section>
		<h1 style="text-align: center">Faculty Members</h1>
		<table class="table table-bordered">
			<tr>
				<th>f_empid1</th>
				<th>f_name</th>
                <th>f_eduid</th>
                <!-- <th>f_phoneno</th> -->
               <!-- <th>Edit</th>  -->
                <th>Delete</th>
			</tr>
			<?php
				while($rows=$result->fetch_assoc())
				{
			?>
			<tr>
				<td><?php echo $rows['f_empid1'];?></td>
				<td><?php echo $rows['f_name'];?></td>
				<td><?php echo $rows['f_eduid'];?></td>
			  <!-- 	<td></td>  -->
				<td>  
                      <form action='action.php' method="POST">
                      <button type="submit" name="delete_u" value="<?php echo $rows['f_empid1'];?>" class="btn btn-primary">Delete</button>
                      </form>
                </td>
			</tr>
			<?php
				}
			?>
		</table>
	</section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
