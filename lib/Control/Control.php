<?php
namespace SerginhoLD\Bitrix\Iblock\BooleanProperty\Control;

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Localization\Loc;

/**
 * Class Control
 * @package SerginhoLD\Bitrix\Iblock\BooleanProperty\Control
 */
abstract class Control
{
    /**
     * @param array $arName
     * @param array $arValue
     * @param bool $withDescription
     *
     * @return string
     */
    public function render(array $arName, array $arValue, $withDescription = false)
    {
        if (is_numeric($arValue['VALUE']))
        {
            $arValue['VALUE'] = (int)$arValue['VALUE'];
        }
        else
        {
            $arValue['VALUE'] = null;
        }
        
        $html = $this->renderControlField($arName['VALUE'], $arValue['VALUE']);
        
        if ($withDescription)
        {
            $html .= $this->renderDescriptionField($arName['DESCRIPTION'], $arValue['DESCRIPTION']);
        }
        
        return $html;
    }
    
    /**
     * @param string $name
     * @param mixed $value
     *
     * @return string
     */
    abstract protected function renderControlField($name, $value = null);
    
    /**
     * @param string $name
     * @param string $value
     *
     * @return string
     */
    protected function renderDescriptionField($name, $value)
    {
        $placeholder = htmlentities(Loc::getMessage('SERGINHOLD_IBLOCK_BOOLEAN_PROPERTY_PLACEHOLDER_DESCRIPTION'), ENT_QUOTES);
        $value = htmlentities($value, ENT_QUOTES);
        
        return '<div style="margin-top: 5px">
            <input type="text" name="' . $name . '" placeholder="' . $placeholder . '" value="' . $value . '" size="50">
        </div>';
    }
}