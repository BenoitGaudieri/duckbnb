import $ from 'jquery';

$(document).ready(function() {
    var apartments = getIds();
    console.log(apartments);

    var globalFilters = {
        services: []
    }

    $(document).on('change', 'input:checkbox', function() {
        getFilters(globalFilters);
        callApi(apartments);
    });




}); // <--- End Ready


function callApi(apartments) {
    $.ajax({
        url: 'http://127.0.0.1:8000/api/apartments/',
        data: {
            id: apartments.join(',')
        },
        success: function(res) {
            console.log(res);
        },
        error: function() {
            console.log('Errore');
        }
    })
}

function getFilters(globalFilters) {
    var services = globalFilters.services;
    
    $('input:checkbox').each(function() {
        var self = $(this);
        var serviceId = self.attr('data-id');

        if( self.prop('checked') == true ) {
            console.log('Checked');
            if( !services.includes(serviceId) ) {
                services.push(serviceId);
            }
        } else {
            console.log('Unchecked');
            if( services.includes(serviceId) ) {
                var index = services.indexOf(serviceId);
                if (index > -1) {
                    services.splice(index);
                }
            }
        }
    })
    
    console.log(globalFilters);
}

function getIds() {
    var ids = [];

    $('.card').each(function() {
        ids.push( $(this).attr('data-id') );
    })

    return ids;
}