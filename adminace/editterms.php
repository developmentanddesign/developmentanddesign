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
        <li class="active">Terms</li>
      </ol>
    </section>
<?php

if(isset($_POST['submit'])){
        if($_POST['title']==""){$_POST['title']="Terms and Conditions";}
	    if($_POST['desc']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Fill the Description </div>";
		}elseif($_POST['mtitle']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Fill the Meta Title Description </div>";
		}elseif($_POST['mdesc']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Fill the Meta Description </div>";
		}else{
		
			$p="update terms set
			    title='".mysqli_real_escape_string($conn,$_POST['title'])."',
			    description='".mysqli_real_escape_string($conn,$_POST['desc'])."',
			    meta_title='".mysqli_real_escape_string($conn,$_POST['mtitle'])."',
			    meta_desc='".mysqli_real_escape_string($conn,$_POST['mdesc'])."'
			    ";
			$n=mysqli_query($conn,$p);
			if($n){ $msg="<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Success: </span>  Details Updated Successfully. </div>";
			 }
			else{$msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Sorry Failed. </div>"; }
		}
}			
?>
    <!-- Main content -->
    <section class="content">
      <div class="col-xs-12">
          <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Update Terms Page Details</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form action="#" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                      <?php global $msg; echo $msg;?>
                     <?php $id=$_GET['id']; 
                        $q="select * from terms where id=$id";
                        $r=mysqli_query($conn,$q);
        					while($ro=mysqli_fetch_array($r)){
        				?>
                    <div class="col-sm-6">
    					<div Class="form-group">
    						<label for="title">Title</label>
    						<input type="text" name="title" id="title" value="Terms and Conditions" disabled title="Already Filled" class="form-control"  required>
    					</div>
    					<div Class="form-group">
    						<label for="editor1">Description</label>
    			            <textarea id="editor1" name="desc" rows="10" title="Please Fill out This Field" cols="80" required>
                                 <?php echo $ro['description'];?>
                            </textarea>
    					</div>
    				</div>
    				<div class="col-sm-6">
    					<div Class="form-group">
    						<label for="mtitle">Meta Title</label>
    						<input type="text" name="mtitle" id="mtitle" value="<?php echo $ro['meta_title'];?>" title="Please Fill out This Field" class="form-control"  required>
    					</div>
    					<div Class="form-group">
    						<label for="mdesc">Meta Description</label>
    						<textarea id="mdesc" name="mdesc" rows="5" class="form-control" cols="30" title="Please Fill out This Field" required> <?php echo $ro['meta_desc'];?></textarea>
    					</div>
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
              
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php include_once('views/footer.php');?>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>

