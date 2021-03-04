<?php 
include_once 'profile.php';
?>
<div class="container">
<div class="w-50 p-2">
      <form method="GET" action="mappdata.php" class="form-group align-content-center">
      <p class="h3">Enter The Course Number</p>
      <label class="h2">Search</label>
      <input type="text" name="search" class="form-control">
      <input type="submit" name="submit" class="btn btn-success mt-3">
      </form>
</div>
</div>
<?php
 
include('connection.php');
if(isset($_GET['search']))
{
  $str= $_GET['search'];
  $statement = $connect->prepare("
    SELECT * FROM co_detail 
    Where Course_no ='$str'
  ");

  $statement->execute();

  $all_result = $statement->fetchAll();

  $total_rows = $statement->rowCount();

  if(isset($_POST["create_invoice"]))
  { 
    $statement = $connect->prepare("
      INSERT INTO co_detail 
        (Course_no, Subject, Semester)
        VALUES (:Course_no, :Subject, :Semester)
    ");
    $statement->execute(
      array(
          ':Course_no'             =>  trim($_POST["Course_no"]),
          ':Subject'          =>  trim($_POST["Subject"]),
          ':Semester'       =>  trim($_POST["Semester"])
      )
    );

      $statement = $connect->query("SELECT LAST_INSERT_ID()");
      $Coid = $statement->fetchColumn();
      for($count=0; $count<$_POST["total_item"]; $count++)
      {
        $statement = $connect->prepare("
          INSERT INTO co_discription 
          (Coid, Discription)
          VALUES (:Coid, :Discription)
        ");

        $statement->execute(
          array(
            ':Coid'               =>  $Coid,
            ':Discription'              =>  trim($_POST["Discription"][$count])
          )
        );
      }
      header("location:mappdata.php");
  }

  if(isset($_POST["update_invoice"]))
  {
      
      $Coid = $_POST["Coid"];
      
      
      
      $statement = $connect->prepare("
                DELETE FROM co_discription WHERE Coid = :Coid
            ");
            $statement->execute(
                array(
                    ':Coid'       =>      $Coid
                )
            );
      
      for($count=0; $count<$_POST["total_item"]; $count++)
      {
      
        $statement = $connect->prepare("
          INSERT INTO co_discription 
          (Coid, Discription, po1, po2, po3, po4, po5, po6, po7, po8, po9, po10, po11, po12) 
          VALUES (:Coid, :Discription, :po1, :po2, :po3, :po4, :po5, :po6, :po7, :po8, :po9, :po10, :po11, :po12)
        ");
        $statement->execute(
          array(
            ':Coid'         =>  $Coid,
            ':Discription'  =>  trim($_POST["Discription"][$count]),
            ':po1'          =>  trim($_POST["po1"][$count]),
            ':po2'          =>  trim($_POST["po2"][$count]),
            ':po3'          =>  trim($_POST["po3"][$count]),
            ':po4'          =>  trim($_POST["po4"][$count]),
            ':po5'          =>  trim($_POST["po5"][$count]),
            ':po6'          =>  trim($_POST["po6"][$count]),
            ':po7'          =>  trim($_POST["po7"][$count]),
            ':po8'          =>  trim($_POST["po8"][$count]),
            ':po9'          =>  trim($_POST["po9"][$count]),
            ':po10'         =>  trim($_POST["po10"][$count]),
            ':po11'         =>  trim($_POST["po11"][$count]),
            ':po12'         =>  trim($_POST["po12"][$count])
          )
        );
        $result = $statement->fetchAll();
      }
      
      $statement = $connect->prepare("
        UPDATE co_detail 
        SET Course_no = :Course_no, 
        Subject = :Subject, 
        Semester = :Semester
        WHERE Coid = :Coid 
      ");
      
      $statement->execute(
        array(
          ':Course_no'       =>  trim($_POST["Course_no"]),
          ':Subject'         =>  trim($_POST["Subject"]),
          ':Semester'        =>  trim($_POST["Semester"]),
          ':Coid'             =>  $Coid
        )
      );
      
      $result = $statement->fetchAll();
            
      header("location:mappdata.php");
  }

  if(isset($_GET["delete"]) && isset($_GET["id"]))
  {
    $statement = $connect->prepare("DELETE FROM co_detail WHERE Coid = :id");
    $statement->execute(
      array(
        ':id'       =>      $_GET["id"]
      )
    );
    $statement = $connect->prepare(
      "DELETE FROM co_discription WHERE Coid = :id");
    $statement->execute(
      array(
        ':id'       =>      $_GET["id"]
      )
    );
    header("location:mappdata.php");
  }

  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    <!-- <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css"> -->

    <link rel="stylesheet" href="Bootstrap\css\bootstrap.min.css">
    <script src="Bootstrap\js\icon.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <style>
      /* Remove the navbar's default margin-bottom and rounded borders */ 
      .navbar {
      margin-bottom: 4px;
      border-radius: 0;
      }
      /* Add a gray background color and some padding to the footer */
      footer {
      background-color: #f2f2f2;
      padding: 25px;
      }
      .carousel-inner img {
      width: 100%; /* Set width to 100% */
      margin: auto;
      min-height:200px;
      }
      .navbar-brand
      {
      padding:5px 40px;
      }
      .navbar-brand:hover
      {
      background-color:#ffffff;
      }
      /* Hide the carousel text when the screen is less than 600 pixels wide */
      @media (max-width: 600px) {
      .carousel-caption {
      display: none; 
      }
      }
    </style>
  </head>
  <body>
    <style>
      .box
      {
      width: 100%;
      max-width: 1390px;
      border-radius: 5px;
      border:1px solid #ccc;
      padding: 15px;
      margin: 0 auto;                
      margin-top:50px;
      box-sizing:border-box;
      }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <!-- <link rel="stylesheet" href="css/datepicker.css"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <!-- <script src="js/bootstrap-datepicker1.js"></script> -->
    <script>
      $(document).ready(function(){
        $('#order_date').datepicker({
          format: "yyyy-mm-dd",
          autoclose: true
        });
      });
    </script>
    <div class="container">
      <?php
      if(isset($_GET["add"]))
      {
      ?>
      
      <form method="post" id="invoice_form">
        <div class="table-responsive">
          <table class="table table-bordered">
            <tr>
              <td colspan="2" align="center"><h2 style="margin-top:10.5px">Create Invoice</h2></td>
            </tr>
            <tr>
                <td colspan="2">
                  <div class="row">
                    <div class="col-md-8">
                      To,<br />
                        <b>RECEIVER (BILL TO)</b><br />
                        <input type="text" name="Subject" id="Subject" class="form-control input-sm" placeholder="Subject" />
                        <textarea name="Semester" id="Semester" class="form-control" placeholder="Semester"></textarea>
                    </div>
                    <div class="col-md-4">
                      Reverse Charge<br />
                      <!-- <input type="text" name="Coid" id="Coid" class="form-control input-sm" placeholder="Coid" /> -->
                      <input type="text" name="Course_no" id="Course_no" class="form-control input-sm" placeholder="Course no" />
                    </div>
                  </div>
                  <br />
                  <table id="invoice-item-table" class="table table-bordered">
                    <tr>
                      <th width="7%">Sr No.</th>
                      <th width="20%">Discrption</th>
                    </tr>
                    <tr>
                      <td><span id="sr_no">1</span></td>
                      <td><input type="text" name="Discription[]" id="Discription1" class="form-control input-sm" /></td>
                      <td></td> 
                    </tr>
                  </table>
                  <div align="right">
                    <button type="button" name="add_row" id="add_row" class="btn btn-success btn-xs">+</button>
                  </div>
                </td>
              </tr>

              <tr>
                <td colspan="2"></td>
              </tr>
              <tr>
                <td colspan="2" align="center">
                  <input type="hidden" name="total_item" id="total_item" value="1" />
                  <input type="submit" name="create_invoice" id="create_invoice" class="btn btn-info" value="Create" />
                </td>
              </tr>
          </table>
        </div>
      </form>
      <script>
      $(document).ready(function(){
        var final_total_amt = $('#final_total_amt').text();
        var count = 1;
        
        $(document).on('click', '#add_row', function(){
          count++;
          $('#total_item').val(count);
          var html_code = '';
          html_code += '<tr id="row_id_'+count+'">';
          html_code += '<td><span id="sr_no">'+count+'</span></td>';
          
          html_code += '<td><input type="text" name="Discription[]" id="Discription'+count+'" class="form-control input-sm" /></td>';
          
           html_code += '<td><button type="button" name="remove_row" id="'+count+'" class="btn btn-danger btn-xs remove_row">X</button></td>';
          html_code += '</tr>';
          $('#invoice-item-table').append(html_code);
        });
        
        $(document).on('click', '.remove_row', function(){
          var row_id = $(this).attr("id");
          var total_item_amount = $('#order_item_final_amount'+row_id).val();
          var final_amount = $('#final_total_amt').text();
          var result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);
          $('#final_total_amt').text(result_amount);
          $('#row_id_'+row_id).remove();
          count--;
          $('#total_item').val(count);
        });

        function cal_final_total(count)
        {
          var final_item_total = 0;
          for(j=1; j<=count; j++)
          {
            var quantity = 0;
            var price = 0;
            var actual_amount = 0;
            var tax1_rate = 0;
            var tax1_amount = 0;
            var tax2_rate = 0;
            var tax2_amount = 0;
            var tax3_rate = 0;
            var tax3_amount = 0;
            var item_total = 0;
            quantity = $('#order_item_quantity'+j).val();
            if(quantity > 0)
            {
              price = $('#order_item_price'+j).val();
              if(price > 0)
              {
                actual_amount = parseFloat(quantity) * parseFloat(price);
                $('#order_item_actual_amount'+j).val(actual_amount);
                tax1_rate = $('#order_item_tax1_rate'+j).val();
                if(tax1_rate > 0)
                {
                  tax1_amount = parseFloat(actual_amount)*parseFloat(tax1_rate)/100;
                  $('#order_item_tax1_amount'+j).val(tax1_amount);
                }
                tax2_rate = $('#order_item_tax2_rate'+j).val();
                if(tax2_rate > 0)
                {
                  tax2_amount = parseFloat(actual_amount)*parseFloat(tax2_rate)/100;
                  $('#order_item_tax2_amount'+j).val(tax2_amount);
                }
                tax3_rate = $('#order_item_tax3_rate'+j).val();
                if(tax3_rate > 0)
                {
                  tax3_amount = parseFloat(actual_amount)*parseFloat(tax3_rate)/100;
                  $('#order_item_tax3_amount'+j).val(tax3_amount);
                }
                item_total = parseFloat(actual_amount) + parseFloat(tax1_amount) + parseFloat(tax2_amount) + parseFloat(tax3_amount);
                final_item_total = parseFloat(final_item_total) + parseFloat(item_total);
                $('#order_item_final_amount'+j).val(item_total);
              }
            }
          }
          $('#final_total_amt').text(final_item_total);
        }

        $(document).on('blur', '.order_item_price', function(){
          cal_final_total(count);
        });

        $(document).on('blur', '.order_item_tax1_rate', function(){
          cal_final_total(count);
        });

        $(document).on('blur', '.order_item_tax2_rate', function(){
          cal_final_total(count);
        });

        $(document).on('blur', '.order_item_tax3_rate', function(){
          cal_final_total(count);
        });

        $('#create_invoice').click(function(){
          if($.trim($('#Subject').val()).length == 0)
          {
            alert("Please Enter Reciever Name");
            return false;
          }

         
          if($.trim($('#Course_no').val()).length == 0)
          {
            alert("Please Select Invoice Date");
            return false;
          }

          for(var no=1; no<=count; no++)
          {
            if($.trim($('#Discription'+no).val()).length == 0)
            {
              alert("Please Enter Item Name");
              $('#Discription'+no).focus();
              return false;
            }

         
          }

          $('#invoice_form').submit();

        });

      });
      </script>
      <?php
      }
      elseif(isset($_GET["update"]) && isset($_GET["id"]))
      {
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
        <script>
        $(document).ready(function(){
          $('#Course_no').val("<?php echo $row["Course_no"]; ?>");
          $('#Subject').val("<?php echo $row["Subject"]; ?>");
          $('#Semester').val("<?php echo $row["Semester"]; ?>");
        });
        </script> 
        <form method="post" id="invoice_form">
        <div class="table-responsive">
          <table class="table table-bordered">
            <tr>
              <td colspan="2" align="center"><h2 style="margin-top:10.5px">Mapping CO With PO</h2></td>
            </tr>
            <tr>
                <td colspan="2">
                <table class="table-borderless">
                <tr>
                <td><label for="Course_no">Course NO:</label></td>
                <td><input type="text" name="Course_no" id="Course_no" class="form-control input-sm" placeholder="Course no" /></td>
                </tr>
                <tr>
                <td><label for="Subject">Subject:</label></br></td>
                <td><input type="text" name="Subject" id="Subject" class="form-control input-sm" placeholder="Subject" /></td>
                </tr>
                <tr>
                <td><label for="Semester">Semester:</label></td>
                <td><input type="text" name="Semester" id="Semester" class="form-control input-sm" placeholder="Semester" /></td>
                </tr>
                </table>
                  
                  <br />
                  <table id="invoice-item-table" class="table table-bordered">
                    <tr>
                      <th width="6%">CO No.</th>
                      <th width="20%">Discrption</th>
                      <th width="6%">PO1</th>
                      <th width="6%">PO2</th>
                      <th width="6%">PO3</th>
                      <th width="6%">PO4</th>
                      <th width="6%">PO5</th>
                      <th width="6%">PO6</th>
                      <th width="6%">PO7</th>
                      <th width="6%">PO8</th>
                      <th width="6%">PO9</th>
                      <th width="6%">PO10</th>
                      <th width="6%">PO11</th>
                      <th width="6%">PO12</th>
                    </tr>
                    <?php
                    $statement = $connect->prepare("
                      SELECT * FROM co_discription 
                      WHERE Coid = :Coid
                    ");
                    $statement->execute(
                      array(
                        ':Coid'       =>  $_GET["id"]
                      )
                    );
                    $item_result = $statement->fetchAll();
                    $m = 0;
                    foreach($item_result as $sub_row)
                    {
                      $m = $m + 1;
                    ?>
                    <tr>
                      <td><span id="sr_no"><?php echo $m; ?></span></td>
                      <td><input type="text" name="Discription[]" id="Discription<?php echo $m; ?>" class="form-control input-sm" value="<?php echo $sub_row["Discription"]; ?>" /></td>
                      <td><input type="text" name="po1[]" id="po1<?php echo $m;?>" class="form-control input-sm" value="<?php echo $sub_row["po1"]; ?>" /></td>
                      <td><input type="text" name="po2[]" id="po2<?php echo $m;?>" class="form-control input-sm" value="<?php echo $sub_row["po2"]; ?>" /></td>
                      <td><input type="text" name="po3[]" id="po3<?php echo $m;?>" class="form-control input-sm" value="<?php echo $sub_row["po3"]; ?>" /></td>
                      <td><input type="text" name="po4[]" id="po4<?php echo $m;?>" class="form-control input-sm" value="<?php echo $sub_row["po4"]; ?>" /></td>
                      <td><input type="text" name="po5[]" id="po5<?php echo $m;?>" class="form-control input-sm" value="<?php echo $sub_row["po5"]; ?>" /></td>
                      <td><input type="text" name="po6[]" id="po6<?php echo $m;?>" class="form-control input-sm" value="<?php echo $sub_row["po6"]; ?>" /></td>
                      <td><input type="text" name="po7[]" id="po7<?php echo $m;?>" class="form-control input-sm" value="<?php echo $sub_row["po7"]; ?>" /></td>
                      <td><input type="text" name="po8[]" id="po8<?php echo $m;?>" class="form-control input-sm" value="<?php echo $sub_row["po8"]; ?>" /></td>
                      <td><input type="text" name="po9[]" id="po9<?php echo $m;?>" class="form-control input-sm" value="<?php echo $sub_row["po9"]; ?>" /></td>
                      <td><input type="text" name="po10[]" id="po10<?php echo $m;?>" class="form-control input-sm" value="<?php echo $sub_row["po10"]; ?>" /></td>
                      <td><input type="text" name="po11[]" id="po11<?php echo $m;?>" class="form-control input-sm" value="<?php echo $sub_row["po11"]; ?>" /></td>
                      <td><input type="text" name="po12[]" id="po12<?php echo $m;?>" class="form-control input-sm" value="<?php echo $sub_row["po12"]; ?>" /></td>
                    </tr>
                    <?php
                    }
                    ?>
                  </table>
                </td>
              </tr>
              
              <tr>
                <td colspan="2"></td>
              </tr>
              <tr>
                <td colspan="2" align="center">
                  <input type="hidden" name="total_item" id="total_item" value="<?php echo $m; ?>" />
                  <input type="hidden" name="Coid" id="Coid" value="<?php echo $row["Coid"]; ?>" />
                  <input type="submit" name="update_invoice" id="create_invoice" class="btn btn-info" value="MAPP" />
                </td>
              </tr>
          </table>
        </div>
      </form>
      <script>
      $(document).ready(function(){
        var final_total_amt = $('#final_total_amt').text();
        var count = "<?php echo $m; ?>";
        
        $(document).on('click', '#add_row', function(){
          count++;
          $('#total_item').val(count);
          var html_code = '';
          html_code += '<tr id="row_id_'+count+'">';
          html_code += '<td><span id="sr_no">'+count+'</span></td>';
          
          html_code += '<td><input type="text" name="Discription[]" id="Discription'+count+'" class="form-control input-sm" /></td>';
          html_code += '<td><button type="button" name="remove_row" id="'+count+'" class="btn btn-danger btn-xs remove_row">X</button></td>';
          html_code += '</tr>';
          $('#invoice-item-table').append(html_code);
        });
        
        $(document).on('click', '.remove_row', function(){
          var row_id = $(this).attr("id");
          var total_item_amount = $('#order_item_final_amount'+row_id).val();
          var final_amount = $('#final_total_amt').text();
          var result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);
          $('#final_total_amt').text(result_amount);
          $('#row_id_'+row_id).remove();
          count--;
          $('#total_item').val(count);
        });

        function cal_final_total(count)
        {
          var final_item_total = 0;
          for(j=1; j<=count; j++)
          {
            var quantity = 0;
            var price = 0;
            var actual_amount = 0;
            var tax1_rate = 0;
            var tax1_amount = 0;
            var tax2_rate = 0;
            var tax2_amount = 0;
            var tax3_rate = 0;
            var tax3_amount = 0;
            var item_total = 0;
            quantity = $('#order_item_quantity'+j).val();
            if(quantity > 0)
            {
              price = $('#order_item_price'+j).val();
              if(price > 0)
              {
                actual_amount = parseFloat(quantity) * parseFloat(price);
                $('#order_item_actual_amount'+j).val(actual_amount);
                tax1_rate = $('#order_item_tax1_rate'+j).val();
                if(tax1_rate > 0)
                {
                  tax1_amount = parseFloat(actual_amount)*parseFloat(tax1_rate)/100;
                  $('#order_item_tax1_amount'+j).val(tax1_amount);
                }
                tax2_rate = $('#order_item_tax2_rate'+j).val();
                if(tax2_rate > 0)
                {
                  tax2_amount = parseFloat(actual_amount)*parseFloat(tax2_rate)/100;
                  $('#order_item_tax2_amount'+j).val(tax2_amount);
                }
                tax3_rate = $('#order_item_tax3_rate'+j).val();
                if(tax3_rate > 0)
                {
                  tax3_amount = parseFloat(actual_amount)*parseFloat(tax3_rate)/100;
                  $('#order_item_tax3_amount'+j).val(tax3_amount);
                }
                item_total = parseFloat(actual_amount) + parseFloat(tax1_amount) + parseFloat(tax2_amount) + parseFloat(tax3_amount);
                final_item_total = parseFloat(final_item_total) + parseFloat(item_total);
                $('#order_item_final_amount'+j).val(item_total);
              }
            }
          }
          $('#final_total_amt').text(final_item_total);
        }

        $(document).on('blur', '.order_item_price', function(){
          cal_final_total(count);
        });

        $(document).on('blur', '.order_item_tax1_rate', function(){
          cal_final_total(count);
        });

        $(document).on('blur', '.order_item_tax2_rate', function(){
          cal_final_total(count);
        });

        $(document).on('blur', '.order_item_tax3_rate', function(){
          cal_final_total(count);
        });

        $('#create_invoice').click(function(){
          if($.trim($('#Course_no').val()).length == 0)
          {
            alert("Please Enter Reciever Name");
            return false;
          }

          if($.trim($('#Subject').val()).length == 0)
          {
            alert("Please Enter Invoice Number");
            return false;
          }

          if($.trim($('#Semester').val()).length == 0)
          {
            alert("Please Select Invoice Date");
            return false;
          }

          for(var no=1; no<=count; no++)
          {
            if($.trim($('#Discription'+no).val()).length == 0)
            {
              alert("Please Enter Item Name");
              $('#item_name'+no).focus();
              return false;
            }

            

          }

          $('#invoice_form').submit();

        });

      });
      </script>
        <?php 
        }
      }
      else
      {
      ?>
      <div class="container">
      <h3 align="center">CO Data Submit by Teacher</h3>

      <br />
      <!-- <div align="right">
        <a href="mapping.php?add=1" class="btn btn-info btn-xs">Create</a>
      </div> -->
      <br />
      
      <table id="data-table" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>CO ID.</th>
            <th>CO NO</th>
            <th>SubJect Name</th>
            <th>Semester</th>
            <th>Show</th>
            <th>Mapp</th>
            <!-- <th>Delete</th> -->
          </tr>
        </thead>
        <?php
        if($total_rows > 0)
        {
          foreach($all_result as $row)
          {
            echo '
              <tr>
                <td>'.$row["Coid"].'</td>
                <td>'.$row["Course_no"].'</td>
                <td>'.$row["Subject"].'</td>
                <td>'.$row["Semester"].'</td>
                <th><a href="show.php?show=1&id='.$row["Coid"].'">Show</th>
                <td><a href="mapping.php?update=1&id='.$row["Coid"].'"><span class="glyphicon glyphicon-edit"></span></a></td>
                
              </tr>
            ';
          }
        }
        ?>
        <!-- <td><a href="mappdata.php?delete=1&id='.$row["Coid"].'" class="delete"><span class="glyphicon glyphicon-remove"></span></a></td> -->
      </table>
      <?php
      }
    }
  ?>
     
      </div>
    </div>
    <br>
    
  </body>
</html>
<script type="text/javascript">
  $(document).ready(function(){
    var table = $('#data-table').DataTable({
          "order":[],
          "columnDefs":[
          {
            "targets":[4, 5, 6],
            "orderable":false,
          },
        ],
        "pageLength": 25
        });
    $(document).on('click', '.delete', function(){
      var id = $(this).attr("id");
      if(confirm("Are you sure you want to remove this?"))
      {
        window.location.href="mappdata.php?delete=1&id="+id;
      }
      else
      {
        return false;
      }
    });
  });

</script>

<script>
$(document).ready(function(){
$('.number_only').keypress(function(e){
return isNumbers(e, this);      
});
function isNumbers(evt, element) 
{
var charCode = (evt.which) ? evt.which : event.keyCode;
if (
(charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
(charCode < 48 || charCode > 57))
return false;
return true;
}
});
</script>
