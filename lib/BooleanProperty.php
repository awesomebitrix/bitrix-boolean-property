<?php
namespace SerginhoLD\Bitrix\Iblock\BooleanProperty;

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Application;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Error;

Loc::loadMessages(__FILE__);

/**
 * Класс свойства "Да/Нет" для инфоблоков
 * 
 * Class PropertyBoolean
 * @package SerginhoLD\Bitrix\Iblock\BooleanProperty
 */
class BooleanProperty
{
    /**
     * Параметры свойства
     * 
     * @return array
     */
    public static function GetIBlockPropertyDescription()
    {
        $userTypeBoolean = \CUserTypeBoolean::GetUserTypeDescription();
        
        return [
            'PROPERTY_TYPE'             => 'N',
            'USER_TYPE'                 => $userTypeBoolean['USER_TYPE_ID'],
            'DESCRIPTION'               => $userTypeBoolean['DESCRIPTION'],
            'GetPropertyFieldHtml'      => [__CLASS__, 'GetPropertyFieldHtml'],
            'GetPropertyFieldHtmlMulty' => [__CLASS__, 'GetPropertyFieldHtmlMulty'],
            'GetAdminListViewHTML'      => [__CLASS__, 'GetAdminListViewHTML'],
            'GetAdminFilterHTML'        => [__CLASS__, 'GetAdminFilterHTML'],
            'GetPublicViewHTML'         => [__CLASS__, 'GetPublicViewHTML'],
            'GetPublicEditHTML'         => [__CLASS__, 'GetPublicEditHTML'],
            'PrepareSettings'           => [__CLASS__, 'PrepareSettings'],
            'GetSettingsHTML'           => [__CLASS__, 'GetSettingsHTML'],
        ];
    }

    /**
     * html для редактирования свойства в административной части сайта
     * 
     * @param $arProperty
     * @param $value
     * @param $strHTMLControlName
     * 
     * @return string
     */
    public static function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName)
    {
        return self::getPropertyHtml($strHTMLControlName['VALUE'], $value['VALUE'], $arProperty);
    }
    
    /**
     * html для редактирования множественного свойства в административной части сайта
     *
     * @param $arProperty
     * @param $arValues
     * @param $strHTMLControlName
     *
     * @return string
     */
    public static function GetPropertyFieldHtmlMulty($arProperty, $arValues, $strHTMLControlName)
    {
        $errorMessage = Loc::getMessage('SERGINHOLD_IBLOCK_BOOLEAN_PROPERTY_ERROR_MULTY', [
            '#TYPE#' => $arProperty['USER_TYPE']
        ]);
        
        return (new \CAdminMessage(new Error($errorMessage)))->show();
    }
    
    /**
     * html фильтра в административной части сайта
     *
     * @param $arProperty
     * @param $strHTMLControlName
     *
     * @return string
     */
    public static function GetAdminFilterHTML($arProperty, $strHTMLControlName)
    {
        $request = Application::getInstance()->getContext()->getRequest();
        
        $value = (int)$request->getQuery($strHTMLControlName['VALUE']);
        
        return self::getPropertyHtml($strHTMLControlName['VALUE'], $value, $arProperty);
    }
    
    /**
     * html для редактирования свойства
     *
     * @param $name
     * @param $value
     * @param $arProperty
     *
     * @return string
     */
    protected static function getPropertyHtml($name, $value = null, $arProperty = null)
    {
        $display = isset($arProperty['USER_TYPE_SETTINGS']['DISPLAY']) 
            ? $arProperty['USER_TYPE_SETTINGS']['DISPLAY'] : null;
        
        return ControlFactory::create($display)->render($name, (int)$value);
    }
    
    /**
     * html значения свойства в публичной части сайта
     *
     * @param $arProperty
     * @param $value
     * @param $strHTMLControlName
     *
     * @return string
     */
    public static function GetPublicViewHTML($arProperty, $value, $strHTMLControlName)
    {
        return htmlentities(Loc::getMessage((int)$value['VALUE'] ? 'MAIN_YES' : 'MAIN_NO'), ENT_QUOTES);
    }
    
    /**
     * html для редактирования свойства в публичной части сайта
     *
     * @param $arProperty
     * @param $value
     * @param $strHTMLControlName
     *
     * @return string
     */
    public static function GetPublicEditHTML($arProperty, $value, $strHTMLControlName)
    {
        return self::getPropertyHtml($strHTMLControlName['VALUE'], $value['VALUE'], $arProperty);
    }
    
    /**
     * @param $arProperty
     *
     * @return string
     */
    function PrepareSettings($arProperty)
    {
        $result = [
            'DISPLAY' => null,
        ];
        
        if (isset($arProperty['USER_TYPE_SETTINGS']['DISPLAY']))
        {
            $result['DISPLAY'] = $arProperty['USER_TYPE_SETTINGS']['DISPLAY'];
        }
        
        return $result;
    }
    
    /**
     * html настроек параметров свойства
     *
     * @param $arProperty
     * @param $strHTMLControlName
     * @param $arPropertyFields
     *
     * @return string
     */
    function GetSettingsHTML($arProperty, $strHTMLControlName, &$arPropertyFields)
    {
        $arPropertyFields = [
            'HIDE' => [
                'WITH_DESCRIPTION',
                'ROW_COUNT',
                'COL_COUNT',
                'MULTIPLE',
                'MULTIPLE_CNT'
            ],
        ];
    
        $settings = $arProperty['USER_TYPE_SETTINGS'];
        $display = isset($settings['DISPLAY']) ? $settings['DISPLAY'] : null;
    
        $classFiles = glob(__DIR__ . '/Control/*Control.php', GLOB_NOESCAPE);
    
        $listHtml = null;
    
        foreach ($classFiles as $file)
        {
            $controlName = preg_replace('/.*\/(.+?)Control\.php/', "$1", $file);
    
            $checked = ($display === $controlName) ? 'checked' : null;
            $name = Loc::getMessage('SERGINHOLD_IBLOCK_BOOLEAN_PROPERTY_DISPLAY_' . strtoupper($controlName));
    
            $listHtml .= '<div>
                <label>
                    <input type="radio" name="' . $strHTMLControlName['NAME'] . '[DISPLAY]" value="' . $controlName . '" '. $checked .'>'
                    . htmlentities($name, ENT_QUOTES)
                . '</label>
            </div>';
        }
        
        return '<tr valign="top">
            <td>' . htmlentities(Loc::getMessage('SERGINHOLD_IBLOCK_BOOLEAN_PROPERTY_DISPLAY'), ENT_QUOTES) . ':</td>
            <td>' . $listHtml . '</td>
        </tr>';
    }
}