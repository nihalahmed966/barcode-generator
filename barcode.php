<?php
require 'vendor/autoload.php';
use Laminas\Barcode\Barcode;
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Default Symbology
        $symbology = 'code128';
        if (isset($_POST['symbology']) && !empty($_POST['symbology'])) {
            $symbology = $_POST['symbology'];
        }
        if (isset($_POST['text']) && !empty($_POST['text'])) {
            ob_start();
            Barcode::factory($symbology, 'image', array('text' => $_POST['text']), array('imageType' => 'jpg'))->render();
            $image = base64_encode(ob_get_contents());
            ob_end_clean();
            echo "<img  class='img-fluid' src='data:image/png;base64," . $image . "'/>";
            die();
        }
        {
            echo 'failed';
        }
    } else {
        // Mehtod Not Allowed
        http_response_code(405);
    }
} else {
    http_response_code(403);
}