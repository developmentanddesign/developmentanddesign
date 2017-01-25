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
        <li class="active">Disclaimer</li>
      </ol>
    </section>

<?php	if(isset($_GET['del'])){
					$id=$_GET['del'];
					$query="delete from disclaimer where id='".mysqli_real_escape_string($conn,$id)."'";
					$run=mysqli_query($conn,$query);
					if($run){ $msg="<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
						<span class=\"bold\">Success: </span>  Details Deleted. </div>";
					}else{
						$msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
						<span class=\"bold\">Error: </span>  Sorry Failed. </div>"; 
					}
				}
?>
    <!-- Main content -->
    <section class="content">
      <div class="col-xs-12 disclaimerform">
          <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Disclaimer Page Details</h3>
                <?php  $q="select * from disclaimer order by 1 desc limit 1";
                        $run=mysqli_query($conn,$q);
                        $submit="ture";
                        while($row=mysqli_fetch_array($run)){
                          $submit="false";
                    ?>
                  <button class="btn btn-warning pull-right" id="edit-disclaimer">Edit</button>
                <?php } ?>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form id="disclaimer_form" action="ajax/disclaimerajax.php" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                  <div id="result"><?php global $msg; echo $msg;?></div>
                      
                  <div class="col-sm-6">
          					<div Class="form-group">
          						<label for="title">Title</label>
          						<input type="text" name="title" id="title" value="Disclaimer" class="form-control" disabled title="Already Filled"  required>
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
        						<p>Confirm Delete</p>
        					</div>
        					<div class="modal-footer">
        						<button class="btn btn-outline pull-left" data-dismiss="modal" type="button">No</button>
        						<a href="" class="del-confirm"><button class="btn btn-outline" type="button">Yes</button></a>
        					</div>
        				</div>
        			</div>
        		</div>
      		<!-- /Modal -->
      		
            <div class="col-xs-12">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">All Disclaimer Page Entries</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body disclaimerdata">
                  
                </div>
                    
                    
              </div>
            </div>  
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- /.content -->
   
  <!-- /.content-wrapper -->
  
<?php include_once('views/footer.php');?>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script src="js/disclaimer.js"></script>
