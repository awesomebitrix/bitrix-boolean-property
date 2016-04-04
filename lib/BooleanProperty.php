<?php
namespace SerginhoLD\Bitrix\Iblock\BooleanProperty;

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Application;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Error;

Loc::loadMessages(__FILE__);

/**
 * Класс свойства "Да/Нет" для инфоблоков
 * Значение свойства является числом, возможные значения: null, 0 или 1
 * 
 * Class BooleanProperty
 * @package SerginhoLD\Bitrix\Iblock\BooleanProperty
 * 
 * @link https://dev.1c-bitrix.ru/api_help/iblock/classes/user_properties/index.php
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
        return [
            'PROPERTY_TYPE'             => 'N',
            'USER_TYPE'                 => 'boolean',
            'DESCRIPTION'               => Loc::getMessage('SERGINHOLD_IBLOCK_BOOLEAN_PROPERTY_DESCRIPTION'),
            'ConvertToDB'               => [__CLASS__, 'valueToInt'],
            'ConvertFromDB'             => [__CLASS__, 'valueToInt'],
            'GetPropertyFieldHtml'      => [__CLASS__, 'GetPropertyFieldHtml'],
            'GetPropertyFieldHtmlMulty' => [__CLASS__, 'GetPropertyFieldHtmlMulty'],
            'GetAdminListViewHTML'      => [__CLASS__, 'GetAdminListViewHTML'],
            'GetAdminFilterHTML'        => [__CLASS__, 'GetAdminFilterHTML'],
            'GetPublicViewHTML'         => [__CLASS__, 'GetPublicViewHTML'],
            'GetPublicEditHTML'         => [__CLASS__, 'GetPublicEditHTML'],
            //'GetPublicFilterHTML'       => [__CLASS__, 'GetPublicFilterHTML'],
            'PrepareSettings'           => [__CLASS__, 'PrepareSettings'],
            'GetSettingsHTML'           => [__CLASS__, 'GetSettingsHTML'],
        ];
    }
    
    /**
     * @param $arProperty
     * @param $value
     *
     * @return array
     */
    public static function valueToInt($arProperty, $value)
    {
        if (is_numeric($value['VALUE']))
        {
            $value['VALUE'] = (int)$value['VALUE'];
    
            if ($value['VALUE'] > 1) $value['VALUE'] = 1;
            if ($value['VALUE'] < 0) $value['VALUE'] = 0;
        }
        else
        {
            $value['VALUE'] = null;
        }
        
        return $value;
    }
    
    /**
     * html значения свойства
     *
     * @param $value
     *
     * @return string
     */
    protected static function renderValue($value = null)
    {
        $message = 'SERGINHOLD_IBLOCK_BOOLEAN_PROPERTY_ANY';
        
        if (is_numeric($value))
        {
            $message = $value ? 'SERGINHOLD_IBLOCK_BOOLEAN_PROPERTY_YES' : 'SERGINHOLD_IBLOCK_BOOLEAN_PROPERTY_NO';
        }
        
        return htmlentities(Loc::getMessage($message), ENT_QUOTES);
    }
    
    /**
     * html значения свойства в списке в административной части сайта
     *
     * @param $arUserField
     * @param $arHtmlControl
     *
     * @return string
     */
    public static function GetAdminListViewHTML($arUserField, $arHtmlControl)
    {
        return self::renderValue($arHtmlControl['VALUE']);
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
        return self::renderValue($value['VALUE']);
    }
    
    /**
     * html для редактирования свойства
     *
     * @param array $arName
     * @param array $arValue
     * @param mixed $arProperty
     *
     * @return string
     */
    protected static function renderEditProperty(array $arName, array $arValue, $arProperty = null)
    {
        $display = isset($arProperty['USER_TYPE_SETTINGS']['DISPLAY'])
            ? $arProperty['USER_TYPE_SETTINGS']['DISPLAY'] : null;
        
        $withDescription = (isset($arProperty['WITH_DESCRIPTION']) && $arProperty['WITH_DESCRIPTION'] === 'Y')
            ? true : false;
        
        return ControlFactory::create($display)->render($arName, $arValue, $withDescription);
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
        if (empty($strHTMLControlName['DESCRIPTION']))
        {
            $arProperty['WITH_DESCRIPTION'] = 'N';
        }
        
        return self::renderEditProperty($strHTMLControlName, $value, $arProperty);
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
        $arProperty['USER_TYPE_SETTINGS']['DISPLAY'] = 'Select';
        
        $request = Application::getInstance()->getContext()->getRequest();
    
        $value['VALUE'] = $request->getQuery($strHTMLControlName['VALUE']);
        
        return self::GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName);
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
        $arProperty['WITH_DESCRIPTION'] = 'N';
        
        return self::renderEditProperty($strHTMLControlName, $value, $arProperty);
    }
    
    /**
     * html фильтра в публичной части сайта
     *
     * @param $arProperty
     * @param $strHTMLControlName
     *
     * @return string
     */
    public static function GetPublicFilterHTML($arProperty, $strHTMLControlName)
    {
        // TODO: не работает для стандартных компонентов/фильтров (жестко захуярены исходники), не нашел где еще можно использовать
        return null;
    }
    
    /**
     * @param $arProperty
     *
     * @return string
     */
    public static function PrepareSettings($arProperty)
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
    public static function GetSettingsHTML($arProperty, $strHTMLControlName, &$arPropertyFields)
    {
        $arPropertyFields = [
            'HIDE' => [
                'ROW_COUNT',
                'COL_COUNT',
                'MULTIPLE',
                'MULTIPLE_CNT'
            ],
        ];
    
        $settings = $arProperty['USER_TYPE_SETTINGS'];
        $display = isset($settings['DISPLAY']) ? $settings['DISPLAY'] : null;
    
        $classFiles = glob(__DIR__ . '/Control/*Control.php');
    
        $listHtml = null;
    
        foreach ($classFiles as $file)
        {
            $controlName = preg_replace('/.*\/(\w+)?Control\.php/', "$1", $file);
            
            if (empty($controlName)) continue;
    
            $checked = ($display === $controlName) ? 'checked' : null;
            $name = Loc::getMessage('SERGINHOLD_IBLOCK_BOOLEAN_PROPERTY_DISPLAY_' . strtoupper($controlName));
    
            $listHtml .= '<div>
                <label>
                    <input type="radio" name="' . $strHTMLControlName['NAME'] . '[DISPLAY]" value="' . $controlName . '" '. $checked .'>'
                    . htmlentities($name, ENT_QUOTES) . 
                '</label>
            </div>';
        }
        
        return '<tr valign="top">
            <td>' . htmlentities(Loc::getMessage('SERGINHOLD_IBLOCK_BOOLEAN_PROPERTY_DISPLAY'), ENT_QUOTES) . ':</td>
            <td>' . $listHtml . '</td>
        </tr>';
    }
}