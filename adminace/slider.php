<?php include_once('views/header.php');?>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
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
        <li class="active">Slider</li>
      </ol>
    </section>

<?php	if(isset($_GET['del'])){
			$id=$_GET['del'];
			$q1="select * from slider where id='".mysqli_real_escape_string($conn,$id)."'";
			$run1=mysqli_query($conn,$q1);
			while($row=mysqli_fetch_array($run1)){
			  unlink('../images/slides/'.$row['image_name']);
			}
			$query="delete from slider where id='".mysqli_real_escape_string($conn,$id)."'";
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
          <div class="col-xs-12">
          <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Sliders</h3>
                <div id="result"><?php global $msg; echo $msg;?></div>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
                <div class="box-body">
                  
                  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-default">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            Add Slide
                        </h4>
                      </div>
                    </a>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body slidersform">
                        <div class="box box-info">
                          <form id="sliderform" action="ajax/sliderajax.php" method="POST" enctype="multipart/form-data">
                            <div class="box-body">
                           <div class="col-sm-6">
                  					<div Class="form-group">
                                <label for="desc">Slide Image *</label>
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
                                          <input id="image_name" type="file" accept="image/*" name="image_name" required/> <!-- rename it -->
                						              <input type="hidden" name="form" value="add" class="form-control">
                                      </div>
                                  </span>
                                </div>
                              </div>
                    				<div Class="form-group">
                    					<label for="image_alt">Image ALT *</label>
                    					<input type="text" name="image_alt" id="image_alt" value="" class="form-control" required>
                    				</div>
                    				<div Class="form-group">
                    					<label for="image_title">Image Title *</label>
                    					<input type="text" name="image_title" id="image_title" value="" class="form-control" required>
                    				</div>
                    				<div Class="form-group">
                    					<label for="image_cap">Caption</label>
                    					<input type="text" name="image_caption" id="image_cap" value="" class="form-control">
                    					<i><small>Optional</small></i>
                    				</div>
                         </div>
            				     <div class="col-sm-6">
                    				<div Class="form-group">
                    					<label for="btn_text">Button Text</label>
                    					<input type="text" name="btn_text" id="btn_text" value="" placeholder="Optional" class="form-control">
                    				</div>
                    				<div Class="form-group">
                    					<label>Date range:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" name="range" id="range">
                              </div>
                    				</div>
                    				<div Class="form-group col-md-6 no-padding">
                    					<label for="status" class="col-xs-12 no-padding">Status: *</label>
                    					<div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-sm btn-success active statusbtn1">
                                  <input type="radio" name="status" id="status" value="1" autocomplete="off" checked> Active
                                </label>
                                <label class="btn btn-sm statusbtn2 btn-default">
                                  <input type="radio" name="status" id="status" value="0" autocomplete="off"> Inactive
                                </label>
                              </div>
                    				</div>
                    				<div Class="form-group col-md-6 no-padding">
                    					<label for="status" class="col-xs-12 no-padding">Timer: *</label>
                    					<div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-sm btn-success active timerbtn1">
                                  <input type="radio" name="timer" id="status" value="1" autocomplete="off" checked> Active
                                </label>
                                <label class="btn btn-sm timerbtn2 btn-default">
                                  <input type="radio" name="timer" id="status" value="0" autocomplete="off"> Inactive
                                </label>
                              </div>
                    				</div>
                    				<div Class="form-group">
                    					<label for="destination_url">Destination URL</label>
                    					<input type="text" name="destination_url" id="destination_url" placeholder="Optional" value="" class="form-control">
                    				</div>
                          </div>
                            </div>
                            <div class="box-footer">
                              <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                            </div>
                                  <!-- /.box-footer -->
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      <div class="panel-heading" role="tab" id="headingTwo">
                      <h4 class="panel-title">
                          Priority
                      </h4>
                      </div>
                    </a>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                      <div class="panel-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                            All Slides
                        </h4>
                      </div>
                    </a>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                      <div class="panel-body">
                        <div class="col-xs-12">
                          <div class="box box-info">
                            <div class="box-header with-border">
                              <h3 class="box-title">All Slides</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="cssload-whirlpool"></div>
                            
                            <div class="box-body sliderdata album-box">
                              
                            </div>
                                
                          </div>
                        </div> 
                      </div>
                    </div>
                  </div>
                </div>
  
                </div>
                      <!-- /.box-body -->
                
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
      		
             
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- /.content -->
   
  <!-- /.content-wrapper -->
  
<?php include_once('views/footer.php');?>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script src="js/slider.js"></script>
