<?

namespace Vabank\Content;

use Vabank\API;

class Life
{
    public static function getList($page = 1, $type = 0)
    {
        $type = $type == 0 ? false : true;
        $arLife = [];
        $result = API\IB::getList(
            [
                "NAME",
                "DETAIL_TEXT",
                "PROPERTY_DATE",
                "PROPERTY_LINK",
                "PROPERTY_SOURCE",
                "PROPERTY_ICON",
                "PROPERTY_COLOR",
                "PROPERTY_PHOTO",
            ],
            [
                "IBLOCK_ID" => DEFAULT_LIFE_IBLOCK_ID,
                "!PROPERTY_MAIN" => $type
            ],
            [
                'SORT' => 'DESC', 'ID' => 'DESC'
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
        shuffle($arColors);
        if (!empty($result)) {
            $prop_search = ['name', 'detail_text', 'date', 'link', 'source', 'icon', 'color', 'photo'];
            for ($i = 0; $i < count($result); $i++) {
                foreach ($result[$i] as $k => $v) {
                    $k = API\IB::propPrepare($k);
                    if (in_array($k, $prop_search)) {
                        if ($k == "detail_text") {
                            $arLife["items"][$i]["text"] = $v;
                        } else if ($k == "name") {
                            $arLife["items"][$i]["title"] = $v;
                        } else if ($k == "icon" && empty($v)) {
                            $arLife["items"][$i]["icon"] = false;
                        } else if ($k == "color" && empty($v)) {
                            $arLife["items"][$i]["color"] = $arColors[rand(0, count($arColors) - 1)];
                        } else if ($k == "photo") {
                            foreach ($v as $photo_key => $photo_value) {
                                $imageFile = \CFile::GetFileArray($photo_value);
                                if ($imageFile !== false) {
                                    $arFileTmp = \CFile::ResizeImageGet(
                                        $imageFile,
                                        [
                                            "width" => 120,
                                            "height" => 120
                                        ],
                                        BX_RESIZE_IMAGE_EXACT,
                                        true
                                    );
                                }
                                $arLife["items"][$i]["photos"][] = [
                                    "thumb" => $arFileTmp["src"],
                                    "src" => $imageFile["SRC"],
                                    "gallery_key" => intval($page - 1),
                                ];
                            }
                        } else {
                            $arLife["items"][$i][$k] = $v;
                        }
                    }
                }
            }
        }
        if (empty($arLife["items"])) {
            $arLife["items"] = [];
        }
        return $arLife;
    }
}
