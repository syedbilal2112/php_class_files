<!DOCTYPE html>
<html>
<head>
	<title></title>
		<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <?php $id=$_GET['id'];
    
    include 'conn.php';

  $query="SELECT * FROM `users` where id='$id'";
  $result=mysqli_query($con,$query);
  $json_data=array();
  while($row=mysqli_fetch_assoc($result)){
    $name=$row['name'];
    $email=$row['email'];
    $profile_pic=$row['profile_pic'];
  }
  
  ?>
    <form>
      <input type="hidden" name="id" value="<?php echo $id?>" id="id">
  <label>Enter Name</label>
  <input  class="form-control" type="text" id="name" name="name" value="<?php echo $name?>"><br>

  <label>Enter Email</label>
  <input  class="form-control" type="email" id="email" name="email" value="<?php echo $email?>"><br>
  <button type="button" id="btn">Update</button>
</form>
  <img src="<?php echo $profile_pic?>" id="profile_pic" width="150px" height="150px" style="border-radius: 50%">
    <input type="file" name="files[]" id="file" accept=".pdf" required/>
    <br>
     <button type="button" id="upload_profile_pic" class="btn btn-primary ">Update Pic</button>
<table class="table" id="history_display">
    <thead>
     <th>ID</th>
      <th>Name</th>
      <th>email</th>
      <th>Password</th>
      <!-- <th>Action</th> -->
    </thead>
</table>

<script type="text/javascript">
	$(function(){
               $('#file').on('change', function () {
                    var file_data = $('#file').prop('files')[0];
                    var form_data = new FormData();
                    form_data.append('file', file_data);
                    $.ajax({
                        url: 'upload.php', // point to server-side PHP script 
                        dataType: 'text', // what to expect back from the PHP script
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function (response) {
                        
                            alert(response)
                            document.getElementById("profile_pic").src=response;
                            x=response;

                           
                        },
                        error: function (response) {
                          
                           alert(response);
                        }
                    });
               });
    $('#upload_profile_pic').on('click', function () {

               
                  var id=$("#id").val();
                  var profile=x;
                   
                        $.ajax({
                            url:"update_profile_pic.php",
                            type:"post",
                            data:{
                                "id":id,
                                "profile":profile
                            },
                            success:function(data){
                              alert(data);
                             // window.reload();   
                              },
                              error:function(){
                                alert(';hi');
                              }
                });
           
      });
    $('#btn').click(function(){

      var a=document.getElementById('name').value;
      var b=document.getElementById('email').value;
      var c=document.getElementById('id').value;
      alert(a+b+c)
      $.ajax({
        url:'update.php',
        type:'post',
        data:{
          "name":a,
          "email":b,
          "id":c
        },
        success:function(){
          alert('row added Updated')
        },
        error:function(){
          alert('something went wrong')
        }
      })
    })

			$.ajax({
				url:'view.php',
				type:'get',
				data:{

				},
				success: function(response){
					var obj=JSON.parse(response);

                        var table_content=""
                        $('#history_display').find( 'tr:not(:first)' ).remove();
                        $.each(obj,function(index,value){
                            table_content+="<tr>";
                            table_content+="<td>"+value.id+"</td>";
                            table_content+="<td>"+value.name+"</td>";
                            table_content+="<td>"+value.email+"</td>";
                            table_content+="<td>"+value.password+"</td>";
  table_content+="<td><a class='btn btn-primary' href='edit.php?id="+value.id+"'>Edit</a></td>";
                            table_content+="</tr>";
                        });
                        $("#history_display").append(table_content);
				},
				error: function(){
					alert('Something went wrong');
				}
			})
		})
		
</script>
</body>
</html>