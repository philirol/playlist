@extends('layouts.app')

@section('content')
<form action="{{ route('don.post2') }}" method="post" id="payment-form">
 @csrf
<div class="py-4 container">
    <div class="row justify-content-center">  
          <div class="col-md-8">
                    <div class="card">
                        <div class="card-header" >
                            <h4 class="float-left">Payment Details </h4>
                            <div class="float-right" ><img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png"></div>
                        </div>
                        <div class="card-body" >
                            <h5 class="card-title">Credit or debit card</h5><br><br>
                            <div id="card-element"></div>
                            <div id="card-errors" role="alert"></div><br><br>
                            <button class="btn btn-primary btn-lg btn-block" type="submit">@lang('Versement de') {{session('amount')}} €</button>
                        </div>
                    </div><br>
                    <a href="javascript:history.back()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> @lang('Retour')</a> 
          </div>
    </div>
</div>                   
                                   
</form>  
@endsection
@section('scripts')

<script src="https://js.stripe.com/v3/"></script>
<script>

var stripe = Stripe('{{ env("STRIPE_KEY") }}');

var elements = stripe.elements();

var style = {
    base: {
        color: '#32325d',
        lineHeight: '24px',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
          color: '#aab7c4'
        }
  },
  invalid: {
      color: '#fa755a',
      iconColor: '#fa755a',
  }
};

var card = elements.create('card', {style: style});
card.mount('#card-element');

card.addEventListener('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
      displayError.textContent = '';
    }
});

var form = document.getElementById('payment-form');

form.addEventListener('submit', function(event) {
      event.preventDefault();

      stripe.createToken(card).then(function(result) {
      if (result.error) {
          // Inform the user if there was an error
          var errorElement = document.getElementById('card-errors');
          errorElement.textContent = result.error.message;
      } else {
        // Send the token to your server
        stripeTokenHandler(result.token);
      }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
</script>
@endsection