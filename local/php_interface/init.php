<?php

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

AddEventHandler("iblock", "OnIBlockPropertyBuildList", ['App\CustomProperties\Textarea', 'getTypeDescription']);