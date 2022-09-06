<?php

include('dbcon.php');

if(isset($_POST['add_feedback']))
{
    $s_prn=$_POST['s_prn'];
    $f_empid1=$_POST['f_empid1'];
    $f_subject=$_POST['f_subject'];
    $f_year=$_POST['f_year'];
    $q1=$_POST['q1'];
    $q2=$_POST['q2'];
    $q3=$_POST['q3'];
    $q4=$_POST['q4'];
    $q5=$_POST['q5'];
    $q6=$_POST['q6'];
    $q7=$_POST['q7'];
    
    
    $query0 = "SELECT s_prn FROM feedback WHERE s_prn = '$s_prn' and f_empid1= '$f_empid1' and f_subject = '$f_subject'";
    $query_run1 = mysqli_query($con, $query0);
    
    
        if(mysqli_num_rows($query_run1) > 0) {     
        echo "<SCRIPT> //not showing me this
        alert('feedback is already given')
        window.location.replace('feedback.php');
        </SCRIPT>";        
        }
        else{
        $query = "INSERT INTO `feedback`(`s_prn`, `f_empid1`, `f_subject`, `q1`, `q2`, `q3`, `q4`, `q5`, `f_year`,`q6`,`q7` ) VALUES ('$s_prn','$f_empid1','$f_subject','$q1','$q2','$q3','$q4','$q5','$f_year','$q6','$q7')";
        $query_run = mysqli_query($con, $query);
        if($query_run)
        {
            header("Location: feedback.php");
        }
        else
        { 
			echo "ERROR: Hush! Sorry $sql. ". mysqli_error($con);

            header("Location: feedback.php");
        }
    }
}
?>





