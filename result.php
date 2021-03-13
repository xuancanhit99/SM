<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');
global $dbh;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="University">
    <meta name="author" content="Xuan Canh">
    <title>Student Management</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="css/main.css" media="screen">
    <script src="https://kit.fontawesome.com/e427de2876.js" crossorigin=""></script>
</head>
<body>
<div class="main-wrapper">
    <div class="content-wrapper">
        <div class="content-container">
            <div class="main-page">
                <div class="container-fluid">
                    <div class="row page-title-div">
                        <div class="col-md-12">
                            <h2 class="title" align="center">Result Management System</h2>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <?php
                                            $studentno = $_POST['studentno'];
                                            $classid = $_POST['class'];
                                            $_SESSION['studentno'] = $studentno;
                                            $_SESSION['classid'] = $classid;
                                            $qery = "Select students.StudentName, students.StudentNo, students.RegDate, students.StudentID, students.Status, classes.ClassName, classes.ClassNumber, classes.ClassYear from students join classes on classes.id=students.ClassID where students.StudentNo=:studentno and students.ClassID=:classid ";
                                            $stmt = $dbh->prepare($qery);
                                            $stmt->bindParam(':studentno', $studentno, PDO::PARAM_STR);
                                            $stmt->bindParam(':classid', $classid, PDO::PARAM_STR);
                                            $stmt->execute();
                                            $resultss = $stmt->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($stmt->rowCount() > 0)
                                            {
                                            foreach ($resultss as $row)
                                            { ?>
                                        </div>
                                        <div class="panel-body p-20">
                                            <table class="table table-hover table-bordered" id="dataTable" width="100%"
                                                   border="1" cellpadding="3">
                                                <thead>
                                                <tr>
                                                    <th><b>Student Name
                                                            :</b> <?php echo htmlentities($row->StudentName); ?></th>
                                                    <th><b>Student ID :</b> <?php echo htmlentities($row->StudentNo); ?>
                                                    </th>
                                                    <th><b>Student
                                                            Class:</b> <?php echo htmlentities($row->ClassName); ?>-<?php echo htmlentities($row->ClassNumber); ?>-<?php echo htmlentities($row->ClassYear); ?>
                                                    </th>
                                                    <?php }
                                                    ?>

                                                </tr>
                                                </thead>
                                                <thead>
                                                <tr>
                                                    <th colspan="3"></th>
                                                </tr>
                                                </thead>
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Subject</th>
                                                    <th>Marks</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                // Code for result
                                                $query = "select t.StudentName,t.StudentNo,t.ClassID,t.Marks, t.SubjectID,subjects.SubjectName from (select students.StudentName, students.StudentNo, students.ClassID, results.Marks, results.SubjectID from students join results on results.StudentID=students.StudentID) as t join subjects on subjects.id=t.SubjectID where (t.StudentNo=:studentno and t.ClassID=:classid)";
                                                $query = $dbh->prepare($query);
                                                $query->bindParam(':studentno', $studentno, PDO::PARAM_STR);
                                                $query->bindParam(':classid', $classid, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($countrow = $query->rowCount() > 0)
                                                {
                                                    foreach ($results as $result) {
                                                        ?>
                                                        <tr>
                                                            <th scope="row"><?php echo htmlentities($cnt); ?></th>
                                                            <td><?php echo htmlentities($result->SubjectName); ?></td>
                                                            <td><?php echo htmlentities($totalmarks = $result->Marks); ?></td>
                                                        </tr>
                                                        <?php
                                                        $totlcount += $totalmarks;
                                                        $cnt++;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <th scope="row" colspan="2">Total Marks</th>
                                                        <td><b><?php echo htmlentities($totlcount); ?></b> out of
                                                            <b><?php echo htmlentities($outof = ($cnt - 1) * 100); ?></b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" colspan="2">Percntage</th>
                                                        <td><b><?php echo htmlentities($totlcount * (100) / $outof); ?>
                                                                %</b></td>
                                                    </tr>
                                                <?php } else { ?>
                                                <div class="alert alert-warning left-icon-alert" role="alert">
                                                    <strong>Notice!</strong> Your result not declare yet
                                                    <?php }
                                                    ?>
                                                </div>
                                                <?php
                                                } else
                                                {
                                                ?>
                                                <div class="alert alert-danger left-icon-alert" role="alert">
                                                    <strong>Oh wrong!</strong>
                                                    <?php
                                                    echo htmlentities("Invalid Student ID.");
                                                    }
                                                    ?>
                                                </div>
                                                </tbody>
                                            </table>
                                            <a onclick="printData()" title="Print"><strong><i class="fas fa-print"></i>
                                                    Print result</strong> </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <a href="index.php">Back to Home</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                </section>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function printData() {
        var divToPrint = document.getElementById("dataTable");
        newWin = window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }
    $('button').on('click', function () {
        printData();
    })
</script>
</body>
</html>
