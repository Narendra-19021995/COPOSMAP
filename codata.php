<?php
include_once 'connection.php';
 $statement = $connect->prepare("
    SELECT * FROM co_detail 
    ORDER BY Coid DESC
  ");

  $statement->execute();

  $all_result = $statement->fetchAll();

  $total_rows = $statement->rowCount();

  if(isset($_POST["create_Co"]))
  { 
     $statement = $connect->prepare("
     Insert Into co_detail
     (Course_no, Subject, Semester)
     VALUES(:Course_no, :Subject, :Semester)
     ");
     $statement -> execute(
       array(
             ':Course_no' =>  trim($_POST["Course_no"]),
             ':Subject' =>  trim($_POST["Subject"]),
             ':Semester' =>  trim($_POST["Semester"])
            )
       );
       $statement = $connect->query("SELECT LAST_INSERT_ID()");
       $Coid = $statement->fetchColumn();
       for($count=0; $count<$_POST["total_Co"]; $count++)
       {
          $statement = $connect->prepare("
          INSERT INTO co_discription 
          (Coid, Discription)
          VALUES (:Coid, :Discription)
          ");

           $statement->execute(
          array(
            ':Coid'                =>  $Coid,
            ':Discription'         =>  trim($_POST["Discription"][$count])
          )
          );

       }
       header("location:codata.php");

  } 
?>
<?php
include_once 'profile.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Co Data</title>

    <link rel="stylesheet" href="Bootstrap\css\bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

</head>
<body>
  <div class="container">
  <form method="post" id="Co_form">
  <div class="table-responsive">
  <table class="table-borderless">
  <tr>
  <h2 style="margin-top:10.5px" align="center">Insert Course Outcome</h2>
  </tr>
  <tr>
  <td class="col-sm-2"><label for="Course_no" name="Course_no"><h4>Course No:</h4></label></td>
  <td class="col-sm-5"><input type="text" name="Course_no" id="Course_no" class="form-control col-lg-12"></td>
  <td class="col-sm-5"></td>
  </tr>
  <tr>
  <td class="col-sm-2"><label for="Subject_name" name="Subject_name"><h4>Subject Name:</h4></label></td>
  <td class="col-sm-5"><input type="text" name="Subject" id="Subject" class="form-control col-lg-12"></td>
  <td class="col-sm-5"></td>
  </tr>
  <tr>
  <td class="col-sm-2"><label for="Semester" name="Semester"><h4>Select Semester:</h4></label></td>
  <td class="col-sm-5">
  <select name="Semester" class="form-control" id="Semester">
  <option value="Semester 1">Semester 1</option>
  <option value="Semester 2">Semester 2</option>
  <option value="Semester 3">Semester 3</option>
  <option value="Semester 4">Semester 4</option>
  <option value="Semester 5">Semester 5</option>
  <option value="Semester 6">Semester 6</option>
  <option value="Semester 7">Semester 7</option>
  <option value="Semester 8">Semester 8</option>
  </select></td>
  <td class="col-sm-5"></td>
  </tr>
  <tr>
  <table class="table" id="coinsert">
  <tr>
  <th>CO NO</th>
  <th>Discription</th>
  </tr>
  <tr>
  <td><span id="sr_no">1</span></td>
   <td><input type="text" name="Discription[]" id="Discription1" class="form-control col-lg-9" /></td>
  </tr>
  </table>
   <div align="right">
     <button type="button" name="add_row" id="add_row" class="btn btn-success btn-xs">+</button>
   </div>
  </tr>
  <tr>
  <input type="hidden" name="total_Co" id="total_Co" value="1" />
  <input type="submit" name="create_Co" id="create_Co" class="btn btn-info" align="center" value="Create" />
  </tr>
  </table>
  </div>
  </form>
  <script>
  $(document).ready(function(){
     var count = 1;
      $(document).on('click', '#add_row', function(){
          count++;
          $('#total_Co').val(count);
          var html_code = '';
          html_code += '<tr id="row_id_'+count+'">';
          html_code += '<td><span id="sr_no">'+count+'</span></td>';
          
          html_code += '<td><input type="text" name="Discription[]" id="Discription'+count+'" class="form-control col-lg-9" /></td>';
          html_code += '<td><button type="button" name="remove_row" id="'+count+'" class="btn btn-danger btn-xs remove_row">X</button></td>';
          html_code += '</tr>';
          $('#coinsert').append(html_code);
         });

        $(document).on('click', '.remove_row', function(){
          var row_id = $(this).attr("id");
          $('#row_id_'+row_id).remove();
          count--;
          $('#total_Co').val(count);
        });

      });
  </script>
  </div>
</body>
</html>
