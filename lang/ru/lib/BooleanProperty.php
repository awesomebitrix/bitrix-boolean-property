<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

$MESS = array_merge(!empty($MESS) ? $MESS : [], [
    'SERGINHOLD_IBLOCK_BOOLEAN_PROPERTY_ERROR_MULTY' => 'Свойство типа "#TYPE#" не может быть множественным',
    'SERGINHOLD_IBLOCK_BOOLEAN_PROPERTY_DISPLAY' => 'Внешний вид',
    'SERGINHOLD_IBLOCK_BOOLEAN_PROPERTY_DISPLAY_CHECKBOX' => 'Флажок',
    'SERGINHOLD_IBLOCK_BOOLEAN_PROPERTY_DISPLAY_RADIO' => 'Радио кнопки',
    'SERGINHOLD_IBLOCK_BOOLEAN_PROPERTY_DISPLAY_SELECT' => 'Выпадающий список',
]);