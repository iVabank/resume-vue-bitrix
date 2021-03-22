<?

namespace Vabank\Content;

use Vabank\API;

class About
{
    public static function getList()
    {
        $arAbout = [];
        $result = API\IB::getList(
            [
                "NAME",
                "DETAIL_TEXT",
            ],
            [
                "IBLOCK_ID" => DEFAULT_ABOUT_IBLOCK_ID
            ]
        );
        if (!empty($result)) {
            $prop_search = ['name', 'detail_text'];
            for ($i = 0; $i < count($result); $i++) {
                foreach ($result[$i] as $k => $v) {
                    $k = API\IB::propPrepare($k);
                    if (in_array($k, $prop_search)) {
                        if ($k == "detail_text") {
                            $arAbout[$i]["text"] = $v;
                        } else if ($k == "name") {
                            $arAbout[$i]["title"] = $v;
                        } else {
                            $arAbout[$i][$k] = $v;
                        }
                    }
                }
            }
        }
        return $arAbout;
    }
}
