<?
namespace Vabank\Utility;

use \CUser;

class UsersExt
{
    public static function userInGroup(array $arGroupsAvalaible = [], int $user_id = null)
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
}
