# Direct Payments

Version 1.2.0 and above include direct payment methods operations.
Currently implemented and supported direct payments:

### Direct payments:

* Processout
* Braintree Paypal

### Direct payment methods:
* Processout_APM
    * CoinPayments
    * Sandbox (for testing)

Difference between two groups is that the second group has a subgroup of payment methods for specific merchant
(currently only processout).

# API Client commands

## getDirectPaymentForm
```$xslt
    /**
     * @param string $merchantAccount
     * @param string $paymentToken
     * @return array
     * @throws GuzzleException
     */
    public function getDirectPaymentForm(string $merchantAccount, string $paymentToken)
```
This method returns a form, to be included in your page. You need to create a payment in advance and provide 
a payment token, so correct form can be returned to you (they may differ according to provided payment data).

 __Bear in mind that most likely it is not enough to include this form. You will have to add some javascript 
 and styling to handle events, wire the form to your backend and adjust styling to fit yours.__ More about 
 what javascript code to include will be explained in next chapter.

## getDirectPaymentMethodForm
```$xslt
    /**
     * @param string $merchantAccount
     * @param string $paymentToken
     * @return array
     * @throws GuzzleException
     */
    public function getDirectPaymentMethodForm(string $merchantAccount, string $paymentMethod)
```
This does exactly same as getDirectPaymentForm , but for payment methods, e.g. Processout->Coinpayments.
This is implemented a little differently and you don't have to provide payment token right away,
 however as you will read in the next chapter, you will have to provide that information yourself, 
 by implementing event listeners - more on that in next chapter.
 
 ## submitDirectPaymentForm
 ```$xslt
    /**
     * @param string $merchantAccount
     * @param array  $formData
     * @return array
     * @throws GuzzleException
     */
    public function submitDirectPaymentForm(string $merchantAccount, array $formData)
```
As you will read in next chapter, you will have to implement event listeners and provide your backend url 
for form post data handling. After receiving post data in the backend, you will have to send it 
through this method, so it can be processed. You will receive json {"completed": true} in the event 
of succesfuly finished transaction.

## submitDirectPaymentMethodForm
```$xslt
    /**
     * @param string $merchantAccount
     * @param string $paymentMethod
     * @param array  $formData
     * @return array
     * @throws GuzzleException
     */
    public function submitDirectPaymentMethodForm(string $merchantAccount, string $paymentMethod, array $formData)
```

This does exactly same as submitDirectPaymentForm , but does that for provided paymentMethod instead of just merchant.

## submitDirectPaymentError
```$xslt
    /**
     * @param string $message
     * @param string $code
     * @return array
     * @throws GuzzleException
     */
    public function submitDirectPaymentError(string $message, string $code)
```
You will read about what you need to implement in next chapter. It is very important that you implement error listeners 
and make an ajax request to your own backend error handler. You should then call this method from there and
pass error code and message, so they can be tracked and we can timely react to occuring errors.

# Integrating forms
So you are integrating some merchang: e.g. braintree_paypal. You will have some page for that on your side.
 You will then call above mentioned getDirectPaymentForm or submitDirectPaymentMethodForm if you 
 are integrating payment method e.g. processout_apm->coinpayments. Next you will need to include more
 javascript to: handle javascript events, handle errors, provide your backend url and other data. Below
 are presented example implementations, which you can adjust to your needs and of course change to 
 correct data.
 
 ## Processout example implementation
 ```$xslt
<script>
    document.getElementById('payment-btn').removeAttribute('hidden');

    //there should be your backend endpoint url for processout handling
    document.querySelector('#payment-form').action = '/api/testing/direct-payment/v3/processout' + getQueryToAppend();

    document.addEventListener("payment.completed", function (e) {
        alert(e.detail.message);
    });
    document.addEventListener("payment.failed", function (e) {
        alert(e.detail.message);
        togglePaymentButton(false);
    });
    document.addEventListener("payment.establishing", function (e) {
        console.log(e.detail.message);
    });
    document.addEventListener("payment.invalid-details", function (e) {
        alert(e.detail.message);
        togglePaymentButton(false);
    });

</script>
<style>
    div {
        position: relative;
        padding-bottom: 10px;
    }
    [data-processout-input], input {
        border: 1px solid #ECEFF1;
        border-radius: 4px;
        box-shadow: 0 5px 7px rgba(50, 50, 93, 0.04), 0 1px 3px rgba(0, 0, 0, 0.03);
        padding: 0.5em;
        width: 100%;
        margin-bottom: 1em;
        font-size: 14px;
        height: 2em;
        background: white;
    }

    form {
        width: 500px;
        margin: 0 auto;
    }
</style>

```

