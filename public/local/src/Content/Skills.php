<?

namespace Vabank\Content;

use Vabank\API;

class Skills
{
    public static function getList()
    {
        $arSkills = [];
        $result = API\IB::getList(
            [
                "NAME",
                "PROPERTY_ICON",
                "PROPERTY_VALUE",
                "PROPERTY_GROUP",
            ],
            [
                "IBLOCK_ID" => DEFAULT_SKILLS_IBLOCK_ID,
                "ACTIVE" => "Y",
            ],
            [
                "PROPERTY_GROUP" => "ASC", "SORT" => "ASC",
            ]
        );

        $group = false;
        if (!empty($result)) {
            for ($i = 0; $i < count($result); $i++) {
                $divider = false;
                $prop_search = ['name', 'icon', 'value', 'divider', 'group'];
                foreach ($result[$i] as $k => $v) {
                    $k = API\IB::propPrepare($k);
                    if ($k == 'group' && $group == false) {
                        $group = $v;
                    }
                    if ($k == 'group' && $v != $group) {
                        $group = $v;
                        $divider = true;
                    }
                    if (in_array($k, $prop_search)) {
                        $arTmp[$k] = $v;
                    }
                }
                if ($divider != false) {
                    $arSkills["items"][] = ["divider" => true];
                }
                $arSkills["items"][] = $arTmp;
            }
        }
        $arSkills["title"] = \CIBlock::GetByID(DEFAULT_SKILLS_IBLOCK_ID)->Fetch()['NAME'];
        return $arSkills;
    }
}
