<?

namespace Vabank\API;

\Bitrix\Main\Loader::includeModule('iblock');

class IB
{
    public static function getList(
        $arSelect = ["ID"],
        $arFilter = [],
        $arOrder = ['SORT' => 'ASC'],
        $arGroupBy = false,
        $arNavStartParams = false
    )
    {
        if (empty($arFilter)) return false;
        $arElements = [];
        $resElements = \CIBlockElement::GetList(
            $arOrder,
            $arFilter,
            $arGroupBy,
            $arNavStartParams,
            $arSelect
        );
        while ($rowElements = $resElements->Fetch()) {
            $arElements[] = $rowElements;
        }
        return $arElements;
    }

    public static function propPrepare($prop = '')
    {
        $prop = mb_strtolower($prop);
        $str_replace = ['property_', '_value'];
        $prop = str_replace($str_replace, "", $prop);
        return $prop;
    }

    public static function propClear($prop_search = [], $arData = [])
    {
        $result = [];
        for ($i = 0; $i < count($arData); $i++) {
            foreach ($arData[$i] as $k => $v) {
                $k = self::propPrepare($k);
                if (in_array($k, $prop_search)) {
                    if ($k == "detail_text") {
                        $result["items"][$i]["text"] = $v;
                    } else {
                        $result["items"][$i][$k] = $v;
                    }
                }
            }
        }
        return $result;
    }
}