## Braintree Paypal example implementation
```$xslt
<script>
    document.querySelector('#payment-form').action = '/api/testing/direct-payment/v3/braintree_paypal'
        + getQueryToAppend(); //there should be your backend url for braintree_paypal post handling

    document.addEventListener("payment.completed", function (e) {
        alert(e.detail.message);
        console.log(e.detail);
    });
    document.addEventListener("payment.failed", function (e) {
        alert(e.detail.message);
        togglePaymentButton(false);
    });
    document.addEventListener("payment.establishing", function (e) {
        console.log(e.detail.message);
    });
    document.addEventListener("payment.invalid-details", function (e) {
        alert(e.detail.message);
        togglePaymentButton(false);
    });
</script>

```

## Coinpayments example implementation
```$xslt
<script>
    document.addEventListener("payment.completed", function (e) {
        document.getElementById('method-info').innerHTML = '<p>Succesfuly finished</p>';
        alert('Payment completed succesfuly');
        setLoaderHidden(true);
        setMethodInfoHidden(false);
        setSubmitHidden(true);
    });
    document.addEventListener("payment.failed", function (e) {
        document.getElementById('method-info').innerHTML = '<p>Payment failed</p>';
        alert('payment.failed');
        setLoaderHidden(true);
        setMethodInfoHidden(false);
        setSubmitHidden(true);
    });

    document.addEventListener("payment.provide_invoice", function (e) {
        console.log('Implement this listener to fetch invoiceId and pass that to callback together with submitUrl');

        url = '/api/testing/direct-payment/v3/processout_apm/coinpayments' + getQueryToAppend();
        makeGetRequest(url, null, function (response) {
            if (!response.status || 200 !== response.status) {
                console.log(response);
                alert('Payment failed. Response is in console');
                return;
            }
            appendHiddenInput('apms-payment-form', 'processout-apm-payment-token', 'payment_token', response.data.payment_token);
            e.detail.callback(response.data.invoice_reference, url);
        });

    });
    document.addEventListener("payment.invalid-details", function (e) {
        alert(e.detail.message);
    });
</script>
```

## Processout sandbox implementation
This integration is mainly for testing, as after hitting submit you will emulate succesful or 
failed response. It should be mainly the same integration with all other alternative payment methods
for processout (APM's).
```$xslt
<script>
    document.addEventListener("payment.completed", function (e) {
        document.getElementById('method-info').innerHTML = '<p>Succesfuly finished</p>';
        alert('Payment completed succesfuly');
        setLoaderHidden(true);
        setMethodInfoHidden(false);
        setSubmitHidden(true);
    });
    document.addEventListener("payment.failed", function (e) {
        document.getElementById('method-info').innerHTML = '<p>Payment failed</p>';
        alert('payment.failed');
        setLoaderHidden(true);
        setMethodInfoHidden(false);
        setSubmitHidden(true);
    });

    document.addEventListener("payment.provide_invoice", function (e) {
        console.log('Implement this listener to fetch invoiceId and pass that to callback together with submitUrl');

        url = '/api/testing/direct-payment/v3/processout_apm/sandbox' + getQueryToAppend();
        makeGetRequest(url, null, function (response) {
            if (!response.status || 200 !== response.status) {
                console.log(response);
                alert('Payment failed. Response is in console');
                return;
            }
            appendHiddenInput('apms-payment-form', 'processout-apm-payment-token', 'payment_token', response.data.payment_token);
            e.detail.callback(response.data.invoice_reference, url);
        });

    });
    document.addEventListener("payment.invalid-details", function (e) {
        alert(e.detail.message);
    });
</script>

```
