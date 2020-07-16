require("./bootstrap");

/**
 * GEOLOC
 */
const client = algoliasearch("NWETNAHZK6", "74f79f9cd51ac246370b92525271c814");
const index = client.initIndex("apartments");

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

    index
        .search("", {
            aroundLatLng: `${lat}, ${lng}`,
            // aroundRadius: 1000000 // 1000 km
            aroundRadius: 20000 // 20 km
        })
        .then(({ hits }) => {
            hits.forEach(item => {
                apts.push(item["id"]);
            });
            document.getElementById("apartmentId").value = apts;
            console.log(apts);
        });
}
