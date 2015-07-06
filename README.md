opsone/wordpress-theme-kit
=====

Create empty wordpress theme with minimal developper kit

## Installation

Install composer in your project:

```bash
$ curl -s https://getcomposer.org/installer | php
```

Simply install with composer:

```bash
$ php composer.phar create-project opsone/wordpress-theme-kit path/to/install/
```

## Composer

Use composer for add lib PHP.

Controller
Use a controller for all view Wordpress.
Samples:
index.php -> IndexController.php
single.php -> SingleController.php
page.php -> PageController.php
custom.php -> CustomController.php
...

## Required
Meta-box plugin for create simple meta-box.
Site: http://www.deluxeblogtips.com/meta-box/getting-started

## Optional plugin : Options Framework Theme
Use Options Framework plugin for administer your option theme(file: options.php).
Use of_get_option($id,$default) to return option values.
Site: http://wptheming.com/options-framework-plugin

### Description

This is the adapted theme version of the Options Framework plugin.

The Options Framework makes it easy to include an options panel in any WordPress theme.  It was built so developers can concentrate on making the actual theme rather than spending time creating an options panel from scratch.

#### What options are available to use?

* text
* textarea
* checkbox
* select
* radio
* upload (an image uploader)
* images (use images instead of radio buttons)
* background (a set of options to define a background)
* multicheck
* color (a jquery color picker)
* typography (a set of options to define typography)
* editor
