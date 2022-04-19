# yii2-asset-slimscroll
Use slimScroll jquery plugin in your project

## Installation

To install with composer:

```
$ php composer.phar require diiimonn/yii2-asset-slimscroll "dev-master"
```

or add

```
"diiimonn/yii2-asset-slimscroll": "dev-master"
```

to the ```require``` section of your `composer.json` file.

## Usage

### in your AssetBundle:
```php
public $depends = [
    ...
    'diiimonn\assets\SlimScrollAsset',
];
```
### in your.script.js

```javascript
...
$('#your-content-id').slimScroll({/* options */});
...
```
Demo and more: http://rocha.la/jQuery-slimScroll
