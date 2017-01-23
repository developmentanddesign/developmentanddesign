<?php require_once('../config/config.php');?>
	     <table id="example" class="table table-striped table-bordered dt-responsive nowrap">
            <thead>
            <tr>
              <th>Sr.</th>
              <th>Title</th>
              <th>Description</th>
              <th>Meta Title</th>
              <th>Meta Description</th>
              <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
           <?php 
                //insert query//
                $r="select * from aboutus";
                $sr=1;
                $result=mysqli_query($conn,$r) or die (mysql_error());
                while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
                    $id=$row['id'];
                	$title=$row['title'];
                	$desc=$row['description'];
                	$mtitle=$row['meta_title'];
                	$mdesc=$row['meta_desc'];
                	
                ?>
                <tr>
                  <td><?php echo $sr;?></td>
                  <td><?php echo $title;?></td>
                  <td><?php echo wordwrap($desc,35,"<br>\n");?></td>
                  <td><?php echo $mtitle;?></td>
                  <td><?php echo wordwrap($mdesc,35,"<br>\n");?></td>
                  <td class="text-center">  
						        <button title="Delete" id="<?php echo $id; ?>" class="btn btn-danger delete" data-href="about.php?del=" data-toggle="modal" data-target="#myModal"><i class="fa fa-times"></i></button>
						      </td>
                </tr>
			      <?php $sr++;}?>

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