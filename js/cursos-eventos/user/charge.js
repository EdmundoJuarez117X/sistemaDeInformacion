// clave pública de stripe
var stripe = Stripe("pk_test_51J1NoGIk4HpdCTxANSLrsZZKXKUmSsPk97PmOmRbLXgDRcrfG9TIdBbfJpfjpDm26EotII5urV1Gr5owKZdd4oBm00SnUGHkgn");

// Crear una instancia de elementos
var elements = stripe.elements();

// El estilo personalizado se puede pasar a las opciones al crear un Elemento.
// (Tenga en cuenta que esta demostración utiliza un conjunto de estilos más amplio que la guía a continuación).
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Crear una instancia del elemento de la tarjeta
var card = elements.create('card', { style: style });

// Agregue una instancia del Elemento de la tarjeta en el  `card-element` <div>
card.mount('#card-element');

// Manejar errores de validación en tiempo real desde la tarjeta Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Manejar el envío de formularios
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Informar al usuario si hubo un error
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Envía el token a tu servidor
      stripeTokenHandler(result.token);
    }
  });
});

function stripeTokenHandler(token) {
  // Inserte la ID del token en el formulario para que se envíe al servidor
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}