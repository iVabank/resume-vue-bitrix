<?

namespace Vabank\Content;

use Vabank\API;

class Education
{
    public static function getList()
    {
        $arEducation = [];
        $result = API\IB::getList(
            [
                "NAME",
                "DETAIL_TEXT",
                "PROPERTY_YEARS",
                "PROPERTY_LOCATION",
            ],
            [
                "IBLOCK_ID" => DEFAULT_EDUCATION_IBLOCK_ID,
                "ACTIVE" => "Y",
            ]
        );
        if (!empty($result)) {
            $prop_search = ['name', 'detail_text', 'years', 'location'];
            $arEducation = API\IB::propClear($prop_search, $result);
        }
        $arEducation["title"] = \CIBlock::GetByID(DEFAULT_EDUCATION_IBLOCK_ID)->Fetch()['NAME'];
        return $arEducation;
    }
}
