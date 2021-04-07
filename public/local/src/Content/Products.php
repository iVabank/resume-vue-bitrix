<?

namespace Vabank\Content;

use Vabank\API;

class Products
{
    public static function getList()
    {
        $arProducts = [];
        $result = API\IB::getList(
            [
                "NAME",
                "DETAIL_TEXT",
                "PREVIEW_TEXT",
                "PROPERTY_ICON",
                "PROPERTY_LINK",
                "PROPERTY_SOURCE",
            ],
            [
                "IBLOCK_ID" => DEFAULT_PRODUCTS_IBLOCK_ID,
                "ACTIVE" => "Y",
            ]
        );
        if (!empty($result)) {
            $prop_search = ['name', 'detail_text', 'link', 'icon', 'source'];
            $arProducts = API\IB::propClear($prop_search, $result);
        }
        $arProducts["title"] = \CIBlock::GetByID(DEFAULT_PRODUCTS_IBLOCK_ID)->Fetch()['NAME'];
        return $arProducts;
    }
}
