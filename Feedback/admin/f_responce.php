<?php 
include('dbcon1.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Feedback</title>
  </head>
  <body>
    <!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SIES-GST</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="addfaculty.php">Faculty</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="responce.php">Responce</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="f_responce.php">Feedback</a>
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
    <!--/navbar--> 

   
      
      
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Feeedback</h3>
                    </div>
                    <div class="card-body">
                        <h2>FE</h2>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    
                                    <th>empid</th>
                                    <th>name</th>
                                    <th>subject</th>
 
                                    <th>q1</th>
                                    <th>q2</th>
                                    <th>q3</th>
                                    <th>q4</th>
                                    <th>q5</th>
                                    
                                </tr>
                            </thead>
                            

                            <tbody>
                                <?php
                                    
                                    $query = "select feedback.f_empid1,faculty.f_name, feedback.f_subject , (sum(q1)/(count(q1)*5))*100 as q1, (sum(q2)/(count(q2)*5))*100 as q2, (sum(q3)/(count(q3)*5))*100 as q3, (sum(q4)/(count(q4)*5))*100 as q4, (sum(q5)/(count(q5)*5))*100 as q5 from feedback join faculty on faculty.f_empid1= feedback.f_empid1  and f_year='FE'  GROUP by f_subject ORDER BY f_empid1";
                                    $statement = $conn->prepare($query);
                                    $statement->execute();

                                    $statement->setFetchMode(PDO::FETCH_OBJ); //PDO::FETCH_ASSOC
                                    $result = $statement->fetchAll();
                                    if($result)
                                    {
                                        foreach($result as $row)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $row->f_empid1; ?></td>
                                                <td><?= $row->f_name; ?></td>
                                                <td><?= $row->f_subject; ?></td>
                                                <td><?= $row->q1; ?></td>
                                                <td><?= $row->q2; ?></td>
                                                <td><?= $row->q3; ?></td>
                                                <td><?= $row->q4; ?></td>
                                                <td><?= $row->q5; ?></td>   
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <tr>
                                            <td colspan="5">No Record Found</td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                        
                        
                        <h2>SE</h2>
                            <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    
                                    <th>empid</th>
                                    <th>name</th>
                                    <th>subject</th>
 
                                    <th>q1</th>
                                    <th>q2</th>
                                    <th>q3</th>
                                    <th>q4</th>
                                    <th>q5</th>
                                    
                                </tr>
                            </thead>
                            

                            <tbody>
                                <?php
                                    
                                    $query = "select feedback.f_empid1,faculty.f_name, feedback.f_subject , (sum(q1)/(count(q1)*5))*100 as q1, (sum(q2)/(count(q2)*5))*100 as q2, (sum(q3)/(count(q3)*5))*100 as q3, (sum(q4)/(count(q4)*5))*100 as q4, (sum(q5)/(count(q5)*5))*100 as q5 from feedback join faculty on faculty.f_empid1= feedback.f_empid1  and f_year='SE'  GROUP by f_subject ORDER BY f_empid1";
                                    $statement = $conn->prepare($query);
                                    $statement->execute();

                                    $statement->setFetchMode(PDO::FETCH_OBJ); //PDO::FETCH_ASSOC
                                    $result = $statement->fetchAll();
                                    if($result)
                                    {
                                        foreach($result as $row)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $row->f_empid1; ?></td>
                                                <td><?= $row->f_name; ?></td>
                                                <td><?= $row->f_subject; ?></td>
                                                <td><?= $row->q1; ?></td>
                                                <td><?= $row->q2; ?></td>
                                                <td><?= $row->q3; ?></td>
                                                <td><?= $row->q4; ?></td>
                                                <td><?= $row->q5; ?></td>   
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <tr>
                                            <td colspan="5">No Record Found</td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                        
                        
                        
                        <h2>TE</h2>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    
                                    <th>empid</th>
                                    <th>name</th>
                                    <th>subject</th>
 
                                    <th>q1</th>
                                    <th>q2</th>
                                    <th>q3</th>
                                    <th>q4</th>
                                    <th>q5</th>
                                    
                                </tr>
                            </thead>
                            

                            <tbody>
                                <?php
                                    
                                    $query = "select feedback.f_empid1,faculty.f_name, feedback.f_subject , (sum(q1)/(count(q1)*5))*100 as q1, (sum(q2)/(count(q2)*5))*100 as q2, (sum(q3)/(count(q3)*5))*100 as q3, (sum(q4)/(count(q4)*5))*100 as q4, (sum(q5)/(count(q5)*5))*100 as q5 from feedback join faculty on faculty.f_empid1= feedback.f_empid1  and f_year='TE'   GROUP by f_subject ORDER BY f_empid1";
                                    $statement = $conn->prepare($query);
                                    $statement->execute();

                                    $statement->setFetchMode(PDO::FETCH_OBJ); //PDO::FETCH_ASSOC
                                    $result = $statement->fetchAll();
                                    if($result)
                                    {
                                        foreach($result as $row)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $row->f_empid1; ?></td>
                                                <td><?= $row->f_name; ?></td>
                                                <td><?= $row->f_subject; ?></td>
                                                <td><?= $row->q1; ?></td>
                                                <td><?= $row->q2; ?></td>
                                                <td><?= $row->q3; ?></td>
                                                <td><?= $row->q4; ?></td>
                                                <td><?= $row->q5; ?></td>   
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <tr>
                                            <td colspan="5">No Record Found</td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                        
                        <h2>BE</h2>
                        
                                                <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    
                                    <th>empid</th>
                                    <th>name</th>
                                    <th>subject</th>
 
                                    <th>q1</th>
                                    <th>q2</th>
                                    <th>q3</th>
                                    <th>q4</th>
                                    <th>q5</th>
                                    
                                </tr>
                            </thead>
                            

                            <tbody>
                                <?php
                                    
                                    $query = "select feedback.f_empid1,faculty.f_name, feedback.f_subject , (sum(q1)/(count(q1)*5))*100 as q1, (sum(q2)/(count(q2)*5))*100 as q2, (sum(q3)/(count(q3)*5))*100 as q3, (sum(q4)/(count(q4)*5))*100 as q4, (sum(q5)/(count(q5)*5))*100 as q5 from feedback join faculty on faculty.f_empid1= feedback.f_empid1  and f_year='BE'  GROUP by f_subject ORDER BY f_empid1";
                                    $statement = $conn->prepare($query);
                                    $statement->execute();

                                    $statement->setFetchMode(PDO::FETCH_OBJ); //PDO::FETCH_ASSOC
                                    $result = $statement->fetchAll();
                                    if($result)
                                    {
                                        foreach($result as $row)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $row->f_empid1; ?></td>
                                                <td><?= $row->f_name; ?></td>
                                                <td><?= $row->f_subject; ?></td>
                                                <td><?= $row->q1; ?></td>
                                                <td><?= $row->q2; ?></td>
                                                <td><?= $row->q3; ?></td>
                                                <td><?= $row->q4; ?></td>
                                                <td><?= $row->q5; ?></td>   
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <tr>
                                            <td colspan="5">No Record Found</td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>