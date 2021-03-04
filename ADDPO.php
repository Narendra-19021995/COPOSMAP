<?php
require 'index.php';
?> 
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
     <link rel="stylesheet" href="bootstrap.min.css" />
     <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
   <div class="container">
   <h3 class="text-center">Add Program Objective</h3>
   <!-- <div align="left" class="col-md-2 mb-2">
   <input type="text" name="coid" id="coid" value="" class="form-control input-group">
   </div> -->
   <div align="right" style="margin-bottom:5px;">
    <button type="button" name="add" id="add" class="btn btn-success btn-xs">Add</button>
   </div>
   <br />
   <div align="center">
   
   <form method="post" id="user_form">
    <div class="table-responsive">
     <table class="table table-striped table-bordered" id="user_data">
      <tr>
       <th>Subject</th>
       <th>PO NO</th>
       <th>GC</th>
       <th>PI</th>
       <th>Edit</th>
       <th>Remove</th>
      </tr>
     </table>
    </div>
    <div align="center">
     <input type="submit" name="insert" id="insert" class="btn btn-primary" value="Submit" />
    </div>
   </form>
   </div>

   <br />
  </div>
  <div id="user_dialog" title="Add Data">
   <div class="form-group">
    <label>Enter Subject Name</label>
    <input type="text" name="s_name" id="s_name" class="form-control" />
    <span id="error_s_name" class="text-danger"></span>
   </div>
   <div class="form-group">
    <label>Enter PO No</label>
    <input type="text" name="po" id="po" class="form-control" />
    <span id="error_po" class="text-danger"></span>
   </div>

   <div class="form-group">
    <label>Enter GC</label>
    <input type="text" name="gi" id="gi" class="form-control" />
    <span id="error_gi" class="text-danger"></span>
   </div>

   <div class="form-group">
    <label>Enter PI</label>
    <input type="text" name="pi" id="pi" class="form-control" />
    <span id="error_pi" class="text-danger"></span>
   </div>

   <div class="form-group" align="center">
    <input type="hidden" name="row_id" id="hidden_row_id" />
    <button type="button" name="save" id="save" class="btn btn-info">Save</button>
   </div>
  </div>
  <div id="action_alert" title="Action">

  </div>

