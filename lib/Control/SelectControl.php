<?php
namespace SerginhoLD\Bitrix\Iblock\BooleanProperty\Control;

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Localization\Loc;
use SerginhoLD\Bitrix\Iblock\BooleanProperty\ControlInterface;

/**
 * Select
 *
 * Class SelectControl
 * @package SerginhoLD\Bitrix\Iblock\BooleanProperty\Control
 */
class SelectControl implements ControlInterface
{
    /**
     * @param $name
     * @param null $value
     *
     * @return string
     */
    function render($name, $value = null)
    {
        return '<select name="' . $name . '">
            <option value="0">' . htmlentities(Loc::getMessage('MAIN_NO'), ENT_QUOTES) . '</option>
            <option value="1" ' . ($value ? 'selected' : null) .'>' . htmlentities(Loc::getMessage('MAIN_YES'), ENT_QUOTES) . '</option>
        </select>';
    }
}