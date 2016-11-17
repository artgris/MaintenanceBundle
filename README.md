# MaintenanceBundle
Symfony Bundle  to place your Symfony website in maintenance mode - [**Default Maintenance Page**] (https://artgris.github.io/MaintenanceBundle/)

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
``` 
 
### 4) Override maintenance.html.twig (optional)

Create your own twig in `app/Resources/ArtgrisMaintenanceBundle/view/maintenance.html.twig`.

Usage
=====

The `dev` and `test` environments were not affected by maintenance.

- Enable|Disable maintenance : `enable: true|false`
- Add authorized IPs to prod : `ips: [127.0.0.1, ...]`


Don't forget to clear and warm the `prod` cache :

    php bin/console cache:clear --env=prod

