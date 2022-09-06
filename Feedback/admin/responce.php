

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
<style>
    .div-1{
        background-color: #ABBAEA;   
    } 
</style>
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
                        <a class="nav-link " aria-current="page" href="addfaculty.php">Faculty</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="responce.php">Response</a>
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

    <div class="container div-1">
    <h1 style="text-align: center">Form Status</h1>
    <form  method="POST" >
        <button class="btn btn-primary" name="f_open" type="submit">Enable From</button>
    </form><br>
    <form  method="POST" >
    <button class="btn btn-primary" name="f_cloase" type="submit">Disable Form</button>
    </form>
        
<?php
include('dbcon.php');
if(isset($_POST['f_open']))
{
    $query = "UPDATE status SET status=0 WHERE id=1";
    $query_run = mysqli_query($con, $query);
}
      
if(isset($_POST['f_cloase']))
{
    $query = "UPDATE status SET status=1 WHERE id=1";
    $query_run = mysqli_query($con, $query);
}     
?>        
        
  
        
    
    <?php
$con = mysqli_connect("localhost","root","","id19456629_database");
//$con = mysqli_connect("localhost","root","","id19456629_database");
$query= mysqli_query($con, "select status from status WHERE id=1  ") or die(mysqli_error($conexion));
$row = mysqli_fetch_array($query);
if ($row['status']==1){
        ?>
         <h4 style="text-align: center;">Form Is Currently Closed.</h4>
        <?php
    }else{
     ?>
    <h4 style="text-align: center;">Form Is Currently Open.</h4>
    <?php
}
?>
    </div>
<br><br>
     
     <br>
        <div class="container">
             <form method="post" action="">
                    <div class="row">
                    <div class="col-md-2" >
                         <select class="form-select" name="s_branch">
                             <option>CE</option>
                             <option>IT</option>  
                             <option>ECS</option>
                             <option>EXTC</option>
                             <option>Mechanical</option>
                             <option>AIDS</option>
                             <option>AIML</option>
                             <option>IOT</option>
                             <option>ppt</option>
                         </select>
                        </div>   
                         <div class="col-md-2" >
                             <select class="form-select" name="s_year">
                             <option>FE</option>
                               <option>SE</option>  
                                 <option>TE</option>
                                 <option>BE</option>
                             </select>
                         </div>
                          <div class="col-md-2" >
                             <select class="form-select" name="s_division">
                             <option>A</option>
                               <option>B</option>  
                                 <option>C</option>
                                 <option>D</option>
                             </select>
                         </div>
                        <div class="col-md-2" >
                            <button class="btn btn-primary" id="submit" type="submit" name="submit" >Submit</button>
                        </div>
                    </div>    
                 </form>
           </div> 
        <?php
        $s_branch=$_POST["s_branch"];
        $s_year=$_POST["s_year"]; 
        $s_division=$_POST["s_division"]; 
        ?>  
    
    <br>
    <div class="container">
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="Remaning-tab" data-bs-toggle="tab" data-bs-target="#Remaning" type="button" role="tab" aria-controls="Remaning" aria-selected="true">Remaning student list</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="Resopnded-tab" data-bs-toggle="tab" data-bs-target="#Resopnded" type="button" role="tab" aria-controls="Resopnded" aria-selected="false">Resopnded Student list </button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="Remaning" role="tabpanel" aria-labelledby="Remaning-tab">

      <br>
            <div class="container">
                    <section>
                        <table class="table table-bordered">
                            <tr>
                                <th>PRN</th>
                                <th>Branch</th>
                                <th>Year</th>
                                <th>Division</th>
                            </tr>
                            <?php
                            include( 'dbcon.php' );
                            $sql = "SELECT student.s_prn,student.s_branch,student.s_year,student.s_division FROM `student` LEFT JOIN feedback on student.s_prn=feedback.s_prn WHERE feedback.s_prn IS NULL and student.s_year =  '". $s_year ."' and student.s_division = '". $s_division ."' and student.s_branch = '". $s_branch ."' ;";
                            $result = $con->query($sql);
                            $con->close();
                            while($rows=$result->fetch_assoc())
                                {
                            ?>
                            <tr>
                                <td><?php echo $rows['s_prn'];?></td>
                                <td><?php echo $rows['s_branch'];?></td>
                                <td><?php echo $rows['s_year'];?></td>
                                <td><?php echo $rows['s_division'];?></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </table>
                   </section>
            </div>
    </div>
  <div class="tab-pane fade" id="Resopnded" role="tabpanel" aria-labelledby="Resopnded-tab">
    
<br>

      <br>
            <div class="container">
                    <section>
                        <table class="table table-bordered">
                            <tr>
                                <th>PRN</th>
                                <th>Branch</th>
                                <th>Year</th>
                                <th>Division</th>
                            </tr>
                            <?php
                            include( 'dbcon.php' );
                            $sql = "SELECT student.s_prn,student.s_branch,student.s_year,student.s_division FROM `student` JOIN feedback on student.s_prn=feedback.s_prn WHERE student.s_year =  '". $s_year ."' and student.s_division = '". $s_division ."' and student.s_branch = '". $s_branch ."' GROUP by feedback.s_prn;";
                            $result = $con->query($sql);
                            $con->close();
                            while($rows=$result->fetch_assoc())
                                {
                            ?>
                            <tr>
                                <td><?php echo $rows['s_prn'];?></td>
                                <td><?php echo $rows['s_branch'];?></td>
                                <td><?php echo $rows['s_year'];?></td>
                                <td><?php echo $rows['s_division'];?></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </table>
                   </section>
            </div>
    
    </div>
</div>
    </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

