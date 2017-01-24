<?php
require_once('../config/config.php');

if($_POST['form']=='add'){
		$title="Terms and Conditions";
		if($_POST['description']=="")
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
		
			$p="insert into terms set
			    title='".mysqli_real_escape_string($conn,$title)."',
			    description='".mysqli_real_escape_string($conn,$_POST['description'])."',
			    meta_title='".mysqli_real_escape_string($conn,$_POST['mtitle'])."',
			    meta_desc='".mysqli_real_escape_string($conn,$_POST['mdesc'])."'
			    ";
			$n=mysqli_query($conn,$p);
			if($n){ $msg="<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Success: </span>  Details Added Successfully. </div>";
			 }
			else{$msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Sorry Failed. </div>"; }
		}
	echo $msg;
}
elseif($_POST['form']=='update'){
		$title="Terms and Conditions";
		if($_POST['description']=="")
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
			    title='".mysqli_real_escape_string($conn,$title)."',
			    description='".mysqli_real_escape_string($conn,$_POST['description'])."',
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
	echo $msg;
}			
?>