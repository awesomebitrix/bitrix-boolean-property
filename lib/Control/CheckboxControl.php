<?php
namespace SerginhoLD\BooleanProperty\Control;

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

/**
 * Checkbox
 * 
 * Class CheckboxControl
 * @package SerginhoLD\BooleanProperty\Control
 */
class CheckboxControl extends Control
{
    /**
     * @param string $name
     * @param mixed $value
     * 
     * @return string
     */
    protected function renderControl($name, $value = null)
    {
        return '<input type="hidden" value="0" name="' . $name . '">
            <input type="checkbox" value="1" name="' . $name . '"' . ($value ? ' checked' : null) . ' id="' . $name . '">';
    }
}