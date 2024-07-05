<!DOCTYPE html>
<html>

<head>
    <title>Stripe Payment Gateway</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>

    <div class="container">

        <h1>Stripe Payment Gateway Integration <br /></h1>

        <div class="row">
            <div class="container">
                <h2>Subscribe to a Plan</h2>
                <!-- Display any success or error messages -->
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <!-- Subscription Form -->
                <form action="{{ route('stripe.payment') }}" method="POST" id="subscription-form">
                    @csrf

                    <!-- Plan Selection (Assuming two plans for demonstration) -->
                    <div class="form-group">
                        <label for="plan">Select Plan:</label>
                        <select name="plan" id="plan" class="form-control">
                            <option value="plan_id_from_stripe_basic">Basic Plan</option>
                            <option value="plan_id_from_stripe_premium">Premium Plan</option>
                        </select>
                    </div>

                    <!-- Payment Method Element -->
                    <div id="card-element">
                        <!-- A Stripe Element will be inserted here. -->
                    </div>

                    <!-- Form submission -->
                    <button id="submit-button" class="btn btn-primary mt-4">Subscribe</button>
                </form>
            </div>

        </div>

</body>

<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
    // Initialize Stripe and elements
    var stripe = Stripe('pk_test_51OzD44P2jpJZ1J5syWQeAqIyfEta7xpLGwAAmuLtziPmFIJzxHDBG7WedNjUt6vobzP0AQspvVtIs9cGe39wLCcW00JlACclAC');
    // Initialize Stripe and elements
    var elements = stripe.elements();
    var card = elements.create('card');
    card.mount('#card-element');

    // Handle form submission
    var form = document.getElementById('subscription-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error.
                alert(result.error.message);
            } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('subscription-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }
</script>

</html>