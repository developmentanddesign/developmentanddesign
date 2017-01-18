
<?php 
require_once('../config/config.php');

		// insert query into albums
			if($_POST['title']=="")
			{
				$msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
								<span class=\"bold\">Error: </span>  Please Fill the Title. </div>";
			}elseif($_POST['url']=="")
			{
			    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
								<span class=\"bold\">Error: </span>  Please Fill the Url </div>";
			}else{
				$p1="select * from videos where url='".mysqli_real_escape_string($conn,$_POST['url'])."'";
				 $n=mysqli_query($conn,$p1);
				 if(mysqli_num_rows($n)>0){
					 $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
				    							<span class=\"bold\">Error: </span> Video Url Already Exist. </div>"; 
				 }else{
						$p="insert into videos set
						    title='".mysqli_real_escape_string($conn,$_POST['title'])."',
						    url='".mysqli_real_escape_string($conn,$_POST['url'])."',
						    created=NOW()
						    ";
						    
					    $n=mysqli_query($conn,$p);
		    			if($n){ 
		    			  $msg="<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
		    							<span class=\"bold\">Success: </span>  Video Added Successfully. </div>";
		    			 }
		    			else{
		    			  $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
		    							<span class=\"bold\">Error: </span>  Sorry Failed. </div>"; 
		    			  
		    			}
				 }
			}
		echo $msg;