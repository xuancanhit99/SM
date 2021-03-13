<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');
if (strlen($_SESSION['alogin']) == 0) {
    header("Location: index.php");
} else {
    $stid = intval($_GET['stid']);
    if (isset($_POST['submit'])) {
        $studentname = $_POST['fullanme'];
        $studentno = $_POST['studentno'];
        $studentemail = $_POST['emailid'];
        $gender = $_POST['gender'];
        $classid = $_POST['class'];
        $dob = $_POST['dob'];
        $status = $_POST['status'];
        $sql = "update students set StudentName=:studentname,StudentNo=:studentno,StudentEmail=:studentemail,Gender=:gender,DOB=:dob,Status=:status where StudentID=:stid ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':studentname', $studentname, PDO::PARAM_STR);
        $query->bindParam(':studentno', $studentno, PDO::PARAM_STR);
        $query->bindParam(':studentemail', $studentemail, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':dob', $dob, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':stid', $stid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Student info updated successfully";
    }

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="University">
        <meta name="author" content="Xuan Canh">
        <title>SM Admin| Edit Student < </title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" href="css/main.css" media="screen">
        <script src="https://kit.fontawesome.com/e427de2876.js" crossorigin=""></script>
    </head>
    <body class="top-navbar-fixed">
    <div class="main-wrapper">
        <?php include('includes/topbar.php'); ?>
        <div class="content-wrapper">
            <div class="content-container">
                <?php include('includes/leftbar.php'); ?>
                <div class="main-page">
                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">Student Admission</h2>
                            </div>
                        </div>
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li class="active">Student Admission</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h5>Fill the Student info</h5>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <?php if ($msg) { ?>
                                            <div class="alert alert-success left-icon-alert" role="alert">
                                            <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                                            </div><?php } else if ($error) { ?>
                                            <div class="alert alert-danger left-icon-alert" role="alert">
                                                <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                            </div>
                                        <?php } ?>
                                        <form class="form-horizontal" method="post">
                                            <?php
                                            $sql = "SELECT students.StudentName,students.StudentNo,students.RegDate,students.StudentID,students.Status,students.StudentEmail,students.Gender,students.DOB,classes.ClassName,classes.ClassNumber,classes.ClassYear from students join classes on classes.id=students.ClassID where students.StudentID=:stid";
                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':stid', $stid, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) { ?>
                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Full Name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="fullanme" class="form-control"
                                                                   id="fullanme"
                                                                   value="<?php echo htmlentities($result->StudentName) ?>"
                                                                   required="required" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Student ID</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="studentno" class="form-control"
                                                                   id="studentno"
                                                                   value="<?php echo htmlentities($result->StudentNo) ?>"
                                                                   maxlength="5" required="required" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Email
                                                            id)</label>
                                                        <div class="col-sm-10">
                                                            <input type="email" name="emailid" class="form-control"
                                                                   id="email"
                                                                   value="<?php echo htmlentities($result->StudentEmail) ?>"
                                                                   required="required" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="default"
                                                               class="col-sm-2 control-label">Gender</label>
                                                        <div class="col-sm-10">
                                                            <?php $gndr = $result->Gender;
                                                            if ($gndr == "Male") {
                                                                ?>
                                                                <input type="radio" name="gender" value="Male"
                                                                       required="required" checked>Male <input
                                                                        type="radio" name="gender" value="Female"
                                                                        required="required">Female <input type="radio"
                                                                                                          name="gender"
                                                                                                          value="Other"
                                                                                                          required="required">Other
                                                            <?php } ?>
                                                            <?php
                                                            if ($gndr == "Female") {
                                                                ?>
                                                                <input type="radio" name="gender" value="Male"
                                                                       required="required">Male <input type="radio"
                                                                                                       name="gender"
                                                                                                       value="Female"
                                                                                                       required="required"
                                                                                                       checked>Female
                                                                <input type="radio" name="gender" value="Other"
                                                                       required="required">Other
                                                            <?php } ?>
                                                            <?php
                                                            if ($gndr == "Other") {
                                                                ?>
                                                                <input type="radio" name="gender" value="Male"
                                                                       required="required">Male <input type="radio"
                                                                                                       name="gender"
                                                                                                       value="Female"
                                                                                                       required="required">Female
                                                                <input type="radio" name="gender" value="Other"
                                                                       required="required" checked>Other
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="default"
                                                               class="col-sm-2 control-label">Class</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="classname" class="form-control"
                                                                   id="classname"
                                                                   value="<?php echo htmlentities($result->ClassName) ?>-<?php echo htmlentities($result->ClassNumber) ?>-<?php echo htmlentities($result->ClassYear) ?>"
                                                                   readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="date" class="col-sm-2 control-label">DOB</label>
                                                        <div class="col-sm-10">
                                                            <input type="date" name="dob" class="form-control"
                                                                   value="<?php echo htmlentities($result->DOB) ?>"
                                                                   id="date">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Reg
                                                            Date: </label>
                                                        <div class="col-sm-10">
                                                            <?php echo htmlentities($result->RegDate) ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="default"
                                                               class="col-sm-2 control-label">Status</label>
                                                        <div class="col-sm-10">
                                                            <?php $stats = $result->Status;
                                                            if ($stats == "1") {
                                                                ?>
                                                                <input type="radio" name="status" value="1"
                                                                       required="required" checked>Active <input
                                                                        type="radio" name="status" value="0"
                                                                        required="required">Block
                                                            <?php } ?>
                                                            <?php
                                                            if ($stats == "0") {
                                                                ?>
                                                                <input type="radio" name="status" value="1"
                                                                       required="required">Active <input type="radio"
                                                                                                         name="status"
                                                                                                         value="0"
                                                                                                         required="required"
                                                                                                         checked>Block
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                <?php }
                                            } ?>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" name="submit" class="btn btn-warning">Update
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/main.js"></script>
    </body>
    <div class="foot">
        <footer>
            <?php include('includes/footer.php'); ?>
        </footer>
    </div>
    <style> .foot {
            text-align: center;
            */
        }</style>
    </html>
<?PHP } ?>
