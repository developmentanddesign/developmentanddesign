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
        <li class="active">Articles</li>
      </ol>
    </section>

<?php	if(isset($_GET['del'])){
					$id=$_GET['del'];
					$query="delete from articles where id='".mysqli_real_escape_string($conn,$id)."'";
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
      <div class="form-box col-xs-12 no-padding">
        <div class="cssload-whirlpool1"></div>
        <div class="col-xs-12 articlesform">
          <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Articles</h3>
                <div id="result"><?php global $msg; echo $msg;?></div>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form id="articles_form" action="ajax/articlesajax.php" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                      
                  <div class="col-sm-12">
          					<div Class="form-group field">
          						<label for="title">Title</label>
          						<input type="text" name="title" id="title" class="form-control" title="Article Title">
          						<input type="hidden" name="form" value="add" class="form-control" required>
        						<input type="hidden" name="date" value="" id="localdate">
          					</div>
          					<div Class="form-group field">
          						<label>Article Content</label>
          			      <textarea name="content" class="t" rows="10" cols="80" title="Article Content"></textarea>
          					</div>
          					<div Class="form-group field">
          						<label for="mtitle">Meta Title</label>
          						<input type="text" name="mtitle" id="mtitle" class="form-control" title="Meta Title" required>
          					</div>
          					<div Class="form-group field">
          						<label for="mdesc">Meta Description</label>
          						<textarea name="mdesc" rows="5" cols="20" class="form-control noresize" title="Meta Description" required></textarea>
          					</div>
          				</div>
          			
              </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <input type="submit" name="submit" value="Submit" class="btn btn-primary" id="submit">
                  </div>
                      <!-- /.box-footer -->
                </form>
              </div>
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
                  <h3 class="box-title">All Articles</h3>
                </div>
                <!-- /.box-header -->
                <div class="cssload-whirlpool"></div>
                <div class="box-body articlesdata album-box">
                  
                </div>
                    
                    
              </div>
            </div>  
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- /.content -->
   
  <!-- /.content-wrapper -->
  
<?php include_once('views/footer.php');?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.2/tinymce.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.2/jquery.tinymce.min.js"></script>
<script src="js/articles.js"></script>
