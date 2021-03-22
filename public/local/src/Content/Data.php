<?

namespace Vabank\Content;

class Data
{
    public static function getData()
    {
        $arData['sections'] = Sections::getList();
        $arData['user'] = User::getUser();
        $arData['skills'] = Skills::getList();
        $arData['education'] = Education::getList();
        $arData['products'] = Products::getList();
        $arData['about'] = About::getList();
        return $arData;
    }
}
