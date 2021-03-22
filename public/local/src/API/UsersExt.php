<?

namespace Vabank\API;

use CFile;
use CUser;

class UsersExt
{
    public static function userInGroup($arGroupsAvalaible = [], $user_id = 0)
    {
        global $USER;
        $user_id = intval($user_id) == 0 ? $USER->GetID() : intval($user_id);
        $arGroups = CUser::GetUserGroup($user_id);
        $result_intersect = array_intersect($arGroupsAvalaible, $arGroups);
        if (!empty($result_intersect)) {
            return true;
        }
        return false;
    }

    public static function getUsers()
    {
        return self::UsersGetByField("ACTIVE", "Y", [
            "ID",
            "NAME",
            "LAST_NAME",
            "SECOND_NAME",
            "EMAIL",
            "PERSONAL_PROFESSION",
            "PERSONAL_WWW",
            "PERSONAL_BIRTHDAY",
            "PERSONAL_CITY",
            "PERSONAL_PHOTO",
        ],
            $sort_by = "ID"
        );
    }

    public static function UsersGetByField($field = '', $value = '', $prop = false, $sort_by = "ID")
    {
        $arUser = [];
        $resUsers = CUser::GetList(
            ($sort_by),
            ($sort_ord = "ASC"),
            [
                "ACTIVE" => "Y",
                $field => $value
            ],
            [
                "SELECT" => [
                    "UF_*"
                ],
                "FIELDS" => [
                    "*"
                ]
            ]
        );
        while ($rowUsers = $resUsers->Fetch()) {
            if (!empty($rowUsers["PERSONAL_PHOTO"])) {
                $imageFile = CFile::GetFileArray($rowUsers["PERSONAL_PHOTO"]);
                if ($imageFile !== false) {
                    $arFileTmp = CFile::ResizeImageGet(
                        $imageFile,
                        [
                            "width" => 100, "height" => 100
                        ],
                        BX_RESIZE_IMAGE_EXACT,
                        true
                    );
                }
                if ($arFileTmp && array_key_exists("src", $arFileTmp))
                    $rowUsers["PERSONAL_PHOTO"] = $arFileTmp["src"];
            } else {
                $rowUsers["PERSONAL_PHOTO"] = false;
            }
            if ($prop != false) {
                foreach ($rowUsers as $k => $v) {
                    if (!in_array($k, $prop)) {
                        unset($rowUsers[$k]);
                    }
                }
            }
            $arUser[] = $rowUsers;
        }
        return $arUser;
    }

    public static function Update($user_id = false, $fields = [])
    {
        $user = new CUser;
        return $user->Update(intval($user_id), $fields);
    }

    public static function UserGetByField($field = '', $value = '', $prop = [])
    {
        $arUser = CUser::GetList(
            $sort_by = "ID",
            $sort_ord = "ASC",
            [
                "ACTIVE" => "Y",
                $field => $value
            ],
            [
                "SELECT" => [
                    "UF_*"
                ],
                "FIELDS" => [
                    "*"
                ]
            ]
        )->Fetch();
        if (!empty($arUser["PERSONAL_PHOTO"])) {
            $imageFile = CFile::GetFileArray($arUser["PERSONAL_PHOTO"]);
            if ($imageFile !== false) {
                $arFileTmp = CFile::ResizeImageGet(
                    $imageFile,
                    [
                        "width" => 120,
                        "height" => 120
                    ],
                    BX_RESIZE_IMAGE_EXACT,
                    true
                );
            }
            if ($arFileTmp && array_key_exists("src", $arFileTmp))
                $arUser["PERSONAL_PHOTO"] = $arFileTmp["src"];
        } else {
            $arUser["PERSONAL_PHOTO"] = false;
        }
        if (count($prop) > 0) {
            foreach ($arUser as $k => $v) {
                if (!in_array($k, $prop)) {
                    unset($arUser[$k]);
                }
            }
        }
        return $arUser;
    }

    public static function UserGetById($user_id)
    {
        return CUser::GetList(
            $sort_by = "ID",
            $sort_ord = "ASC",
            [
                "ID" => intval($user_id)
            ],
            [
                "SELECT" => [
                    "UF_*"
                ],
                "FIELDS" => [
                    "*"
                ]
            ]
        )->Fetch();
    }
}
