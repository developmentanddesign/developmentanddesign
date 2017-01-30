<?php require_once('../config/config.php');?>
<table id="example3" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
      <th>Sr.</th>
      <th>Article</th>
      <th>Created</th>
      <th class="text-center">Actions</th>
    </tr>
    </thead>
    <tbody>
   <?php 
        //fetch query//
          $r="select * from articles order by 1 desc";
        $sr=1;
        $result=mysqli_query($conn,$r) or die (mysql_error());
        while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){
          $id=$row['id'];
        	$title=$row['title'];
        	$content=$row['content'];
        	$created=$row['created'];
        	$lastupdate=$row['lastupdate'];
        ?>
        <tr>
          <td><?php echo $sr;?></td>
          <td> <?php echo strlen($title) > 50 ? ucwords(substr($title,0,50))."..." : ucwords($title);?></td>
          <td>
              <span class="pull-left"><?php echo $created?></span>
          </td>
          <td class="text-center">
      		  <button id="<?php echo $id; ?>" data-href="addalbum.php" title="Edit" onclick="editarticle(id,'views/editarticleajax.php')" class="btn btn-success edit-btn">
      		    <i class="fa fa-pencil-square-o"></i>
      		  </button>
      		  <button title="Delete" id="<?php echo $id; ?>" class="btn btn-danger delete" data-href="articles.php?del=" data-toggle="modal" data-target="#myModal"><i class="fa fa-times"></i></button>
      	  </td>
        </tr>
    <?php $sr++;}?>

    </tbody>
</table>
<script>
  // initializing data table
    $('#example3').DataTable({ });
    // initializing data table
    
    //  image delete action
    $('.delete').click(function(){
    var id= $(this).attr('id');
    var href= $(this).attr('data-href');
    $('.del-confirm').attr('href',href+id);
    });
     //  image delete action
</script>