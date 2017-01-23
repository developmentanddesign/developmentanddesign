<?php 
require_once('../config/config.php'); ?>

<?php if($_POST['name']=='states'){?>
<label for="state">Select State</label>
<select class="select4 form-control" name="state" id="state" onchange="countrydata('#state','cities',$('#state').val(),'ajax/contactajax.php','.cities')" required>
<?php }?>
<?php if($_POST['name']=='cities'){?>
<label for="city">Select City</label>
<select class="select5 form-control citydata" name="city" id="city" required>
<?php }?>
    <?php if($_POST['name']=='states'){?>
        <option value="">Select One</option>
          <?php $p="select * from states where country_id='".mysqli_real_escape_string($conn,$_POST['id'])."'";;
                $run=mysqli_query($conn,$p);
                while($row=mysqli_fetch_array($run)){ ?>
              <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
           <?php  } }
           
    elseif($_POST['name']=='cities'){?>
        <option value="">Select One</option>
        <?php $p="select * from cities where state_id='".mysqli_real_escape_string($conn,$_POST['id'])."'";;
            $run=mysqli_query($conn,$p);
            while($row=mysqli_fetch_array($run)){ ?>
          <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
        <?php  } }?>
<?php if($_POST['name']=='states' || $_POST['name']=='cities'){?>
</select>	
<script>
    //select2 initilizing
    $(".select4").select2();
    
     //select2 initilizing
    $(".select5").select2();
</script>
<?php } 
			
	    // insert query into Videos
    if($_POST['form']=="add"){
		
		if($_POST['address']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Fill the Address </div>";
		}elseif($_POST['mobile']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Fill the Mobile Number </div>";
		}elseif($_POST['ccode']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span> Fill Country Code For Mobile </div>";
		}elseif($_POST['email']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Fill the Email Address </div>";
		}elseif($_POST['country']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Select the Country </div>";
		}elseif($_POST['state']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Select the State </div>";
		}elseif($_POST['city']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Select the City </div>";
		}elseif($_POST['pin']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Enter the Pin code </div>";
		}else{	  
    			$title="Contact Us";
            $p="insert into contacts set
			    title='".mysqli_real_escape_string($conn,$title)."',
			    address='".mysqli_real_escape_string($conn,$_POST['address'])."',
			    mobile='".mysqli_real_escape_string($conn,$_POST['ccode']."-".$_POST['mobile'])."',
			    phone='".mysqli_real_escape_string($conn,$_POST['ccode1']."-".$_POST['areacode']."-".$_POST['phone'])."',
			    email='".mysqli_real_escape_string($conn,$_POST['email'])."',
			    country='".mysqli_real_escape_string($conn,$_POST['country'])."',
			    state='".mysqli_real_escape_string($conn,$_POST['state'])."',
			    city='".mysqli_real_escape_string($conn,$_POST['city'])."',
			    pin='".mysqli_real_escape_string($conn,$_POST['pin'])."'
			    ";
			    
		    $n=mysqli_query($conn,$p);
			if($n){ 
			  $msg="<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Success: </span>Contact Details Added Successfully. </div>";
			 }
			else{
			  $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Sorry Failed. </div>"; 
			  
			}
	    }
	echo $msg;// Update query into Videos
	}elseif($_POST['form']=="update"){
		$id=mysqli_real_escape_string($conn,$_POST['id']);
		if($_POST['address']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Fill the Address </div>";
		}elseif($_POST['mobile']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Fill the Mobile Number </div>";
		}elseif($_POST['ccode']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span> Fill Country Code For Mobile </div>";
		}elseif($_POST['email']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Fill the Email Address </div>";
		}elseif($_POST['country']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Select the Country </div>";
		}elseif($_POST['state']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Select the State </div>";
		}elseif($_POST['city']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Select the City </div>";
		}elseif($_POST['pin']=="")
		{
		    $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Please Enter the Pin code </div>";
		}else{	
    			$title="Contact Us";
            $p="update contacts set
			    title='".mysqli_real_escape_string($conn,$title)."',
			    address='".mysqli_real_escape_string($conn,$_POST['address'])."',
			    mobile='".mysqli_real_escape_string($conn,$_POST['ccode']."-".$_POST['mobile'])."',
			    phone='".mysqli_real_escape_string($conn,$_POST['ccode1']."-".$_POST['areacode']."-".$_POST['phone'])."',
			    email='".mysqli_real_escape_string($conn,$_POST['email'])."',
			    country='".mysqli_real_escape_string($conn,$_POST['country'])."',
			    state='".mysqli_real_escape_string($conn,$_POST['state'])."',
			    city='".mysqli_real_escape_string($conn,$_POST['city'])."',
			    pin='".mysqli_real_escape_string($conn,$_POST['pin'])."'
			    ";
			    
		    $n=mysqli_query($conn,$p);
			if($n){ 
			  $msg="<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Success: </span>Contact Details Updated Successfully. </div>";
			 }
			else{
			  $msg="<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
							<span class=\"bold\">Error: </span>  Sorry Failed. </div>"; 
			  
			}
	    }
	echo $msg; 
    }
?>