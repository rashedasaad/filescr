<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <form action="/buy/done" method="post" id="payment-form">
        @csrf
        <input type="hidden" name="product_name" value="{{ $product_id }}">
        <input type="hidden" name="plan_id" value="{{ $plan_id }}">



        <div class="form-row">
          <label for="card-element">
            Credit or debit card
          </label>
          <div id="card-element">
            <!-- A Stripe Element will be inserted here. -->
          </div>
      
          <!-- Used to display Element errors. -->
          <div id="card-errors" role="alert"></div>
        </div>
      
        <button>Submit Payment</button>
      </form>
    <script src="https://js.stripe.com/v3/"></script>
<script>

 var stripe = Stripe('pk_test_51LRLpEJpSSRZs77gqTQxy8ykfvNTZRSaMAtmLs1j2TlMr44VglC41pCzBX8ifH2omb1vX8w5Iy0LyGXgbHak3BlG0058pHNmci');
var elements = stripe.elements();

var style = {
  base: {
    // Add your base input styles here. For example:
    fontSize: '16px',
    color: '#32325d',
  },
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the customer that there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
  
});
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
</body>
</html>