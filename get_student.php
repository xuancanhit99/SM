<?php
include('includes/db_connection.php');
global $dbh;
if (!empty($_POST["classid"])) {
    $cid = intval($_POST['classid']);
    if (!is_numeric($cid)) {
        echo htmlentities("invalid Class");
        exit;
    } else {
        $stmt = $dbh->prepare("Select StudentName,StudentID from students WHERE ClassID= :id order by StudentName");
        $stmt->execute(array(':id' => $cid));
        ?>
        <option value="">Select Category</option><?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option value="<?php echo htmlentities($row['StudentID']); ?>"><?php echo htmlentities($row['StudentName']); ?></option>
            <?php
        }
    }
}
if (!empty($_POST["classid1"])) {
    $cid1 = intval($_POST['classid1']);
    if (!is_numeric($cid1)) {
        echo htmlentities("Invalid Class");
        exit;
    } else {
        $status = 0;
        $stmt = $dbh->prepare("SELECT subjects.SubjectName,subjects.id FROM subjectcombination join  subjects on  subjects.id=subjectcombination.SubjectID WHERE subjectcombination.ClassID=:cid and subjectcombination.status!=:stts order by subjects.SubjectName");
        $stmt->execute(array(':cid' => $cid1, ':stts' => $status));
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <p> <?php echo htmlentities($row['SubjectName']); ?><input type="text" name="marks[]" value=""
                                                                       class="form-control" required=""
                                                                       placeholder="Enter marks out of 100"
                                                                       autocomplete="off"></p>
        <?php }
    }
}
?>
<?php
if (!empty($_POST["studclass"])) {
    $id = $_POST['studclass'];
    $dta = explode("$", $id);
    $id = $dta[0];
    $id1 = $dta[1];
    $query = $dbh->prepare("SELECT StudentID,ClassID FROM results WHERE StudentID=:id1 and ClassID=:id ");
    $query->bindParam(':id1', $id1, PDO::PARAM_STR);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;
    if ($query->rowCount() > 0) { ?>
        <p>
            <?php
            echo "<span style='color:red'> Result Already Declare .</span>";
            echo "<script>$('#submit').prop('disabled',true);</script>";
            ?></p>
    <?php }
} ?>


