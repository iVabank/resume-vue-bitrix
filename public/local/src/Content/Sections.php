<?

namespace Vabank\Content;

use Vabank\API;

class Sections
{
    public static function getList()
    {
        $arSections = [];
        $result = API\IB::getList(
            [
                "NAME",
                "PROPERTY_SECTIONS",
                "PROPERTY_ICON",
                "PROPERTY_LINK",
                "PROPERTY_VALUE",
                "PROPERTY_TEXT",
            ],
            [
                "IBLOCK_ID" => DEFAULT_SECTIONS_IBLOCK_ID,
                "ACTIVE" => "Y",
            ]
        );
        if (!empty($result)) {
            for ($i = 0; $i < count($result); $i++) {
                foreach ($result[$i] as $k => $v) {
                    unset($result[$i][$k]);
                    $k = API\IB::propPrepare($k);
                    $prop_search = ['sections', 'icon', 'link', 'value', 'name', 'text'];
                    if (in_array($k, $prop_search)) {
                        $result[$i][$k] = $v;
                    }
                }
            }
            for ($i = 0; $i < count($result); $i++) {
                $arSections
                [mb_strtolower($result[$i]['sections'])]
                ["title"] = $result[$i]['sections'];
                $arSections
                [mb_strtolower($result[$i]['sections'])]
                ["items"][] = $result[$i];
            }
        }
        return $arSections;
    }
}
