<?php

include('dbcon.php');

if(isset($_POST['add_data']))
{
    
    $f_empid1=$_POST['f_empid1'];
    $sel1=$_POST['sel1'];
    $sel2=$_POST['sel2'];
    $sel3=$_POST['sel3'];
    $sel4=$_POST['sel4'];
    $sel5=$_POST['sel5'];
    $sel6=$_POST['sel6'];
    $sel7=$_POST['sel7'];
    
    $query = "INSERT INTO f_allocation (f_empid,f_branch,f_year,f_semester,f_division,f_type,f_subject,f_batch) VALUES ('$f_empid1','$sel1','$sel5','$sel2','$sel4','$sel6','$sel3','$sel7')";

    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
      
        header("location:home.php");
    }
    else
    {
        header("Location:home.php");
    }
}


?>





