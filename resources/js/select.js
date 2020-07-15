let selectRooms = $("#select-rooms");
let results = $(".card");

selectRooms.change(function() {
    $(".card").show();
    for (let i = 0; i < results.length; i++) {
        text = $(".card")
            .eq(i)
            .find(".rooms")
            .text();
        console.log(text);

        if (selectRooms.val()) {
            if (text != selectRooms.val()) {
                $(".card")
                    .eq(i)
                    .hide();
            }
        }
    }
});
