<?php
namespace SerginhoLD\BooleanProperty\Control;

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Localization\Loc;

/**
 * Select
 *
 * Class SelectControl
 * @package SerginhoLD\BooleanProperty\Control
 */
class SelectControl extends Control
{
    /**
     * @param string $name
     * @param mixed $value
     *
     * @return string
     */
    protected function renderControl($name, $value = null)
    {
        return '<select name="' . $name . '">
            <option value="">' . htmlentities(Loc::getMessage('SERGINHOLD_BOOLEAN_PROPERTY_ANY'), ENT_QUOTES) . '</option>
            <option value="1" ' . ($value ? 'selected' : null) .'>' . htmlentities(Loc::getMessage('SERGINHOLD_BOOLEAN_PROPERTY_YES'), ENT_QUOTES) . '</option>
            <option value="0" ' . ($value === 0 ? 'selected' : null) .'>' . htmlentities(Loc::getMessage('SERGINHOLD_BOOLEAN_PROPERTY_NO'), ENT_QUOTES) . '</option>
        </select>';
    }
}