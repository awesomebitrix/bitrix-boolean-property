# Свойство Да/Нет для Инфоблоков (1С-Битрикс)

[![Latest Stable Version](https://poser.pugx.org/serginhold/bitrix-boolean-property/v/stable)](https://packagist.org/packages/serginhold/bitrix-boolean-property) [![Total Downloads](https://poser.pugx.org/serginhold/bitrix-boolean-property/downloads)](https://packagist.org/packages/serginhold/bitrix-boolean-property) [![License](https://poser.pugx.org/serginhold/bitrix-boolean-property/license)](https://packagist.org/packages/serginhold/bitrix-boolean-property)

Значение свойства является числом, возможные значения: null, 0 или 1.

## Установка

### Composer
```bash
composer require serginhold/bitrix-boolean-property
```
Для установки модуля в папку `/local/modules/` добавьте следующий код в `composer.json`:
```json
"extra": {
  "installer-paths": {
    "local/modules/{$name}/": ["type:bitrix-module"]
  }
}
```

### Ручная установка
* Разместить модуль в папке для модулей, `/local/modules/` или `/bitrix/modules/`
* Переименовать папку с модулем на `serginhold.booleanproperty`

### Настройка свойств элементов инфоблока
![Настройка свойств элементов инфоблока](screenshot.png)

## Требования
* PHP >= 5.5.0

## Лицензия
[MIT](LICENSE.md)