<?php include_once('views/header.php');?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker3.standalone.min.css" />
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
<?php

if(isset($_POST['submit'])){
			if($_POST['image_alt']==""||$_POST['s_date']==""
		||$_POST['e_date']==""||$_POST['image_title']==""
		||$_POST['priority']==""||$_POST['status']==""
		||$_POST['timer']=="")
		{
			$msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Fill * the Fields. </div>";
		}else{
			$s_date=explode('-',$_POST['s_date']);
			$e_date=explode('-',$_POST['e_date']);
			$id=$_GET['id'];
			if($_FILES['image_name']['name']==""){
							$p="update slider set
				image_alt='".$_POST['image_alt']."',
				s_date='".$s_date['2']."-".$s_date['1']."-".$s_date['0']."',
				e_date='".$e_date['2']."-".$e_date['1']."-".$e_date['0']."',
				image_title='".$_POST['image_title']."',
				btn_text='".$_POST['btn_text']."',
				priority='".$_POST['priority']."',
				timer='".$_POST['timer']."',
				image_caption='".$_POST['image_caption']."',
				status='".$_POST['status']."',
				destination_url='".$_POST['destination_url']."'
				where id='$id'
				";
			}else{
				$q="sleect * from slider where id='$id'";
				$r=mysqli_query($conn,$q);
				while($ro=mysqli_fetch_array($r)){
					unlink('../images/slides/'.$ro['image_name']);
				}
				$p="update slider set
				image_name='".$_FILES['image_name']['name']."',
				s_date='".$s_date['2']."-".$s_date['1']."-".$s_date['0']."',
				e_date='".$e_date['2']."-".$e_date['1']."-".$e_date['0']."',
				image_alt='".$_POST['image_alt']."',
				image_title='".$_POST['image_title']."',
				btn_text='".$_POST['btn_text']."',
				priority='".$_POST['priority']."',
				timer='".$_POST['timer']."',
				image_caption='".$_POST['image_caption']."',
				status='".$_POST['status']."',
				destination_url='".$_POST['destination_url']."'
				where id='$id'
				";
			}
			$n=mysqli_query($conn,$p);
			if($n){ $msg="<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Success: </span>  Slide Updated Successfully. </div>";
					move_uploaded_file($_FILES['image_name']['tmp_name'],"../images/slides/".$_FILES['image_name']['name']);
			 }
			else{$msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Sorry Failed. </div>"; }
		}
}
?>
    <!-- Main content -->
    <section class="content">
      <div class="col-xs-12">
        <div class="col-sm-6">
          <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Update Slide</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form action="#" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                  <?php global $msg; echo $msg;?>
        					<?php	$id=$_GET['id'];
					$q="select * from slider where id='$id'";
					$r=mysqli_query($conn,$q);
					while($ro=mysqli_fetch_array($r)){
				?>
    					<div Class="form-group">
    						<label for="image_name">Image</label>
    						<input type="file" name="image_name" id="image_name" value="">
    						<i>If Empty Remains the Last One</i>
    					</div>
    					<div Class="form-group">
    						<label for="image_alt">Image ALT *</label>
    						<input type="text" name="image_alt" id="image_alt" value="<?php echo $ro['image_alt'];?>" class="form-control" required>
    					</div>
    					<div Class="form-group">
    						<label for="image_title">Image Title *</label>
    						<input type="text" name="image_title" id="image_title" value="<?php echo $ro['image_title'];?>" class="form-control" required>
    					</div>
    					<div Class="form-group">
    						<label for="image_cap">Caption</label>
    						<input type="text" name="image_caption" id="image_cap" value="<?php echo $ro['image_caption'];?>" class="form-control">
    					</div>
    					<div Class="form-group">
    						<label for="btn_text">Button Text</label>
    						<input type="text" name="btn_text" id="btn_text" value="<?php echo $ro['btn_text'];?>" class="form-control">
    						<i><small>Optional</small></i>
    					</div>
    					<div Class="form-group">
    						<label for="destination_url">Start Date *</label>
    						<input type="text" name="s_date" value="<?php echo date('d-m-Y',strtotime($ro['s_date']));?>" data-date-format="dd-mm-yyyy" class="form-control" id="s_date"  required>
    					</div>
    					<div Class="form-group">
    						<label for="destination_url">End Date *</label>
    						<input type="text" name="e_date" value="<?php echo date('d-m-Y',strtotime($ro['e_date']));?>" data-date-format="dd-mm-yyyy" class="form-control" id="e_date"  required>
    					</div>
    					<div Class="form-group">
    						<label for="destination_url">Priority *</label>
    						<input type="text" name="priority" id="priority" value="<?php echo $ro['priority'];?>" class="form-control">
    					</div>
    					<div Class="form-group">
    						<label for="status" class="col-sm-4 no-padding">Status: *</label>
    						<label for="active" class="col-sm-4"><input type="radio" name="status" id="active" value="1" class="radio-control" <?php if($ro['status']==1){?>checked="checked" <?php } ?>> Active</label>
    						<label for="inactive" class="col-sm-4"><input type="radio" name="status" id="inactive" value="0" class="radio-control" <?php if($ro['status']==0){?>checked="checked" <?php } ?>> Inactive</label>
    					</div>
    					<div Class="form-group">
    						<label for="timer" class="col-sm-4 no-padding">Show Timer:</label>
    						<label for="active1" class="col-sm-4"><input type="radio" name="timer" id="active1" value="1" class="radio-control" <?php if($ro['timer']==1){?>checked="checked" <?php } ?>> Yes</label>
    						<label for="inactive1" class="col-sm-4"><input type="radio" name="timer" id="inactive1" value="0" class="radio-control" <?php if($ro['timer']==0){?>checked="checked" <?php } ?>> No</label>
    					</div>
    					<div Class="form-group">
    						<label for="destination_url">Destination URL</label>
    						<input type="text" name="destination_url" id="destination_url" value="<?php echo $ro['destination_url'];?>" class="form-control">
    					</div>
    					<?php } ?>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                </div>
                <!-- /.box-footer -->
              </form>
            </div>
        </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Check Active Slides</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                  <div class="box-body">
                			<h4>Scheduled</h4>
                			<table id="example" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                <tr>
                                  <th class="no-sort">Date</th>
                                  <th>No of Slides</th>
                                </tr>
                                </thead>
                                <tbody>
                				
                				<?php 
                						$date=date("d-m-Y");
                						$date;
                						for($i=1;$i<30;$i++){
                						$datenew=date("Y-m-d", strtotime($date));
                				?>		
                               <?php 
                				//insert query//
                				$r="select * from slider where date(s_date) <= date('$datenew') and date(e_date) >= date('$datenew')";
                				$result=mysqli_query($conn,$r) or die (mysql_error());
                				$count=mysqli_num_rows($result);
                				?>
                                <tr>
                                  <td><?php echo $date; $date = date('d-m-Y', strtotime('+1 day',strtotime($date)));?></td>
                				  
                                  <td><?php echo $count;?></td>
                                  
                                </tr>
                				<?php } ?>
                
                                </tbody>
                               </table>
                		</div>
                  </div>
              </div>
            </div>
              
            <div class="clearfix"></div>
            </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php include_once('views/footer.php');?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