<script>  
$(document).ready(function(){ 
 
 var count = 0;

 $('#user_dialog').dialog({
  autoOpen:false,
  width:400
 });

 $('#add').click(function(){
  $('#user_dialog').dialog('option', 'title', 'Add Data');
  $('#s_name').val('');
  $('#po').val('');
  $('#gi').val('');
  $('#pi').val('');
  $('#error_s_name').text('');
  $('#error_po').text('');
  $('#error_gi').text('');
  $('#error_pi').text('');
  $('#s_name').css('border-color', '');
  $('#po').css('border-color', '');
  $('#gi').css('border-color', '');
  $('#pi').css('border-color', '');
  $('#save').text('Save');
  $('#user_dialog').dialog('open');
 });

 $('#save').click(function(){
  var error_s_name = '';
  var error_po = '';
  var error_gi = '';
  var error_pi = '';
  var s_name = '';
  var po = '';
  var gi = '';
  var pi = '';
  if($('#s_name').val() == '')
  {
   error_s_name = 'Subject is required';
   $('#error_s_name').text(error_s_name);
   $('#s_name').css('border-color', '#cc0000');
   s_name = '';
  }
  else
  {
   error_s_name = '';
   $('#error_s_name').text(error_s_name);
   $('#s_name').css('border-color', '');
   s_name = $('#s_name').val();
  } 
  if($('#po').val() == '')
  {
   error_po = 'PO NO is required';
   $('#error_po').text(error_po);
   $('#po').css('border-color', '#cc0000');
   po = '';
  }
  else
  {
   error_po = '';
   $('#error_po').text(error_po);
   $('#po').css('border-color', '');
   po = $('#po').val();
  }
  if($('#gi').val() == '')
  {
   error_gi = 'GC is required';
   $('#error_gi').text(error_gi);
   $('#gi').css('border-color', '#cc0000');
   gi = '';
  }
  else
  {
   error_gi = '';
   $('#error_gi').text(error_gi);
   $('#gi').css('border-color', '');
   gi = $('#gi').val();
  }

if($('#pi').val() == '')
  {
   error_pi = 'PI is required';
   $('#error_pi').text(error_gi);
   $('#pi').css('border-color', '#cc0000');
   pi = '';
  }
  else
  {
   error_pi = '';
   $('#error_pi').text(error_pi);
   $('#pi').css('border-color', '');
   pi = $('#pi').val();
  }

  if(error_s_name != '' || error_po != ''|| error_gi != ''||error_pi != '' )
  {
   return false;
  }
  else
  {
   if($('#save').text() == 'Save')
   {
    count = count + 1;
    output = '<tr id="row_'+count+'">';
    output += '<td>'+s_name+' <input type="hidden" name="hidden_s_name[]" id="s_name'+count+'" class="s_name" value="'+s_name+'" /></td>';
    output += '<td>'+po+' <input type="hidden" name="hidden_po[]" id="po'+count+'" value="'+po+'" /></td>';
    output += '<td>'+gi+' <input type="hidden" name="hidden_gi[]" id="gi'+count+'" value="'+gi+'" /></td>';
    output += '<td>'+pi+' <input type="hidden" name="hidden_pi[]" id="pi'+count+'" value="'+pi+'" /></td>';
    output += '<td><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="'+count+'">Edit</button></td>';
    output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="'+count+'">Remove</button></td>';
    output += '</tr>';
    $('#user_data').append(output);
   }
   else
   {
    var row_id = $('#hidden_row_id').val();
    output = '<td>'+s_name+' <input type="hidden" name="hidden_s_name[]" id="s_name'+row_id+'" class="s_name" value="'+s_name+'" /></td>';
    output += '<td>'+po+' <input type="hidden" name="hidden_po[]" id="po'+row_id+'" value="'+po+'" /></td>';
    output += '<td>'+gi+' <input type="hidden" name="hidden_gi[]" id="gi'+row_id+'" value="'+gi+'" /></td>';
    output += '<td>'+pi+' <input type="hidden" name="hidden_pi[]" id="pi'+row_id+'" value="'+pi+'" /></td>';
    output += '<td><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="'+row_id+'">Edit</button></td>';
    output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="'+row_id+'">Remove</button></td>';
    $('#row_'+row_id+'').html(output);
   }

   $('#user_dialog').dialog('close');
  }
 });

 $(document).on('click', '.view_details', function(){
  var row_id = $(this).attr("id");
  var s_name = $('#s_name'+row_id+'').val();
  var po = $('#po'+row_id+'').val();
  var gi = $('#gi'+row_id+'').val();
  var pi = $('#pi'+row_id+'').val();
  $('#s_name').val(s_name);
  $('#po').val(po);
  $('#gi').val(gi);
  $('#pi').val(pi);
  $('#save').text('Edit');
  $('#hidden_row_id').val(row_id);
  $('#user_dialog').dialog('option', 'title', 'Edit Data');
  $('#user_dialog').dialog('open');
 });

 $(document).on('click', '.remove_details', function(){
  var row_id = $(this).attr("id");
  if(confirm("Are you sure you want to remove this row data?"))
  {
   $('#row_'+row_id+'').remove();
  }
  else
  {
   return false;
  }
 });

 $('#action_alert').dialog({
  autoOpen:false
 });

 $('#user_form').on('submit', function(event){
  event.preventDefault();
  var count_data = 0;
  $('.s_name').each(function(){
   count_data = count_data + 1;
  });
  if(count_data > 0)
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:"insertpo.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     $('#user_data').find("tr:gt(0)").remove();
     $('#action_alert').html('<p>Data Inserted Successfully</p>');
     $('#action_alert').dialog('open');
    }
   })
  }
  else
  {
   $('#action_alert').html('<p>Please Add atleast one data</p>');
   $('#action_alert').dialog('open');
  }
 });
 
});  
</script>
