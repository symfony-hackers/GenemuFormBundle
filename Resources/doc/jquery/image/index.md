# JQueryImage Field

![Crop image](https://github.com/genemu/SHFormBundle/raw/master/Resources/doc/jquery/image/images/crop.png)

## Minimal configuration:

``` yml
# app/config/config.yml
sh_form:
    image: ~
```

## Add in your routing.yml

``` yml
genemu_image:
    resource: "@SHFormBundle/Resources/config/routing/image.xml"
```

## Default Usage:

``` php
<?php
// ...
public function buildForm(FormBuilder $builder, array $options)
{
    $builder
        // ...
        ->add('image', 'genemu_jqueryimage');
}
```

## Extra

[Configuration](Resources/doc/jquery/image/default.md)
