<?

namespace Vabank\API;

use Bitrix\Main\Page\Asset as Asset;

class CssJsVue
{
    public static function On($css = true)
    {
        $GetCssJsFile = self::GetCssJsFile(['/css/', '/js/']);
        if ($css == true) {
            foreach ($GetCssJsFile['css'] as $k => $v) {
                Asset::getInstance()->addString('<link href="' . $v . '" rel=preload as=style />');
                Asset::getInstance()->addString('<link href="' . $v . '" rel=stylesheet />');
            }
        }
        foreach ($GetCssJsFile['js'] as $k => $v) {
            if (preg_match("/app/i", $v)) {
                Asset::getInstance()->addString('<script src="' . $v . '"></script>');
            }
        }
        foreach ($GetCssJsFile['js'] as $k => $v) {
            if (preg_match("/chunk-vendors/i", $v)) {
                Asset::getInstance()->addString('<script src="' . $v . '"></script>');
            }
        }
    }

    public static function GetCssJsFile($dir)
    {
        $result = [];
        foreach ($dir as $path_key => $path_name) {
            $OneArr = self::dirToArray($_SERVER['DOCUMENT_ROOT'] . $path_name);
            foreach ($OneArr as $data_key => $data_name) {
                if ($data_name['EXT'] == 'js') {
                    $result['js'][] = '/' . str_replace($_SERVER["DOCUMENT_ROOT"] . '/', "", $data_name['FILE']);
                }
                if ($data_name['EXT'] == 'css') {

                    $result['css'][] = '/' . str_replace($_SERVER["DOCUMENT_ROOT"] . '/', "", $data_name['FILE']);
                }
            }
        }
        return $result;
    }

    public static function dirToArray($dir)
    {
        $result = [];
        $cdir = scandir($dir);
        foreach ($cdir as $key => $value) {
            if (!in_array($value, array(".", ".."))) {
                if (is_dir($dir . $value)) {
                    $result[] = self::dirToArray($dir . $value);
                } else {
                    $info = pathinfo($dir . $value);
                    $result[] = ["FILE" => $dir . $value, "EXT" => $info['extension']];
                }
            }
        }
        return $result;
    }
}
