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
     * @param $name
     * 
     * @return object ControlInterface
     */
    public static function create($name)
    {
        $control = __NAMESPACE__ . '\\Control\\' . ucwords(strtolower($name)) . 'Control';
        
        if (!class_exists($control))
        {
            return new CheckboxControl();
        }
        
        return new $control;
    }
}