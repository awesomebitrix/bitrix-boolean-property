<?php
namespace SerginhoLD\Bitrix\Iblock\BooleanProperty\Control;

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Localization\Loc;
use SerginhoLD\Bitrix\Iblock\BooleanProperty\ControlInterface;

/**
 * Radio buttons
 *
 * Class Radio Control
 * @package SerginhoLD\Bitrix\Iblock\BooleanProperty\Control
 */
class RadioControl implements ControlInterface
{
    /**
     * @param $name
     * @param null $value
     *
     * @return string
     */
    function render($name, $value = null)
    {
        return '<div>
            <label>
                <input type="radio" name="' . $name . '" value="0" '. (!$value ? 'checked' : null) .'>'
                . htmlentities(Loc::getMessage('MAIN_NO'), ENT_QUOTES)
            . '</label>
            <br>
            <label>
                <input type="radio" name="' . $name . '" value="1" '. ($value ? 'checked' : null) .'>'
                . htmlentities(Loc::getMessage('MAIN_YES'), ENT_QUOTES)
            . '</label>
        </div>';
    }
}