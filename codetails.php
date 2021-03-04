<?php 
require 'index.php';
?>
<div class="container">
<div class="header" align="center">
<p class="h1 text-primary font-weight-bold ">Course Objective Details</p> 
</div>
<div class="table-responsive">
<table class="table">
<tr>
<th>CID</th>
<th>Subject Name</th>
<th>CO</th>
<th>Course Name</th>
</tr>
<?php
 $conn= mysqli_connect("localhost","root","", "coposmap");
 if($conn ->connect_error){
     die ("Connection failed:".$conn-> connect_error);
 }
 $sql= "Select CID, s_name, Co_no, co_name from codata";
 $result = $conn-> query($sql);
 if($result-> num_rows > 0 )
 {
     while($row = $result->fetch_assoc())
     {
         echo "<tr><td>".$row["CID"]."</td><td>".$row["s_name"]."</td><td>".$row["Co_no"]."</td><td>".$row["co_name"]."</td></tr>";
     }
     echo "</table>";
 }
 else{
          echo"0 result";
      }
      $conn->close();
?>
</table>
</div>
</div>