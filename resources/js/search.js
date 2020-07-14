const search = instantsearch({
    indexName: "apartments",
    searchClient: algoliasearch(
        process.env.MIX_ALGOLIA_APP_ID,
        process.env.MIX_ALGOLIA_SEARCH
    )
});

search.addWidgets([
    instantsearch.widgets.searchBox({
        container: "#searchbox"
    }),
    instantsearch.widgets.clearRefinements({
        container: "#clear-refinements"
    }),
    instantsearch.widgets.refinementList({
        container: "#services",
        attribute: "services"
    }),
    instantsearch.widgets.hits({
        container: "#hits",
        templates: {
            item: `
          <div class="container">
            <img src="/storage/{{ img_url }}" align="left" alt="{{title}}" />
            <div class="hit-name">
              {{#helpers.highlight}}{ "attribute": "title" }{{/helpers.highlight}}
            </div>
            <div class="hit-description">
              {{#helpers.highlight}}{ "attribute": "description" }{{/helpers.highlight}}
            </div>
            <div class="item-lng">{{id}}</div>
            <div class="hit-price">\${{price}}</div>
            <div class="item-lat">{{lat}}</div>
            <div class="item-lng">{{lng}}</div>
            <div class="servizi">{{services}}</div>
          </div>
        `
        }
    }),
    instantsearch.widgets.pagination({
        container: "#pagination"
    })
]);

search.start();
