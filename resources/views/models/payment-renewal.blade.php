<style>
    #stripeFields .form-control {
        margin-bottom: 15px;
    }

    #card-element {
        padding: 10px 12px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        background-color: #fff;
        width: 100%;
    }

    .form-control.StripeElement {
        height: auto;
        padding: 10px;
    }

    #stripeFields .form-label {
        display: block;
        margin-bottom: 5px;
    }

    .modal-body p,
    .modal-body .form-label,
    .modal-body .form-check-label {
        text-align: left;
        /* Align text to the left */
        width: 100%;
        /* Ensure full-width alignment */
        margin: 0;
        /* Remove any default margins */
    }
    .cash-amount{
        text-align: left;
    }
</style>
<!-- Payment Renewal Modal -->
<div class="modal fade" id="paymentRenewalModal" tabindex="-1" role="dialog" aria-labelledby="paymentRenewalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal header -->
            <div class="modal-header">
                <h5 class="modal-title" id="paymentRenewalLabel">Choose Payment Method</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body text-center">
                <p>Price: $<span id="selectedPriceField"></span></p><br>
                <p>Please choose your preferred payment method:</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="cashOption" value="cash">
                    <label class="form-check-label" for="cashOption">
                        Cash
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="onlineOption"
                        value="online">
                    <label class="form-check-label" for="onlineOption">
                        Online
                    </label>
                </div>
                <div class="mb-3" id="cashFields" style="display: none;margin-top: 20px;">
                    <div class="form-group">
                        <label for="cash-amount" class="form-label">Amount to Pay:</label>
                        <input type="text" id="cash-amount" class="form-control" placeholder="Enter amount">
                    </div>
                </div>

                <!-- Stripe Elements (Hidden by default) -->
                <div id="stripeFields" style="display: none; margin-top: 20px;">
                    <!-- Cardholder Name -->
                    <div class="mb-3">
                        <label for="cardholder-name" class="form-label">Cardholder Name</label>
                        <input type="text" id="cardholder-name" class="form-control" placeholder="Name on Card">
                    </div>

                    <!-- Card Number -->
                    <div class="mb-3">
                        <label for="card-element" class="form-label">Credit or Debit Card Number</label>
                        <div id="card-element" class="form-control">
                            <!-- Stripe Element will be inserted here -->
                        </div>
                        <div id="card-errors" role="alert" style="color: red; margin-top: 10px;"></div>
                    </div>

                    <!-- Billing Address -->
                    <div class="mb-3">
                        <label for="billing-address" class="form-label">Billing Address</label>
                        <input type="text" id="billing-address" class="form-control" placeholder="Street Address"
                            autocomplete="address-line1">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="billing-city" class="form-label">City</label>
                            <input type="text" id="billing-city" class="form-control" placeholder="City"
                                autocomplete="address-level2">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="billing-state" class="form-label">State</label>
                            <input type="text" id="billing-state" class="form-control" placeholder="State"
                                autocomplete="address-level1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="billing-postal" class="form-label">Postal Code</label>
                            <input type="text" id="billing-postal" class="form-control" placeholder="Postal Code"
                                autocomplete="postal-code">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="billing-country" class="form-label">Country</label>
                            <input type="text" id="billing-country" class="form-control" placeholder="Country"
                                autocomplete="country">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="submitPaymentMethod">Proceed</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
