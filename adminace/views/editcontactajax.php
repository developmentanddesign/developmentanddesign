<?php require_once('../config/config.php'); ?>
<?php if(isset($_POST['edit'])){ ?>
    <?php $q="select * from contacts";
            $run=mysqli_query($conn,$q);
            while($row=mysqli_fetch_array($run)){
                $country=$row['country'];
                $state=$row['state'];
                $city=$row['city'];
                $mobile=explode('-',$row['mobile']);
                $ccode=$mobile['0'];
                $mobile1=$mobile['1'];
                $phone=explode('-',$row['phone']);
                $ccode1=$phone['0'];
                $acode=$phone['1'];
                $phone1=$phone['2'];
                $pin=$row['pin'];
                $address=$row['address'];
                $email=$row['email'];
        ?>
        <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Contact Information</h3>
                <button class="btn btn-warning pull-right" onclick="cancle('views/editcontactajax.php','.contactform')">Cancle</button>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form id="update" action="ajax/contactajax.php" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                  <div id="result"><?php global $msg; echo $msg;?></div>
                  
                        <div class="col-sm-6">
                            <div Class="form-group">
        						<label for="title">Title</label>
        						<input type="text" name="title" id="title" value="Contact Us" placeholder="Contact Us" class="form-control" title="Already Filled" disabled>
        						<input type="hidden" name="form" id="form" value="update" class="form-control">
        					</div>
        					<div Class="form-group">
        						<label for="address">Address</label>
        			             <textarea id="address" name="address" rows="4" cols="50" class="form-control" title="Address" required><?php echo $address;?></textarea>
        					</div>
        					<div Class="form-group">
        						<div class="col-xs-4 col-sm-5 no-left-padding no-right-padding">
        						  <label for="ccode">Country Code</label>
    						      <select class="select4 form-control" name="ccode" id="ccode" required>
                      			    <option value="">Select One</option>
                      			    <?php $p="select * from codes";
                      			          $run=mysqli_query($conn,$p);
                      			          while($row=mysqli_fetch_array($run)){ ?>
                                          <option value="<?php echo $row['code'];?>" <?php if($ccode==$row['code']){ echo "selected='selected'";}?>><?php echo $row['code'];?></option>
                      			     <?php  } ?>
                    			   </select>		
        						</div>
        						<div class="col-xs-8 col-sm-7 no-right-padding">
        						   <label for="mobile">Mobile no</label>
        			               <input type="text" id="mobile" class="form-control" value="<?php echo $mobile1;?>" name="mobile" pattern="[0-9]{10}" placeholder="" required>
        			            </div>      
        					</div>
        					<div Class="form-group">
        						<div class="col-xs-6 col-sm-4 no-left-padding no-right-padding">
        						  <label for="ccode1">Country Code</label>
        						  <select class="select4 form-control" name="ccode1" id="ccode1">
                      			    <option value="">Select One</option>
                      			    <?php $p="select * from codes";
                      			          $run=mysqli_query($conn,$p);
                      			          while($row=mysqli_fetch_array($run)){ ?>
                                          <option value="<?php echo $row['code'];?>" <?php if($ccode1==$row['code']){ echo "selected='selected'";}?>><?php echo $row['code'];?></option>
                      			     <?php  } ?>
                    			    </select>		
        						</div>
        						<div class="col-xs-6 col-sm-4 no-right-padding">
        						   <label for="areacode">Area Code</label>
            			           <input type="text" class="form-control" value="<?php echo $acode;?>" name="areacode" id="areacode" pattern="\d*">
        						</div>
        						<div class="col-xs-12 col-sm-4 no-right-padding">
        						   <label for="phone">Phone no</label>
    			                   <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $phone1;?>" pattern="\d*">
    			                </div>
        					</div>
        					<div Class="form-group">
        						<label for="email">Email</label>
        			           <input type="email" class="form-control" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="<?php echo $email;?>" required>
        					</div>
          				</div>
          				<div class="col-sm-6">
          					<div Class="form-group">
          						<label for="country">Select Country</label>
          						<select class="select3 form-control" name="country" id="country" onchange="countrydata('#country','states',$('#country').val(),'ajax/contactajax.php','.states')" required>
                			    <option value="">Select One</option>
                			    <?php $p="select * from countries";
                			          $run=mysqli_query($conn,$p);
                			          while($row1=mysqli_fetch_array($run)){ ?>
                                    <option value="<?php echo $row1['id'];?>" <?php if($country==$row1['id']){ echo "selected='selected'";}?>><?php echo $row1['name'];?></option>
                			     <?php  } ?>
                			</select>		
          					</div>
          					<div Class="form-group states">
          						<label for="state">Select State</label>
          						<select class="select4 form-control" name="state" id="state">
                        	    <option value="">Select One</option>
                			    <?php global $country;
                			        $p="select * from states where country_id=$country";
                			          $run=mysqli_query($conn,$p);
                			          while($row2=mysqli_fetch_array($run)){ ?>
                                    <option value="<?php echo $row2['id'];?>" <?php if($row2['id']==$state){ echo "selected='selected'";}?>><?php echo $row2['name'];?></option>
                			     <?php  } ?>
                                </select>	
          					</div>
          					<div Class="form-group cities">
          						<label for="city">Select City</label>
          						<select class="select5 form-control" name="city" id="city">
                        	    <option value="" selected="selected">Select One</option>
                			    <?php global $state;
                			        $p="select * from cities where state_id=$state";
                			          $run=mysqli_query($conn,$p);
                			          while($row3=mysqli_fetch_array($run)){ ?>
                                    <option value="<?php echo $row3['id'];?>" <?php if($row3['id']==$city){ echo "selected='selected'";}?>><?php echo $row3['name'];?></option>
                			     <?php  } ?>
                			    </select>	
          					</div>
          					<div Class="form-group">
        						<label for="pin">Pin Code</label>
        						<input type="text" name="pin" id="pin" value="<?php echo $pin;?>" placeholder="Pin Code" class="form-control" title="Pin Code" required>
        					</div>
                  </div>
                </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                      <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                    </div>
                        <!-- /.box-footer -->
                  </form>
                </div>
<?php }
echo '<script>
 // form submition for adding contact
    $("#update").submit(function(event){
        event.preventDefault(); //prevent default action
        var post_url = $(this).attr("action"); //get form action url
        var request_method = $(this).attr("method"); //get form GET/POST method
        var formData = new FormData($(this)[0]); //Encode form elements for submission
        $.ajax({
            url : post_url,
            type: request_method,
            data : formData,
            processData: false,
            contentType: false,
            beforeSend: function(){
                 $(".cssload-whirlpool1").show();
                 $(".contactform").fadeTo(0,0.1);
                 $(".cssload-whirlpool2").show();
                 $(".album-box").fadeTo(0,0.1);
             },
        }).done(function(response){ //
            $("#result").html(response);
            $.ajax({
                url: "views/allcontactajax.php",
                type: "POST",
                data: "data",
                success: function(data) {
                 $(".contactdata").html(data);
                 $(".cssload-whirlpool1").delay(2000).fadeOut();
                 $(".contactform").delay(2000).fadeTo(0, 1);
                 $(".cssload-whirlpool2").delay(2000).fadeOut();
                 $(".album-box").delay(2000).fadeTo(0, 1);
                }
            });
            $.ajax({
                url: "views/editcontactajax.php",
                type: "POST",
                data: "data",
                success: function(data) {
                 $(".contactform").html(data);
                }
            });
        
        });
    });
    //select2 initilizing
    $(".select3").select2();
   
     //select2 initilizing
    $(".select4").select2();
    
     //select2 initilizing
    $(".select5").select2();
    </script>
    ';
    
}else{?>
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Contact Information</h3>
                <?php  $q="select * from contacts";
                        $run=mysqli_query($conn,$q);
                        $submit="ture";
                        while($row=mysqli_fetch_array($run)){
                          $submit="false";
                    ?>
                  <button class="btn btn-warning pull-right" id="edit-contact">Edit</button>
                <?php } ?>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form id="contact_form" action="ajax/contactajax.php" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                  <div id="result"><?php global $msg; echo $msg;?></div>
                  <div class="col-sm-6">
                  <div Class="form-group">
        					<label for="title">Title</label>
        					<input type="text" name="title" id="title" value="Contact Us" placeholder="Contact Us" class="form-control" title="Already Filled" disabled>
        					<input type="hidden" name="form" id="form" value="add" class="form-control">
        				</div>
        				<div Class="form-group">
        					<label for="address">Address</label>
        		     <textarea id="address" name="address" rows="4" cols="50" class="form-control" title="Please Fill out This Field" required></textarea>
        				</div>
        				<div Class="form-group">
        					<div class="col-xs-4 col-sm-5 no-left-padding no-right-padding">
        					  <label for="ccode">Country Code</label>
        					  <select class="select4 form-control" name="ccode" id="ccode" required>
          			    <option value="">Select One</option>
          			    <?php $p="select * from codes";
          			          $run=mysqli_query($conn,$p);
          			          while($row=mysqli_fetch_array($run)){ ?>
                              <option value="<?php echo $row['code'];?>"><?php echo $row['code'];?></option>
          			     <?php  } ?>
        			    </select>		
        					</div>
        					<div class="col-xs-8 col-sm-7 no-right-padding">
        					   <label for="ccode1">Mobile No.</label>
        					   <input type="text" id="mobile" class="form-control" name="mobile" pattern="[0-9]{10}" required>
        				  </div>
        				</div>
        				<div Class="form-group">
        					<div class="col-xs-6 col-sm-4 no-left-padding no-right-padding">
        					  <label for="ccode1">Country Code</label>
        					  <select class="select4 form-control" name="ccode1" id="ccode1">
                  			    <option value="">Select One</option>
                  			    <?php $p="select * from codes";
                  			          $run=mysqli_query($conn,$p);
                  			          while($row=mysqli_fetch_array($run)){ ?>
                                      <option value="<?php echo $row['code'];?>"><?php echo $row['code'];?></option>
                  			     <?php  } ?>
                			  </select>		
        					</div>
        					<div class="col-xs-6 col-sm-4 no-right-padding">
        					  <label for="areacode">Area Code</label>
        		              <input type="text" class="form-control" name="areacode" id="areacode" pattern="\d*">
        					</div>
        					<div class="col-xs-12 col-sm-4 no-right-padding">
        					   <label for="phone">Phone No.</label>
        	                   <input type="text" class="form-control" name="phone" id="phone" pattern="\d*">
        					</div>
        				</div>
        				<div Class="form-group">
        					<label for="email">Email</label>
        		            <input type="email" class="form-control" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
        				</div>
          			</div>
          			<div class="col-sm-6">
          				<div Class="form-group">
          					<label for="country">Select Country</label>
          					<select class="select3 form-control" name="country" id="country" onchange="countrydata('#country','states',$('#country').val(),'ajax/contactajax.php','.states')" required>
            			    <option value="">Select One</option>
            			    <?php $p="select * from countries";
            			          $run=mysqli_query($conn,$p);
            			          while($row=mysqli_fetch_array($run)){ ?>
                                <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
            			     <?php  } ?>
            			</select>		
          				</div>
          				<div Class="form-group states">
          					<label for="state">Select State</label>
          					<select class="select4 form-control" name="state" id="state" disabled>
                        	<option value="">Select One</option>
                			    <?php $p="select * from states";
                			          $run=mysqli_query($conn,$p);
                			          while($row=mysqli_fetch_array($run)){ ?>
                                    <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                			     <?php  } ?>
                             </select>	
          				</div>
          				<div Class="form-group cities">
          					<label for="city">Select City</label>
          					<select class="select5 form-control" name="city" id="city" disabled>
                        	<option value="" selected="selected">Select One</option>
                			    <?php $p="select * from cities";
                			          $run=mysqli_query($conn,$p);
                			          while($row=mysqli_fetch_array($run)){ ?>
                                    <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                			     <?php  } ?>
                			</select>	
          				</div>
          				<div Class="form-group">
    						<label for="pin">Pin Code</label>
    						<input type="text" name="pin" id="pin" value="" placeholder="Pin Code" class="form-control" title="Pin Code" required>
    					</div>
                  </div>
                </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                      
                      <input type="submit" name="submit" value="Submit" class="btn btn-primary" <?php if($submit=="false"){ echo "disabled";}?>>
                    </div>
                        <!-- /.box-footer -->
                  </form>
                </div>
<?php echo '<script>
 // form submition for adding contact
    $("#contact_form").submit(function(event){
        event.preventDefault(); //prevent default action
        var post_url = $(this).attr("action"); //get form action url
        var request_method = $(this).attr("method"); //get form GET/POST method
        var formData = new FormData($(this)[0]); //Encode form elements for submission
        $.ajax({
            url : post_url,
            type: request_method,
            data : formData,
            processData: false,
            contentType: false,
        beforeSend: function(){
             $(".cssload-whirlpool1").show();
             $(".contactform").fadeTo(0,0.1);
         }
        }).done(function(response){ //
            $("#result").html(response);
            $.ajax({
                url: "views/allcontactajax.php",
                type: "POST",
                data: "data",
                success: function(data) {
                 $(".contactdata").html(data);
                $(".cssload-whirlpool1").delay(2000).fadeOut();
                $(".contactform").delay(2000).fadeTo(0, 1);
                }
            });
        
        });
    });
    $("#edit-contact").click(function(){
        $.ajax({
                url: "views/editcontactajax.php",
                type: "POST",
                data: {edit:edit},
                beforeSend: function(){
                     $(".cssload-whirlpool1").show();
                     $(".contactform").fadeTo(0,0.1);
                 },
                success: function(data) {
                 $(".contactform").html(data);
                 $(".cssload-whirlpool1").delay(2000).fadeOut();
                 $(".contactform").delay(2000).fadeTo(0, 1);
                }
            });
    });
    //select2 initilizing
    $(".select3").select2();
   
     //select2 initilizing
    $(".select4").select2();
    
     //select2 initilizing
    $(".select5").select2();
    </script>
    '; }

?>
