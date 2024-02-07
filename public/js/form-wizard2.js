$(function () {
    let canChangeStep = false;
    var stripeApi;
    if (typeof Stripe !== 'undefined') {
        stripeApi = Stripe($("#stripe_key").val());
    }
    // let elements;
    const options = {
        mode: 'payment',
        amount: 75 * 100,
        currency: 'aud',
        // Fully customizable with appearance API.
        appearance: {/*...*/ },
    };
    // Set up Stripe.js and Elements to use in checkout form
    const elements = stripeApi.elements(options);
    const paymentElement = elements.create('payment');
    const addressElement = elements.create('address', { ...options, "mode": "billing" });
    $('#wizard2').steps({
        headerTag: 'h3',
        bodyTag: 'section',
        autoFocus: true,
        titleTemplate: '<span class="number">#index#<\/span> <span class="title">#title#<\/span>',
        onFinishing: function (event, currentIndex) {
            if (!$("a[href='#finish']").is("disabled")) {
                const fun = async () => {
                    $("a[href='#finish']").text("Loading...").prop("disabled", true);
                    const addressElement = elements.getElement('address');
                    const { complete, value } = await addressElement.getValue();
                    if (complete) {
                        $.ajax($("#membership_form").attr("action"), {
                            type: "POST",
                            data: {
                                step: currentIndex,
                                form: $("#membership_form").serialize(),
                                address: value
                            },
                        })
                            .done(async res => {
                                if (res?.success && res?.client_secret) {
                                    const clientSecret = res?.client_secret;
                                    const { error: submitError } = await elements.submit();
                                    if (submitError) {
                                        handleError(submitError);
                                        return;
                                    }
                                    stripeApi.confirmPayment({
                                        elements,
                                        clientSecret,
                                        confirmParams: {
                                            return_url: window.location.href,
                                        },
                                        redirect: 'if_required'
                                    }).then(res => {
                                        if (res?.error) {
                                            const messageContainer = document.querySelector('#error-message');
                                            messageContainer.textContent = res?.error?.message;
                                            $("a[href='#finish']").text("Finish").prop("disabled", false);
                                        }
                                        const paymentIntent = res?.paymentIntent;
                                        if (paymentIntent && paymentIntent?.status == "succeeded") {
                                            $.ajax($("#membership_form").attr("action"), {
                                                type: "POST",
                                                data: {
                                                    step: currentIndex,
                                                    form: $("#membership_form").serialize(),
                                                    intent: paymentIntent
                                                },
                                            })
                                                .done(res => {
                                                    if (res?.success) {
                                                        $.growl.notice({
                                                            title: ""
                                                            , message: res?.success
                                                        });
                                                        setTimeout(() => {
                                                            if (res?.redirectTo) {
                                                                window.location.href = res?.redirectTo;
                                                            } else {
                                                                window.location.href = "/";
                                                            }
                                                        }, 1200);
                                                    } else {
                                                        if (res?.error) {
                                                            window.alert(res?.error);
                                                        } else {
                                                            window.alert("Unable to make payment")
                                                        }
                                                    }
                                                })
                                        }
                                    })
                                } else {
                                    if (res?.error) {
                                        window.alert(res?.error);
                                    } else {
                                        window.alert("Unable to make payment")
                                    }
                                }
                            })
                    }
                }
                fun();
            }
        },
        onStepChanging: function (event, currentIndex, newIndex) {
            // if (currentIndex == 1) {
            // Create and mount the Payment Element
            paymentElement.mount('#card-element');
            addressElement.mount('#address-element');
            // }
            return true;
        }
    });
    $(document).on("change", "#journal_preferred_delivery", e => {
        if (e.target.value == "1") {
            elements.update({ amount: 85 * 100 });
        } else {
            elements.update({ amount: 75 * 100 });
        }
    });
});
