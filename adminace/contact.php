<?php include_once('views/header.php');?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/css/inputmask.min.css" />
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        ACEChannel
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>About Us</li>
        <li class="active">Add Details</li>
      </ol>
    </section>
    
    <?php	if(isset($_GET['del'])){
					$id=$_GET['del'];
					$query="delete from contacts where id='".mysqli_real_escape_string($conn,$id)."'";
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
      <div class="col-xs-12 contactform">
          <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Contact Information</h3>
                <?php  $q="select * from contacts";
                        $run=mysqli_query($conn,$q);
                        $submit="ture";
                        while($row=mysqli_fetch_array($run)){
                          $submit="false";
                    ?>
                  <button class="btn btn-warning pull-right" id="edit-contact">Edit</button>
                <?php } ?>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form id="contact_form" action="ajax/contactajax.php" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                  <div id="result"><?php global $msg; echo $msg;?></div>
                  <div class="col-sm-6">
                      <div Class="form-group">
            						<label for="title">Title</label>
            						<input type="text" name="title" id="title" value="Contact Us" placeholder="Contact Us" class="form-control" title="Already Filled" disabled>
            						<input type="hidden" name="form" id="form" value="add" class="form-control">
            					</div>
            					<div Class="form-group">
            						<label for="address">Address</label>
            			     <textarea id="address" name="address" rows="4" cols="50" class="form-control" title="Please Fill out This Field" required></textarea>
            					</div>
            					<div Class="form-group">
            						<div class="col-xs-4 col-sm-5 no-left-padding no-right-padding">
            						  <label for="ccode">Country Code</label>
            						  <select class="select4 form-control" name="ccode" id="ccode" required>
                  			    <option value="">Select One</option>
                  			    <?php $p="select * from codes";
                  			          $run=mysqli_query($conn,$p);
                  			          while($row=mysqli_fetch_array($run)){ ?>
                                      <option value="<?php echo $row['code'];?>"><?php echo $row['code'];?></option>
                  			     <?php  } ?>
                			    </select>		
            						</div>
            						<div class="col-xs-8 col-sm-7 no-right-padding">
            						   <label for="ccode1">Mobile No.</label>
            						   <input type="text" id="mobile" class="form-control" name="mobile" pattern="[0-9]{10}" required>
            					  </div>
            					</div>
            					<div Class="form-group">
            						<div class="col-xs-6 col-sm-4 no-left-padding no-right-padding">
            						  <label for="ccode1">Country Code</label>
            						  <select class="select4 form-control" name="ccode1" id="ccode1">
                  			    <option value="">Select One</option>
                  			    <?php $p="select * from codes";
                  			          $run=mysqli_query($conn,$p);
                  			          while($row=mysqli_fetch_array($run)){ ?>
                                      <option value="<?php echo $row['code'];?>"><?php echo $row['code'];?></option>
                  			     <?php  } ?>
                			    </select>		
            						</div>
            						<div class="col-xs-6 col-sm-4 no-right-padding">
            						  <label for="areacode">Area Code</label>
            			        <input type="text" class="form-control" name="areacode" id="areacode">
            						</div>
            						<div class="col-xs-12 col-sm-4 no-right-padding">
            						   <label for="phone">Phone No.</label>
            			         <input type="text" class="form-control" name="phone" id="phone">
            						</div>
            					</div>
            					<div Class="form-group">
            						<label for="email">Email</label>
            			       <input type="email" class="form-control" name="email" id="email" required>
            					</div>
          				</div>
          				<div class="col-sm-6">
          					<div Class="form-group">
          						<label for="country">Select Country</label>
          						<select class="select3 form-control" name="country" id="country" onchange="countrydata('#country','states',$('#country').val(),'ajax/contactajax.php','.states')" required>
                			    <option value="">Select One</option>
                			    <?php $p="select * from countries";
                			          $run=mysqli_query($conn,$p);
                			          while($row=mysqli_fetch_array($run)){ ?>
                                    <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                			     <?php  } ?>
                			</select>		
          					</div>
          					<div Class="form-group states">
          						<label for="state">Select State</label>
          						<select class="select4 form-control" name="state" id="state" disabled>
                        	<option value="">Select One</option>
                			    <?php $p="select * from states";
                			          $run=mysqli_query($conn,$p);
                			          while($row=mysqli_fetch_array($run)){ ?>
                                    <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                			     <?php  } ?>
                      </select>	
          					</div>
          					<div Class="form-group cities">
          						<label for="city">Select City</label>
          						<select class="select5 form-control" name="city" id="city" disabled>
                        	<option value="" selected="selected">Select One</option>
                			    <?php $p="select * from cities";
                			          $run=mysqli_query($conn,$p);
                			          while($row=mysqli_fetch_array($run)){ ?>
                                    <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                			     <?php  } ?>
                			 </select>	
          					</div>
          					<div Class="form-group">
            						<label for="pin">Pin Code</label>
            						<input type="text" name="pin" id="pin" value="" placeholder="Pin Code" class="form-control" title="Pin Code" required>
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
      <div class="col-sm-12 col-xs-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">All Fields</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <div class="box-body contactdata">
              
          </div>
        </div>
      </div>
            
      <div class="clearfix"></div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
  <!-- /.content-wrapper -->
  
<?php include_once('views/footer.php');?>
<script src="plugins/inputmask/jquery.inputmask.js"></script>
<script src="plugins/inputmask/jquery.inputmask.extensions.js">$("[data-mask]").inputmask();</script>
<script src="js/contact.js"></script>

