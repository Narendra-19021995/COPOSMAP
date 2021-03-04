<?php
require 'index.php';
?>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coposmap";
$con = mysqli_connect($servername, $username, $password, $dbname);
?>

<script>
function myFunction(){
<?php
$query = "select Cid from Coursedetails order by Cid desc ";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$lastid = $row['Cid'] + 1;
$Cid = $lastid;
?>
}
</script>


<div class="container" onload="myFunction();">
<header class="align-center"><p class="text-center h2 mt-1"> Add Course Details</p></header>
<div class="content mt-5">
<center>
<table>

<form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="post" class="form-control">
<tr>
<td><label for="id" class="text-primary h4">ID:</label></td>
<td class="col-sm-9"><input type="text" name="Cid" id="Cid" Value="<?php echo $Cid; ?>" class="form-control" readonly></td>
</tr>
<tr>
<td><label for="name" class="text-primary h4">Course Name:</label></td>
<td class="col-sm-9"><input type="text" name="CourseName" id="CourseName" value="" class="form-control" required></td>
</tr>
<tr>
<td><label for="lname" class="text-primary h4">Duration:</label></td>
<td class="col-sm-9"><input type="text" name="Duration" id="Duration" value="" class="form-control" required></td>
</tr>
<tr>
<td><label for="lname" class="text-primary h4">Semesters:</label></td>
<td class="col-sm-9"><input type="text" name="Semesters" id="Semesters" value="" class="form-control" required></td>
</tr>
<tr>
<td><label for="lname" class="text-primary h4">Type:</label></td>
<td class="col-sm-9">
<select name="Type" class="form-control" id="Type">
  <option value="Vocational">Vocational</option>
  <option value="Non-Vocational">Non-Vocational</option>
</select>
  </td>
</tr>
<tr>
<td><input type="submit" value="Submit" id="submit" name="submit" class="btn btn-primary"></td>
<td class="col-sm-9"><input type="button" name="cancel" id="cancel" value="cancel" class="btn btn-primary" required></td>
</tr>
</table>
</form>
</center>
</div>
</div>

<?php
if(isset($_POST['submit']))
{
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $Cid=$_POST['Cid'];
        $CourseName=$_POST['CourseName'];
        $Duration=$_POST['Duration'];
        $Semesters=$_POST['Semesters'];
        $Type=$_POST['Type'];

        if (!$con)
    {
        die("Connection Failed" . mysql_connect_error());
    }
     else
     {
         $sql = "insert into Coursedetails(Cid, CourseName, Duration, Semesters, Type)VALUES('$Cid', '$CourseName', '$Duration', '$Semesters', '$Type')";
        if (mysqli_query($con, $sql))
        {
            echo "<script>alert('Course Added Successfully.');window.locate='AddCourse.php'</script>";
        }
        else
        {

            echo "Record Failed TO Adds";
        }
     }



    }

}
?>

