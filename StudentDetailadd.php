<?php
require 'profile.php';
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
$query = "select ID from studentdetails order by ID desc ";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$lastid = $row['ID'] + 1;
$ID = $lastid;
?>
}
</script>


<div class="container" onload="myFunction();">
<header class="align-center"><p class="text-center h2 mt-1"> ADD Student Details</p></header>
<div class="content mt-5">
<center>
<table>

<form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="post" class="form-control">
<tr>
<td><label for="id" class="text-primary h4">ID:</label></td>
<td class="col-sm-9"><input type="text" name="ID" id="ID" Value="<?php echo $ID; ?>" class="form-control" readonly></td>
</tr>
<tr>
<td><label for="name" class="text-primary h4">Name:</label></td>
<td class="col-sm-9"><input type="text" name="Name" id="Name" value="" class="form-control" required></td>
</tr>
<tr>
<td><label for="lname" class="text-primary h4">Yearofstudy:</label></td>
<td class="col-sm-9"><input type="text" name="Yearofstudy" id="Yearofstudy" value="" class="form-control" required></td>
</tr>
<tr>
<td><label for="lname" class="text-primary h4">CourseName:</label></td>
<td class="col-sm-9"><input type="text" name="CourseName" id="CourseName" value="" class="form-control" required></td>
</tr>
<tr>
<td><label for="lname" class="text-primary h4">Age:</label></td>
<td class="col-sm-9"><input type="text" name="Age" id="Age" value="" class="form-control" required></td>
</tr>
<tr>
<td><label for="lname" class="text-primary h4">Contact:</label></td>
<td class="col-sm-9"><input type="text" name="contact" id="contact" value="" maxlength="10" pattern="\ *\+?\d+" title="Only numbers and '+' are accepted" class="form-control" required></td>
</tr>
<tr>
<td><label for="lname" class="text-primary h4">Gender:</label></td>
<td class="col-sm-9">
<select name="gender" class="form-control" id="gender" value="Gender">
  <option value="Male">Male</option>
  <option value="Female">Female</option>
</select>
</td>
</tr>
<tr>
<td><label for="lname" class="text-primary h4">Place:</label></td>
<td class="col-sm-9"><input type="text" name="Place" id="Place" value="" class="form-control" required></td>
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
        $ID=$_POST['ID'];
        $Name=$_POST['Name'];
        $Yearofstudy=$_POST['Yearofstudy'];
        $CourseName=$_POST['CourseName'];
        $Age=$_POST['Age'];
        $contact=$_POST['contact'];
        $gender=$_POST['gender'];
        $Place=$_POST['Place'];

        if (!$con) 
    {
        die("Connection Failed" . mysql_connect_error());
    }
     else 
     {
         $sql = "insert into studentdetails(ID,Name,Yearofstudy,CourseName,Age,contact,gender,Place)VALUES('$ID', '$Name', '$Yearofstudy', '$CourseName', '$Age', '$contact', '$gender', '$Place')";
        if (mysqli_query($con, $sql))
        {
            echo "<script>alert('Record Added Successfully.');window.locate='StudentDetailadd.php'</script>";
        }   
        else
        {

            echo "Record Failed TO Adds";
        }
     }



    }

}
?>

