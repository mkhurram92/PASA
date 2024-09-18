<!-- Payment Renewal Modal -->
<div class="modal fade" id="paymentRenewalModal" tabindex="-1" role="dialog" aria-labelledby="paymentRenewalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- Modal header -->
            <div class="modal-header">
                <h5 class="modal-title" id="paymentRenewalLabel">Choose Payment Method</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body" style="font-size: 16px;">
                <p>Price: $<span id="selectedPriceField"></span></p><br>
                <p>Please choose your preferred payment method:</p>

                <!-- Payment Options -->
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="cashOption" value="cash">
                    <label class="form-check-label" for="cashOption">
                        Cash
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="onlineOption" value="online">
                    <label class="form-check-label" for="onlineOption">
                        Online
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="eftOption" value="eft">
                    <label class="form-check-label" for="eftOption">
                        Direct Debit (EFT)
                    </label>
                </div>

                <!-- EFT Details (Hidden by default) -->
                <div class="eft-details" id="eftDetails" style="display: none; margin-top: 20px;">
                    <strong>Account Name:</strong> Pioneers SA <br>
                    <strong>BSB No.:</strong> 105900 <br>
                    <strong>Account No.:</strong> 950067040
                </div>

                <!-- Cash Fields -->
                <div class="mb-3" id="cashFields" style="display: none; margin-top: 20px;">
                    <div class="form-group">
                        <label for="cash-amount" class="form-label">Amount to Pay:</label>
                        <input type="text" id="cash-amount" class="form-control" placeholder="Enter amount">
                    </div>
                </div>

                <!-- Stripe Elements (Hidden by default) -->
                <div id="stripeFields" style="display: none; margin-top: 20px;">
                    <div class="mb-3">
                        <label for="cardholder-name" class="form-label">Cardholder Name</label>
                        <input type="text" id="cardholder-name" class="form-control" placeholder="Name on Card">
                    </div>
                    <input type="hidden" id="stripe-amount" name="amount">
                    <div class="mb-3">
                        <label for="card-element" class="form-label">Credit or Debit Card Number</label>
                        <div id="card-element" class="form-control">
                            <!-- Stripe Element will be inserted here -->
                        </div>
                        <div id="card-errors" role="alert" style="color: red; margin-top: 10px;"></div>
                    </div>
                    <div class="mb-3">
                        <label for="billing-address" class="form-label">Billing Address</label>
                        <input type="text" id="billing-address" class="form-control" placeholder="Street Address" autocomplete="address-line1">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="billing-city" class="form-label">City</label>
                            <input type="text" id="billing-city" class="form-control" placeholder="City" autocomplete="address-level2">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="billing-state" class="form-label">State</label>
                            <input type="text" id="billing-state" class="form-control" placeholder="State" autocomplete="address-level1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="billing-postal" class="form-label">Postal Code</label>
                            <input type="text" id="billing-postal" class="form-control" placeholder="Postal Code" autocomplete="postal-code">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="billing-country" class="form-label">Country</label>
                            <input type="text" id="billing-country" class="form-control" placeholder="Country" autocomplete="country">
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

<script>
    const paymentMethodRadios = document.querySelectorAll('input[name="paymentMethod"]');
    const cashFields = document.getElementById('cashFields');
    const stripeFields = document.getElementById('stripeFields');
    const eftDetails = document.getElementById('eftDetails');

    paymentMethodRadios.forEach(radio => {
        radio.addEventListener('change', () => {
            cashFields.style.display = 'none';
            stripeFields.style.display = 'none';
            eftDetails.style.display = 'none';

            if (radio.value === 'online') {
                stripeFields.style.display = 'block';
            } else if (radio.value === 'eft') {
                eftDetails.style.display = 'block';
            }
        });
    });
</script>
