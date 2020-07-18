import $ from 'jquery';

$(document).ready(function() {

    var globalFilters = {
        services: []
    }

    $(document).on('change', 'input:checkbox', function() {
        getFilters(globalFilters);
    });




}); // <--- End Ready


function callApi() {
    $.ajax({
        url: 'http://127.0.0.1:8000/api/apartments/',
        success: function(res) {
            console.log(res);
        },
        error: function() {
            console.log('Errore');
        }
    })
}

function getFilters(globalFilters) {
    $('input:checkbox').each(function() {
        if( $(this).prop('checked') == true ) {
            console.log('Checked');
            if( !globalFilters.services.includes($(this).attr('data-id')) ) {
                globalFilters.services.push($(this).attr('data-id'));
            }
        } else {
            console.log('Unchecked');
            if( globalFilters.services.includes($(this).attr('data-id')) ) {
                var index = globalFilters.services.indexOf($(this).attr('data-id'));
                if (index > -1) {
                    globalFilters.services.splice(index);
                }
            }
        }
    })
    console.log(globalFilters);
}