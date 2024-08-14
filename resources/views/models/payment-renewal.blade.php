<!-- Payment Renewal Modal -->
<div class="modal fade" id="paymentRenewalModal" tabindex="-1" role="dialog" aria-labelledby="paymentRenewalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal header -->
            <div class="modal-header">
                <h5 class="modal-title" id="paymentRenewalLabel">Choose Payment Method</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body text-center">
                <p>Please choose your preferred payment method:</p>
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

                <!-- Stripe Elements (Hidden by default) -->
                <div id="stripeFields" style="display: none; margin-top: 20px;">
                    <div id="card-element">
                        <!-- Stripe Element will be inserted here -->
                    </div>
                    <div id="card-errors" role="alert" style="color: red; margin-top: 10px;"></div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="submitPaymentMethod">Proceed</button>
            </div>
        </div>
    </div>
</div>
