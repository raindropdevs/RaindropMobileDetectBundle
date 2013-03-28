# Raindrop Mobile Detect Bundle

[![Build Status](https://travis-ci.org/raindropdevs/RaindropMobileDetectBundle.png?branch=master)](https://travis-ci.org/raindropdevs/RaindropMobileDetectBundle)

This bundle adds support for detect mobile devices. It uses the lightweight PHP class [Mobile_Detect](https://github.com/serbanghita/Mobile-Detect).

### **INSTALLATION**:

First add the dependency to your composer.json` file:

    "require": {
        ...
        "raindrop/mobiledetect-bundle": "dev-master"
    },

Then install the bundle with the command:

    php composer.phar update

Enable the bundle in your application kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Raindrop\MobileDetectBundle\RaindropMobileDetectBundle(),
    );
}
```

Now the bundle is enabled.
