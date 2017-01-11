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
					$query1="select * from slider where id='".mysqli_real_escape_string($conn,$id)."'";
					$run1=mysqli_query($conn,$query1);
					while($ro=mysqli_fetch_array($run1)){
						unlink('../images/'.$ro['image_name']);
					}
					$query="delete from slider where id='".mysqli_real_escape_string($conn,$id)."'";
					$run=mysqli_query($conn,$query);
					if($run){ $msg="<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
						<span class=\"bold\">Success: </span>  Slide Deleted. </div>";
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
                          <th>Image</th>
                          <th>Image ALT</th>
                          <th>Image Title</th>
                          <th>Detination URL</th>
        				  <th>Status</th>
        				  <th>Priority</th>
        				  <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                       <?php 
                            //insert query//
                            $r="select * from slider";
                            $result=mysqli_query($conn,$r) or die (mysql_error());
                            while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
                            	$id=$row['id'];
                            	$image_name=$row['image_name'];
                            	$image_alt=$row['image_alt'];
                            	$image_title=$row['image_title'];
                            	$status=$row['status'];
                            	$priority=$row['priority'];
                            	$destination_url=$row['destination_url'];
                            	
                            ?>
                        <tr>
                          <td><img src="../images/slides/<?php echo $image_name;?>" height="50px" width="50px" /></td>
                          <td><?php echo $image_alt;?></td>
        				  <td><?php echo $image_title;?></td>
        				  <td><?php echo $destination_url;?></td>
        				  <td><?php echo $status;?></td>
        				  <td><?php echo $priority;?></td>
                          <td>  <a href="editslide.php?id=<?php echo $id; ?>">
        						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        						<button class="btn btn-success"><i class="fa fa-pencil-square-o"></i></button>
        						</a>
        						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
        						<button id="<?php echo $id; ?>" class="btn btn-danger delete" data-toggle="modal" data-target="#myModal"><i class="fa fa-times"></i></button></td>
                        </tr>
        				<?php
        					}
        					?>
        
                        </tbody>
                   </table>
                </div>
                <!-- /.box-body -->
            </div>
        
        <div class="clearfix"></div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php include_once('views/footer.php');?>
<script src="js/functions.js"></script>
