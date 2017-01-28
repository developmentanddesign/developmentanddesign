
<?php 
require_once('../config/config.php');
		// insert query into albums
		if($_POST['form']=="addalbum"){
			if($_POST['title']=="")
			{
				$msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
								<span class=\"bold\">Error: </span>  Please Fill the Title. </div>";
			}elseif($_FILES['cover']['name']=="")
			{
			    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
								<span class=\"bold\">Error: </span>  Please Attach the Cover Image </div>";
			}elseif($_POST['mtitle']=="")
			{
			    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
								<span class=\"bold\">Error: </span>  Please Fill Meta Title </div>";
			}elseif($_POST['mdesc']=="")
			{
			    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
								<span class=\"bold\">Error: </span>  Please Fill Meta Description </div>";
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
						    created='".mysqli_real_escape_string($conn,$_POST['date'])."',
						    mtitle='".mysqli_real_escape_string($conn,$_POST['mtitle'])."',
						    mdesc='".mysqli_real_escape_string($conn,$_POST['mdesc'])."',
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
		echo $msg; // Update query into albums
		}elseif($_POST['form']=="updatealbum"){
				$id=mysqli_real_escape_string($conn,$_POST['id']);
				$img=mysqli_real_escape_string($conn,$_POST['imgold']);
			if($_POST['title']=="")
			{
				$msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
								<span class=\"bold\">Error: </span>  Please Fill the Title. </div>";
			}elseif($_POST['mtitle']=="")
			{
			    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
								<span class=\"bold\">Error: </span>  Please Fill Meta Title </div>";
			}elseif($_POST['mdesc']=="")
			{
			    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
								<span class=\"bold\">Error: </span>  Please Fill Meta Description </div>";
			}
			elseif($_FILES['cover']['name']=="" || $_FILES['cover']['name']==null)
			{
			
			    $p="update albums set
				    title='".mysqli_real_escape_string($conn,$_POST['title'])."',
				    mtitle='".mysqli_real_escape_string($conn,$_POST['mtitle'])."',
				    mdesc='".mysqli_real_escape_string($conn,$_POST['mdesc'])."',
				    lastupdate='".mysqli_real_escape_string($conn,$_POST['date'])."'
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
					    cover='".mysqli_real_escape_string($conn,$_FILES['cover']['name'])."',
					    mtitle='".mysqli_real_escape_string($conn,$_POST['mtitle'])."',
					    mdesc='".mysqli_real_escape_string($conn,$_POST['mdesc'])."',
					    lastupdate='".mysqli_real_escape_string($conn,$_POST['date'])."'
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
					$x=1;
					$p1="select * from albumimages where image='$file'";
					$n1=mysqli_query($conn,$p1);
					if(mysqli_num_rows($n1)>0){
						$str = '';
						$str_len = 4 ;
						for($i = 0; $i < $str_len; $i++){
						    //97 is ascii code for 'a' and 122 is ascii code for z
						    $str .= chr(rand(97, 122));
						}
						$temp = explode(".", $file);
						$extension = end($temp);
						$filenew=$temp[0] .$str.".".$extension;
						$p2="insert into albumimages set
					    parent_id='".mysqli_real_escape_string($conn,$_POST['album'])."',
					    image='".mysqli_real_escape_string($conn,$filenew)."',
					    created='".mysqli_real_escape_string($conn,$_POST['date'])."'
					    ";
					    if(move_uploaded_file($_FILES['images']['tmp_name'][$key],'../../images/albumimages/'.$filenew)){
		    			    $n=mysqli_query($conn,$p2);
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
					}else{
						$p="insert into albumimages set
					    parent_id='".mysqli_real_escape_string($conn,$_POST['album'])."',
					    image='".mysqli_real_escape_string($conn,$file)."',
					    created=NOW()
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
			}
		echo $msg;
		}
		
?>