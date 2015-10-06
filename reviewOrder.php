<?php

$merchantApiKey = '1234567890';
$returnUrl = 'http://dev.vagrant/return.php';
$submitUrl = 'https://dev.api.raisenow.vagrant/epayment/api/step/pay/merchant/' . $merchantApiKey;

?>

<html>
<head>
    <title>RaiseNow Example Checkout with HMAC</title>
<body>
    <h2>Review your order</h2>
    <form action="<?php echo $submitUrl; ?>" method="POST">
        <input type="hidden" name="hmac" value="<?php echo $order['hmac']; ?>" />
        <input type="hidden" name="success_url" value="<?php echo $returnUrl; ?>" />
        <input type="hidden" name="error_url" value="<?php echo $returnUrl; ?>" />
        <input type="hidden" name="cancel_url" value="<?php echo $returnUrl; ?>" />

<!-- test card -->
        <input type="hidden" name="cardno" value="4242424242424242" />
        <input type="hidden" name="expy" value="15" />
        <input type="hidden" name="expm" value="12" />
        <input type="hidden" name="cvv" value="123" />
        <input type="hidden" name="card_holder_name" value="test" />
        <input type="hidden" name="reqtype" value="CAA" />


        <input type="hidden" name="stored_transaction_time" value="<?php echo $order['stored_transaction_time'] ?>" />

        <label for="payment_method">Payment Method: <?php echo $order['payment_method']; ?></label>
        <input type="hidden" name="payment_method" value="<?php echo $order['payment_method'] ?>" />
        <br />

        <label for="amount">Amount: <?php echo $order['amount'] ?></label>
        <input type="hidden" name="amount" value="<?php echo $order['amount'] ?>" />
        <br />
        <label for="currency">Currency: <?php echo $order['currency'] ?></label>
        <input type="hidden" name="currency" value="<?php echo $order['currency'] ?>" />
        <br />
        <label for="test_mode">TestMode: <?php echo $order['test_mode'] ?></label>
        <input type="hidden" name="test_mode" value="<?php echo $order['test_mode'] ?>" />
        <br />
        <label for="stored_product_name">Product Name: <?php echo $order['stored_product_name'] ?></label>
        <input type="hidden" name="stored_product_name" value="<?php echo $order['stored_product_name'] ?>" />
        <br />
        <label for="stored_product_id">Product Id: <?php echo $order['stored_product_id'] ?></label>
        <input type="hidden" name="stored_product_id" value="<?php echo $order['stored_product_id'] ?>" />
        <br />
        <label for="stored_customer_name">Customer Name: <?php echo $order['stored_customer_name'] ?></label>
        <input type="hidden" name="stored_customer_name" value="<?php echo $order['stored_customer_name'] ?>" />
        <br />

        <input type="submit" value="Order Now" />

    </form>
</body>
</html>
