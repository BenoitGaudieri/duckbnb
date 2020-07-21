import $ from "jquery";
import Handlebars from "handlebars";

$(document).ready(function() {
    var source = $("#card-template").html();
    const template = Handlebars.compile(source);

    const client = algoliasearch("47VSO533ZH", "eaa5d8cf24f4fb6090811993ad43f3fd");
    const index = client.initIndex("apartments");
    
    var origin = {
        lat: $('#origin-lat').val(),
        lng: $('#origin-lng').val()
    };

    $(document).on('change', '.search-option', function() {
        var radius = $('#select-radius input:checked').val();
        var apartments = [];
        var services = getServices();
        var rooms = $("#select-rooms").val();
        var beds = $("#select-beds").val();

        index
        .search("", {
            aroundLatLng: `${origin.lat}, ${origin.lng}`,
            // aroundRadius: 1000000 // 1000 km
            aroundRadius: radius // 20 km
        })
        .then(({ hits }) => {
            hits.forEach(item => {
                apartments.push(item["id"]);
            });
            
            $("#search-results").html('');

            $.ajax({
                url: "http://127.0.0.1:8000/api/apartments/",
                data: {
                    id: joinApartments(apartments),
                    services: services,
                    rooms: rooms,
                    beds: beds
                },
                success: function(data) {
                    var results = data.response;
                    console.log(data.response);

                    for (let i = 0; i < results.length; i++) {
                        var item = results[i];

                        var ctx = {
                            id: item.id,
                            imgUrl: item.img_url,
                            title: item.title,
                            price: item.price,
                            rooms: item.room_qty,
                            beds: item.bed_qty,
                            bathrooms: item.bathroom_qty,
                            sqrMeters: item.sqr_meters
                        };

                        var html = template(ctx);
                        $("#search-results").append(html);
                    }
                },
                error: function() {
                    console.log("Errore");
                }
            });

        });

    });

    $(document).on('click', '#reset', function() {
        var apartments = [];
        
        index
        .search("", {
            aroundLatLng: `${origin.lat}, ${origin.lng}`,
            // aroundRadius: 1000000 // 1000 km
            aroundRadius: 20000 // 20 km
        })
        .then(({ hits }) => {
            hits.forEach(item => {
                apartments.push(item["id"]);
            });
            
            clearFilters();
            $("#search-results").html('');

            $.ajax({
                url: "http://127.0.0.1:8000/api/apartments/",
                data: {
                    id: joinApartments(apartments),
                    services: 'all',
                    rooms: 1,
                    beds: 1
                },
                success: function(data) {
                    var results = data.response;
                    console.log(data.response);

                    for (let i = 0; i < results.length; i++) {
                        var item = results[i];

                        var ctx = {
                            id: item.id,
                            imgUrl: item.img_url,
                            title: item.title,
                            price: item.price,
                            rooms: item.room_qty,
                            beds: item.bed_qty,
                            bathrooms: item.bathroom_qty,
                            sqrMeters: item.sqr_meters
                        };

                        var html = template(ctx);
                        $("#search-results").append(html);
                    }
                },
                error: function() {
                    console.log("Errore");
                }
            });
        });
    });

}); // <--- End Ready

/* FUNCTIONS */

function getServices() {
    var serviceIds = [];

    $("input:checkbox").each(function() {
        var self = $(this);
        var serviceId = self.attr("data-id");

        if (self.prop("checked") == true) {
            console.log("Checked");
            if (!serviceIds.includes(serviceId)) {
                serviceIds.push(serviceId);
            }
        } else {
            console.log("Unchecked");
            if (serviceIds.includes(serviceId)) {
                var index = serviceIds.indexOf(serviceId);
                if (index > -1) {
                    serviceIds.splice(index);
                }
            }
        }
    });

    

    if (serviceIds.length != 0) {
        var services = serviceIds.join(',');
        return services;
    } else {
        services = "all";
        return services;
    }
}

function joinApartments(apartments) {
    var result = apartments.join(',');
    return result;
}

function clearFilters() {
    var self = $(this);

    $("input:checkbox").each(function() {
        self.prop("checked", false);
    });

    $("select").each(function() {
        self.val("1");
    });

    $('#select-radius input').each(function() {
        if(self.prop('checked', true)) {
            self.prop('checked', false)
        }
    });

    $('#select-radius #20').prop('checked', true);
}