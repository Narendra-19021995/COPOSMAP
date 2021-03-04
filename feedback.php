<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coposmap";
$con = mysqli_connect($servername, $username, $password, $dbname);
?>

<?php
if(isset($_POST['Submit']))
{
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        
        $name=$_POST['name'];
        $email=$_POST['email'];
        $feedback=$_POST['feedback'];

        if (!$con) 
    {
        die("Connection Failed" . mysql_connect_error());
    }
     else 
     {
         $sql = "insert into feedback(name, email, feedback)VALUES('$name', '$email', '$feedback')";
        if (mysqli_query($con, $sql))
        {
            echo "<script>alert('Thank You For Your Feedback.');window.locate='AddnewFaculty.php'</script>";
        }   
        else
        {

            echo "Record Failed TO Adds";
        }
     }



    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COPOMAPP</title>
    <link rel="stylesheet" href="Bootstrap\css\bootstrap.min.css">
    <script src="Bootstrap\js\icon.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body>
    <div class="containers">
        <nav>
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
                <i class="fas fa-bars"></i>
            </label>
            <label class="logo">
                COPOS
            </label>
            <ul>
                <li><a href="index.php" class="font-weight-bold">Home</a></li>
                <li><a href="#" class="font-weight-bold">About</a></li>
                <li><a href="#" class="font-weight-bold" data-toggle="modal" data-target="#feedback">Feedback</a></li>
                <li><button type="button" class="btn btn-info fas fa-sign-in-alt font-weight-bold" data-toggle="modal"
                        data-target="#myModal"> Login</button></li>
            </ul>
        </nav>
        <div class="modal fade" id="feedback" role="dialog">
        <div class="modal-dialog">
        <!--Modal content Feedback-->
        <div class="modal-content">
        <div class="modal-header">
        <p class="h1 text-primary text-center font-weight-bolder ">feedback</p>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
         <div class="modal-body">
         <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
         <label for="name" class="label label-default font-weight-bold">Name</label>
         <input type="text" name="name" id="name" class="form-control" required/>
         </div>
         <div class="form-group">
         <label for="email" class="label label-default font-weight-bold">Email</label>
         <input type="email" name="email" id="email" class="form-control" required/>
         </div>
         <div class="form-group">
         <label for="feedback" class="label label-default font-weight-bold">Feedback</label>
         <textarea name="feedback" id="feedback" cols="50" rows="5" class="form-control" required></textarea>
         </div>
         <div class="form-group">
         <input type="submit" class="btn btn-primary" value="Submit" name="Submit" id="Submit"/>
         <button type="button" class="btn btn-primary margin-left" data-dismiss="modal">Close</button>
         </div>
         </form>
         </div>
        </div>
        </div>
        </div>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="h1 text-primary text-center font-weight-bolder ">Select Login Type</p>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <ul class="nav navbar-nav">
                            <li><a href="Adminlogin.php" class="font-weight-bold h3 text-secondary">Admin
                                    Login</a>
                            </li>
                            <li><a href="Facultylog.php" class="font-weight-bold h3 text-success">Faculty Login</a></li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <section class="content"></section>
    </div>
    <script src="Bootstrap\js\Jquery.js"></script>
    <script src="Bootstrap\js\bootstrap.min.js"></script>
</body>

</html>