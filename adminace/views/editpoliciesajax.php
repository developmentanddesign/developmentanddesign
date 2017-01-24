<?php
require_once('../config/config.php');
if(isset($_POST['edit'])){ 
    $p="select * from policies";
    $run=mysqli_query($conn,$p);
    while($row=mysqli_fetch_array($run)){
        $title=$row['title'];
        $desc=$row['description'];
        $mtitle=$row['meta_title'];
        $mdesc=$row['meta_desc'];
    }
?>
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Privacy Policies Page Details</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form id="update" action="ajax/policiesajax.php" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                     <div id="result"><?php global $msg; echo $msg;?></div>
                      
                    <div class="col-sm-6">
    					<div Class="form-group">
    						<label for="title">Title</label>
    						<input type="text" name="title" id="title" value="Privacy Policies" class="form-control" disabled title="Already Filled"  required>
    						<input type="hidden" name="form" value="update" class="form-control" required>
    					</div>
    					<div Class="form-group">
    						<label for="editor1">Description</label>
    			            <textarea id="editor1" name="description" rows="10" cols="80" title="Please Fill out This Field" required><?php echo $desc;?></textarea>
    					</div>
    				</div>
    				<div class="col-sm-6">
    					<div Class="form-group">
    						<label for="mtitle">Meta Title</label>
    						<input type="text" name="mtitle" id="mtitle" value="<?php echo $mtitle;?>" title="Please Fill out This Field" class="form-control" required>
    					</div>
    					<div Class="form-group">
    						<label for="mdesc">Meta Description</label>
    						<textarea id="mdesc" name="mdesc" rows="5" class="form-control" cols="30" title="Please Fill out This Field" required><?php echo $mdesc;?></textarea>
    					</div>
                    </div>
                </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                      <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                    </div>
                        <!-- /.box-footer -->
                  </form>
                </div>
<script>
    // form submition for adding about details
        $("#update").submit(function(event){
            event.preventDefault(); //prevent default action 
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
            var post_url = $(this).attr("action"); //get form action url
            var request_method = $(this).attr("method"); //get form GET/POST method
            var formData = new FormData($(this)[0]); //Encode form elements for submission
            $.ajax({
                url : post_url,
                type: request_method,
                data : formData,
                processData: false,
                contentType: false
            }).done(function(response){ //
                $("#result").html(response);
                $('#mtitle').val('');
                $('#editor1').val('');
                $('#mdesc').val('');
                $.ajax({
                    url: "views/allpoliciesajax.php",
                    type: "POST",
                    data: 'data',
                    success: function(data) {
                     $('.policiesdata').html(data);
                    }
                });
                $.ajax({
                    url: "views/editpoliciesajax.php",
                    type: "POST",
                    data: 'data',
                    success: function(data) {
                     $('.policiesform').html(data);
                    }
                });
            
            });
        });
    // form submition for adding about details
</script>
<?php }else{ ?>
        <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Privacy Policies Page Details</h3>
                <?php  $q="select * from policies order by 1 desc limit 1";
                        $run=mysqli_query($conn,$q);
                        $submit="ture";
                        while($row=mysqli_fetch_array($run)){
                          $submit="false";
                    ?>
                  <button class="btn btn-warning pull-right" id="edit-policies">Edit</button>
                <?php } ?>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form id="policies_form" action="ajax/policiesajax.php" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                  <div id="result"><?php global $msg; echo $msg;?></div>
                      
                  <div class="col-sm-6">
          					<div Class="form-group">
          						<label for="title">Title</label>
          						<input type="text" name="title" id="title" value="Privacy Policies" class="form-control" disabled title="Already Filled"  required>
          						<input type="hidden" name="form" value="add" class="form-control" required>
          					</div>
          					<div Class="form-group">
          						<label for="editor1">Description</label>
          			            <textarea id="editor1" name="description" rows="10" cols="80" title="Please Fill out This Field" required></textarea>
          					</div>
          				</div>
          				<div class="col-sm-6">
          					<div Class="form-group">
          						<label for="mtitle">Meta Title</label>
          						<input type="text" name="mtitle" id="mtitle" value="" title="Please Fill out This Field" class="form-control"  required>
          					</div>
          					<div Class="form-group">
          						<label for="mdesc">Meta Description</label>
          						<textarea id="mdesc" name="mdesc" rows="5" class="form-control" cols="30" title="Please Fill out This Field" required></textarea>
          					</div>
                          </div>
                      </div>
                          <!-- /.box-body -->
                          <div class="box-footer">
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary" <?php if($submit=="false"){ echo "disabled";}?>>
                          </div>
                              <!-- /.box-footer -->
                        </form>
                      </div>
<script>
// form submition for adding about details
    $("#policies_form").submit(function(event){
        event.preventDefault(); //prevent default action 
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        var post_url = $(this).attr("action"); //get form action url
        var request_method = $(this).attr("method"); //get form GET/POST method
        var formData = new FormData($(this)[0]); //Encode form elements for submission
        $.ajax({
            url : post_url,
            type: request_method,
            data : formData,
            processData: false,
            contentType: false
        }).done(function(response){ //
            $("#result").html(response);
            $('#mtitle').val('');
            $('#editor1').val('');
            $('#mdesc').val('');
            $.ajax({
                url: "views/allpoliciesajax.php",
                type: "POST",
                data: 'data',
                success: function(data) {
                 $('.policiesdata').html(data);
                 // html Editor
                 CKEDITOR.replace('editor1');
                }
            });
        
        });
    });
    // form submition for adding about details
    
    $('#edit-policies').click(function(){
        $.ajax({
                url: "views/editpoliciesajax.php",
                type: "POST",
                data: {edit:edit},
                success: function(data) {
                 $('.policiesform').html(data);
                 
                 // html Editor
                 CKEDITOR.replace('editor1');
                 
                }
            });
    });
    
                 // html Editor
                 CKEDITOR.replace('editor1');
</script>
<?php }?>