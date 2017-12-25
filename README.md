# SHFormBundle

This package is a **maintainable** fork of [GenemuFormBundle](https://github.com/genemu/GenemuFormBundle)

[![Build Status](https://travis-ci.org/symfony-hackers/SHFormBundle.svg?branch=master)](https://travis-ci.org/symfony-hackers/SHFormBundle)

## Installation

Installation is quick and easy, 3 steps process

1. Install SHFormBundle
2. Enable the bundle
3. Initialize assets

### Step 1: Install SHFormBundle

Run the following command :

``` bash
$ composer require symfony-hackers/form-bundle "^3.0@dev"
```

### Step 2: Enable the bundle

Finally, enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new SymfonyHackers\Bundle\FormBundle\SHFormBundle(),
    );
}
```

### Step 3: Initialize assets

``` bash
$ php app/console assets:install web/
```

## Form types

### Select2 ([view demo](http://ivaynberg.github.com/select2/)):

[View configuration](Resources/doc/jquery/select2/index.md)

### Captcha GD

[View configuration](Resources/doc/captcha_gd/index.md)

### ReCaptcha ([Google library](http://www.google.com/recaptcha)):

[View configuration](Resources/doc/recaptcha/index.md)

### JQueryUi ([download](http://jqueryui.com/)):

- [Autocomplete](Resources/doc/jquery/autocomplete/text.md)

### Plain

A Form type that just renders the field as a p tag.
This is useful for forms where certain field need to be shown but not editable.

The type name is ``genemu_plain``.

## Tips

[Prototype usage within form collections](Resources/doc/tips/form_prototype.md)

## Template

You use SHFormBundle and you seen that it does not work!
Maybe you have forgotten ``form_javascript`` or ``form_stylesheet``.

The principle is to separate the javascript, stylesheet and html. This allows better integration of web pages.

[View a template example form view](Resources/doc/template.md)

## Note

There are maybe some bugs in those implementations, this package is just an idea of form types which can be very useful for your Symfony projects.
