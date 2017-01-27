<?php include_once('views/header.php');?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        ACE Channel
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Albums</li>
        <li class="active">Add Albums</li>
      </ol>
    </section>
    
    <?php	if(isset($_GET['del'])){
    					$id=$_GET['del'];
    					$query1="select * from albums where id='".mysqli_real_escape_string($conn,$id)."'";
    					$run1=mysqli_query($conn,$query1);
    					while($ro=mysqli_fetch_array($run1)){
    						unlink('../images/albumcover/'.$ro['cover']);
    						$q1="select * from albumimages where parent_id=$id";
    						$run2=mysqli_query($conn,$q1);
    						while($ro1=mysqli_fetch_array($run2)){
    						  unlink('../images/albumimages/'.$ro1['image']);
    						}
    						$q2="delete from albumimages where parent_id='".mysqli_real_escape_string($conn,$id)."'";
    				    $run=mysqli_query($conn,$q2);
    					}
    					$query="delete from albums where id='".mysqli_real_escape_string($conn,$id)."'";
    					$run=mysqli_query($conn,$query);
    					if($run){ $msg="<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
    						<span class=\"bold\">Success: </span>  Album Deleted. </div>";
    					}else{
    						$msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
    						<span class=\"bold\">Error: </span>  Sorry Failed. </div>"; 
    					}
    				}
    ?>
    <!-- Main content -->
    <section class="content">
      <div class="form-box col-xs-12">
        <div class="cssload-whirlpool1"></div>
        <div class="box box-info addform">
              <div class="box-header with-border">
                <h3 class="box-title">Add Albums</h3>
                <button class="btn btn-warning pull-right" id="add-album">Add Album</button>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form id="albums_form" action="ajax/albumajax.php" method="POST" enctype="multipart/form-data">
                <div class="box-body custom-form">
                  <div id="result"><?php global $msg; echo $msg;?></div>
                  <div class="col-sm-6 no-padding">
          					<div Class="form-group col-sm-12">
          						<label for="title">Album Title</label>
          						<input type="hidden" name="form" value="addalbum">
          						<input type="hidden" name="date" value="" id="localdate">
          						<div class="field">
          						  <input type="text" name="title" id="title" value="" class="form-control" required>
          						</div>
          					</div>
          					<div Class="form-group col-sm-12">
          						<label for="desc">Album Cover</label>
          						<div class="input-group image-preview">
                          <input id="coverinput" type="text" class="form-control image-preview-filename" disabled="disabled" title="Please Browse an Image"> <!-- don't give a name === doesn't send on POST/GET -->
                          <span class="input-group-btn">
                              <!-- image-preview-clear button -->
                              <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                  <span class="glyphicon glyphicon-remove"></span> Clear
                              </button>
                              <!-- image-preview-input -->
                              <div class="btn btn-default field image-preview-input">
                                  <span class="glyphicon glyphicon-folder-open"></span>
                                  <span class="image-preview-input-title">Browse</span>
                                  <input id="coverimg" type="file" accept="image/png, image/jpeg, image/gif" name="cover" required/> <!-- rename it -->
                              </div>
                          </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 no-padding">
                    <div Class="form-group col-sm-12">
          						<label for="mtitle">Meta Title</label>
          						<div class="field">
          						  <input type="text" name="mtitle" id="mtitle" class="form-control" required>
          						</div>
        					  </div>
        					  <div Class="form-group col-sm-12">
          						<label for="mdesc">Meta Description</label>
          						<div class="field">
          						  <textarea name="mdesc" id="mdesc" class="form-control" required></textarea>
          						</div>
        					  </div>
        					</div>
        					</div>
                  <div class="box-footer custom-form">
                    <input type="submit" id="submit" name="submit" value="Submit" class="btn btn-primary">
                  </div>
                <!-- /.box-body -->
              </form>
      </div>

      </div>
       <!-- Modal -->
      		<div class="modal modal-primary" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      			<div class="modal-dialog">
      				<div class="modal-content">
      					<div class="modal-header">
      						<button class="close" aria-label="Close" data-dismiss="modal" type="button">
      						<span aria-hidden="true">&times</span>
      						</button>
      						<h4 class="modal-title">Confirmation</h4>
      					</div>
      					<div class="modal-body">
      					  <p>All Album Images will be Deleted </p>
      						<p> Confirm Delete </p>
      					</div>
      					<div class="modal-footer">
      						<button class="btn btn-outline pull-left" data-dismiss="modal" type="button">No</button>
      						<a href="" class="del-confirm"><button class="btn btn-outline" type="button">Yes</button></a>
      					</div>
      				</div>
      			</div>
      		</div>
    		<!-- /Modal -->
            
      <div class="col-sm-12 col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">All Albums</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="cssload-whirlpool"></div>
            <div class="box-body albumdata album-box">
            </div>
          </div>
      </div>
              
      <div class="clearfix"></div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php include_once('views/footer.php');?>
<script>
    //get all albums 
    $.ajax({
            url: "views/allalbumsajax.php",
            type: "POST",
            data: 'data',
            beforeSend: function(){
                 $('.cssload-whirlpool').show();
                 $('.album-box').fadeTo(0,0.1);
             },
            success: function(data) {
            $("#result").html('');
             $('.albumdata').delay(2000).html(data);
             $('.cssload-whirlpool').delay(2000).fadeOut();
             $('.album-box').delay(2000).fadeTo(0, 1);
            }
        });
    //get all albums
</script>