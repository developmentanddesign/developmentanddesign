
<?php 
require_once('../config/config.php');
		if($_POST['form']=="addalbum"){
			if($_POST['title']=="")
			{
				$msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
								<span class=\"bold\">Error: </span>  Please Fill the Title. </div>";
			}elseif($_FILES['cover']['name']=="")
			{
			    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
								<span class=\"bold\">Error: </span>  Please Attach the Cover Image </div>";
			}else{
			
				$p="insert into albums set
				    title='".mysqli_real_escape_string($conn,$_POST['title'])."',
				    cover='".mysqli_real_escape_string($conn,$_FILES['cover']['name'])."'
				    ";
				    if(move_uploaded_file($_FILES['cover']['tmp_name'],'../../images/albumcover/'.$_FILES['cover']['name'])){
	    			    $n=mysqli_query($conn,$p);
	        			if($n){ 
	        			  $msg="<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
	        							<span class=\"bold\">Success: </span>  album Created Successfully. </div>";
	        			 }
	        			else{
	        			  $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
	        							<span class=\"bold\">Error: </span>  Sorry Failed. </div>"; 
	        			  
	        			}
				    }else{
				      $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
	        							<span class=\"bold\">Error: </span>Sorry Upload Error. </div>";
				    }
			}
		echo $msg;
		}elseif($_POST['form']=="updatealbum"){
				$id=mysqli_real_escape_string($_POST['id']);
				$img=mysqli_real_escape_string($_POST['img']);
			if($_POST['title']=="")
			{
				$msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
								<span class=\"bold\">Error: </span>  Please Fill the Title. </div>";
			}elseif($_FILES['cover']['name']=="")
			{
			    $p="update albums set
				    title='".mysqli_real_escape_string($conn,$_POST['title'])."'
				    where id=$id
				    ";
    			    $n=mysqli_query($conn,$p);
        			if($n){ 
        			  $msg="<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
        							<span class=\"bold\">Success: </span>  album Updated Successfully. </div>";
        			 }
        			else{
        			  $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
        							<span class=\"bold\">Error: </span>  Sorry Failed. </div>"; 
        			}
			}else{
			
				$p="update albums set
				    title='".mysqli_real_escape_string($conn,$_POST['title'])."',
				    cover='".mysqli_real_escape_string($conn,$_FILES['cover']['name'])."'
				    where id=$id
				    ";
				    if(move_uploaded_file($_FILES['cover']['tmp_name'],'../../images/albumcover/'.$_FILES['cover']['name'])){
				    	unlink('../../images/albumcover/'.$_FILES['cover']['name']);
	    			    $n=mysqli_query($conn,$p);
	        			if($n){ 
	        			  $msg="<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
	        							<span class=\"bold\">Success: </span>  album Updated Successfully. </div>";
	        			 }
	        			else{
	        			  $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
	        							<span class=\"bold\">Error: </span>  Sorry Failed. </div>"; 
	        			  
	        			}
				    }else{
				      $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
	        							<span class=\"bold\">Error: </span>Sorry Upload Error. </div>";
				    }
			}
		echo $msg;
		}
?>