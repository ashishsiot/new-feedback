<?php
include('dbcon.php');

session_start();


?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src=script.js></script>



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
          <!--
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="">temp</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">temp</a>
                    </li>
-->
        </ul>

        <span class="navbar-text">
          <?php echo $_SESSION["s_siesid"] ?>
          <button onclick="document.location='../logout.php'" class="btn btn-outline-success me-2" type="button">
            Logout
          </button>
        </span>

      </div>
    </div>
  </nav>
  <!--/navbar-->
  <!--login informarion-->
  <div class="container ">
    <div class="d-flex flex-row   justify-content-around form-outline mb-4">
      <div class="p-1">
        <label class="form-label float-left">Student Name:
          <?php
          $sql = "SELECT s_name from student where s_prn='" . $_SESSION['s_prn'] . "'";
          $result = $con->query($sql);
          while ($row = mysqli_fetch_array($result)) {
            echo "" . $row['s_name'];
          }
          ?>
        </label>
      </div>
      <div class="p-1">
        <label class="form-label float-left">Student PRN:
          <?php
          $sql = "SELECT s_prn from student where s_prn='" . $_SESSION['s_prn'] . "'";
          $result = $con->query($sql);
          while ($row = mysqli_fetch_array($result)) {
            echo "" . $row['s_prn'];
          }
          ?>
        </label>
      </div>
    </div>
  </div>

  <!--/login information-->
  <h3 style="text-align:center">Theory</h3>

  <div class="container">
    <?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $databaseName = "id19456629_database";

    // Create connection
    $conn = new mysqli($hostname, $username, $password, $databaseName);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }


    /////////////////////////////////////////////////////////////////////


    $student_year = array('SE', 'TE', 'BE');
    //                       0     1       2      3      4       5       6       7      8
    $student_branch = array('CE', 'EXTC', 'IT', 'PPT', 'MECH', 'ECS', 'AIDS', 'IOT', 'AIML');

    // GET THE YEAR OF THE STUDENT
    $sql_year = "SELECT s_year from student where s_prn='" . $_SESSION['s_prn'] . "'";
    $result_year = $con->query($sql_year);
    $year = mysqli_fetch_assoc($result_year);
    $value_year = $year['s_year'];
    //var_dump($value_year);



    // GET THE BRANCH OF THE STUDENT
    $sql_branch = "SELECT s_branch from student where s_prn='" . $_SESSION['s_prn'] . "'";
    $result_branch = $con->query($sql_branch);
    $branch = mysqli_fetch_assoc($result_branch);
    $value_branch = $branch['s_branch'];
    //var_dump($value_branch);

    if ($value_year == $student_year[0]) {
      $sql = "
      SELECT f_subject,f_name,f_empid1,f_year from f_allocation,student,faculty
      WHERE student.s_branch = f_allocation.f_branch AND 
      student.s_division = f_allocation.f_division AND
      student.s_year = f_allocation.f_year AND
      student.s_prn= '" . $_SESSION['s_prn'] . "'  AND 
      f_allocation.f_empid= faculty.f_empid1 and
      f_type='theory' ";

      $result = $conn->query($sql);
    } elseif ($value_year == $student_year[1]) {

      // DLOS OF ALL THE BRANCHES OF TE 
      $student_dlo_TE = array(
        array('PGM', 'IP', 'ADBMS'),  // CE
        array('DCC', 'ST'),           // EXTC
        array('ADMT', 'ADSA'),        // IT
        array(),                      // PPT
        array(),                       // MECH
        array('ITC', 'ST')             // ECS
      );

      // GET THE DLO OF THE TE STUDENT
      $sql_dlo = "SELECT s_dlo1 from student where s_prn='" . $_SESSION['s_prn'] . "'";
      $result_dlo = $con->query($sql_dlo);
      $dlo = mysqli_fetch_assoc($result_dlo);
      $value_to_delete_dlo = $dlo['s_dlo1'];
      //var_dump($value_to_delete_dlo);

      // CE
      if ($value_branch == $student_branch[0]) {
        $dlo = $student_dlo_TE[0];
        $key = array_search($value_to_delete_dlo, $dlo);
        if (($key) !== false) {
          #deleting the key found
          unset($dlo[$key]);
        }
        $dlo1 = array_values($dlo);

        $sql = "
        SELECT f_subject,f_name,f_empid1,f_year from f_allocation,student,faculty
        WHERE student.s_branch = f_allocation.f_branch AND 
        student.s_division = f_allocation.f_division AND
        student.s_year = f_allocation.f_year AND
        student.s_prn= '" . $_SESSION['s_prn'] . "'  AND 
        f_allocation.f_empid= faculty.f_empid1 and
        f_type='theory' AND 
        f_subject != '$dlo1[0]' AND 
        f_subject != '$dlo1[1]' ";

        $result = $conn->query($sql);
      }
      // EXTC
      if ($value_branch == $student_branch[1]) {
        $dlo = $student_dlo_TE[1];
        $key = array_search($value_to_delete_dlo, $dlo);
        if (($key) !== false) {
          #deleting the key found
          unset($dlo[$key]);
        }
        $dlo1 = array_values($dlo);

        $sql = "
        SELECT f_subject,f_name,f_empid1,f_year from f_allocation,student,faculty
        WHERE student.s_branch = f_allocation.f_branch AND 
        student.s_division = f_allocation.f_division AND
        student.s_year = f_allocation.f_year AND
        student.s_prn= '" . $_SESSION['s_prn'] . "'  AND 
        f_allocation.f_empid= faculty.f_empid1 and
        f_type='theory' AND 
        f_subject != '$dlo1[0]' 
   ";
        $result = $conn->query($sql);
      }
      // IT
      if ($value_branch == $student_branch[2]) {
        $dlo = $student_dlo_TE[2];
        $key = array_search($value_to_delete_dlo, $dlo);
        if (($key) !== false) {
          #deleting the key found
          unset($dlo[$key]);
        }
        $dlo1 = array_values($dlo);

        $sql = "
      SELECT f_subject,f_name,f_empid1,f_year from f_allocation,student,faculty
      WHERE student.s_branch = f_allocation.f_branch AND 
      student.s_division = f_allocation.f_division AND
      student.s_year = f_allocation.f_year AND
      student.s_prn= '" . $_SESSION['s_prn'] . "'  AND 
      f_allocation.f_empid= faculty.f_empid1 and
      f_type='theory' AND 
      f_subject != '$dlo1[0]' 
 ";
        $result = $conn->query($sql);
      }
      // PPT
      if ($value_branch == $student_branch[3]) {
        $dlo = $student_dlo_TE[3];
        $key = array_search($value_to_delete_dlo, $dlo);
        if (($key) !== false) {
          #deleting the key found
          unset($dlo[$key]);
        }
        $dlo1 = array_values($dlo);

        $sql = "
        SELECT f_subject,f_name,f_empid1,f_year from f_allocation,student,faculty
        WHERE student.s_branch = f_allocation.f_branch AND 
        student.s_division = f_allocation.f_division AND
        student.s_year = f_allocation.f_year AND
        student.s_prn= '" . $_SESSION['s_prn'] . "'  AND 
        f_allocation.f_empid= faculty.f_empid1 and
        f_type='theory' AND 
        f_subject != '$dlo1[0]' 
   ";
        $result = $conn->query($sql);
      }
      // MECH
      if ($value_branch == $student_branch[4]) {
        $dlo = $student_dlo_TE[4];
        $key = array_search($value_to_delete_dlo, $dlo);
        if (($key) !== false) {
          #deleting the key found
          unset($dlo[$key]);
        }
        $dlo1 = array_values($dlo);

        $sql = "
            SELECT f_subject,f_name,f_empid1,f_year from f_allocation,student,faculty
            WHERE student.s_branch = f_allocation.f_branch AND 
            student.s_division = f_allocation.f_division AND
            student.s_year = f_allocation.f_year AND
            student.s_prn= '" . $_SESSION['s_prn'] . "'  AND 
            f_allocation.f_empid= faculty.f_empid1 and
            f_type='theory' AND 
            f_subject != '$dlo1[0]' 
       ";
        $result = $conn->query($sql);
      }

      if ($value_branch == $student_branch[5]) {
        $dlo = $student_dlo_TE[5];
        $key = array_search($value_to_delete_dlo, $dlo);
        if (($key) !== false) {
          #deleting the key found
          unset($dlo[$key]);
        }
        $dlo1 = array_values($dlo);

        $sql = "
        SELECT f_subject,f_name,f_empid1,f_year from f_allocation,student,faculty
        WHERE student.s_branch = f_allocation.f_branch AND 
        student.s_division = f_allocation.f_division AND
        student.s_year = f_allocation.f_year AND
        student.s_prn= '" . $_SESSION['s_prn'] . "'  AND 
        f_allocation.f_empid= faculty.f_empid1 and
        f_type='theory' AND 
        f_subject != '$dlo1[0]' 
";

        $result = $conn->query($sql);
      }
    }

    //////////////////////////////////////////////////BE//////////////////////////////////


    elseif ($value_year == $student_year[2]) {

      // DLOS OF ALL THE BRANCHES OF BE 
      $student_dlo1_BE = array(
        array('NLP', 'MV'),  // CE
        array('DL', 'CC'),   // EXTC
        array('IS', 'STQA'), // IT
        array('AFP', 'PDD'),  // PPT
        array('APS', 'RES')   // MECH
      );

      $student_dlo2_BE = array(
        array('BC ', 'IR'),  // CE
        array('ROBOTICS', 'ICE'),   // EXTC
        array('IRS'), // IT
        array(),  // PPT
        array('MD', 'AV')   // MECH
      );

      $student_ilo_BE = array(
        array('MIS', 'DMMM', 'CSL', 'PLM')

      );

      // GET THE DLO1 OF THE TE STUDENT
      $sql_dlo1 = "SELECT s_dlo1 from student where s_prn='" . $_SESSION['s_prn'] . "'";
      $result_dlo1 = $con->query($sql_dlo1);
      $dlo1 = mysqli_fetch_assoc($result_dlo1);
      $value_to_delete_dlo1 = $dlo1['s_dlo1'];
      //var_dump($value_to_delete_dlo1);


      // GET THE DLO2 OF THE TE STUDENT
      $sql_dlo2 = "SELECT s_dlo2 from student where s_prn='" . $_SESSION['s_prn'] . "'";
      $result_dlo2 = $con->query($sql_dlo2);
      $dlo2 = mysqli_fetch_assoc($result_dlo2);
      $value_to_delete_dlo2 = $dlo2['s_dlo2'];
      //var_dump($value_to_delete_dlo2);


      // GET THE DLO2 OF THE TE STUDENT
      $sql_ilo = "SELECT s_ilo from student where s_prn='" . $_SESSION['s_prn'] . "'";
      $result_ilo = $con->query($sql_ilo);
      $ilo = mysqli_fetch_assoc($result_ilo);
      $value_to_delete_ilo = $ilo['s_ilo'];
      // $value_to_delete_dlo2_lab = 'BLOCKCHAIN LAB';
      //var_dump($value_to_delete_ilo);



      // CE
      if ($value_branch == $student_branch[0]) {
        $dlo1 = $student_dlo1_BE[0];
        $dlo2 = $student_dlo2_BE[0];
        $ilo = $student_ilo_BE[0];


        $key1 = array_search($value_to_delete_dlo1, $dlo1);
        if (($key1) !== false) {
          #deleting the key found
          unset($dlo1[$key1]);
        }
        $dlo11 = array_values($dlo1);


        $key2 = array_search($value_to_delete_dlo2, $dlo2);
        if (($key2) !== false) {
          #deleting the key found
          unset($dlo2[$key2]);
        }
        $dlo12 = array_values($dlo2);


        $key3 = array_search($value_to_delete_ilo, $ilo);
        if (($key3) !== false) {
          #deleting the key found
          unset($ilo[$key3]);
        }
        $ilo1 = array_values($ilo);



        $sql = "
        SELECT f_subject,f_name,f_empid1,f_year from f_allocation,student,faculty
        WHERE student.s_branch = f_allocation.f_branch AND 
        student.s_division = f_allocation.f_division AND
        student.s_year = f_allocation.f_year AND
        student.s_prn= '" . $_SESSION['s_prn'] . "'  AND 
        f_allocation.f_empid= faculty.f_empid1 and
        f_type='theory' AND 
        f_subject != '$dlo11[0]' AND 
        f_subject != '$dlo12[0]' AND
        f_subject != '$ilo1[0]' AND
        f_subject != '$ilo1[1]' AND
        f_subject != '$ilo1[2]'  
";

        $result = $conn->query($sql);
      }
      // EXTC
      elseif ($value_branch == $student_branch[1]) {
        $dlo1 = $student_dlo1_BE[1];
        $dlo2 = $student_dlo2_BE[1];
        $key1 = array_search($value_to_delete_dlo1, $dlo1);
        if (($key1) !== false) {
          #deleting the key found
          unset($dlo1[$key1]);
        }
        $dlo11 = array_values($dlo1);


        $key2 = array_search($value_to_delete_dlo2, $dlo2);
        if (($key2) !== false) {
          #deleting the key found
          unset($dlo2[$key2]);
        }
        $dlo12 = array_values($dlo2);

        $sql = "
        SELECT f_subject,f_name,f_empid1,f_year from f_allocation,student,faculty
        WHERE student.s_branch = f_allocation.f_branch AND 
        student.s_division = f_allocation.f_division AND
        student.s_year = f_allocation.f_year AND
        student.s_prn= '" . $_SESSION['s_prn'] . "'  AND 
        f_allocation.f_empid= faculty.f_empid1 and
        f_type='theory' AND 
        f_subject != '$dlo11[0]' AND 
        f_subject != '$dlo12[0]'";

        $result = $conn->query($sql);
      }
      // IT
      if ($value_branch == $student_branch[2]) {
        $dlo1 = $student_dlo1_BE[2];
        $dlo2 = $student_dlo2_BE[2];
        $key1 = array_search($value_to_delete_dlo1, $dlo1);
        if (($key1) !== false) {
          #deleting the key found
          unset($dlo1[$key1]);
        }
        $dlo11 = array_values($dlo1);


        $key2 = array_search($value_to_delete_dlo2, $dlo2);
        if (($key2) !== false) {
          #deleting the key found
          unset($dlo2[$key2]);
        }
        $dlo12 = array_values($dlo2);

        $sql = "
        SELECT f_subject,f_name,f_empid1,f_year from f_allocation,student,faculty
        WHERE student.s_branch = f_allocation.f_branch AND 
        student.s_division = f_allocation.f_division AND
        student.s_year = f_allocation.f_year AND
        student.s_prn= '" . $_SESSION['s_prn'] . "'  AND 
        f_allocation.f_empid= faculty.f_empid1 and
        f_type='theory' AND 
        f_subject != '$dlo11[0]' AND 
        f_subject != '$dlo12[0]'";

        $result = $conn->query($sql);
      }
      // PPT
      if ($value_branch == $student_branch[3]) {
        $dlo1 = $student_dlo1_BE[3];
        $dlo2 = $student_dlo2_BE[3];
        $key1 = array_search($value_to_delete_dlo1, $dlo1);
        if (($key1) !== false) {
          #deleting the key found
          unset($dlo2[$key1]);
        }
        $dlo11 = array_values($dlo1);


        $key2 = array_search($value_to_delete_dlo2, $dlo2);
        if (($key2) !== false) {
          #deleting the key found
          unset($dlo1[$key2]);
        }
        $dlo12 = array_values($dlo2);

        $sql = "
        SELECT f_subject,f_name,f_empid1,f_year from f_allocation,student,faculty
        WHERE student.s_branch = f_allocation.f_branch AND 
        student.s_division = f_allocation.f_division AND
        student.s_year = f_allocation.f_year AND
        student.s_prn= '" . $_SESSION['s_prn'] . "'  AND 
        f_allocation.f_empid= faculty.f_empid1 and
        f_type='theory' AND 
        f_subject != '$dlo11[0]' AND 
        f_subject != '$dlo12[0]'";

        $result = $conn->query($sql);
      }
      // MECH
      if ($value_branch == $student_branch[4]) {
        $dlo1 = $student_dlo1_BE[4];
        $dlo2 = $student_dlo2_BE[4];
        $key1 = array_search($value_to_delete_dlo1, $dlo1);
        if (($key1) !== false) {
          #deleting the key found
          unset($dlo2[$key1]);
        }
        $dlo11 = array_values($dlo1);


        $key2 = array_search($value_to_delete_dlo2, $dlo2);
        if (($key2) !== false) {
          #deleting the key found
          unset($dlo1[$key2]);
        }
        $dlo12 = array_values($dlo2);

        $sql = "
        SELECT f_subject,f_name,f_empid1,f_year from f_allocation,student,faculty
        WHERE student.s_branch = f_allocation.f_branch AND 
        student.s_division = f_allocation.f_division AND
        student.s_year = f_allocation.f_year AND
        student.s_prn= '" . $_SESSION['s_prn'] . "'  AND 
        f_allocation.f_empid= faculty.f_empid1 and
        f_type='theory' AND 
        f_subject != '$dlo11[0]' AND 
        f_subject != '$dlo12[0]' 
     ";

        $result = $conn->query($sql);
      }
    }


    if ($result->num_rows > 0) {
      // output data of each row

      while ($row = $result->fetch_assoc()) {
        echo "<br> Teacher Name: " . $row["f_name"] . " - Subject: " . $row["f_subject"] . "<br>"; ?>

        <div id="hideform">
          <form method="POST" action="action.php" id="formsub">

            <input type=hidden type="text" class="form-control" id="s_prn" name="s_prn" value="<?php echo $_SESSION["s_prn"] ?>">
            <input type=hidden type="text" class="form-control" name="f_empid1" value=<?php echo '"' . $row["f_empid1"] . '"' ?>>
            <input type=hidden type="text" class="form-control" name="f_subject" value=<?php echo '"' . $row["f_subject"] . '"' ?>>
            <input type=hidden type="text" class="form-control" name="f_year" value=<?php echo '"' . $row["f_year"] . '"' ?>>

            <table class="table table-bordered" id="f1">
              <thead>
                <tr>
                  <th>Question</th>
                  <th>Strongly Disagree</th>
                  <th>Disagree</th>
                  <th>Neutral</th>
                  <th>Agree</th>
                  <th>Strongly Agree</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Teachers Subject Knowledge</td>
                  <td><input class="form-check-input" type="radio" value="1" name="q1" required="required"></td>
                  <td><input class="form-check-input" type="radio" value="2" name="q1"></td>
                  <td><input class="form-check-input" type="radio" value="3" name="q1"></td>
                  <td><input class="form-check-input" type="radio" value="4" name="q1"></td>
                  <td><input class="form-check-input" type="radio" value="5" name="q1"></td>
                </tr>
                <tr>
                  <td>Communication skills of the teacher</td>
                  <td><input class="form-check-input" type="radio" value="1" name="q2" required="required"></td>
                  <td><input class="form-check-input" type="radio" value="2" name="q2"></td>
                  <td><input class="form-check-input" type="radio" value="3" name="q2"></td>
                  <td><input class="form-check-input" type="radio" value="4" name="q2"></td>
                  <td><input class="form-check-input" type="radio" value="5" name="q2"></td>
                </tr>
                <tr>
                  <td>Ability to bring conceptual clarity and promotion of thinking ability</td>
                  <td><input class="form-check-input" type="radio" value="1" name="q3" required="required"></td>
                  <td><input class="form-check-input" type="radio" value="2" name="q3"></td>
                  <td><input class="form-check-input" type="radio" value="3" name="q3"></td>
                  <td><input class="form-check-input" type="radio" value="4" name="q3"></td>
                  <td><input class="form-check-input" type="radio" value="5" name="q3"></td>
                </tr>
                <tr>
                  <td>Teacher illustrates the concept through examples and applications</td>
                  <td><input class="form-check-input" type="radio" value="1" name="q4" required="required"></td>
                  <td><input class="form-check-input" type="radio" value="2" name="q4"></td>
                  <td><input class="form-check-input" type="radio" value="3" name="q4"></td>
                  <td><input class="form-check-input" type="radio" value="4" name="q4"></td>
                  <td><input class="form-check-input" type="radio" value="5" name="q4"></td>
                </tr>
                <tr>
                  <td>Use of appropriate online teaching methods</td>
                  <td><input class="form-check-input" type="radio" value="1" name="q5" required="required"></td>
                  <td><input class="form-check-input" type="radio" value="2" name="q5"></td>
                  <td><input class="form-check-input" type="radio" value="3" name="q5"></td>
                  <td><input class="form-check-input" type="radio" value="4" name="q5"></td>
                  <td><input class="form-check-input" type="radio" value="5" name="q5"></td>
                </tr>
                <tr>
                  <td>Ability to engage students during online lecture</td>
                  <td><input class="form-check-input" type="radio" value="1" name="q6" required="required"></td>
                  <td><input class="form-check-input" type="radio" value="2" name="q6"></td>
                  <td><input class="form-check-input" type="radio" value="3" name="q6"></td>
                  <td><input class="form-check-input" type="radio" value="4" name="q6"></td>
                  <td><input class="form-check-input" type="radio" value="5" name="q6"></td>
                </tr>
                <tr>
                  <td>Fairness in internal evaluation</td>
                  <td><input class="form-check-input" type="radio" value="1" name="q7" required="required"></td>
                  <td><input class="form-check-input" type="radio" value="2" name="q7"></td>
                  <td><input class="form-check-input" type="radio" value="3" name="q7"></td>
                  <td><input class="form-check-input" type="radio" value="4" name="q7"></td>
                  <td><input class="form-check-input" type="radio" value="5" name="q7"></td>
                </tr>
              </tbody>
            </table>
            <?php
            $sqlt = "SELECT s_prn,f_empid1,f_subject FROM feedback where s_prn = '" . $_SESSION['s_prn'] . "'and f_empid1 = '" . $row["f_empid1"] . "'and f_subject='" . $row["f_subject"] . "'";
            $result1 = $conn->query($sqlt);
            if ($result1->num_rows > 0) {
              // output data of each row
              echo '<span style="color:green;border: 1px solid green;padding: 5px;font-size: 20px;">Response Noted!</span>';
            } else {
              echo '<span style="color:red;border: 1px solid red;padding: 5px;font-size: 20px;">Response Remaining!</span>';
            }
            ?>
            <div class="form-group mb-3 text-center">
              <button type="submit" id="btSubmit" name="add_feedback" class="btn btn-primary">Submit</button>
            </div>
          </form>

        </div>

        <?php
        $sqltt = "SELECT q1 FROM feedback where s_prn = '" . $_SESSION['s_prn'] . "'and f_empid1 = '" . $row["f_empid1"] . "'and f_subject='" . $row["f_subject"] . "'";
        $result11 = $conn->query($sqlt);
        if ($result11->num_rows > 0) {
        ?>
          <script type="text/javascript">
            $('#btSubmit').hide()
          </script>
    <?php

        }
      }
    } else {
      echo "0 results";
    }

    $conn->close();
    ?>

  </div>
  <h3 style="text-align:center">Lab</h3>
  <div class="container">
    <?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $databaseName = "id19456629_database";

    // Create connection
    $conn = new mysqli($hostname, $username, $password, $databaseName);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    if ($value_year == $student_year[0]) {
      $sql = "
        SELECT f_subject,f_name,f_empid1,f_year from f_allocation,student,faculty
        WHERE student.s_branch = f_allocation.f_branch AND 
	      student.s_division = f_allocation.f_division AND
        student.s_year = f_allocation.f_year AND
        student.s_prn= '" . $_SESSION['s_prn'] . "'  AND 
        student.s_batch = f_allocation.f_batch and
        f_allocation.f_empid= faculty.f_empid1 and
        f_type='LAB';
";
      $result = $conn->query($sql);
    } elseif ($value_year == $student_year[1]) {
      $sql = "
      SELECT f_subject,f_name,f_empid1,f_year from f_allocation,student,faculty
      WHERE student.s_branch = f_allocation.f_branch AND 
      student.s_division = f_allocation.f_division AND
      student.s_year = f_allocation.f_year AND
      student.s_prn= '" . $_SESSION['s_prn'] . "'  AND 
      student.s_batch = f_allocation.f_batch and
      f_allocation.f_empid= faculty.f_empid1 and
      f_type='LAB';
";
      $result = $conn->query($sql);
    }

    ///////////////////////BE/////////////////////////////////////



    elseif ($value_year == $student_year[2]) {

      $student_dlo1_BE_lab = array(
        array('NLP LAB', 'MV LAB'),  // CE
        array('DL', 'CC'),   // EXTC
        array('IS', 'STQA'), // IT
        array('AFP', 'PDD'),  // PPT
        array('APS', 'RES')   // MECH
      );

      $student_dlo2_BE_lab = array(
        array('IR LAB', 'BC LAB'),  // CE
        array('ROBOTICS', 'ICE'),   // EXTC
        array('IRS'), // IT
        array(),  // PPT
        array('MD', 'AV')   // MECH
      );



      // GET THE DLO1 OF THE TE STUDENT
      $sql_dlo1_lab = "SELECT s_dlo1_lab from student where s_prn='" . $_SESSION['s_prn'] . "'";
      $result_dlo1_lab = $con->query($sql_dlo1_lab);
      $dlo1_lab = mysqli_fetch_assoc($result_dlo1_lab);
      $value_to_delete_dlo1_lab = $dlo1_lab['s_dlo1_lab'];
      // $value_to_delete_dlo1_lab = 'MV LAB';
      //var_dump($value_to_delete_dlo1_lab);


      // GET THE DLO2 OF THE TE STUDENT
      $sql_dlo2_lab = "SELECT s_dlo2_lab from student where s_prn='" . $_SESSION['s_prn'] . "'";
      $result_dlo2_lab = $con->query($sql_dlo2_lab);
      $dlo2_lab = mysqli_fetch_assoc($result_dlo2_lab);
      $value_to_delete_dlo2_lab = $dlo2_lab['s_dlo2_lab'];
      // $value_to_delete_dlo2_lab = 'BLOCKCHAIN LAB';
      //var_dump($value_to_delete_dlo2_lab);

      // CE
      if ($value_branch == $student_branch[0]) {
        $dlo1_lab = $student_dlo1_BE_lab[0];
        $dlo2_lab = $student_dlo2_BE_lab[0];
        //echo "Hello";
        //var_dump($dlo2_lab);
        $key1_lab = array_search($value_to_delete_dlo1_lab, $dlo1_lab);
        if (($key1_lab) !== false) {
          #deleting the key found
          unset($dlo1_lab[$key1_lab]);
        }
        $dlo11_lab = array_values($dlo1_lab);



        $key2_lab = array_search($value_to_delete_dlo2_lab, $dlo2_lab);
        if (($key2_lab) !== false) {
          #deleting the key found
          unset($dlo2_lab[$key2_lab]);
        }
        $dlo12_lab = array_values($dlo2_lab);
        //echo "World";
        //var_dump($dlo12_lab);

        $sql = "
        SELECT f_subject,f_name,f_empid1,f_year, f_type from f_allocation,student,faculty
        WHERE student.s_branch = f_allocation.f_branch AND 
        student.s_division = f_allocation.f_division AND
        student.s_year = f_allocation.f_year AND
        student.s_prn= '" . $_SESSION['s_prn'] . "'  AND 
        student.s_batch = f_allocation.f_batch AND
        f_allocation.f_empid= faculty.f_empid1 and
        f_type='LAB' AND
        f_subject != '$dlo11_lab[0]' AND 
        f_subject != '$dlo12_lab[0]'
";

        $result = $conn->query($sql);
      }
      // EXTC
      //   elseif ($value_branch == $student_branch[1]) {
      //     $dlo1 = $student_dlo1_BE[1];
      //     $dlo2 = $student_dlo2_BE[1];
      //     $key1 = array_search($value_to_delete_dlo1, $dlo1);
      //     if (($key1) !== false) {
      //       #deleting the key found
      //       unset($dlo1[$key1]);
      //     }
      //     $dlo11 = array_values($dlo1);


      //     $key2 = array_search($value_to_delete_dlo2, $dlo2);
      //     if (($key2) !== false) {
      //       #deleting the key found
      //       unset($dlo2[$key2]);
      //     }
      //     $dlo12 = array_values($dlo2);

      //     $sql = "
      //     SELECT f_subject,f_name,f_empid1,f_year from f_allocation,student,faculty
      //     WHERE student.s_branch = f_allocation.f_branch AND 
      //     student.s_division = f_allocation.f_division AND
      //     student.s_year = f_allocation.f_year AND
      //     student.s_prn= '" . $_SESSION['s_prn'] . "'  AND 
      //     student.s_batch = f_allocation.f_batch AND
      //     f_allocation.f_empid= faculty.f_empid1 and
      //     f_type='LAB' AND
      //     f_subject != '$dlo11[0]' AND 
      //     f_subject != '$dlo12[0]'";

      //     $result = $conn->query($sql);
      //   }
      //   // IT
      //   elseif ($value_branch == $student_branch[2]) {
      //     $dlo1 = $student_dlo1_BE[2];
      //     $dlo2 = $student_dlo2_BE[2];
      //     $key1 = array_search($value_to_delete_dlo1, $dlo1);
      //     if (($key1) !== false) {
      //       #deleting the key found
      //       unset($dlo1[$key1]);
      //     }
      //     $dlo11 = array_values($dlo1);


      //     $key2 = array_search($value_to_delete_dlo2, $dlo2);
      //     if (($key2) !== false) {
      //       #deleting the key found
      //       unset($dlo2[$key2]);
      //     }
      //     $dlo12 = array_values($dlo2);

      //     $sql = "
      //     SELECT f_subject,f_name,f_empid1,f_year from f_allocation,student,faculty
      //     WHERE student.s_branch = f_allocation.f_branch AND 
      //     student.s_division = f_allocation.f_division AND
      //     student.s_year = f_allocation.f_year AND
      //     student.s_prn= '" . $_SESSION['s_prn'] . "'  AND 
      //     student.s_batch = f_allocation.f_batch AND
      //     f_allocation.f_empid= faculty.f_empid1 and
      //     f_type='LAB' AND
      //     f_subject != '$dlo11[0]' AND 
      //     f_subject != '$dlo12[0]'";

      //     $result = $conn->query($sql);
      //   }
      //   // PPT
      //   elseif ($value_branch == $student_branch[3]) {
      //     $dlo1 = $student_dlo1_BE[3];
      //     $dlo2 = $student_dlo2_BE[3];
      //     $key1 = array_search($value_to_delete_dlo1, $dlo1);
      //     if (($key1) !== false) {
      //       #deleting the key found
      //       unset($dlo2[$key1]);
      //     }
      //     $dlo11 = array_values($dlo1);


      //     $key2 = array_search($value_to_delete_dlo2, $dlo2);
      //     if (($key2) !== false) {
      //       #deleting the key found
      //       unset($dlo1[$key2]);
      //     }
      //     $dlo12 = array_values($dlo2);

      //     $sql = "
      //     SELECT f_subject,f_name,f_empid1,f_year from f_allocation,student,faculty
      //     WHERE student.s_branch = f_allocation.f_branch AND 
      //     student.s_division = f_allocation.f_division AND
      //     student.s_year = f_allocation.f_year AND
      //     student.s_prn= '" . $_SESSION['s_prn'] . "'  AND 
      //     student.s_batch = f_allocation.f_batch AND
      //     f_allocation.f_empid= faculty.f_empid1 and
      //     f_type='LAB' AND
      //     f_subject != '$dlo11[0]' AND 
      //     f_subject != '$dlo12[0]'";

      //     $result = $conn->query($sql);
      //   }
      //   // MECH
      //   elseif ($value_branch == $student_branch[4]) {
      //     $dlo1 = $student_dlo1_BE[4];
      //     $dlo2 = $student_dlo2_BE[4];
      //     $key1 = array_search($value_to_delete_dlo1, $dlo1);
      //     if (($key1) !== false) {
      //       #deleting the key found
      //       unset($dlo2[$key1]);
      //     }
      //     $dlo11 = array_values($dlo1);


      //     $key2 = array_search($value_to_delete_dlo2, $dlo2);
      //     if (($key2) !== false) {
      //       #deleting the key found
      //       unset($dlo1[$key2]);
      //     }
      //     $dlo12 = array_values($dlo2);

      //     $sql = "
      //     SELECT f_subject,f_name,f_empid1,f_year from f_allocation,student,faculty
      //     WHERE student.s_branch = f_allocation.f_branch AND 
      //     student.s_division = f_allocation.f_division AND
      //     student.s_year = f_allocation.f_year AND
      //     student.s_prn= '" . $_SESSION['s_prn'] . "'  AND 
      //     student.s_batch = f_allocation.f_batch AND
      //     f_allocation.f_empid= faculty.f_empid1 and
      //     f_type='LAB' AND
      //     f_subject != '$dlo11[0]' AND 
      //     f_subject != '$dlo12[0]' 
      //  ";

      //     $result = $conn->query($sql);
      //   }
      else {
        $sql = "
      SELECT f_subject,f_name,f_empid1,f_year from f_allocation,student,faculty
      WHERE student.s_branch = f_allocation.f_branch AND 
      student.s_division = f_allocation.f_division AND
      student.s_year = f_allocation.f_year AND
      student.s_prn= '" . $_SESSION['s_prn'] . "'  AND 
      student.s_batch = f_allocation.f_batch and
      f_allocation.f_empid= faculty.f_empid1 and
      f_type='LAB';
";
        $result = $conn->query($sql);
      }
    }

    if ($result->num_rows > 0) {
      // output data of each row

      while ($row = $result->fetch_assoc()) {
        echo "<br> Teacher Name: " . $row["f_name"] . " - Subject: " . $row["f_subject"]  . " <br>"; ?>


        <form method="POST" action="action.php">

          <input type=hidden type="text" class="form-control" id="s_prn" name="s_prn" value="<?php echo $_SESSION["s_prn"] ?>">
          <input type=hidden type="text" class="form-control" name="f_empid1" value=<?php echo '"' . $row["f_empid1"] . '"' ?>>
          <input type=hidden type="text" class="form-control" name="f_subject" value=<?php echo '"' . $row["f_subject"] . '"' ?>>
          <input type=hidden type="text" class="form-control" name="f_year" value=<?php echo '"' . $row["f_year"] . '"' ?>>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Question(Lab)</th>
                <th>Strongly Disagree</th>
                <th>Disagree</th>
                <th>Nutral</th>
                <th>Agree</th>
                <th>Strongly Agree</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Teachers Subject Knowledge</td>
                <td><input class="form-check-input" type="radio" value="1" name="q1" required="required"></td>
                <td><input class="form-check-input" type="radio" value="2" name="q1"></td>
                <td><input class="form-check-input" type="radio" value="3" name="q1"></td>
                <td><input class="form-check-input" type="radio" value="4" name="q1"></td>
                <td><input class="form-check-input" type="radio" value="5" name="q1"></td>
              </tr>
              <tr>
                <td>Communication skills of the teacher</td>
                <td><input class="form-check-input" type="radio" value="1" name="q2" required="required"></td>
                <td><input class="form-check-input" type="radio" value="2" name="q2"></td>
                <td><input class="form-check-input" type="radio" value="3" name="q2"></td>
                <td><input class="form-check-input" type="radio" value="4" name="q2"></td>
                <td><input class="form-check-input" type="radio" value="5" name="q2"></td>
              </tr>
              <tr>
                <td>Ability to bring conceptual clarity and promotion of thinking ability</td>
                <td><input class="form-check-input" type="radio" value="1" name="q3" required="required"></td>
                <td><input class="form-check-input" type="radio" value="2" name="q3"></td>
                <td><input class="form-check-input" type="radio" value="3" name="q3"></td>
                <td><input class="form-check-input" type="radio" value="4" name="q3"></td>
                <td><input class="form-check-input" type="radio" value="5" name="q3"></td>
              </tr>
              <tr>
                <td>Teacher illustrates the concept through examples and applications</td>
                <td><input class="form-check-input" type="radio" value="1" name="q4" required="required"></td>
                <td><input class="form-check-input" type="radio" value="2" name="q4"></td>
                <td><input class="form-check-input" type="radio" value="3" name="q4"></td>
                <td><input class="form-check-input" type="radio" value="4" name="q4"></td>
                <td><input class="form-check-input" type="radio" value="5" name="q4"></td>
              </tr>
              <tr>
                <td>Use of appropriate online teaching methods</td>
                <td><input class="form-check-input" type="radio" value="1" name="q5" required="required"></td>
                <td><input class="form-check-input" type="radio" value="2" name="q5"></td>
                <td><input class="form-check-input" type="radio" value="3" name="q5"></td>
                <td><input class="form-check-input" type="radio" value="4" name="q5"></td>
                <td><input class="form-check-input" type="radio" value="5" name="q5"></td>
              </tr>
              <tr>
                <td>Ability to engage students during online lecture.</td>
                <td><input class="form-check-input" type="radio" value="1" name="q6" required="required"></td>
                <td><input class="form-check-input" type="radio" value="2" name="q6"></td>
                <td><input class="form-check-input" type="radio" value="3" name="q6"></td>
                <td><input class="form-check-input" type="radio" value="4" name="q6"></td>
                <td><input class="form-check-input" type="radio" value="5" name="q6"></td>
              </tr>
              <tr>
                <td>Fairness in internal evaluation</td>
                <td><input class="form-check-input" type="radio" value="1" name="q7" required="required"></td>
                <td><input class="form-check-input" type="radio" value="2" name="q7"></td>
                <td><input class="form-check-input" type="radio" value="3" name="q7"></td>
                <td><input class="form-check-input" type="radio" value="4" name="q7"></td>
                <td><input class="form-check-input" type="radio" value="5" name="q7"></td>
              </tr>
            </tbody>
          </table>
          <?php
          $sqlt = "SELECT s_prn,f_empid1,f_subject FROM feedback where s_prn = '" . $_SESSION['s_prn'] . "'and f_empid1 = '" . $row["f_empid1"] . "'and f_subject='" . $row["f_subject"] . "' ";
          $result1 = $conn->query($sqlt);
          if ($result1->num_rows > 0) {
            // output data of each row
            echo '<span style="color:green;border: 1px solid green;padding: 5px;font-size: 20px;">Response Noted!</span>';
          } else {
            echo '<span style="color:red;border: 1px solid red;padding: 5px;font-size: 20px;">Response Remaining!</span>';
          }
          ?>

        </form>

        <div class="form-group mb-3 text-center">
          <button type="submit" id="btSubmit" name="add_feedback" class="btn btn-primary">Submit</button>
        </div>
    <?php
      }
    } else {
      echo "0 results";
    }

    $conn->close();
    ?>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>