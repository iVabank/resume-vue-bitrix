<? use Vabank\API\UsersExt;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

define("DEFAULT_USER_ID", 1);
// Sections
define("DEFAULT_SECTIONS_IBLOCK_ID", 2);
// Skills
define("DEFAULT_SKILLS_IBLOCK_ID", 7);
// Education
define("DEFAULT_EDUCATION_IBLOCK_ID", 6);
// Products
define("DEFAULT_PRODUCTS_IBLOCK_ID", 5);
// About
define("DEFAULT_ABOUT_IBLOCK_ID", 4);
// My life
define("DEFAULT_LIFE_IBLOCK_ID", 8);
// Default avatar
define("DEFAULT_AVATAR_USER", "/img/avatar-default.png");

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
    if (UsersExt::userInGroup([1])) {
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
    if (UsersExt::userInGroup([1])) {
        echo "<pre>";
        var_dump($ar);
        echo "</pre>";
        if ($exit == true) {
            exit();
        }
    }
}
