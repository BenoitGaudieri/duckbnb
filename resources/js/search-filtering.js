import $ from 'jquery';

$(document).ready(function() {

    var apartments = getIds();

    $(document).on('change', 'input:checkbox', function() {
        $('#search-results').html('');
        callApi(apartments);
    });
    
    $(document).on('change', 'select', function() {
        $('#search-results').html('');
        callApi(apartments);
    });
    
    $(document).on('click', '#reset', function() {
        $('#search-results').html('');
        clearFilters();
        resetCall(apartments);
    });

}); // <--- End Ready


function callApi(apartments) {
    $.ajax({
        url: 'http://127.0.0.1:8000/api/apartments/',
        data: dataCompile(apartments),
        success: function(res) {
            console.log(res);
        },
        error: function() {
            console.log('Errore');
        }
    })
}

function getServices() {
    var services = [];
    
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

    if(services.length != 0) {
        return services;
    } else {
        services.push('all');
        return services;
    }
}

function getIds() {
    var ids = [];

    $('.card').each(function() {
        ids.push( $(this).attr('data-id') );
    })

    return ids.join(',');
}

function dataCompile(apartments) {
    var data = {
        id: apartments,
        services: getServices().join(','),
        rooms: $('#select-rooms').val(),
        beds: $('#select-beds').val()
    }

    console.log(data);
    return data;
}

function clearFilters() {
    $('input:checkbox').each(function(){
        var self = $(this);

        self.prop('checked', false);
    });
    
    $('select').each(function(){
        var self = $(this);

        self.val('1');
    });
}

function resetCall(apartments) {
    $.ajax({
        url: 'http://127.0.0.1:8000/api/apartments/',
        data: {
            id: apartments,
            services: 'all',
            rooms: $('#select-rooms').val(),
            beds: $('#select-beds').val()
        },
        success: function(res) {
            console.log(res);
        },
        error: function() {
            console.log('Errore');
        }
    });
}