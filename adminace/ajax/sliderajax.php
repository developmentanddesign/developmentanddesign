<?php
require_once('../config/config.php');

if($_POST['form']=='add'){
		if($_FILES['image_name']['name']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Select Image </div>";
		}elseif($_POST['image_alt']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Fill the Slide Image Alt </div>";
		}elseif($_POST['range']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span> Please Select the Active Range </div>";
		}elseif($_POST['image_title']=="")
		{
			$msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Fill the Image Title. </div>";
		}elseif($_POST['timer']=="")
		{
			$msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span> Please Select Timer. </div>";
		}elseif($_POST['status']=="")
		{
			$msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Select the Status. </div>";
		}else{
			$date1=explode(' - ',$_POST['range']);
			$s_date=explode('/',$date1[0]);
			$e_date=explode('/',$date1[1]);
			$p="insert into slider set
			image_name='".$_FILES['image_name']['name']."',
			image_alt='".$_POST['image_alt']."',
			s_date='".trim($s_date['2'])."-".trim($s_date['1'])."-".trim($s_date['0'])."',
			e_date='".trim($e_date['2'])."-".trim($e_date['1'])."-".trim($e_date['0'])."',
			image_title='".$_POST['image_title']."',
			btn_text='".$_POST['btn_text']."',
			range='".$_POST['range']."',
			timer='".$_POST['timer']."',
			image_caption='".$_POST['image_caption']."',
			status='".$_POST['status']."',
			destination_url='".$_POST['destination_url']."'
			";
			echo $s_date['2']."-".$s_date['1']."-".$s_date['0'];
			echo $e_date['2']."-".$e_date['1']."-".$e_date['0'];
			if(move_uploaded_file($_FILES['image_name']['tmp_name'],"../../images/slides/".$_FILES['image_name']['name']))
			{		$n=mysqli_query($conn,$p);
				$msg="<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Success: </span>  Slide Added Successfully. </div>";
					
			 }
			else{$msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Sorry Failed. </div>"; }
		}	
	echo $msg;
}
elseif($_POST['form']=='update'){
		if($_POST['image_alt']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Fill the Slide Image Alt </div>";
		}elseif($_POST['range']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span> Please Select the Active Range </div>";
		}elseif($_POST['image_title']=="")
		{
			$msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Fill the Image Title. </div>";
		}elseif($_POST['timer']=="")
		{
			$msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span> Please Select Timer. </div>";
		}elseif($_POST['status']=="")
		{
			$msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Select the Status. </div>";
		}else{
			if($_FILES['image_name']['name']=="")
			{
			    $date1=explode(' - ',$_POST['range']);
				$s_date=explode('/',$date1[0]);
				$e_date=explode('/',$date1[1]);
				$p="update slider set
				image_alt='".$_POST['image_alt']."',
				s_date='".trim($s_date['2'])."-".trim($s_date['1'])."-".trim($s_date['0'])."',
				e_date='".trim($e_date['2'])."-".trim($e_date['1'])."-".trim($e_date['0'])."',
				image_title='".$_POST['image_title']."',
				daterange='".$_POST['range']."',
				btn_text='".$_POST['btn_text']."',
				timer='".$_POST['timer']."',
				image_caption='".$_POST['image_caption']."',
				status='".$_POST['status']."',
				destination_url='".$_POST['destination_url']."'
				";
				$n=mysqli_query($conn,$p);
				if($n)
				{
					$msg="<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
								<span class=\"bold\">Success: </span>  Slide Updated Successfully. </div>";
						
				 }else
				 {	
					$msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
								<span class=\"bold\">Error: </span>  Sorry Failed1. </div>"; 
				 }
			}else
			{
				$date1=explode(' - ',$_POST['range']);
				$s_date=explode('/',$date1[0]);
				$e_date=explode('/',$date1[1]);
				$p="update slider set
				image_name='".$_FILES['image_name']['name']."',
				image_alt='".$_POST['image_alt']."',
				s_date='".trim($s_date['2'])."-".trim($s_date['1'])."-".trim($s_date['0'])."',
				e_date='".trim($e_date['2'])."-".trim($e_date['1'])."-".trim($e_date['0'])."',
				image_title='".$_POST['image_title']."',
				daterange='".$_POST['range']."',
				btn_text='".$_POST['btn_text']."',
				timer='".$_POST['timer']."',
				image_caption='".$_POST['image_caption']."',
				status='".$_POST['status']."',
				destination_url='".$_POST['destination_url']."'
				";
				if(move_uploaded_file($_FILES['image_name']['tmp_name'],"../../images/slides/".$_FILES['image_name']['name']))
				{		$n=mysqli_query($conn,$p);
					$msg="<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
								<span class=\"bold\">Success: </span>  Slide Updated Successfully. </div>";
						
				 }
				else
				{
					$msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
								<span class=\"bold\">Error: </span>  Sorry Failed2. </div>"; 
				}
			}
		}	
	echo $msg;
}			
?>