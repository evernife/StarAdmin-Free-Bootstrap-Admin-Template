//Declaração
var replace_here           = document.getElementById('replace-here');

function loadNewContent(){
    $.ajax("arima.html",{
        success: function(response) {
            $("#showthemall").html(response);
        }
    });
};

$("#showthemall").on('click',loadNewContent);




