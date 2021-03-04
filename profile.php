<?php
include 'session.php';
if (!isset($_SESSION['login_user'])) {
    header("location: index.php"); // Redirecting To Home Page
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COPOMAPP</title>
    <link rel="icon" href="../COPO.png">
    <link rel="stylesheet" href="Bootstrap\css\bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script src="Bootstrap\js\icon.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
    body {
        font-family: "Lato", sans-serif;
        transition: background-color .5s;
    }

    .sidenav {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #111;
        overflow-x: hidden;
        transition: 0.1s;
        padding-top: 60px;
    }

    .sidenav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 15px;
        color: #818181;
        display: block;
        transition: 0.1s;
    }

    .sidenav a:hover {
        color: #f1f1f1;
    }

    .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }

    #main {
        transition: margin-left 0.1s;
        padding: 16px;
    }

    @media screen and (max-height: 450px) {
        .sidenav {
            padding-top: 15px;
        }

        .sidenav a {
            font-size: 18px;
        }
    }
    </style>



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
                <li>
                    <p style="color:white; font-weight:bold;">Welcome : <?php echo $login_session; ?></p>
                </li>
                <li><a href="logout.php" class='fas fa-sign-out-alt' style="color:white"> Logout</a></li>
            </ul>
        </nav>

        <div id="mySidenav" class="sidenav">
           <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <ul class="list-unstyled components">
                <li class="list-group-item list-group-item-action disabled">
                    <a href="#">
                        <i class="glyphicon glyphicon-home"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="#CompanySubmenu" data-toggle="collapse" aria-expanded="false">
                        <i class="glyphicon glyphicon-briefcase"></i>
                       Co-ordinator
                    </a>
                    <ul class="collapse list-unstyled" id="CompanySubmenu">
                        <li class="list-group-item list-group-item-action"><a href="ADDCourse.php">Add Course</a></li>
                        <li class="list-group-item list-group-item-action"><a href="ADDPO.php">Add PO</a></li>
                        <li class="list-group-item list-group-item-action"><a href="Podetails.php">PO Details</a></li>
                        <li class="list-group-item list-group-item-action"><a href="mapping.php">CO Details</a></li>
                        <li class="list-group-item list-group-item-action"><a href="studentdetails.php">Student Details</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#customerSubmenu" data-toggle="collapse" aria-expanded="false">
                        <i class="glyphicon glyphicon-user"></i>
                         Manage Faculty
                    </a>
                    <ul class="collapse list-unstyled" id="customerSubmenu">
                        <li class="list-group-item list-group-item-action"><a href="AddnewFacalty.php">Add Faculty</a></li>
                        <li class="list-group-item list-group-item-action"><a href="detailoffaculty.php">Faculty Details</a></li>
                        <li class="list-group-item list-group-item-action"><a href="faculty.php">Faculty Data</a></li>
                        
                    </ul>
                </li>
            </ul>
        </div>

        <div id="main">
            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
        </div>

        <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
            document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
            document.body.style.backgroundColor = "white";
        }
        </script>
        <div class="container">
            <div class="content">
                <div class="container">
                <h1 class="tect-primary" align="center">Wel-Come To Admin Page</h1>
                </div>
                <div class="w-50" align="center">
               <table>
               <tr>
               <td><p class="h3">Faculty Menu </p></td>
               </tr>
                <tr>
               <td> <p class="h4">Add Course</p></td>
               </tr>
                <tr>
               <td><p class="h4">Add Program OutCome</p></td>
               </tr>
                <tr>
               <td><p class="h4">Program OutComes Details</p></td>
               </tr>
                <tr>
               <td><p class="h4">Course Outcome Details</p></td>
               </tr>
               <tr>
               <td> <p class="h4">Student Information</p>
               </td></tr>
               <tr>
               <td> <p class="h4">Add Faculty</p>
               </td></tr>
               <tr>
               <td> <p class="h4"> Faculty Details</p>
               </td></tr>
               <tr>
               <td> <p class="h4">Faculty Data</p>
               </td></tr>
               </table>
                    
                    
                    
                    
                   
               </div>
            </div>
        </div>

    </div>
    <script src="Bootstrap\js\Jquery.js"></script>
    <script src="Bootstrap\js\bootstrap.min.js"></script>
</body>

</html>