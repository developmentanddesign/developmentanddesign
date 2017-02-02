<?php require_once('../config/config.php');?>
	     <table id="example" class="table table-striped table-bordered dt-responsive nowrap">
            <thead>
            <tr>
              <th>Sr.</th>
              <th>Image</th>
              <th>Image ALT</th>
              <th>Image Title</th>
              <th>Detination URL</th>
    				  <th>Status</th>
    				  <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
           <?php 
                //insert query//
                $r="select * from slider order by 1 desc";
                $sr=1;
                $result=mysqli_query($conn,$r) or die (mysql_error());
                while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
                	$id=$row['id'];
                	$image_name=$row['image_name'];
                	$image_alt=$row['image_alt'];
                	$image_title=$row['image_title'];
                	$status=$row['status'];
                	$destination_url=$row['destination_url'];
                	
                ?>
            <tr>
              <td><?php echo $sr;?></td>
              <td><img src="../images/slides/<?php echo $image_name;?>" height="50px" width="50px" /></td>
              <td><?php echo $image_alt;?></td>
    				  <td><?php echo $image_title;?></td>
    				  <td><?php echo $destination_url;?></td>
    				  <td><?php echo $status;?></td>
              <td>
    						<button id="<?php echo $id; ?>" title="Edit" class="btn btn-success" onclick="editslider(id,'views/editsliderajax.php?id=')"><i class="fa fa-pencil-square-o"></i></button>
    						<button title="Delete" id="<?php echo $id; ?>" class="btn btn-danger delete" data-href="slider.php?del=" data-toggle="modal" data-target="#myModal"><i class="fa fa-times"></i></button></td>
              </tr>
              <?php $sr++;	}?>

            </tbody>
       </table>

    <!-- /.box-body -->
<script>
  
  //delete confirm popup
      $('.delete').click(function(){
      var id= $(this).attr('id');
      var href= $(this).attr('data-href');
      $('.del-confirm').attr('href',href+id);
      });
  //delete confirm popup
    
  // initialize datatable on about page
   $('#example').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
</script>