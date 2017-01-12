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
        <li class="active">Video Management</li>
      </ol>
    </section>
<?php

if(isset($_POST['submit'])){
        $id=mysqli_real_escape_string($conn,$_GET['id']);
		if($_POST['title']=="")
		{
			$msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Fill the Title. </div>";
		}elseif($_POST['url']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Fill the URL </div>";
		}else{
		
			$p="update videos set
			    title='".mysqli_real_escape_string($conn,$_POST['title'])."',
			    url='".mysqli_real_escape_string($conn,$_POST['url'])."'
			    where id=$id
			    ";
			$n=mysqli_query($conn,$p);
			if($n){ $msg="<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Success: </span>  Video Updated Successfully. </div>";
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
                <h3 class="box-title">Add Video URL</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form action="#" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                      <?php global $msg; echo $msg;?>
                      <?php $id=mysqli_real_escape_string($conn,$_GET['id']);
                            $q="select * from videos where id=$id";
                            $run=mysqli_query($conn,$q);
                            while($row=mysqli_fetch_array($run)){
                        ?>
    					<div Class="form-group">
    						<label for="title">Video Title</label>
    						<input type="text" name="title" id="title" value="<?php echo $row['title'];?>"  class="form-control"  required>
    					</div>
    					<div Class="form-group">
    						<label for="url">Video URL</label>
    						<input type="text" name="url" id="url" value="<?php echo $row['url'];?>" class="form-control" required>
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
        </div>
              
            <div class="clearfix"></div>
            </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php include_once('views/footer.php');?>
