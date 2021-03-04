<?php
include_once 'profile.php';
?>
<div class="container">
<div class="header" align="center">
<p class="h1 text-primary font-weight-bold ">Course Details</p> 
</div>
<div class="table-responsive">
<table class="table">
<tr>
<th class="text-primary">ID</th>
<th class="text-primary">Course Name</th>
<th class="text-primary">Duration</th>
<th class="text-primary">Semester</th>
<th class="text-primary">Type</th>
</tr>
<?php
 $conn= mysqli_connect("localhost","root","", "coposmap");
 if($conn ->connect_error){
     die ("Connection failed:".$conn-> connect_error);
 }
 $sql= "Select Cid, CourseName, Duration, Semesters, Type from Coursedetails";
 $result = $conn-> query($sql);
 if($result-> num_rows > 0 )
 {
     while($row = $result->fetch_assoc())
     {
         echo "<tr><td>".$row["Cid"]."</td><td>".$row["CourseName"]."</td><td>".$row["Duration"]."</td><td>".$row["Semesters"]."</td><td>".$row["Type"]."</td></tr>";
     }
     echo "</table>";
 }
 else{
        //  echo"0 result";
      }
      $conn->close();
?>
</table>
</div>
</div>