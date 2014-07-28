=== Recipe Hero ===
Contributors: captaintheme, recipehero,
Donate link: http://recipehero.in/
Tags: recipe, recipes, cooking, ingredients, food, cook, cook book, recipe hero, captain theme, google recipes
Requires at least: 3.5.1
Tested up to: 3.9.1
Stable tag: 0.8.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Recipe Hero is the easiest way to add recipes to your WordPress site in seconds. Complete with countless features, food never tasted better.

== Description ==

It shouldn't be difficult to add a recipe to your WordPress site.

Recipe Hero adds a new custom post type, **recipe**, to your website. Adding a recipe is just like adding a post. You can add everything from the recipe's yield to the equipment needed, the cooking time to the ingredients - everything will be automatically formatted for Google Rich Snippets.

* **Support / Docs @ [Recipe Hero HQ](http://recipehero.in/)**
* **Want to try it out?** [Recipe Hero Demo](http://try.recipehero.in/)

Navigate to `http://yourwebsite.com/recipes` to see all the new recipes you've added. You can easily customise the CSS to your liking and make it look perfect. It's automatically set-up to be responsive, clean & beautiful.

* Custom Post Type for 'Recipes'
* Recipe Details, Ingredients & Instructions
* Completely responsive
* Plenty of Options
* Templating Engine for easy customization (anything can be edited)
* Display with easy [recipe] & [recipes] shortcodes
* Valid schema.org Markup - Works with Google Rich Snippets etc. (SEO Optimized)
* Inherits Your Theme's Styles Automatically
* Image Lightbox
* Can Extend / Develop with custom actions, etc.
* Completely Open Source GPL Project - see [GitHub](https://github.com/bryceadams/Recipe-Hero) to contribute!
* Translation-Ready (includes .pot file etc.)
* Documentation (coming soon!)
* Supported

**Contributing:** Why not help out? This project is being actively developed [on GitHub](https://github.com/bryceadams/Recipe-Hero/). Feel free to report issues, help others and make pull requests!

**Translations:** If you translate Recipe Hero, please [send me your translation](mailto:info@recipehero.in) so I can add it to the plugin for others to use. Here is a guide to [translating the plugin](captaintheme.com/docs/general/translating-a-theme-or-plugin/) to help you out! The following translations are available:

* Chezch (cs_CZ)
* Korean (ko_KR)

== Installation ==

= Using The WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Search for 'Recipe Hero'
3. Click 'Install Now'
4. Activate the plugin on the Plugin dashboard

= Uploading in WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Navigate to the 'Upload' area
3. Select `recipe-hero.zip` from your computer
4. Click 'Install Now'
5. Activate the plugin in the Plugin dashboard

= Using FTP =

1. Download `recipe-hero.zip`
2. Extract the `recipe-hero` directory to your computer
3. Upload the `recipe-hero` directory to the `/wp-content/plugins/` directory
4. Activate the plugin in the Plugin dashboard

= RE-SAVE YOUR PERMALINKS! =

It's **essential** that you re-save your permalinks after installing and activating Recipe Hero. Simply go to **Settings > Permalinks** and re-save the settings you currently have (for best results switch to **post name**).

== Usage ==

After creating your first recipe, you'll normally be able to go to: `http://yourwebsite.com/recipes/` to view an archive of all your recipes.

You can also visit **Recipe Hero > Settings > General Options** and choose a Recipe Page. This will turn the chosen page (created through **Pages > Add New**) into a recipe archive, showing all of your recipes. This is useful for then making that page your home page (in **Settings > Reading**).

There are also 2 shortcodes included with Recipe Hero:

* `[recipes]` - displays multiple recipes (see docs below)
* `[recipe]` - displays single recipe (see docs below)

**For more about displaying recipes, check out our [Displaying Recipes](http://recipehero.in/docs/displaying-recipes/) documentation.**

== Frequently Asked Questions ==

= I keep getting 404 Page Not Found errors when trying to view the recipes I've added! =

You need to re-save your permalinks first! Navigate to `http://yourwebsite.com/wp-admin/options-permalink.php` and re-save your permalink settings.

= How do I remove the default Recipe Hero styling? =

Easy! Just add the code in the following gist to your theme's functions.php file: [Remove Styles Gist](https://gist.github.com/bryceadams/22439ae2efd3433ca29a)

= How can I translate the plugin? =

Just like you would translate any other plugin or theme! I've written [some documentation over here](http://captaintheme.com/docs/general/translating-a-theme-or-plugin/) that will help you get started.

Please feel free to [send me your translation](mailto:info@recipehero.in) afterwards so I can share it with other users, making Recipe Hero more accessible to everyone.

= Will Google recognise my recipes and show them like the other recipes in Google? =

Sure, but on food-steroids. Just check out the screenshots area.

= How can I thank you? =

[Send me your most precious family recipe!](mailto:info@recipehero.in)

== Screenshots ==

1. Single Recipe
2. Single Recipe #2
3. Single Recipe #3
4. Google Rich Snippets Preview
5. Recipe Hero Settings #1
6. Recipe Hero Settings #2
7. Recipe Hero Settings #3

== Changelog ==

= 0.9.0 =
* New: Autocomplete Ingredients when adding in Edit screen
* New: Ingredients Column in Recipes Edit Screen
* New: Custom Image Sizes in Settings
* New: Instructions Image Size
* New: Chosen jQuery Select Included for Admin
* New: Cuisine & Course Custom Labels
* Bug Fix: Lightbox Option Handling

= 0.8.1 =
* Bug Fix: Ingredients Amount Display

= 0.8.0 =
* **NOTE:** Major Update - you will lose your Recipe Hero Settings (NOT YOUR  RECIPES THOUGH - Don't Worry!)
* Reworked Termplating System for Single / Archive Template Content
* Switch to WordPress Settings API & Redesigned Settings
* Bug Fix: global wrapper start undefined variable
* Bux Fix: Instructions part
* Better Security Measures with disallowing direct file access
* Sanitize recipe fields
* More formatting improvements
* Added Chezch Translation (Thanks http://www.kvaskovani.cz/)
* Added Korean Translation (Thanks Younwoo!)

= 0.7.1 =
* 2 New Shortcodes - [recipe] & [recipes]
* Remove hr in-between archive.php recipes
* Added courses/cuisines taxonomy sorting/details to Recipes Admin
* Added Thumbnail to Recipes Admin
* Added Help Tab for Admin
* Remove Sidebar / Full-Width Option
* Remove 'Disable Styles' Option (you can do this via a Filter)
* Major Styles Overhall
* Fixed search-results.php page style
* Added search-results.php search text
* Improved Sanitization

= 0.7.0 =
* Recipe 'Home Page'
* Styling: Choose Recipe Padding (px)
* Huge Improvements to Style / Templating
* Taxonomy Title + Information Header for archive.php
* Support for JetPack Publicize Sharing Buttons
* Added lots of if function exists wrappers to allow for better extension development

= 0.6.7 =
* Fix: Sidebar Templating + Options

= 0.6.6 =
* Style Fix for Twenty Fourteen Theme

= 0.6.5 =
* Major Styling Improvements
* Layout Improvements
* Sidebar / Full Width Layout Option

= 0.6.0 =
* Various Improvements
* Fix schema.org mark-up
* Added Lightbox
* System for removing default styles with filter, etc.

= 0.5.0 =
* Initial BETA Release

== Updates ==

They'll come automatically through the WordPress dashboard - just relax and cook.