//Controlling access on Frame Size
$("#s_framesize").focus(function () {
    console.log('focussed');
    document.addEventListener("keydown", function (event) {
        if (event.which == 32) {
            var $xframe = $('#s_framesize');
            var $xframe_check = $('#s_framesize').val();
            if ($xframe_check.indexOf('X') > -1) {}
            else {
                $xframe.val($xframe.val() + 'X');
            }
        }
    });
});
//Type only Numbers in Frame Size -> Do Sale
$(document).ready(function () {
    //called when key is pressed in textbox
    $("#s_framesize").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 45 || e.which > 57)) {
            return false;
        }
    });
});

//Type only Numbers in Quantity -> Do Sale
$(document).ready(function () {
    //called when key is pressed in textbox
    $("#s_quantity").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 47 || e.which > 57)) {
            return false;
        }
    });
});

//Type only Numbers in Quantity -> Do Sale
$(document).ready(function () {
    //called when key is pressed in textbox
    $("#s_choona").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 47 || e.which > 57)) {
            return false;
        }
    });
});

//Disables inner size if frame is selected
$("#s_type").change(function () {
    var get_inner = $('#s_type option:selected').text();
    if (get_inner == 'Frame') {
        $("#s_framesize").prop("disabled", false);
    }
    else {
        $("#s_framesize").prop("disabled", true);
    }
});


//AutoHide System-alert in 4 seconds
$(document).ready(function () {
    $("#system-alert").fadeTo(40000, 1000).slideUp(1000, function(){
        $("#system-alert").alert('close');
    });
    });