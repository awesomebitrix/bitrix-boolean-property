# Свойство Да/Нет для модуля Информационные блоки (1С-Битрикс)

[![Latest Stable Version](https://poser.pugx.org/serginhold/bitrix-boolean-property/v/stable)](https://packagist.org/packages/serginhold/bitrix-boolean-property) [![Total Downloads](https://poser.pugx.org/serginhold/bitrix-boolean-property/downloads)](https://packagist.org/packages/serginhold/bitrix-boolean-property) [![License](https://poser.pugx.org/serginhold/bitrix-boolean-property/license)](https://packagist.org/packages/serginhold/bitrix-boolean-property)

## Установка
```bash
composer require serginhold/bitrix-boolean-property
```
Для установки модуля в папку `/local/` добавить следующий код в `composer.json`:
```json
"extra": {
  "installer-paths": {
    "local/modules/{$name}/": ["type:bitrix-module"]
  }
}
```
Имя модуля:
```
serginhold.booleanproperty
```

### Требования
* PHP >= 5.5.0

### Настройка свойств
![Настройка свойств](screenshot.png)