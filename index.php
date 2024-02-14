<?php
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\Writer\PngWriter;

require_once "vendor/autoload.php";

if (isset($_GET["phonenum"])) {
    $result = Builder::create()
        ->writer(new PngWriter())
        ->writerOptions([])
        ->data('tel:' . $_GET["phonenum"])
        ->encoding(new Encoding('UTF-8'))
        ->size(300)
        ->margin(10)
        ->labelText($_GET["phonenum"])
        ->labelFont(new NotoSans(20))
        ->validateResult(false)
        ->build();
} else {
    // Wenn keine Telefonnummer vorhanden ist, setze $result auf null
    $result = null;
}

echo <<<HTML
<html>
<head>
    <meta charset="UTF-8">
    <title>QRCode</title>
    <link rel="stylesheet" href="mystyle.css">
</head>
<body>
    <form>
        <label>Phonenumber:</label>
        <input name="phonenum" type="number" required>
        <button type="submit">Code generieren</button>
    </form>

    <div id="qrcodeContainer">
HTML;

// Wenn ein QR-Code vorhanden ist, zeige ihn an
if ($result) {
    echo '<img id="qrcode" alt="QR Code" src="data:' . $result->getMimeType() . ';base64,' . base64_encode($result->getString()) . '">';
}

echo <<<HTML
    </div>
</body>
</html>
HTML;
?>