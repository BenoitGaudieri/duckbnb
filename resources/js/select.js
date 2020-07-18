require("./bootstrap");

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

const { ajax } = require("jquery");

$(document).ready(function() {
    // setup

    let selectRooms = $("#select-rooms");
    let results = $(".card");

    $("#reset").on("click", function(e) {
        e.preventDefault();
        $(".card").show();
        $("input[type=checkbox]").prop("checked", false);
    });

    selectRooms.change(roomSelect);

    function roomSelect() {
        if (selectRooms.val()) {
            console.log(selectRooms.val());
            heya = selectRooms.val();
        }
    }
    const filter = $("#test");
    var heya = 0;
    // const filter = $('input[type="checkbox"]');

    const apiUrl =
        window.location.protocol +
        "//" +
        window.location.host +
        "/api/apartments/api";
    // console.log(apiUrl);
    // "http://127.0.0.1:8000/api/apartments/api";

    // HANDLEBARS
    // let source = $("#student-template").html();
    // let template = Handlebars.compile(source);
    // let container = $(".students");

    /**
     * Handle the selector view with handlebars
     * using the array returned with the logic of the Api/StudentController
     */

    /**
     * FETCH TO SET BEDS AND ROOMS,
     * JQUERY TO SET THE SERVICES
     * but it won't work because on the refresh it goes fuck all
     * unless I recheck?
     */
    filter.on("click", function(e) {
        e.preventDefault();

        var arrInString = idArr.join(", ");

        // console.log("From Blade:", idArr.join(", "));
        // console.log("Array in stringa: ", arrInString);
        // var urlCombo = `${apiUrl}?filter=${arrInString}`;
        var urlCombo = `${apiUrl}?filter=${arrInString}&rooms=${heya}`;
        // console.log(urlCombo);

        fetch(urlCombo)
            .then(response => response.json())
            .then(function(data) {
                // console.log(data);
                for (var res in data) {
                    // console.log(data[res]);
                    // object with the apartment
                    let apt = data[res];
                    console.log("id: ", apt.id);
                    console.log("title: ", apt.title);
                    console.log("img_url: ", apt.img_url);
                    console.log("price: ", apt.price);
                    console.log("room_qty: ", apt.room_qty);
                    console.log("bet_qty: ", apt.bed_qty);
                    console.log("bathroom_qty: ", apt.bathroom_qty);
                }
            });

        // Riutilizzare il jquery che onclick sul checkbox aggiunge il value all'url della search

        // $.ajax({
        //     url: apiUrl,
        //     method: "POST",
        //     data: {
        //         filter: 2
        //     }
        // })
        //     .done(function(res) {
        //         if (res.length > 0) {
        //             console.log(res);
        //             // clean
        //             // container.html("");
        //             // for (let i = 0; i < res.response.length; i++) {
        //             //     const item = res.response[i];
        //             //     let context = {
        //             //         slug: item.slug,
        //             //         img: item.img,
        //             //         nome: item.nome,
        //             //         eta: item.eta,
        //             //         assunzione:
        //             //             item.genere == "m" ? "assunto" : "assunta",
        //             //         azienda: item.azienda,
        //             //         ruolo: item.ruolo,
        //             //         descrizione: item.descrizione
        //             //     };
        //             //     let output = template(context);
        //             //     container.append(output);
        //             // }
        //         } else {
        //             console.log(res.error);
        //         }
        //     })
        //     .fail(function(err) {
        //         console.log("Error:", err);
        //     });
    });

    //
}); //end ready
