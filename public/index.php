<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
global $APPLICATION;
\Vabank\API\CssJsVue::On();
$arUser = \Vabank\API\UsersExt::UserGetById(DEFAULT_USER_ID);
$APPLICATION->SetTitle("".$arUser["NAME"]." ".$arUser["SECOND_NAME"].". ".$arUser["LAST_NAME"]."");
?>
<div id="app"></div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
