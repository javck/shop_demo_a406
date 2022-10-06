<?php
return [
    'MerchantId' => env('ECPAY_MERCHANT_ID', '2000132'),
    'HashKey' => env('ECPAY_HASH_KEY', '5294y06JbISpM5x9'),
    'HashIV' => env('ECPAY_HASH_IV', 'v77hoKGq4kWxNNIS'),
    'InvoiceHashKey' => env('ECPAY_INVOICE_HASH_KEY', ''),
    'InvoiceHashIV' => env('ECPAY_INVOICE_HASH_IV', ''),
    'SendForm' => env('ECPAY_SEND_FORM', null)
];