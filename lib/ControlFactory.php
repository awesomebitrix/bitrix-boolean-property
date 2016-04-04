<?php
namespace SerginhoLD\Bitrix\Iblock\BooleanProperty;

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use SerginhoLD\Bitrix\Iblock\BooleanProperty\Control\CheckboxControl;

/**
 * Class ControlFactory
 * @package SerginhoLD\Bitrix\Iblock\BooleanProperty
 */
class ControlFactory
{
    /**
     * Create control
     * 
     * @param string $name
     * 
     * @return object Control
     */
    public static function create($name)
    {
        $control = __NAMESPACE__ . '\\Control\\' . ucfirst(strtolower($name)) . 'Control';
        
        if (!$name || !class_exists($control))
        {
            return new CheckboxControl();
        }
        
        return new $control;
    }
}