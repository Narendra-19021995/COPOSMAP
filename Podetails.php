<?php 
require 'index.php';
?>
<div class="container">
<div class="header" align="center">
<p class="h1 text-primary font-weight-bold ">Program Objective Details</p> 
</div>
<div class="table-responsive">
<table class="table">
<tr>
<th>PID</th>
<th>Subject Name</th>
<th>PO</th>
<th>GC</th>
<th>PI</th>
</tr>
<?php
 $conn= mysqli_connect("localhost","root","", "coposmap");
 if($conn ->connect_error){
     die ("Connection failed:".$conn-> connect_error);
 }
 $sql= "Select pid, s_name, po, gi, pi from podata";
 $result = $conn-> query($sql);
 if($result-> num_rows > 0 )
 {
     while($row = $result->fetch_assoc())
     {
         echo "<tr><td>".$row["pid"]."</td><td>".$row["s_name"]."</td><td>".$row["po"]."</td><td>".$row["gi"]."</td><td>".$row["pi"]."</td></tr>";
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