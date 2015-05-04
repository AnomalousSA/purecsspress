Pure.css Press
=================

## Pure.css WordPress starter theme

Version: 1

## How to use

Here is a example of using the pure nav walker to create menu (Special thanks to [Tomoro - Simeon Griggs](http://tomoro.com.au/) for creating the Pure.css Walker)

```
<div class="pure-menu pure-menu-horizontal">
    <a href="<?php echo home_url('/'); ?>" class="pure-menu-heading pure-menu-link"><?php wp_title(); ?></a>
    <?php
    wp_nav_menu(array(
        'menu' => 'main-menu',
        'theme_location' => 'main-menu',
        'depth' => 2,
        'container' => false,
        //'container_class'   => 'pure-menu pure-menu-horizontal',
        //'container_id'      => 'bs-example-navbar-collapse-1',
        'menu_class' => 'pure-menu-list',
        'fallback_cb' => 'pure_menu_walker::fallback',
        'walker' => new pure_menu_walker())
    );
    ?>
</div>    
```
I exclude the container as I wanted to put in the home link.

## Author:

Donovan Maidens ( [@Anomalous_Bot](http://twitter.com/Anomalous_Bot) / [anomalous.co.za](http://anomalous.co.za) )

## Summary

WordPress starter theme based on Purecss (0.6), it also has Fontawesome (3.3.0) installed.
This is a base theme, and should be used by a developer.
It has no pretty templates.

## Also Look at

Pure.css Press short codes (Pure.css) [Pure.css Press short codes theme](https://github.com/djm56/purecsspress-shortcodes)

Monstrosity Wordpress Theme (Bootstrap) [Monstrosity theme](https://github.com/djm56/Monstrosity-Theme)

Monstrosity short codes (Bootstrap) [Monstrosity short codes](https://github.com/djm56/Monstrosity-Shortcodes)


## Acknowledgement


Thanks to [Wordpress Theme Options Framewor](https://github.com/istefan/wpshed-theme-options) for developing a great WordPress theme options page framework.