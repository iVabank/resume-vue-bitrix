<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

/** @var TYPE_NAME $result */
$result = \Vabank\Content\Data::getData();

exit(json_encode($result));
