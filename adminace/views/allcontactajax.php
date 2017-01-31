
<?php require_once('../config/config.php');?>
<table id="example3" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
      <th>Sr.</th>
      <th>Title</th>
      <th>Address</th>
      <th>Mobile</th>
      <th>Phone</th>
      <th>Email</th>
      <th>Country</th>
      <th>State</th>
      <th>City</th>
      <th>Pin</th>
      <th class="text-center" data-priority="1">Actions</th>
    </tr>
    </thead>
    <tbody>
   <?php 
        //fetch query//
        $r="select * from contacts order by 1 desc";
        $sr=1;
        $result=mysqli_query($conn,$r) or die (mysql_error());
        while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
            $id=$row['id'];
          $title=$row['title'];
        	$address=$row['address'];
        	$mobile=$row['mobile'];
        	$phone=$row['phone'];
        	$email=$row['email'];
        	$country=$row['country'];
        	$state=$row['state'];
        	$city=$row['city'];
          	$p1="select * from countries where id=$country";
          	$run1=mysqli_query($conn,$p1);
            while($row1=mysqli_fetch_array($run1)){
              $countryname=$row1['name'];
            }
            $p2="select * from states where id=$state";
          	$run2=mysqli_query($conn,$p2);
            while($row2=mysqli_fetch_array($run2)){
              $statename=$row2['name'];
            }
            $p3="select * from cities where id=$city";
          	$run3=mysqli_query($conn,$p3);
            while($row3=mysqli_fetch_array($run3)){
              $cityname=$row3['name'];
            }
        	
        	$pin=$row['pin'];
        ?>
        <tr>
          <td><?php echo $sr;?></td>
          <td> <?php echo strlen($title) > 50 ? ucwords(substr($title,0,50))."..." : ucwords($title);?></td>
          <td><?php echo wordwrap($address,35,"<br>\n");?></td>
          <td><?php echo $mobile;?></td>
          <td><?php echo $phone;?></td>
          <td><?php echo $email;?></td>
          <td><?php echo $countryname;?></td>
          <td><?php echo $statename;?></td>
          <td><?php echo $cityname;?></td>
          <td><?php echo $pin;?></td>
          <td class="text-center">
      		<button title="Delete" id="<?php echo $id; ?>" class="btn btn-danger delete" data-href="contact.php?del=" data-toggle="modal" data-target="#myModal"><i class="fa fa-times"></i></button>
      	  </td>
        </tr>
    <?php  $sr++;}?>

    </tbody>
</table>
<script>
  // initializing data table
    $('#example3').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
    // initializing data table
    
    //  contact delete action
    $('.delete').click(function(){
    var id= $(this).attr('id');
    var href= $(this).attr('data-href');
    $('.del-confirm').attr('href',href+id);
    });
     //   contact delete action
     
</script>
		