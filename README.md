# MaintenanceBundle
Symfony Bundle  to place your Symfony website in maintenance mode - [**Default Maintenance Page**](https://artgris.github.io/MaintenanceBundle/)

Installation
============

### 1) Download 

`composer require artgris/maintenance-bundle`

### 2) Enable Bundle

        // app/AppKernel.php
        
        // ...
        class AppKernel extends Kernel
        {
            // ...
        
            public function registerBundles()
            {
                $bundles = array(
                    // ...
                    new Artgris\MaintenanceBundle\ArtgrisMaintenanceBundle(),
                );
        
                // ...
            }
        }
### 3) Configure the Bundle 

Adds following configurations 

to ` app/config/config.yml` :

```yml  
artgris_maintenance:
    enable: true                 # Enable|Disable maintenance
    ips: [127.0.0.1, ...]        # IPs allow (prod)
    response: 503                # Maintenance Page HTTP Status Code
``` 
 
### 4) Override maintenance.html.twig (optional)

Create your own twig in `app/Resources/ArtgrisMaintenanceBundle/views/maintenance.html.twig`.
or in (S4 project) `template/bundles/ArtgrisMaintenanceBundle/maintenance.html.twig`

ex:
```php  
{% extends "@!ArtgrisMaintenance/maintenance.html.twig" %}

{% block content %}
    <h1>Site en cours de maintenance</h1>
    <h2>Nous reviendrons bientôt. Désolé pour le dérangement.</h2>
{% endblock %}
```  

Usage
=====

The `dev` environment was not affected by maintenance.

- Enable|Disable maintenance : `enable: true|false`
- Add authorized IPs to prod : `ips: [127.0.0.1, ...]`
- Maintenance Page HTTP Status Code : `response: 503`


Don't forget to clear and warm the `prod` cache :

    php bin/console cache:clear --env=prod

