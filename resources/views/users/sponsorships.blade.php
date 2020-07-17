@extends('layouts.app')

@section('content')
    @if (session('success_message'))
            <div class="alert alert-success">
                {{ session('success_message')}}
            </div>
    @endif

    @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
    @endif

    <div class="content container">
        <div class="pack">
            <div class="pack-title">
                <h2>Packages</h2>
            </div>
            <div class="pack-packages">
                @foreach($sponsorship as $sponsor)
                <div class="pack-basic">
                    <p class="pack-id">{{ $sponsor->id }}</p>        
                    <p class="price">{{ $sponsor->price }}</p>
                    <div class="duration">{{ $sponsor->duration }}</div>
                    <a id="basic" href="#" class="button-dark btn-pack">Scegli</a>
                </div>
                @endforeach
            </div>
        </div>
        <div class="payment">
            <form method="post" id="payment-form" action="{{ route('user.sponsorships.checkout', $apartment->id) }}">
                        @csrf
                        <section>
                            <label for="amount">
                                <span class="input-label">Amount</span>
                                <div class="input-wrapper amount-wrapper">
                                    <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="0">
                                </div>
                            </label>

                            <label for="pack">
                                <span class="input-label">Pack</span>
                                <div class="input-wrapper amount-wrapper">
                                    <input id="pack" name="pack" type="tel" min="1" placeholder="pack" value="0">
                                </div>
                            </label>
           
                            <div class="bt-drop-in-wrapper">
                                <div id="bt-dropin"></div>
                            </div>
                        </section>
    
                        <input id="nonce" name="payment_method_nonce" type="hidden" />
                        <button class="button" type="submit">
                            <span>Test Transaction</span>
                        </button>
            </form>
        </div>
    </div>
        </div>
        
        <script>

            var form = document.querySelector('#payment-form');
            var client_token = "{{ $token }}";

            braintree.dropin.create({
            authorization: client_token,
            selector: '#bt-dropin',
            paypal: {
                flow: 'vault'
            }
            }, function (createErr, instance) {
            if (createErr) {
                console.log('Create Error', createErr);
                return;
            }
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                instance.requestPaymentMethod(function (err, payload) {
                if (err) {
                    console.log('Request Payment Method Error', err);
                    return;
                }

                // Add the nonce to the form and submit
                document.querySelector('#nonce').value = payload.nonce;
                form.submit();
                });
            });
            });
        </script>
@endsection

@push('scripts')
<script src="https://js.braintreegateway.com/web/dropin/1.23.0/js/dropin.min.js"></script>
        <script src="{{ asset('js/sponsorship.js')}}"></script>
@endpush