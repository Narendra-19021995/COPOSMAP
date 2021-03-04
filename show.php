<?php 
include_once 'index.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="Bootstrap\css\bootstrap.min.css">
   <script src="Bootstrap\js\icon.js"></script>
  <title>Document</title>
</head>
<body>
  
<?php
//print_invoice.php
if(isset($_GET["show"]) && isset($_GET["id"]))
{

 include('connection.php');

 $statement = $connect->prepare("
  SELECT * FROM co_detail 
  WHERE Coid = :Coid
  LIMIT 1
 ");
 $statement->execute(
  array(
   ':Coid'       =>  $_GET["id"]
  )
 );
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  ?>
  <div class="container">
   <table class="table">
    <tr>
     <td colspan="2" align="center" style="font-size:18px"><b>Mapp Data </b></td>
    </tr>
    <tr>
     <td colspan="2">
      <table cellpadding="5">
       <tr>
        <td>Course No :</td><td><?php echo $row["Course_no"];?> </td>
        </tr>
        <tr>
        <td> Subject :</td><td><?php echo $row["Subject"];?></td>
      </tr>
        <tr>
        <td> Semester:</td><td><?php echo $row["Semester"];?></td>
       </tr>
      </table>
      <br />
      <table class="table">
       <tr>
        <th>CO No.</th>
        <th>Discription</th>
        <th>PO1</th>
        <th>PO2</th>
        <th>PO3</th>
        <th>PO4</th>
        <th>PO5</th>
        <th>PO6</th>
        <th>PO7</th>
        <th>PO8</th>
        <th>PO9</th>
        <th>PO10</th>
        <th>PO11</th>
        <th>PO12</th>
       </tr>
       <?php
            $statement = $connect->prepare(
               "SELECT * FROM co_discription 
                WHERE Coid = :Coid"
                );
                 $statement->execute(
                   array(
                        ':Coid'       =>  $_GET["id"]
                         )
                         );
                      $item_result = $statement->fetchAll();
                      $count = 0;
                      foreach($item_result as $sub_row)
                      {
                      $count++;
                      ?>
  
    <tr>
    <td><?php echo $count;?></td>
    <td><?php echo $sub_row["Discription"];?></td>
    <td><?php echo $sub_row["po1"];?></td>
    <td><?php echo $sub_row["po2"];?></td>
    <td><?php echo $sub_row["po3"];?></td>
    <td><?php echo $sub_row["po4"];?></td>
    <td><?php echo $sub_row["po5"];?></td>
    <td><?php echo $sub_row["po6"];?></td>
    <td><?php echo $sub_row["po7"];?></td>
    <td><?php echo $sub_row["po8"];?></td>
    <td><?php echo $sub_row["po9"];?></td>
    <td><?php echo $sub_row["po10"];?></td>
    <td><?php echo $sub_row["po11"];?></td>
    <td><?php echo $sub_row["po12"];?></td>
   </tr>
  <?php
  } 
  ?>
  </table>
     </td>
    </tr>
   </table>
 <?php
 }
}
?>

</div>
</body>
</html>
