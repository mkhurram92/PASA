<div class="modal fade" id="renewModal" tabindex="-1" aria-labelledby="renewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="renewModalLabel">Renew Membership</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Select a payment option:</p>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentOption" id="paymentCash" value="cash">
                        <label class="form-check-label" for="paymentCash">Cash</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentOption" id="paymentOnline" value="online">
                        <label class="form-check-label" for="paymentOnline">Pay Online</label>
                    </div>
                </div>
                <div id="stripePayment" style="display:none;">
                    <form id="payment-form">
                        <div class="form-group">
                            <label for="cardholder-name">Cardholder's Name</label>
                            <input type="text" id="cardholder-name" class="form-control" placeholder="Cardholder's Name" required>
                        </div>
                        <div class="form-group">
                            <label for="card-element">Card Details</label>
                            <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>
                        </div>
                        <button id="submit" class="btn btn-primary mt-3">Submit Payment</button>
                        <div id="card-errors" role="alert"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
