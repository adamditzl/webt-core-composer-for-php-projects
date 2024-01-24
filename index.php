<?php
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;


if (isset($_GET["phonenum"])) {
    $result = Builder::create()
        ->writer(new PngWriter())
        ->writerOptions([])
        ->data('tel:' . $_GET["phonenum"])
        ->encoding(new Encoding('UTF-8'))
        ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
        ->size(300)
        ->margin(10)
        ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
        ->labelText($_GET["phonenum"])
        ->labelFont(new NotoSans(20))
        ->labelAlignment(new LabelAlignmentCenter())
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