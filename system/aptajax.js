$(function () {

$('#blok').on('change',function () {
var blok=$(this).val();
        if(blok){
            $.post('system/ajax.php',{'blok':blok},function (response) {
               $('#kisi').html(response).removeAttr('disabled');
            });
        }
        else{
            $('#kisi').html('<option>-Kişi Seçin-</option>').attr('disabled','disabled');
        }
});


});

$('#number').keypress(function (e) {
    if (this.value.length == 0 && e.which == 48)
    {
        $(".help-block").fadeIn('slow').fadeOut('slow');
        return false;
    }
});