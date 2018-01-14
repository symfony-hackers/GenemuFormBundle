# JQueryFile Field ([download uploadify](http://www.uploadify.com))

![Multi files](https://github.com/genemu/SHFormBundle/raw/master/Resources/doc/jquery/file/images/multiple.png)

## Minimal configuration:

``` yml
# app/config/config.yml
sh_form:
    file:
        swf: /uploadify/uploadify.swf
```

## Add in your routing.yml

``` yml
genemu_upload:
    resource: "@SHFormBundle/Resources/config/routing/upload.xml"
```

## Default Usage:

``` php
<?php
// ...
public function buildForm(FormBuilder $builder, array $options)
{
    $builder
        // ...
        ->add('download', 'genemu_jqueryfile')
        ->add('multiple_download', 'genemu_jqueryfile', array(
            'multiple' => true
        ))
        ->add('auto_download', 'genemu_jqueryfile', array(
            'configs' => array(
                'auto' => true
            )
        ))
        ->add('auto_multiple_download', 'genemu_jqueryfile', array(
            'multiple' => true,
            'configs' => array(
                'auto' => true
            )
        ));
}
```

## Extra

[Configuration](Resources/doc/jquery/file/default.md)
[Save Entity File](Resources/doc/jquery/file/entity.md)
