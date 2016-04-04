<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use \Bitrix\Main\Loader as Loader;

Loader::registerAutoLoadClasses('serginhold.booleanproperty', [
    'SerginhoLD\Bitrix\Iblock\BooleanProperty\BooleanProperty'         => 'lib/BooleanProperty.php',
    'SerginhoLD\Bitrix\Iblock\BooleanProperty\ControlFactory'          => 'lib/ControlFactory.php',
    'SerginhoLD\Bitrix\Iblock\BooleanProperty\Control\Control'         => 'lib/Control/Control.php',
    'SerginhoLD\Bitrix\Iblock\BooleanProperty\Control\CheckboxControl' => 'lib/Control/CheckboxControl.php',
    'SerginhoLD\Bitrix\Iblock\BooleanProperty\Control\SelectControl'   => 'lib/Control/SelectControl.php',
]);