<?php require_once('../config/config.php');?>
<table id="example3" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
      <th>Sr.</th>
      <th>Album</th>
      <th>Image</th>
      <th>Created</th>
      <th class="text-center">Actions</th>
    </tr>
    </thead>
    <tbody>
   <?php 
        //fetch query//
        if($_POST['select']=="all"){
          $r="select * from albumimages order by 1 desc";
        }elseif($_POST['select']=="one"){
          $id=$_POST['id'];
           $r="select * from albumimages where parent_id=$id order by 1 desc";
        }else{
          $r="select * from albumimages order by 1 desc";
        }
        $sr=1;
        $result=mysqli_query($conn,$r) or die (mysql_error());
        while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
            $id=$row['id'];
        	$image_name=$row['image'];
        	$created=$row['created'];
        	$lastupdate=$row['lastupdate'];
        	$parent_id=$row['parent_id'];
        	$q1="select * from albums where id=$parent_id";
        	$p1=mysqli_query($conn,$q1);
        	while($row1=mysqli_fetch_array($p1)){
        	    $title=$row1['title'];
        ?>
        <tr>
          <td><?php echo $sr;?></td>
          <td> <?php echo strlen($title) > 50 ? ucwords(substr($title,0,50))."..." : ucwords($title);?></td>
          <td><img src="../images/albumimages/<?php echo $image_name;?>" alt="<?php echo $image_name;?>" height="50px" width="50px" /></td>
          <td>
              <span class="pull-left"><?php $dateObject = new DateTime($created);
                    echo $dateObject->format("d-m-y  H:i A");?></span>
          </td>
          <td class="text-center">
      		<button title="Delete" id="<?php echo $id; ?>" class="btn btn-danger delete" data-href="addimages.php?del=" data-toggle="modal" data-target="#myModal"><i class="fa fa-times"></i></button>
      	  </td>
        </tr>
    <?php } $sr++;}?>

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
    
    //  image delete action
    $('.delete').click(function(){
    var id= $(this).attr('id');
    var href= $(this).attr('data-href');
    $('.del-confirm').attr('href',href+id);
    });
     //  image delete action
</script>