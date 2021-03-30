<?php
session_start();
error_reporting(0);
include 'includes/db_connection.php';
global $dbh;
if (!isset($_SESSION["email"])) {
    header('location: ../index.php');
} else {
    if ((Boolean) $_SESSION["isStudent"]) {
        header('location: ../index.php');
    } else if ((Boolean) $_SESSION["isEditor"]) {
        header('location: ../index.php');
    } else {
        if (isset($_POST['submit'])) {
            $marks = array();
            $class = $_POST['class'];
            $studentid = $_POST['studentid'];
            $mark = $_POST['marks'];
            $stmt = $dbh->prepare("Select subjects.SubjectName,subjects.id FROM subjectcombination join subjects on subjects.id=subjectcombination.SubjectID WHERE subjectcombination.ClassID=:cid order by subjects.SubjectName");
            $stmt->execute(array(':cid' => $class));
            $sid1 = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                array_push($sid1, $row['id']);
            }
            for ($i = 0; $i < count($mark); $i++) {
                $mar = $mark[$i];
                $sid = $sid1[$i];
                $sql = "Insert into results(StudentID,ClassID,SubjectID,Marks) VALUES(:studentid,:class,:sid,:marks)";
                $query = $dbh->prepare($sql);
                $query->bindParam(':studentid', $studentid, PDO::PARAM_STR);
                $query->bindParam(':class', $class, PDO::PARAM_STR);
                $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                $query->bindParam(':marks', $mar, PDO::PARAM_STR);
                $query->execute();
                $lastInsertId = $dbh->lastInsertId();
                if ($lastInsertId) {
                    $msg = "Result info added successfully";
                } else {
                    $error = "Something went wrong. Please try again";
                }
            }
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
        <link rel="shortcut icon" href="../images/logo/mirea.ico">

        <title>SM Admin| Add Result </title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" href="css/main.css" media="screen">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;1,100;1,500;1,600&family=Rajdhani:wght@500&display=swap" rel="stylesheet">

        <script src="https://kit.fontawesome.com/e427de2876.js" crossorigin=""></script>
        <script>
            function getStudent(val) {
                $.ajax({
                    type: "POST",
                    url: "get_student.php",
                    data: 'classid=' + val,
                    success: function (data) {
                        $("#studentid").html(data);

                    }
                });
                $.ajax({
                    type: "POST",
                    url: "get_student.php",
                    data: 'classid1=' + val,
                    success: function (data) {
                        $("#subject").html(data);

                    }
                });
            }
        </script>
        <script>
            function getresult(val, clid) {
                var clid = $(".clid").val();
                var val = $(".stid").val();
                var abh = clid + '$' + val;
                $.ajax({
                    type: "POST",
                    url: "get_student.php",
                    data: 'studclass=' + abh,
                    success: function (data) {
                        $("#reslt").html(data);

                    }
                });
            }
        </script>
    </head>
    <body class="top-navbar-fixed" style="font-family: 'Montserrat', sans-serif;">
    <div class="main-wrapper">
        <?php include 'includes/topbar.php';?>
        <div class="content-wrapper">
            <div class="content-container">
                <?php include 'includes/leftbar.php';?>
                <div class="main-page">
                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">Declare Result</h2>
                            </div>
                        </div>
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li class="active">Student Result</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-body">
                                        <?php if ($msg) {?>
                                            <div class="alert alert-success left-icon-alert" role="alert">
                                            <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                                            </div><?php } else if ($error) {?>
                                            <div class="alert alert-danger left-icon-alert" role="alert">
                                                <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                            </div>
                                        <?php }?>
                                        <form class="form-horizontal" method="post">
                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Class</label>
                                                <div class="col-sm-10">
                                                    <select name="class" class="form-control clid" id="classid"
                                                            onChange="getStudent(this.value);" required="required">
                                                        <option value="">Select Class</option>
                                                        <?php $sql = "SELECT * from classes";
        $query = $dbh->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            foreach ($results as $result) {?>
                                                                <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->ClassName); ?>-<?php echo htmlentities($result->ClassNumber); ?>-<?php echo htmlentities($result->ClassYear); ?></option>
                                                            <?php }
        }?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="date" class="col-sm-2 control-label ">Student Name</label>
                                                <div class="col-sm-10">
                                                    <select name="studentid" class="form-control stid" id="studentid"
                                                            required="required" onChange="getresult(this.value);">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-10">
                                                    <div id="reslt">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="date" class="col-sm-2 control-label">Subjects</label>
                                                <div class="col-sm-10">
                                                    <div id="subject">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" name="submit" id="submit"
                                                            class="btn btn-primary">Declare Result
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
            <?php include 'includes/footer.php';?>
        </footer>
    </div>
    <style> .foot {
            text-align: center;
            */
        }</style>
    </html>
<?PHP }
}?>
