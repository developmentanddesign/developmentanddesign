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
        <li>Videos</li>
        <li class="active">Add Videos</li>
      </ol>
    </section>
    
    <?php	if(isset($_GET['del'])){
					$id=$_GET['del'];
					$query="delete from videos where id='".mysqli_real_escape_string($conn,$id)."'";
					$run=mysqli_query($conn,$query);
					if($run){ $msg="<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
						<span class=\"bold\">Success: </span>  Video Deleted. </div>";
					}else{
						$msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
						<span class=\"bold\">Error: </span>  Sorry Failed. </div>"; 
					}
				}
    ?>
    
    <!-- Main content -->
    <section class="content">
      <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Video URL</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="video_form" action="ajax/videosajax.php" method="POST" enctype="multipart/form-data">
              <div class="box-body">
                <div id="result"><?php global $msg; echo $msg;?></div>
  					<div Class="form-group col-sm-4 title-height field">
  						<label for="title">Video Title</label>
  						<input type="hidden" name="form" value="add" class="form-control" required>
  						<input type="hidden" name="date" value="" id="localdate">
  						<input type="text" name="title" id="title" value=""  class="form-control"  required>
  					</div>
  					<div Class="form-group col-sm-4 field">
  						<label for="url">Video URL</label>
  						<input type="text" name="url" id="url" value="" class="form-control" required>
  					</div>
  					<div Class="form-group col-sm-4 btn-height">
  					  <input type="submit" name="submit" value="Submit" id="submit" class="btn btn-primary">
  					</div>
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
      					  <p>Video will be Deleted </p>
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
              <h3 class="box-title">All Videos</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body videodata">
                
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
  //get all videos 
    $.ajax({
        url: "views/allvideoajax.php",
        type: "POST",
        data: 'data',
        success: function(data) {
        $("#result").html('');
         $('.videodata').html(data);
        }
    });
//get all videos
</script>