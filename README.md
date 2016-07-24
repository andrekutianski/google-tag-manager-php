# google-tag-manager-php
Google Tag Manager PHP Helper

This class provides some simple PHP helper functions for implementing Google Tag Manager within your website.

## Installation via Composer
to be done

## Methods:
- Gtm::renderContainer($container_id,$datalayer_items_array)
- Gtm::datalayerPush($datalayer_items_array)
- Gtm::datalayerRemember($datalayer_items_array)

## Method renderContainer

#### Description
Renders a Google Tag Manager container.

#### Parameters
- $container_id (required): The id of your container. You can get this value from your Google Tag Manager account admin panel.
- $datalayer_items_array (optional): Array of key-value items to be added to the datalayer.

## Method datalayerPush

#### Description
Use this method for populating your datalayer. When this method is called BEFORE the container rendering, it will populate the datalayer at the time it is declared in the HTML code. When this method is called AFTER the container has been rendered, it will render JavaScript ```dataLayer.push({...})``` calls.

#### Parameters
- $datalayer_items_array (required): Array of key-value items to be added to the datalayer.

## Method datalayerRemember

#### Description
This method is intended for collecting datalayer information in those parts of your application not rendering HTML code. All datalayer items added through this method would be reminded until a container is rendered on a HTML page, when they would finally be triggered.

#### Parameters
- $datalayer_items_array (required): Array of key-value items to be added to the datalayer.