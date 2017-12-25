# JQueryAutocomplete Field ([view demo](http://jqueryui.com/demos/autocomplete/))

## Default Usage:

``` php
<?php
// ...
public function buildForm(FormBuilder $builder, array $options)
{
    $builder
        // ...
        ->add('country', 'genemu_jqueryautocompleter_country')
        ->add('timezone', 'genemu_jqueryautocompleter_timezone')
        ->add('language', 'genemu_jqueryautocompleter_language');
}
```

## Extra

### Text
1. [Text](Resources/doc/jquery/autocomplete/text.md)
2. [Ajax Suggestions](Resources/doc/jquery/autocomplete/text_ajax.md)

### Choices
1. [Choices](Resources/doc/jquery/autocomplete/choices.md)
2. [Ajax Choices](Resources/doc/jquery/autocomplete/choices_ajax.md)

### Entity
1. [Entity](Resources/doc/jquery/autocomplete/entity.md)
2. [Ajax Entity](Resources/doc/jquery/autocomplete/entity_ajax.md)

### MongoDB
1. [MongoDB](Resources/doc/jquery/autocomplete/mongodb.md)
2. [Ajax MongoDB](Resources/doc/jquery/autocomplete/mongodb_ajax.md)

### Propel
1. [Propel](Resources/doc/jquery/autocomplete/propel.md)
2. [Ajax Propel](Resources/doc/jquery/autocomplete/propel_ajax.md)
