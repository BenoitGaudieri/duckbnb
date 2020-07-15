require("./bootstrap");

// const search = instantsearch({
//     indexName: "apartments",
//     searchClient: algoliasearch(
//         process.env.MIX_ALGOLIA_APP_ID,
//         process.env.MIX_ALGOLIA_SEARCH
//     )
// });

const { result } = require("lodash");

// search.addWidgets([
//     instantsearch.widgets.searchBox({
//         container: "#searchbox"
//     }),
//     instantsearch.widgets.clearRefinements({
//         container: "#clear-refinements"
//     }),
//     instantsearch.widgets.refinementList({
//         container: "#services",
//         attribute: "services"
//     }),
//     instantsearch.widgets.hits({
//         container: "#hits",
//         templates: {
//             item: `
//           <div class="container">
//             <img src="/storage/{{ img_url }}" align="left" alt="{{title}}" />
//             <div class="hit-name">
//               {{#helpers.highlight}}{ "attribute": "title" }{{/helpers.highlight}}
//             </div>
//             <div class="hit-description">
//               {{#helpers.highlight}}{ "attribute": "description" }{{/helpers.highlight}}
//             </div>
//             <div class="item-lng">{{id}}</div>
//             <div class="hit-price">\${{price}}</div>
//             <div class="item-lat">{{lat}}</div>
//             <div class="item-lng">{{lng}}</div>
//             <div class="servizi">{{services}}</div>
//           </div>
//         `
//         }
//     }),
//     instantsearch.widgets.pagination({
//         container: "#pagination"
//     })
// ]);

// search.start();

/**
 * GEOLOC
 */
const client = algoliasearch("NWETNAHZK6", "74f79f9cd51ac246370b92525271c814");
const index = client.initIndex("apartments");

// Algolia places
var placesAutocomplete = places({
    appId: process.env.MIX_PLACES_APPID,
    apiKey: process.env.MIX_PLACES_APIKEY,
    container: document.querySelector("#address-input")
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

{
    /* <a href="apartments/{{ id }}" class="card mb-4">
Vai all'appartamento
</a> */
}
