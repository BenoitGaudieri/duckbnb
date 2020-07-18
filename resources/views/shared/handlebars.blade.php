
{{-- Handlebars --}}
<script id="apt-template" type="text/x-handlebars-template">
    <div class="card">
        <a href="{{ url('apartments') }}/@{{id}}" class="card-apt--img">
            <h2>@{{ title }}</h2>
        </a>
        <img class="img-fluid" src="{{ asset('storage') }}/@{{ img }}" alt="{{ $apartment->title }}">
        <h6><span class="weight-light price">Prezzo:</span> @{{ prezzo }}€</h6>
        <h6><span class="weight-light">Stanze:</span> <span class="rooms">@{{ rooms }}</span></h6>
        <h6><span class="weight-light">Posti Letto:</span> @{{beds}}</h6>
        <h6><span class="weight-light">Bagni:</span> @{{ baths }}</h6>
        <h6><span class="weight-light">m&sup2;:</span> @{{ sqr }}</h6>
</script>