<?php require_once('../config/config.php');?>
<table id="example" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
      <th>Sr.</th>
      <th>Title</th>
      <th>Cover</th>
      <th class="text-center">Actions</th>
    </tr>
    </thead>
    <tbody>
   <?php 
        //insert query//
        $r="select * from albums order by 1 desc";
        $sr=1;
        $result=mysqli_query($conn,$r) or die (mysql_error());
        while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
            $id=$row['id'];
        	$title=$row['title'];
        	$image_name=$row['cover'];
        ?>
        <tr>
          <td><?php echo $sr;?></td>
          <td><?php echo ucwords($title);?></td>
          <td><img src="../images/albumcover/<?php echo $image_name;?>" height="50px" width="50px" /></td>
          <td class="text-center">
      		<button title="Edit" class="btn btn-success"><i class="fa fa-pencil-square-o"></i></button>
      		<button title="Delete" id="<?php echo $id; ?>" class="btn btn-danger delete" data-href="addalbum.php?del=" data-toggle="modal" data-target="#myModal"><i class="fa fa-times"></i></button>
      		</td>
        </tr>
    <?php $sr++;}?>

    </tbody>
</table>
<script>
   $('#example').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
</script>