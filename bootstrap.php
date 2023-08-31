<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

use Xendit\Xendit;

require "vendor/autoload.php";

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$xenditSecretKey = $_ENV['XENDIT_SECRET_KEY'];
Xendit::setApiKey($xenditSecretKey);

function getFormattedNumber(
    $value,
    $locale = 'en_US',
    $style = NumberFormatter::DECIMAL,
    $precision = 2,
    $groupingUsed = true,
    $currencyCode = 'USD',
) {
    $formatter = new NumberFormatter($locale, $style);
    $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, $precision);
    $formatter->setAttribute(NumberFormatter::GROUPING_USED, $groupingUsed);
    if ($style == NumberFormatter::CURRENCY) {
        $formatter->setTextAttribute(NumberFormatter::CURRENCY_CODE, $currencyCode);
    }

    return $formatter->format($value);
}

$products = [
    [
        'name' => 'Product #1',
        'price' => 5000
    ],
    [
        'name' => 'Product #2',
        'price' => 12000
    ],
    [
        'name' => 'Product #3',
        'price' => 17000
    ],
];