<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        echo rand(1111111111111, 9999999999999);
    } else {
        // Mehtod Not Allowed
        http_response_code(405);
    }
} else {
    http_response_code(403);
}