$(document).ready(function(){  


    alert('Hej från Test!'); 
        $('#chart').hide();
        $('.byt').click(function(e) {
            alert('Nu byter vi!');
            $('#count-div').hide();
            $('#chart').show();
            e.preventDefault();
        });
    });
