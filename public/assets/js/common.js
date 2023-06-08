$(document).ready(function(){
    $(".deleteRecord").click(function(){
        $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('#csrf_token').val()
            }
        });
        var id = $(this).data("id");
        $.ajax(
        {
            url: "category/"+id,
            type: 'DELETE',
            data: "id"+ id,
            success: function (){
                console.log("Record successfully deleted");
            }
        });
    });
    $("input[id='opening_balance']").keydown(function (event) {
        if (event.shiftKey == true) {
            event.preventDefault();
        }
        if (event.keyCode != 118 && (event.keyCode >= 48 && event.keyCode <= 57) || 
            (event.keyCode >= 96 && event.keyCode <= 105) || 
            event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 ||
            event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

        } else if($(this).val().indexOf('.') == -1  &&  (event.keyCode == 110 || event.keyCode == 190)) {
        } else {
            event.preventDefault();
        }
    });
});
