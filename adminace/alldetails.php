<?php include_once('views/header.php');?>
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
        <li class="active">Dashboard</li>
      </ol>
    </section>
<?php	if(isset($_GET['del'])){
					$id=$_GET['del'];
					$query="delete from aboutus where id='".mysqli_real_escape_string($conn,$id)."'";
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
      <div class="col-xs-12">
          <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Add Slide</h3>
              </div>
              <!-- /.box-header -->
                <div class="box-body">
                  <?Php global $msg; echo $msg;?>
				            <table id="example" class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                        <tr>
                          <th>Sr.</th>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Meta Title</th>
                          <th>Meta Description</th>
                          <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                       <?php 
                            //insert query//
                            $r="select * from aboutus";
                            $sr=1;
                            $result=mysqli_query($conn,$r) or die (mysql_error());
                            while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
                                $id=$row['id'];
                            	$title=$row['title'];
                            	$desc=$row['description'];
                            	$mtitle=$row['meta_title'];
                            	$mdesc=$row['meta_desc'];
                            	
                            ?>
                            <tr>
                              <td><?php echo $sr;?></td>
                              <td><?php echo $title;?></td>
                              <td><?php echo wordwrap($desc,35,"<br>\n");?></td>
                              <td><?php echo $mtitle;?></td>
                              <td><?php echo wordwrap($mdesc,35,"<br>\n");?></td>
                              <td>  <a href="editdetail.php?id=<?php echo $id; ?>">
            						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            						<button class="btn btn-success"><i class="fa fa-pencil-square-o"></i></button>
            						</a>
            						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
            						<button id="<?php echo $id; ?>" class="btn btn-danger delete" data-href="alldetails.php?del=" data-toggle="modal" data-target="#myModal"><i class="fa fa-times"></i></button></td>
                            </tr>
        				<?php $sr++;}?>

                        </tbody>
                   </table>
                   

                            <?php
                                    function getYoutubeImage($e){
                                    //GET THE URL
                                    $url = $e;
                            
                                    $queryString = parse_url($url, PHP_URL_QUERY);
                            
                                    parse_str($queryString, $params);
                            
                                    $v = $params['v'];  
                                    //DISPLAY THE IMAGE
                                    if(strlen($v)>0){
                                        echo "http://img.youtube.com/vi/$v/0.jpg";
                                    }
                                }
                            ?>
                            


                </div>
                <!-- /.box-body -->
                 <!-- Modal -->
                		<div class="modal modal-primary" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                			<div class="modal-dialog">
                				<div class="modal-content">
                					<div class="modal-header">
                						<button class="close" aria-label="Close" data-dismiss="modal" type="button">
                						<span aria-hidden="true">�</span>
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
            </div>
        
        <div class="clearfix"></div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php include_once('views/footer.php');?>

