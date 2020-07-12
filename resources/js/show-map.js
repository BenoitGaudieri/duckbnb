const { isNull } = require("lodash");

require("./bootstrap");

let startLat = document.querySelector("#lat").innerHTML;
let startLng = document.querySelector("#lng").innerHTML;

const mapDiv = document.querySelector("#mapid");
let mymap = L.map(mapDiv, {
    // Map control deactivated in show
    dragging: false,
    zoomControl: false,
    scrollWheelZoom: false
}).setView([startLat, startLng], 13);

L.tileLayer(
    "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}",
    {
        attribution:
            'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: "mapbox/streets-v11",
        tileSize: 512,
        zoomOffset: -1,
        accessToken: process.env.MIX_L_TOKEN
    }
).addTo(mymap);

/**
 * Reverse geoloc
 */
let places = algoliasearch.initPlaces(
    process.env.MIX_PLACES_APPID,
    process.env.MIX_PLACES_APIKEY
);

let latFlt = parseFloat(startLat);
let lngFlt = parseFloat(startLng);

places
    .reverse({
        aroundLatLng: latFlt + "," + lngFlt
    })
    .then(updateDiv);

function updateDiv(response) {
    var hits = response.hits;
    // The first hit is the most accurate
    var suggestion = hits[0];
    var addressDiv = document.querySelector("#address");

    // Check the response for italian names
    if (suggestion.locale_names.it && suggestion.country.it) {
        addressDiv.innerHTML = `${suggestion.locale_names.it}, ${suggestion.country.it}`;
    } else if (suggestion.locale_names.default && suggestion.country.default) {
        addressDiv.innerHTML = `${suggestion.locale_names.default}, ${suggestion.country.default}`;
    } else {
        addressDiv.innerHTML = "Impossibile localizzarti";
    }
}
