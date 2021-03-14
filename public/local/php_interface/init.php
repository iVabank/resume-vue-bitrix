<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

require_once($_SERVER["DOCUMENT_ROOT"] . "/local/vendor/autoload.php");

CPageOption::SetOptionString("main", "nav_page_in_session", "N");
function pre($ar, $exit = false)
{
    echo "<pre>";
    print_r($ar);
    echo "</pre>";
    if ($exit == true) {
        exit();
    }
}
function pre_admin($ar, $exit = false)
{
    if (Vabank\UsersExt::userInGroup([1])) {
        echo "<pre>";
        print_r($ar);
        echo "</pre>";
        if ($exit == true) {
            exit();
        }
    }
}
function pre_dump($ar, $exit = false)
{
    if (Vabank\UsersExt::userInGroup([1])) {
        echo "<pre>";
        var_dump($ar);
        echo "</pre>";
        if ($exit == true) {
            exit();
        }
    }
}
