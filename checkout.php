<?php

include('./RaiseNowSignature.php');

$algorithm = "sha256";
$secret = "secretyoumustbe";

// handle post request
if (count($_POST) > 0) {
    $signature = new RaiseNowSignature($secret, $algorithm);
    $hmac = $signature->signData($_POST);

    $order = $_POST;
    $order['hmac'] = $hmac;
    include ('./reviewOrder.php');
    exit();
} else {
   // default order
   $order = array(
        'hmac' => '',
        'payment_method' => 'VIS',
        'amount' => '5000',
        'currency' => 'chf',
        'test_mode' => 'true',
        'stored_product_name' => 'A book',
        'stored_product_id' => '125',
        'stored_customer_name' => 'John Tester',
        'stored_transaction_time' => (new DateTime('now'))->format('U')
    );

}

?>
<!-- render form -->
<html>
<head>
    <title>RaiseNow Example Checkout with HMAC</title>
<body>
<h2>Make your order</h2>
    <form action="./checkout.php" method="POST">
        <input type="hidden" name="hmac" value="<?php echo $order['hmac'] ?>" />
        <input type="hidden" name="stored_transaction_time" value="<?php echo $order['stored_transaction_time'] ?>" />
        <label for="payment_method">Payment Method</label>
        <input type="text" name="payment_method" value="<?php echo $order['payment_method'] ?>" />
        <br />
        <label for="amount">Amount</label>
        <input type="text" name="amount" value="<?php echo $order['amount'] ?>" />
        <br />
        <label for="currency">Currency</label>
        <input type="text" name="currency" value="<?php echo $order['currency'] ?>" />
        <br />
        <label for="test_mode">TestMode</label>
        <input type="text" name="test_mode" value="<?php echo $order['test_mode'] ?>" />
        <br />
        <label for="stored_product_name">Product Name</label>
        <input type="text" name="stored_product_name" value="<?php echo $order['stored_product_name'] ?>" />
        <br />
        <label for="stored_product_id">Product Id</label>
        <input type="text" name="stored_product_id" value="<?php echo $order['stored_product_id'] ?>" />
        <br />
        <label for="stored_customer_name">Customer Name</label>
        <input type="text" name="stored_customer_name" value="<?php echo $order['stored_customer_name'] ?>" />
        <br />

        <input type="submit" value="Order Now" />
    </form>
</body>
</html>
