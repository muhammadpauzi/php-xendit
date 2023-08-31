<?php
require "bootstrap.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <ul>
        <li>Xendit Balance:
            <?= getFormattedNumber(
                value: \Xendit\Balance::getBalance('CASH')['balance'],
                style: NumberFormatter::CURRENCY,
                locale: "in_ID",
                currencyCode: "IDR"
            ) ?> -

            <?= ucwords(
                getFormattedNumber(
                    value: \Xendit\Balance::getBalance('CASH')['balance'],
                    style: NumberFormatter::SPELLOUT,
                    locale: "in_ID",
                    currencyCode: "IDR"
                )
            ) ?>
        </li>
    </ul>



    <h1>Products</h1>
    <?php foreach ($products as $index => $product): ?>
        <ul>
            <li>
                <?= $product['name']; ?>
            </li>
            <li>
                <?= $product['price']; ?>
            </li>
            <li>
                <a href="checkout.php?product_id=<?= $index + 1; ?>&using=dana">Checkout DANA</a>
                <a href="checkout.php?product_id=<?= $index + 1; ?>&using=invoice">Checkout Invoice</a>
            </li>
        </ul>
    <?php endforeach; ?>


</body>

</html>