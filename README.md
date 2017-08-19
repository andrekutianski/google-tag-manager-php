# google-tag-manager-php
This class provides some simple PHP helper functions for implementing Google Tag Manager within your website.

## Getting Started

You can install this package using Composer by adding this line to your composer.json ```require``` statement.
```json
"antoniotajuelo/google-tag-manager-php": "dev-master"
```

And then run from terminal:
```Bash
sudo composer update
```

## Code Sample

```php
use AntonioTajuelo\Gtm\Gtm;

Gtm::renderContainer('GTM-XXXXXX');
/* This will render the following container:
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-XXXXXX"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-XXXXXX');</script>
*/

Gtm::datalayerPush(['user_id' => 1]);
/* This will trigger the following datalayer push:
<script>dataLayer.push({'user_id':1});</script>
*/
```

## Methods:

- ```Gtm::renderContainer($container_id,$datalayer_items_array)```
- ```Gtm::datalayerPush($datalayer_items_array)```
- ```Gtm::datalayerRemember($datalayer_items_array)```
- ```Gtm::destroyContainer()```

## ```renderContainer``` Method

#### Description
Renders a Google Tag Manager container.

#### Parameters
- ```$container_id``` (required): The id of your container. You can get this value from your Google Tag Manager account admin panel.
- ```$datalayer_items_array``` (optional): Array of key-value items to be added to the datalayer.

## ```datalayerPush``` Method

#### Description
Use this method for populating your datalayer. When this method is called BEFORE the container rendering, it will populate the datalayer at the time it is declared in the HTML code. When this method is called AFTER the container has been rendered, it will render JavaScript ```dataLayer.push({...})``` calls.

#### Parameters
- ```$datalayer_items_array``` (required): Array of key-value items to be added to the datalayer.

## ```datalayerRemember``` Method

#### Description
This method is intended for collecting datalayer information in those parts of your application not rendering HTML code. All datalayer items added through this method would be reminded until a container is rendered on a HTML page, when they would finally be triggered.

#### Parameters
- $datalayer_items_array (required): Array of key-value items to be added to the datalayer.

## ```destroyContainer``` Method

#### Description
Destroys the Google Tag Manager container and resets the datalayer into an empty datalayer. Useful when you need to render multiple containers in the same page using different datalayer settings.

#### Parameters
- This method doesn't take any parameter.