<?

namespace Vabank\Content;

use Vabank\API;

class User
{
    public static function getUser()
    {
        $arUser = [];
        $result = API\UsersExt::UserGetByField(
            "ID",
            DEFAULT_USER_ID,
            [
                "ID",
                "NAME",
                "LAST_NAME",
                "SECOND_NAME",
                "PERSONAL_PROFESSION",
                "PERSONAL_PHOTO",
            ]
        );
        if (!empty($result)) {
            foreach ($result as $k => $v) {
                if ($k == "ID") {
                    $arUser["id"] = $v;
                } else if ($k == "NAME") {
                    $arUser["name"] = $v;
                } else if ($k == "LAST_NAME") {
                    $arUser["lastName"] = $v;
                } else if ($k == "SECOND_NAME") {
                    $arUser["secondName"] = $v;
                } else if ($k == "PERSONAL_PROFESSION") {
                    $arUser["personalProfession"] = $v;
                } else if ($k == "PERSONAL_PHOTO") {
                    $arUser["pathPersonalPhoto"] = $v;
                }
            }
            if (empty($arUser["pathPersonalPhoto"])) {
                $arUser["pathPersonalPhoto"] = DEFAULT_AVATAR_USER;
            }
        }
        return $arUser;
    }
}
