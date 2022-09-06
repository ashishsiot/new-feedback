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
    <!--/navbar-->

    <div class="container ">
        <div class="d-flex flex-row   justify-content-around form-outline mb-4">
            <div class="p-1">
                <label class="form-label float-left">Emp Name:
                    <?php
                    $sql = "SELECT f_name from faculty where f_eduid='" . $_SESSION['f_eduid'] . "'";
                    $result = $con->query($sql);
                    while ($row = mysqli_fetch_array($result)) {
                        echo "" . $row['f_name'];
                    }
                    ?>
                </label>
            </div>
            <div class="p-1">
                <label class="form-label float-left">Emp id:
                    <?php
                    $sql = "SELECT f_empid1 from faculty where f_eduid='" . $_SESSION['f_eduid'] . "'";
                    $result = $con->query($sql);
                    while ($row = mysqli_fetch_array($result)) {
                        echo "" . $row['f_empid1'];
                    }
                    ?>
                </label>
            </div>
            <div class="p-1">
                <label class="form-label float-left">Edu id:
                    <?php
                    $sql = "SELECT f_eduid from faculty where f_eduid='" . $_SESSION['f_eduid'] . "'";
                    $result = $con->query($sql);
                    while ($row = mysqli_fetch_array($result)) {
                        echo "" . $row['f_eduid'];
                    }
                    ?>
                </label>
            </div>
        </div>
    </div>

    <div class="container ">
        <div class="d-flex justify-content-center">
            <div class="col-md-12 justify-content-center mt-4">
                <div class="card">
                    <div class="card-body">
                        <form action="action.php" method="POST" autocomplete="off">

                            <div class="container ">
                                <input type="text" name="f_empid1" required class="form-control" value="<?php echo $_SESSION["f_empid1"] ?>" hidden>
                            </div>
                            <!--xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx-->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            Branch
                                        </th>
                                        <th class="text-center">
                                            Year
                                        </th>
                                        <th class="text-center">
                                            Semester
                                        </th>
                                        <th class="text-center">
                                            Div
                                        </th>
                                        <th class="text-center">
                                            Type
                                        </th>
                                        <th class="text-center">
                                            Subject
                                        </th>
                                        <th class="text-center">
                                            Batch
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="sel1" id="sel1">
                                                <option value="">Select Option</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="sel5" id="sel5">
                                                <option value="">Select Option</option>
                                                <option value="FE">FE</option>
                                                <option value="SE">SE</option>
                                                <option value="TE">TE</option>
                                                <option value="BE">BE</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="sel2" id="sel2">
                                                <option value="">Select Option</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="sel4" id="sel4">
                                                <option value="">Select Option</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="B AIML">B AIML</option>
                                                <option value="B IOT">B IOT</option>
                                                <option value="B AIDS">B AIDS</option>
                                                <option value="E">E</option>
                                                <option value="F">F</option>
                                                <option value="G">G</option>
                                                <option value="H">H</option>
                                                <option value="I">I</option>
                                                <option value="J">J</option>
                                                <option value="K">K</option>
                                                <option value="L">L</option>
                                                <option value="M">M</option>
                                                <option value="N">N</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="sel6" id="sel6" onchange="check()">
                                                <option value="">Select Option</option>
                                                <option value="Theory">Theory</option>
                                                <option value="LAB">Lab</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="sel3" id="sel3">
                                                <option value="">Select Option</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="sel7" id="sel7">
                                                <option value="">Select Option</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group mb-3 text-center">
                                <button type="submit" id="btSubmit" name="add_data" class="btn btn-primary">Save Event</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Allocation</h4>
                    </div>
                    <div class="card-body">
                        <h5>Theory Subject Allocation</h5>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        Branch
                                    </th>
                                    <th class="text-center">
                                        Year
                                    </th>
                                    <th class="text-center">
                                        Semester
                                    </th>
                                    <th class="text-center">
                                        Div
                                    </th>
                                    <th class="text-center">
                                        Type
                                    </th>
                                    <th class="text-center">
                                        Subject
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'dbcon.php';
                                $query = "SELECT * FROM `f_allocation` WHERE f_empid='" . $_SESSION['f_empid1'] . "' and f_type='theory'";
                                // Fetch all the data from the table customers
                                $result = mysqli_query($con, $query); ?>
                                <?php if ($result->num_rows > 0) : ?>
                                    <?php while ($array = mysqli_fetch_row($result)) : ?>
                                        <tr>
                                            <td><?php echo $array[2]; ?></td>
                                            <td><?php echo $array[3]; ?></td>
                                            <td><?php echo $array[4]; ?></td>
                                            <td><?php echo $array[5]; ?></td>
                                            <td><?php echo $array[6]; ?></td>
                                            <td><?php echo $array[7]; ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="3" rowspan="1" headers="">No Data Found</td>
                                    </tr>
                                <?php endif; ?>
                                <?php mysqli_free_result($result); ?>
                            </tbody>
                        </table>

                        <h5>Lab Allocation</h5>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        Branch
                                    </th>
                                    <th class="text-center">
                                        Year
                                    </th>
                                    <th class="text-center">
                                        Semester
                                    </th>
                                    <th class="text-center">
                                        Div
                                    </th>
                                    <th class="text-center">
                                        Type
                                    </th>
                                    <th class="text-center">
                                        Subject
                                    </th>
                                    <th class="text-center">
                                        Batch
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'dbcon.php';
                                $query = "SELECT * FROM `f_allocation` WHERE f_empid='" . $_SESSION['f_empid1'] . "' and f_type='lab'";
                                // Fetch all the data from the table customers
                                $result = mysqli_query($con, $query); ?>
                                <?php if ($result->num_rows > 0) : ?>
                                    <?php while ($array = mysqli_fetch_row($result)) : ?>
                                        <tr>
                                            <td><?php echo $array[2]; ?></td>
                                            <td><?php echo $array[3]; ?></td>
                                            <td><?php echo $array[4]; ?></td>
                                            <td><?php echo $array[5]; ?></td>
                                            <td><?php echo $array[6]; ?></td>
                                            <td><?php echo $array[7]; ?></td>
                                            <td><?php echo $array[8]; ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="3" rowspan="1" headers="">No Data Found</td>
                                    </tr>
                                <?php endif; ?>
                                <?php mysqli_free_result($result); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src=script.js></script>
</body>

</html>