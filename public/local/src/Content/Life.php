<?

namespace Vabank\Content;

use Vabank\API;

class Life
{
    public static function getList($page = 1)
    {
        $arLife = [];
        $result = API\IB::getList(
            [
                "NAME",
                "DETAIL_TEXT",
            ],
            [
                "IBLOCK_ID" => DEFAULT_LIFE_IBLOCK_ID
            ],
            [
                'ID' => 'DESC'
            ],
            false,
            [
                "iNumPage" => $page,
                "nPageSize" => 1,
                "checkOutOfRange" => true
            ]
        );
        $arColors = [
            'cyan', 'green', 'pink', 'amber', 'orange', 'red', 'purple', 'green', 'indigo',
        ];
        if (!empty($result)) {
            $prop_search = ['name', 'detail_text'];
            for ($i = 0; $i < count($result); $i++) {
                foreach ($result[$i] as $k => $v) {
                    $k = API\IB::propPrepare($k);
                    if (in_array($k, $prop_search)) {
                        if ($k == "detail_text") {
                            $arLife["items"][$i]["text"] = $v;
                        } else if ($k == "name") {
                            $arLife["items"][$i]["title"] = $v;
                        } else {
                            $arLife["items"][$i][$k] = $v;
                        }
                    }
                    $arLife["items"][$i]["year"] = "2021";
                    $arLife["items"][$i]["icon"] = "mdi-airballoon";
                    $arLife["items"][$i]["color"] = $arColors[rand(0, count($arColors)-1)];
                }
            }
        }
        if (empty($arLife["items"])) {
            $arLife["items"] = [];
        }
        $arLife["title"] = \CIBlock::GetByID(DEFAULT_LIFE_IBLOCK_ID)->Fetch()['NAME'];
        return $arLife;
    }
}
