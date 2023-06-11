$(document).ready(function(){
    $(".deleteRecord").click(function(){
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
    $(".float_num").keyup(function (event) {
        if (event.shiftKey == true) {
            event.preventDefault();
        }
        if (event.keyCode != 118 && (event.keyCode >= 48 && event.keyCode <= 57) || 
            (event.keyCode >= 96 && event.keyCode <= 105) || 
            event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 ||
            event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

        } else if($(this).val().indexOf('.') == -1  &&  (event.keyCode == 110 || event.keyCode == 190)) {
        } else if((event.keyCode == 109 || event.keyCode == 189)) {
        }else {
            event.preventDefault();
        }
        if ( ($(".compareQuantity").val() == 1) && $('#inward_qty').val() != '') {
            let maxQty = parseFloat($('#inward_qty').val());
            let entered = parseFloat($(this).val());
            if( (maxQty + entered) < 0 ){
                alert('Quantity should not be greater than opening balance');
                $('.float_num').val('');
            }
        }
    });

    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 2000);

    $("#material_id").change(function() {
        var token = $('input[name="_token"]').val();
        var id = $('#material_id').val();
        $.ajax( {
            type: "POST",
            url: '/balance',
            data: {'_token':token, 'id':id},
            dataType:'JSON',
            success: function(response) {
                $('#inward_qty').val("");
                $('#inward_qty').val(response);
                $('#inward_qty_c').val("");
                $('#inward_qty_c').val(response);
            }
        });
    });

    $( "#datepicker" ).datepicker( {dateFormat: 'yy-mm-dd'} );

});
