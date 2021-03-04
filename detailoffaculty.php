<?php 
require 'index.php';
?>
<div class="container">
<div class="header" align="center">
<p class="h1 text-primary font-weight-bold ">Faculty Details</p> 
</div>
<div class="table-responsive">
<table class="table">
<tr>
<th class="text-primary">ID</th>
<th class="text-primary">Name</th>
<th class="text-primary">College Name</th>
<th class="text-primary">Department Name</th>
<th class="text-primary">Adress</th>
<th class="text-primary">Contact</th>
<th class="text-primary">Email</th>
<th class="text-primary">Username</th>
<th class="text-primary">Password</th>
<th class="text-primary">Conform Password</th>
</tr>
<?php
 $conn= mysqli_connect("localhost","root","", "coposmap");
 if($conn ->connect_error){
     die ("Connection failed:".$conn-> connect_error);
 }
 $sql= "Select Fid, Name, C_name, D_name, Address, contact, email, U_name, password, c_password from faculty_regi";
 $result = $conn-> query($sql);
 if($result-> num_rows > 0 )
 {
     while($row = $result->fetch_assoc())
     {
         echo "<tr><td>".$row["Fid"]."</td><td>".$row["Name"]."</td><td>".$row["C_name"]."</td><td>".$row["D_name"]."</td><td>".$row["Address"]."</td><td>".$row["contact"]."</td><td>".$row["email"]."</td><td>".$row["U_name"]."</td><td>".$row["password"]."</td><td>".$row["c_password"]."</td></tr>";
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