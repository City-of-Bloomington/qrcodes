<?php
/**
 * @copyright 2023 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE
 */
declare (strict_types=1);
namespace Web;

use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class HomeController extends Controller
{
    public function __invoke(array $params): View
    {
        if (empty($_GET['url'])) {
            return new \Web\Views\NotFoundView();
        }


        $renderer = new ImageRenderer(new RendererStyle(QR_SIZE), new ImagickImageBackEnd());
        $writer   = new Writer($renderer);
        Header('Content-type: image/png');
        echo $writer->writeString($_GET['url']);
        exit();


        return new Views\HomeView($qrcode);
    }
}
