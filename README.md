# perique-di-examples

A selection of examples of using the DI Container with the Perique Framework (https://github.com/Pink-Crab/Perqiue-Framework/)

To see how these work in action, 

* Clone this repo to you `wp-content/plugins` directory
* Then run `composer install --no-dev`

* Activate the plugin in `wp-admin`


## Cache Examples

These examples show how an Interface can be used with the Container. You can use fallback instances or define what dependency to use on a class by class basis.

![image](https://user-images.githubusercontent.com/28779094/147719032-139112c7-7c86-4430-9286-273e1e973b4d.png)


## Nested Examples

These examples show how dependencies can be nested and how you can swap out instances of dependencies and run custom initialisation with classes that use a fluent API.

![image](https://user-images.githubusercontent.com/28779094/147719060-b3f35dc5-8a8a-4974-9c0b-4c3a57bfd40c.png)

*** 


> The `$dependencies` array on the `plugin.php` file, is better suited in a file. Our examples do this using `config/dependencies.php'

***

## If you would like to see any other examples using the Container, please leave an issue with more details.

***

# [Read the Full DI Docs](https://perique.info/core/DI/)
