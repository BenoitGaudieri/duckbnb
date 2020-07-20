require("./bootstrap");

/**
 * GEOLOC
 */
const client = algoliasearch("47VSO533ZH", "eaa5d8cf24f4fb6090811993ad43f3fd");
const index = client.initIndex("apartments");

// Change radius
var radius = 20000;

$(document).on('click', '#select-radius input[type=radio]', function() {
    radius = ($(this).val());
    console.log(radius);
});

// Algolia places
var placesAutocomplete = places({
    appId: process.env.MIX_PLACES_APPID,
    apiKey: process.env.MIX_PLACES_APIKEY,
    container: document.querySelector("#address-input"),
    language: "it",
    aroundLatLngViaIP: true,
    useDeviceLocation: true
});

placesAutocomplete.on("change", changeHandle);

function changeHandle(e) {
    let lat = e.suggestion.latlng.lat;
    let lng = e.suggestion.latlng.lng;
    var apts = [];

    console.log(radius);

    index
        .search("", {
            aroundLatLng: `${lat}, ${lng}`,
            // aroundRadius: 1000000 // 1000 km
            aroundRadius: radius // 20 km
        })
        .then(({ hits }) => {
            hits.forEach(item => {
                apts.push(item["id"]);
            });
            document.getElementById("apartmentId").value = apts;
            console.log(apts);
        });
}
