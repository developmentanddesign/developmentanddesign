<?php include_once('views/header.php');?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.6/css/fileinput.css" />
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
        <li class="active">Add Images</li>
      </ol>
    </section>
    
<?php	if(isset($_GET['del'])){
			   	$id=$_GET['del'];
					$query1="select * from albumimages where id='".mysqli_real_escape_string($conn,$id)."'";
					$run1=mysqli_query($conn,$query1);
					while($ro=mysqli_fetch_array($run1)){
						unlink('../images/albumimages/'.$ro['image']);
					}
					$query="delete from albumimages where id='".mysqli_real_escape_string($conn,$id)."'";
					$run=mysqli_query($conn,$query);
					if($run){ $msg="<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
						<span class=\"bold\">Success: </span>  Image Deleted. </div>";
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
                <h3 class="box-title">Album Images </h3>
                <button class="btn btn-warning pull-right" id="add-imgs">Add Images</button>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form id="albums_form" action="ajax/albumajax.php" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                  <div id="result"><?php global $msg; echo $msg;?></div>
                  <div Class="form-group col-sm-6">
                    <label class="control-label" id="selectbox">Select Album</label>
                    <input type="hidden" name="form" value="addimages">
        						<input type="hidden" name="date" value="" id="localdate">
              			<select class="select2 form-control" name="album" id="filter">
              			  <?php $getid=$_GET['id']; ?> 
              			    <option value="">All</option>
              			    <?php $p="select * from albums";
              			          $run=mysqli_query($conn,$p);
              			          while($row=mysqli_fetch_array($run)){ ?>
                                      <option value="<?php echo $row['id'];?>" <?php if($getid==$row['id']){ echo "selected='selected'";} ?>><?php echo $row['title'];?></option>
              			     <?php  } ?>
              			</select>		
                  </div>
                  <div Class="form-group col-sm-12 custom-dropbox">
                    <label class="control-label">Select Images</label>
                    <input id="file-5" class="file" type="file" name="images[]" multiple data-preview-file-type="any" data-upload-url="#">
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <input type="submit" name="submit" value="Submit" class="btn btn-primary custom-submit">
                </div>
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
      					  <p>Image will be Deleted </p>
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
              <h3 class="box-title">All Images</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="cssload-whirlpool"></div>
            <div class="box-body imagesdata album-box">
                
            </div>
          </div>
        </div>
      
      <div class="clearfix"></div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script src="plugins/fileinput/fileinput.min.js"></script>
<script src="plugins/fileinput/theme.min.js"></script>
<?php include_once('views/footer.php');?>

<script> 
  setInterval(localdate(), 1000);
</script>