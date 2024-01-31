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

    header('Content-Type: '.$result->getMimeType());
    echo $result->getString();
    } else {
    echo <<<FORMULAR
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
    </body>
</html>
FORMULAR;
}
//qr code auf der selben seite unter dem
// mit inside an image tag  <img>  auf der seite
