<html>
    
    
    
$(document).ready (function(){
            $("#system-alert").hide();
            $("#myWish").click(function showAlert() {
                $("#success-alert").alert();
                $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
               $("#success-alert").slideUp(500);
                });   
            });
 });



