<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\EventManager;
use SerginhoLD\BooleanProperty\BooleanProperty;

Loc::loadMessages(__FILE__);

if (class_exists('serginhold_booleanproperty'))
    return;

/**
 * Модуль добавляющий свойство "Да/Нет" для инфоблоков
 * 
 * Class serginhold_booleanproperty
 */
class serginhold_booleanproperty extends \CModule
{
    /** @var string id модуля */
    public $MODULE_ID = 'serginhold.booleanproperty';

    /** @var string версия модуля */
    public $MODULE_VERSION;

    /** @var string дата версии модуля */
    public $MODULE_VERSION_DATE;

    /** @var string имя модуля */
    public $MODULE_NAME;

    /** @var string автор */
    public $PARTNER_NAME = 'Sergey Zubrilin';

    /** @var string url автора */
    public $PARTNER_URI = 'https://github.com/SerginhoLD';

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->MODULE_NAME = Loc::getMessage('SERGINHOLD_BOOLEAN_PROPERTY_MODULE_NAME');
        
        include __DIR__ . '/version.php';
        
        if (isset($arModuleVersion['VERSION'], $arModuleVersion['VERSION_DATE']))
        {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }
    }

    /**
     * Установка модуля
     */
    public function DoInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
        $this->InstallEvents();
    }

    /**
     * Удаление модуля
     */
    public function DoUninstall()
    {
        $this->UnInstallEvents();
        ModuleManager::unregisterModule($this->MODULE_ID);
    }

    /**
     * Регистрация новых событий
     * 
     * @return bool
     */
    public function InstallEvents()
    {
        $em = EventManager::getInstance();
        
        $em->registerEventHandler('iblock', 'OnIBlockPropertyBuildList', 
            $this->MODULE_ID, BooleanProperty::class, 'GetIBlockPropertyDescription');
        
        return true;
    }

    /**
     * Удаление событий
     * 
     * @return bool
     */
    public function UnInstallEvents()
    {
        $em = EventManager::getInstance();
        
        $em->unRegisterEventHandler('iblock', 'OnIBlockPropertyBuildList', 
            $this->MODULE_ID, BooleanProperty::class, 'GetIBlockPropertyDescription');

        return true;
    }
}
