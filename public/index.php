<?php
/**
 * @copyright 2015-2022 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE
 */
/**
 * Grab a timestamp for calculating process time
 */
declare (strict_types=1);

$startTime = microtime(true);

include '../vendor/autoload.php';

$url = $_GET['url'];

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;

$writer = new PngWriter();

// Create QR code
$qrCode = QrCode::create($url)
    ->setEncoding(new Encoding('UTF-8'))
    ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
    ->setSize(300)
    ->setMargin(10)
    ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
    ->setForegroundColor(new Color(0, 0, 0))
    ->setBackgroundColor(new Color(255, 255, 255));

// // Create generic logo
// $logo = Logo::create(__DIR__.'/assets/symfony.png')
//     ->setResizeToWidth(50);
//
// // Create generic label
// $label = Label::create('Label')
//     ->setTextColor(new Color(255, 0, 0));

$result = $writer->write($qrCode);

// Validate the result
// $writer->validateResult($result, 'Life is too short to be generating QR codes');

#$result->saveToFile('./qr.png');
header('Content-Type: '.$result->getMimeType());
echo $result->getString();

