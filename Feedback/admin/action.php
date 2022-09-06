<?php

include('dbcon.php');
if(isset($_POST['add_faculty']))
{
    
    $f_name=$_POST['f_name'];
    $f_empid=$_POST['f_empid'];
    $f_eduid=$_POST['f_eduid'];
    
    $query = "INSERT INTO faculty (f_name,f_empid1,f_eduid) VALUES ('$f_name','$f_empid','$f_eduid')";

    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
      
        header("Location: addfaculty.php");
    }
    else
    {
      echo "ERROR: Hush! Sorry $sql. ". mysqli_error($con);
        header("Location: addfaculty.php");
    }
}



if(isset($_POST['delete_u']))
{
    
    $id = $_POST['delete_u'];
    $query = "DELETE FROM `faculty` WHERE f_empid1='$id';";
    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        header("Location: addfaculty.php");
    }
    else
    {
        header("Location: addfaculty.php");
    }
}


?>





