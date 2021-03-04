
<?php
include 'session.php';
if (!isset($_SESSION['login_user'])) {
    header("location:../index.php"); // Redirecting To Home Page
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>COPOSMAP</title>
<link rel="icon" href="../COPO.png">
<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="dist/bootstrap.min.css" type="text/css" media="all">
<link href="dist/jquery.bootgrid.css" rel="stylesheet" />
<script src="dist/jquery-1.11.1.min.js"></script>
<script src="dist/bootstrap.min.js"></script>
<script src="dist/jquery.bootgrid.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
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
                    <p class="content text-white font-weight-bold" style="color:white; font-weight:bold;">Welcome : <?php echo $login_session; ?></p>
                </li>
                <li><a href="logout.php" class='fas fa-sign-out-alt' style="color:white"> Logout</a></li>
            </ul>
        </nav>

      <div class="container">
       
        <div class="col-sm-12">
		<div class="well clearfix">
    <a class='fas fa-home' style='font-size:36px' href="profile.php"></a>
     <h2 class="text-center text-primary">Student Data </h2>
      </div> 
		<table id="employee_grid" class="table table-condensed table-hover table-striped" width="60%" cellspacing="0" data-toggle="bootgrid">
			<thead>
				<tr>
					<th data-column-id="ID" data-type="numeric" data-identifier="true">ID</th>
					<th data-column-id="Name">Name</th>
					<th data-column-id="Yearofstudy">Year of Study</th>
					<th data-column-id="CourseName">Course Name</th>
					<th data-column-id="contact">Contact</th>
                    <th data-column-id="gender">Gender</th>
					<th data-column-id="Place">Place</th>
					<th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
				</tr>
			</thead>
		</table>
    </div>
      </div>
    </div>
	
<div id="add_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Student Data</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="frm_add">
				<input type="hidden" value="add" name="action" id="action">
                  <div class="form-group">
                    <label for="name" class="control-label">Name:</label>
                    <input type="text" class="form-control" id="Name" name="Name" readonly/>
                  </div>
                  <div class="form-group">
                    <label for="salary" class="control-label">Year of Study:</label>
                    <input type="text" class="form-control" id="Yearofstudy" name="Yearofstudy" readonly/>
                  </div>
				  <div class="form-group">
                    <label for="salary" class="control-label">Course Name:</label>
                    <input type="text" class="form-control" id="CourseName" name="CourseName" readonly/>
                  </div>
				   <div class="form-group">
                    <label for="salary" class="control-label">Age:</label>
                    <input type="text" class="form-control" id="Age" name="Age" readonly/>
                  </div>
				   <div class="form-group">
                    <label for="salary" class="control-label">Contact:</label>
                    <input type="text" class="form-control" id="contact" name="contact" readonly/>
                  </div>
				   <div class="form-group">
                    <label for="salary" class="control-label">Gender:</label>
                    <input type="text" class="form-control" id="gender" name="gender" readonly/>
                  </div>
				   <div class="form-group">
                    <label for="salary" class="control-label">Place:</label>
                    <input type="text" class="form-control" id="Place" name="Place" readonly/>
                  </div>
				   
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn_add" class="btn btn-primary">Save</button>
            </div>
			</form>
        </div>
    </div>
</div>
<div id="edit_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Student Information</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="frm_edit">
				<input type="hidden" value="edit" name="action" id="action">
				<input type="hidden" value="0" name="edit_ID" id="edit_ID">
                  <div class="form-group">
                    <label for="name" class="control-label">Name:</label>
                    <input type="text" class="form-control" id="edit_Name" name="edit_Name" readonly/>
                  </div>
                  <div class="form-group">
                    <label for="salary" class="control-label">Year OF Study:</label>
                    <input type="text" class="form-control" id="edit_Yearofstudy" name="edit_Yearofstudy" readonly/>
                  </div>
				  <div class="form-group">
                    <label for="salary" class="control-label">Course Name:</label>
                    <input type="text" class="form-control" id="edit_CourseName" name="edit_CourseName" readonly/>
                  </div>
				  <div class="form-group">
                    <label for="salary" class="control-label">Age:</label>
                    <input type="text" class="form-control" id="edit_Age" name="edit_Age" readonly/>
                  </div>
				  <div class="form-group">
                    <label for="salary" class="control-label">Contact:</label>
                    <input type="text" class="form-control" id="edit_contact" name="edit_contact" readonly/>
                  </div>
				  <div class="form-group">
                    <label for="salary" class="control-label">Gender:</label>
                    <input type="text" class="form-control" id="edit_gender" name="edit_gender" readonly/>
                  </div>
				  
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
            </div>
			</form>
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
$( document ).ready(function() {
	var grid = $("#employee_grid").bootgrid({
		ajax: true,
		rowSelect: true,
		post: function ()
		{
			/* To accumulate custom parameter with the request object */
			return {
				id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
			};
		},
		
		url: "response1.php",
		formatters: {
		        "commands": function(column, row)
		        {
		            return "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.ID + "\"><span class=\"glyphicon glyphicon-eye-open\"></span></button> " + 
		                "<button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.ID + "\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
		        }
		    }
   }).on("loaded.rs.jquery.bootgrid", function()
{
    /* Executes after data is loaded and rendered */
    grid.find(".command-edit").on("click", function(e)
    {
        //alert("You pressed edit on row: " + $(this).data("row-id"));
			var ele =$(this).parent();
			var g_id = $(this).parent().siblings(':first').html();
            var g_name = $(this).parent().siblings(':nth-of-type(2)').html();
console.log(g_id);
                    console.log(g_name);

		//console.log(grid.data());//
		$('#edit_model').modal('show');
					if($(this).data("row-id") >0) {
							
                // collect the data
                $('#edit_ID').val(ele.siblings(':first').html()); // in case we're changing the key
                $('#edit_Name').val(ele.siblings(':nth-of-type(2)').html());
                $('#edit_Yearofstudy').val(ele.siblings(':nth-of-type(3)').html());
                $('#edit_CourseName').val(ele.siblings(':nth-of-type(4)').html());
								$('#edit_Age').val(ele.siblings(':nth-of-type(5)').html());
								$('#edit_contact').val(ele.siblings(':nth-of-type(6)').html());
								$('#edit_gender').val(ele.siblings(':nth-of-type(7)').html());
								$('#edit_Place').val(ele.siblings(':nth-of-type(8)').html());
					} else {
					 alert('Now row selected! First select row, then click edit button');
					}
        }).end().find(".command-delete").on("click", function(e)
    {
	
		var conf = confirm('Delete ' + $(this).data("row-id") + ' items?');
					alert(conf);
                    if(conf){
                                $.post('response1.php', { id: $(this).data("row-id"), action:'delete'}
                                    , function(){
                                        // when ajax returns (callback), 
										$("#employee_grid").bootgrid('reload');
                                }); 
								//$(this).parent('tr').remove();
								//$("#employee_grid").bootgrid('remove', $(this).data("row-id"))
                    }
    });
});

function ajaxAction(action) {
				data = $("#frm_"+action).serializeArray();
				$.ajax({
				  type: "POST",  
				  url: "response1.php",  
				  data: data,
				  dataType: "json",       
				  success: function(response)  
				  {
					$('#'+action+'_model').modal('hide');
					$("#employee_grid").bootgrid('reload');
				  }   
				});
			}
			
			$( "#command-add" ).click(function() {
			  $('#add_model').modal('show');
			});
			$( "#btn_add" ).click(function() {
			  ajaxAction('add');
			});
			$( "#btn_edit" ).click(function() {
			  ajaxAction('edit');
			});
});
</script>
