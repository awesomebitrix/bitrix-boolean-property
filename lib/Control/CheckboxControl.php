<?php
namespace SerginhoLD\Bitrix\Iblock\BooleanProperty\Control;

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use SerginhoLD\Bitrix\Iblock\BooleanProperty\ControlInterface;

/**
 * Checkbox
 * 
 * Class CheckboxControl
 * @package SerginhoLD\Bitrix\Iblock\BooleanProperty\Control
 */
class CheckboxControl implements ControlInterface
{
    /**
     * @param $name
     * @param null $value
     * 
     * @return string
     */
    function render($name, $value = null)
    {
        return '<input type="hidden" value="0" name="' . $name . '">
            <input type="checkbox" value="1" name="' . $name . '"'
            . ($value ? ' checked' : null) . ' id="' . $name . '">';
    }
}