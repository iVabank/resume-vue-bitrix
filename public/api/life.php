<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$result = \Vabank\Content\Life::getList(intval($_GET['page']), intval($_GET['type']));

exit(json_encode($result));
