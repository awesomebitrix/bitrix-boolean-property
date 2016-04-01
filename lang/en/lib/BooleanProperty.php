<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

$MESS = array_merge(!empty($MESS) ? $MESS : [], [
    'SERGINHOLD_IBLOCK_BOOLEAN_PROPERTY_ERROR_MULTY' => 'The property of the type "#TYPE#" cannot be a multiple',
    'SERGINHOLD_IBLOCK_BOOLEAN_PROPERTY_DISPLAY' => 'Template',
    'SERGINHOLD_IBLOCK_BOOLEAN_PROPERTY_DISPLAY_CHECKBOX' => 'Checkbox',
    'SERGINHOLD_IBLOCK_BOOLEAN_PROPERTY_DISPLAY_RADIO' => 'Radio buttons',
    'SERGINHOLD_IBLOCK_BOOLEAN_PROPERTY_DISPLAY_SELECT' => 'Drop-down list',
]);