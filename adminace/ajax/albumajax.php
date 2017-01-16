
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
				$p1="select * from albums where title='".mysqli_real_escape_string($conn,$_POST['title'])."'";
				 $n=mysqli_query($conn,$p1);
				 if(mysqli_num_rows($n)>0){
					 $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
				    							<span class=\"bold\">Error: </span> Album Already Exist. </div>"; 
				 }else{
						$p="insert into albums set
						    title='".mysqli_real_escape_string($conn,$_POST['title'])."',
						    cover='".mysqli_real_escape_string($conn,$_FILES['cover']['name'])."',
						    created=NOW(),
						    lastupdate='0000-00-00'
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
			}
		echo $msg;
		}elseif($_POST['form']=="updatealbum"){
				$id=mysqli_real_escape_string($conn,$_POST['id']);
				$img=mysqli_real_escape_string($conn,$_POST['imgold']);
			if($_POST['title']=="")
			{
				$msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
								<span class=\"bold\">Error: </span>  Please Fill the Title. </div>";
			}elseif($_FILES['cover']['name']=="" || $_FILES['cover']['name']==null)
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
				    	unlink('../../images/albumcover/'.$img);
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
		}elseif($_POST['form']=="addimages"){
			if($_POST['album']=="")
			{
				$msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
								<span class=\"bold\">Error: </span>  Please Select the Album. </div>";
			}elseif($_FILES['images']['name']=="" || $_FILES['images']['name']==null)
			{
				$msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
						<span class=\"bold\">Error: </span>  Please Select the Some Images. </div>";
			    
			}else{
				foreach($_FILES['images']['name'] as $key => $file){
			
				$p="insert into albumimages set
				    parent_id='".mysqli_real_escape_string($conn,$_POST['album'])."',
				    image='".mysqli_real_escape_string($conn,$file)."'
				    ";
				    if(move_uploaded_file($_FILES['images']['tmp_name'][$key],'../../images/albumimages/'.$file)){
	    			    $n=mysqli_query($conn,$p);
	        			if($n){ 
	        			  $msg="<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
	        							<span class=\"bold\">Success: </span>  Images Uploaded Successfully. </div>";
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
			}
		echo $msg;
		}
		
?>