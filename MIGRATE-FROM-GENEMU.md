Migration from GenemuFormBundle
===============================

GenemuFormBundle is not maintainable anymore and abandoned.
This fork providers support of the latest symfony versions.

**Keep in mind, this bundle supports only symfony 3 or higher.** 

To migrate from GenemuFormBundle to this you need to do next steps:

1. Replace `genemu/form-bundle` on `symfony-hackers/form-bundle` in your composer.json
2. Execute `composer update` command to install new package.
3. If your are used `Genemu\Bundle\FormBundle` namespace in your code you need to change in on `SymfonyHackers\Bundle\FormBundle`

That's all.
