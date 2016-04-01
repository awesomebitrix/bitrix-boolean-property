<?php
namespace SerginhoLD\Bitrix\Iblock\BooleanProperty;

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

/**
 * Interface ControlInterface
 * @package SerginhoLD\Bitrix\Iblock\BooleanProperty
 */
interface ControlInterface
{
    /**
     * @param $name
     * @param $value
     * 
     * @return string
     */
    public function render($name, $value = null);
}