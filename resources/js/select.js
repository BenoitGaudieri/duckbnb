require("./bootstrap");

const { ajax } = require("jquery");

$(document).ready(function() {
    // refs
    let results = $(".card");
    let selectRooms = $("#select-rooms");
    let selectBeds = $("#select-beds");
    const filter = $("#test");

    // setup
    var roomsInput = 0;
    var bedsInput = 0;

    // HANDLEBARS
    let source = $("#apt-template").html();
    let template = Handlebars.compile(source);
    let container = $("#apts");

    // Selects listeners
    selectRooms.change(roomHandle);
    selectRooms.change(bedHandle);

    $("#reset").on("click", function(e) {
        e.preventDefault();
        $(".card").show();
        $("input[type=checkbox]").prop("checked", false);
    });

    /**
     * Update values
     */
    // Room value
    function roomHandle() {
        roomsInput = 0;
        if (selectRooms.val()) {
            console.log(selectRooms.val());
            roomsInput = selectRooms.val();
        }
    }

    // Beds value
    function bedHandle() {
        bedsInput = 0;
        if (selectBeds.val()) {
            console.log(selectBeds.val());
            bedsInput = selectBeds.val();
        }
    }

    const apiUrl =
        window.location.protocol +
        "//" +
        window.location.host +
        "/api/apartments/api";
    // "http://127.0.0.1:8000/api/apartments/api";

    /**
     * API call
     */
    filter.on("click", function(e) {
        e.preventDefault();

        // creates a string from an array
        var arrInString = idArr.join(", ");

        var urlCombo = `${apiUrl}?filter=${arrInString}&rooms=${roomsInput}&beds=${bedsInput}`;
        console.log(urlCombo);

        fetch(urlCombo)
            .then(response => response.json())
            .then(function(data) {
                container.html("");
                for (var res in data) {
                    let apt = data[res];

                    let context = {
                        id: apt.id,
                        title: apt.title,
                        img: apt.img_url,
                        prezzo: apt.price,
                        rooms: apt.room_qty,
                        beds: apt.bed_qty,
                        baths: apt.bathroom_qty,
                        sqr: apt.sqr_meters
                    };
                    let output = template(context);
                    container.append(output);
                }
            });
    });

    //
}); //end ready

/**
 * Input logic
 */
// $('input[type="checkbox"]').click(function() {
//     if ($(this).prop("checked") == true) {
//         var selectedService = $(this).val();
//         console.log(selectedService);

//         for (let i = 0; i < results.length - 1; i++) {
//             var services = $(".card")
//                 .eq(i)
//                 .find(".nome-servizio");
//             console.log(services.length);

//             for (let s = 0; s < services.length; s++) {
//                 var servizio = $(".card")
//                     .eq(i)
//                     .find(".nome-servizio")
//                     .eq(s)
//                     .text();
//                 console.log("Servizio:", servizio);

//                 if (servizio == selectedService) {
//                     $(".card")
//                         .eq(i)
//                         .show();
//                     console.log("ja");
//                 } else {
//                     $(".card")
//                         .eq(i)
//                         .hide();
//                 }
//             }
//         }
//     } else if ($(this).prop("checked") == false) {
//         console.log("Checkbox is unchecked.");
//     }
// });
