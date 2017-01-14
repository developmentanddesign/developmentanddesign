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
      		<button id="<?php echo $id; ?>" data-href="addalbum.php" title="Edit" class="btn btn-success edit-btn"><i class="fa fa-pencil-square-o"></i></button>
      		<button title="Delete" id="<?php echo $id; ?>" class="btn btn-danger delete" data-href="addalbum.php?del=" data-toggle="modal" data-target="#myModal"><i class="fa fa-times"></i></button>
      		</td>
        </tr>
    <?php $sr++;}?>

    </tbody>
</table>
<script>
    // initialize datatable on adalbums page
   $('#example').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
    
    //delete album function
    $('.delete').click(function(){
    var id= $(this).attr('id');
    var href= $(this).attr('data-href');
    $('.del-confirm').attr('href',href+id);
    });
    
    // edit album function in same field
     $('.edit-btn').click(function(){
    var id= $(this).attr('id');
    var href= $(this).attr('data-href');
        $.ajax({
            url: href,
            type: "GET",
            data: {edit: id},
            success: function(data) {
                alert("hello");
            }
        });
    });
    
    /*function ChangeUrl(title, url) {
        if (typeof (history.pushState) != "undefined") {
            var obj = { Title: title, Url: url };
            history.pushState(obj, obj.Title, obj.Url);
        } else {
            alert("Browser does not support HTML5.");
        }
    }*/
</script>
</script>