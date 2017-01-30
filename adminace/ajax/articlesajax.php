<?php
require_once('../config/config.php');
print_r($_POST);
if($_POST['form']=='add'){
		if($_POST['title']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Fill the Title </div>";
		}
		elseif($_POST['content']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Add Content </div>";
		}elseif($_POST['mtitle']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Fill the Meta Title Description </div>";
		}elseif($_POST['mdesc']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Fill the Meta Description </div>";
		}else{
		
			$p="insert into articles set
			    title='".mysqli_real_escape_string($conn,$_POST['title'])."',
			    content='".mysqli_real_escape_string($conn,$_POST['content'])."',
			    mtitle='".mysqli_real_escape_string($conn,$_POST['mtitle'])."',
			    mdesc='".mysqli_real_escape_string($conn,$_POST['mdesc'])."',
			    created='".mysqli_real_escape_string($conn,$_POST['date'])."'
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
		if($_POST['title']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Fill the Title </div>";
		}
		elseif($_POST['content']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Add Content </div>";
		}elseif($_POST['mtitle']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Fill the Meta Title Description </div>";
		}elseif($_POST['mdesc']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Fill the Meta Description </div>";
		}else{
		
			$p="update articles set
			    title='".mysqli_real_escape_string($conn,$_POST['title'])."',
			    content='".mysqli_real_escape_string($conn,$_POST['content'])."',
			    mtitle='".mysqli_real_escape_string($conn,$_POST['mtitle'])."',
			    mdesc='".mysqli_real_escape_string($conn,$_POST['mdesc'])."',
			    lastupdate='".mysqli_real_escape_string($conn,$_POST['date'])."'
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