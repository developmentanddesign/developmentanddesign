$(function () {
    $('.delete').click(function(){
    var id= $(this).attr('id');
    $('.del-confirm').attr('href','allslides.php?del='+id);
    });
    $('#myModal').on('shown.bs.modal', function () {
    });
});