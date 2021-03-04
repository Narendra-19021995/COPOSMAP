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
$query = "select Fid from faculty_regi order by Fid desc ";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$lastid = $row['Fid'] + 1;
$Fid = $lastid;
?>
}
</script>


<div class="container" onload="myFunction();">
<header class="align-center"><p class="text-center h2 mt-1"> New Faculty Registration</p></header>
<div class="content mt-5">
<center>
<table>

<form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="post" class="form-control">
<tr>
<td><label for="id" class="text-primary h4">ID:</label></td>
<td class="col-sm-9"><input type="text" name="Fid" id="Fid" Value="<?php echo $Fid; ?>" class="form-control" readonly></td>
</tr>
<tr>
<td><label for="name" class="text-primary h4">Name:</label></td>
<td class="col-sm-9"><input type="text" name="Name" id="Name" value="" class="form-control" required></td>
</tr>
<tr>
<td><label for="lname" class="text-primary h4">College Name:</label></td>
<td class="col-sm-9"><input type="text" name="C_name" id="C_name" value="" class="form-control" required></td>
</tr>
<tr>
<td><label for="lname" class="text-primary h4">Department Name:</label></td>
<td class="col-sm-9"><input type="text" name="D_name" id="D_name" value="" class="form-control" required></td>
</tr>
<tr>
<td><label for="lname" class="text-primary h4">Address:</label></td>
<td class="col-sm-9"><input type="text" name="Address" id="Address" value="" class="form-control" required></td>
</tr>
<tr>
<td><label for="lname" class="text-primary h4">Contact:</label></td>
<td class="col-sm-9"><input type="text" name="contact" id="contact" value="" maxlength="10" pattern="\ *\+?\d+" title="Only numbers and '+' are accepted" class="form-control" required></td>
</tr>
<tr>
<td><label for="lname" class="text-primary h4">Email:</label></td>
<td class="col-sm-9"><input type="email" name="email" id="email" value="" pattern="+@gmail.com" class="form-control" required></td>
</tr>
<tr>
<td><label for="lname" class="text-primary h4">User Name:</label></td>
<td class="col-sm-9"><input type="text" name="U_name" id="U_name" value="" class="form-control" required></td>
</tr>
<tr>
<td><label for="lname" class="text-primary h4">Password:</label></td>
<td class="col-sm-9"><input type="password" name="password" id="password" value="" class="form-control" required></td>
</tr>
<tr>
<td></td>
<td><div class="row hidden" id="strengthSection">
		<div class="form-group col-md-6">	
			<div id="strengthWrapper">
				<div class="form-control" id="strength"></div>
			</div>
		</div>
	</div>	
</td>
</tr>
<tr>
<td><label for="lname" class="text-primary h4">Confirm Password:</label></td>
<td class="col-sm-9"><input type="password" name="c_password" id="c_password" value="" class="form-control" required></td>
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
        $Fid=$_POST['Fid'];
        $Name=$_POST['Name'];
        $C_name=$_POST['C_name'];
        $D_name=$_POST['D_name'];
        $Address=$_POST['Address'];
        $contact=$_POST['contact'];
        $email=$_POST['email'];
        $U_name=$_POST['U_name'];
        $password=$_POST['password'];
        $c_password=$_POST['c_password'];

        if (!$con) 
    {
        die("Connection Failed" . mysql_connect_error());
    }
     else 
     {
         $sql = "insert into faculty_regi(Fid,Name,C_name,D_Name,Address,contact,email,U_name,password,c_password)VALUES('$Fid', '$Name', '$C_name', '$D_name', '$Address', '$contact', '$email', '$U_name', '$password', '$c_password')";
        if (mysqli_query($con, $sql))
        {
            echo "<script>alert('Record Added Successfully.');window.locate='AddnewFaculty.php'</script>";
        }   
        else
        {

            echo "Record Failed TO Adds";
        }
     }



    }

}
?>

<script>

 $(function () {
        $("#submit").click(function () {
            var password = $("#password").val();
            var confirmPassword = $("#c_password").val();
            if (password != confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        });
    });

$("#password").keyup(function(){
	validatePassword();
});

function validatePassword() {

    var pass = $("#password").val();
    if (pass != "") {

        $("#strengthSection").removeClass('hidden');

        if (pass.length <= 6) {
            $("#strength").css("background-color", "red").text("Security is too Weak.").animate({ width: '200px' }, 300);
        }

        if (pass.length > 6 && (pass.match(/[a-z]/) || pass.match(/\d+/)
            || pass.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))) {
            $("#strength").css("background-color", "#F5BCA9").text("Security is weak.").animate({ width: '200px' }, 300);
        }

        if (pass.length > 6 && ((pass.match(/[a-z]/) && pass.match(/\d+/))
            || (pass.match(/\d+/) && pass.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) || (pass.match(/[a-z]/) && pass.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)))) {
            $("#strength").css("background-color", "#FF8000").text("Good").animate({ width: '200px' }, 300);
        }

        if (pass.length > 6 && pass.match(/[a-z]/) && pass.match(/\d+/)
            && pass.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) {
            $("#strength").css("background-color", "#00FF40").text("Strong").animate({ width: '200px' }, 300);
        }

    } else {
        $("#strength").animate({ width: '200px' }, 300);
        $("#strengthSection").addClass('hidden');
    }
}
</script>
