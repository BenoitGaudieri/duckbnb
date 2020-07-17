import $ from 'jquery';

$(document).ready(function() { 
    // var form = document.querySelector('#payment-form');
    // var client_token = "{{ $token }}";

    // braintree.dropin.create({
    // authorization: client_token,
    // selector: '#bt-dropin',
    // paypal: {
    //     flow: 'vault'
    // }
    // }, function (createErr, instance) {
    // if (createErr) {
    //     console.log('Create Error', createErr);
    //     return;
    // }
    // form.addEventListener('submit', function (event) {
    //     event.preventDefault();

    //     instance.requestPaymentMethod(function (err, payload) {
    //     if (err) {
    //         console.log('Request Payment Method Error', err);
    //         return;
    //     }

    //     // Add the nonce to the form and submit
    //     document.querySelector('#nonce').value = payload.nonce;
    //     form.submit();
    //     });
    // });
    // });

   
    var pack = $('.btn-pack'); // Get packs
    let amountInput = $('input#amount'); // Get Amount input
    let packInput = $('input#pack'); // Get Pack input

    pack.click( function() {

        // Get Price and duration
        let id = $(this).siblings('.pack-id').text();
        let price = $(this).siblings('.price').text();
        let duration = $(this).siblings('.duration').text();

        // Set price 
        amountInput.val(price);

        // Set pack id
        packInput.val(id);

    })

    });



    