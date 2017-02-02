$.ajax({
            url: "views/allslidesajax.php",
            type: "POST",
            data: 'data',
            beforeSend: function(){
                 $('.cssload-whirlpool').show();
                 $('.album-box').fadeTo(0,0.1);
             },
            success: function(data) {
             $('.sliderdata').html(data);
            $('.cssload-whirlpool').delay(2000).fadeOut();
            $('.album-box').delay(2000).fadeTo(0, 1);
            }
        });
$('#range').daterangepicker(
        {
           ranges: {
            'Today': [moment(), moment()],
            'Tomorrow': [moment().add(1, 'days'), moment().add(1, 'days')],
            'Next 7 Days': [moment(), moment().add(6, 'days')],
            'Next 30 Days': [moment(), moment().add(29, 'days')],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Next Month': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#range span').html(end.format('MMMM D, YYYY') + ' - ' + start.format('MMMM D, YYYY'));
        }
    );
    
// form submition for adding about details
$("#sliderform").submit(function(event){
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
            $('.cssload-whirlpool').show();
            $('.album-box').fadeTo(0,0.1);
         }
    }).done(function(response){ 
        $("#result").html(response);
        $.ajax({
            url: "views/allslidesajax.php",
            type: "POST",
            data: 'data',
            success: function(data) {
            $('.sliderdata').html(data);
            $('.cssload-whirlpool').delay(2000).fadeOut();
            $('.album-box').delay(2000).fadeTo(0, 1);
            $('#collapseOne').removeClass('in');
            $('#collapseOne').attr('aria-expanded','false');
            $('#collapseThree').addClass('in');
            $('#collapseThree').attr('aria-expanded','true');
            $("[aria-controls=collapseOne]").addClass('collapsed');
            $("[aria-controls=collapseOne]").attr('aria-expanded','false');
            $("[aria-controls=collapseThree]").attr('aria-expanded','true');
            $('#collapseThree').attr('style','');
            $("[aria-controls=collapseThree]").removeClass('collapsed');
            $.ajax({
                url: 'views/editsliderajax.php',
                type: "POST",
                data: 'data',
                success: function(data) {
                 $('.slidersform').html(data);
                 }
            });
            }
        });
    
    });
});
// form submition for adding about details

    
// slide status   
$('.statusbtn1').click(function(){
    $(this).removeClass('btn-default');
    $(this).addClass('btn-success');
    $('.statusbtn2').removeClass('btn-danger');
    $('.statusbtn2').addClass('btn-default');
});
$('.statusbtn2').click(function(){
    $(this).removeClass('btn-default');
    $(this).addClass('btn-danger');
    $('.statusbtn1').removeClass('btn-success');
    $('.statusbtn1').addClass('btn-default');
});
// slide status

// slide timer
$('.timerbtn1').click(function(){
    $(this).removeClass('btn-default');
    $(this).addClass('btn-success');
    $('.timerbtn2').removeClass('btn-danger');
    $('.timerbtn2').addClass('btn-default');
});
$('.timerbtn2').click(function(){
    $(this).removeClass('btn-default');
    $(this).addClass('btn-danger');
    $('.timerbtn1').removeClass('btn-success');
    $('.timerbtn1').addClass('btn-default');
});
// slide timer

function editslider(id,href){
    $('#collapseThree').removeClass('in');
    $('#collapseThree').attr('aria-expanded','false');
    $('#collapseOne').addClass('in');
    $('#collapseOne').attr('aria-expanded','true');
    $("[aria-controls=collapseThree]").addClass('collapsed');
    $("[aria-controls=collapseThree]").attr('aria-expanded','false');
    $("[aria-controls=collapseOne]").attr('aria-expanded','true');
    $('#collapseOne').attr('style','');
    $("[aria-controls=collapseOne]").removeClass('collapsed');
        $.ajax({
                url: href,
                type: "POST",
                data: {edit:id},
                beforeSend: function(){
                     $('.cssload-whirlpool1').show();
                     $('.slidersform').fadeTo(0,0.1);
                 },
                success: function(data) {
                 $('.slidersform').html(data);
                 $('.cssload-whirlpool1').delay(2000).fadeOut();
                 $('.slidersform').delay(2000).fadeTo(0, 1);
                 $("[aria-controls=collapseOne]").html('<div class="panel-heading" role="tab" id="headingOne"><h4 class="panel-title">Update Slide</h4></div>');
                 // html Editor
                }
            });
    }