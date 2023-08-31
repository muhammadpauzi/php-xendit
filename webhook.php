<?php

$content = json_encode([
    'status' => 'OK',
    'data' => json_decode(file_get_contents("php://input"))
]);

echo $content;

file_put_contents('webhooks/webhook-' . time() . '.json', $content);

?>