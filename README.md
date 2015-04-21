# Recipe Hero

* **Contributors:** captaintheme, recipehero, bryceadams
* **Donate link:** http://recipehero.in/
* **Tags:** recipe, recipes, cooking, ingredients, food, cook, cook book, recipe hero, captain theme, google recipes
* **Requires at least:** 3.8.0
* **Tested up to:** 4.1.0
* **Stable tag:** 1.0.12
* **License:** GPLv2 or later
* **License URI:** http://www.gnu.org/licenses/gpl-2.0.html

Recipe Hero is the easiest way to add recipes to your WordPress site in seconds. Complete with countless features, food never tasted better.

## Description

It shouldn't be difficult to add a recipe to your WordPress site.

Recipe Hero adds a new custom post type, **recipe**, to your website. Adding a recipe is just like adding a post. You can add everything from the recipe's yield to the equipment needed, the cooking time to the ingredients - everything will be automatically formatted for Google Rich Snippets and Pinterest Rich Pins.

* **Docs @ [Recipe Hero HQ](http://recipehero.in/docs/)**
* **Extensions @ [Recipe Hero Extensions](http://recipehero.in/extensions/)**

Navigate to `http://yourwebsite.com/recipes` to see all the new recipes you've added. You can easily customise the CSS to your liking and make it look perfect. It's automatically set-up to be responsive, clean & beautiful.

> #### Recipe Hero Extensions
> Just incase you're looking to get a little bit more out of Recipe Hero, there are a several extensions available, both free and premium:<br />
>
> - [Recipe Hero Labels](https://wordpress.org/plugins/recipe-hero-labels/)<br />
> - [Recipe Hero Print](http://recipehero.in/extensions/print/)<br />
> - [Recipe Hero Video](http://recipehero.in/extensions/video/)<br />
> - [Recipe Hero Likes](http://recipehero.in/extensions/likes/)<br />
> - [Recipe Hero Submit](http://recipehero.in/extensions/submit/)<br />
>
> [See more about Recipe Hero, extensions and what it's capable of!](http://recipehero.in/)

#### Some Features
* Custom Post Type for 'Recipes'
* Recipe Details, Ingredients & Instructions
* Instruction Images
* Recipe Reviews / Ratings
* Completely Responsive
* Settings Panel
* Intuitive Admin / Editing Experience
* Templating Engine for easy customization (anything can be edited!)
* Display with easy [recipe] & [recipes] shortcodes
* Valid schema.org Markup - Works with Google Rich Snippets etc. (SEO Optimized)
* Ingredients checkboxes (users can check off ingredients as they use them)
* Inherits Your Theme's Styles Automatically
* Image Lightbox
* Recipe Gallery
* Custom Ordering (sorting and in option)
* Can Extend / Develop with custom actions, settings, etc.
* Completely Open Source GPL Project - see [GitHub](https://github.com/bryceadams/Recipe-Hero) to contribute!
* Translation-Ready (includes .pot file etc.)
* Documentation
* Lovingly Supported

**Contributing:** Why not help out? This project is being actively developed [on GitHub](https://github.com/bryceadams/Recipe-Hero/). Feel free to report issues, help others and make pull requests!

**Translations:** If you translate Recipe Hero, please [send me your translation](mailto:info@recipehero.in) so I can add it to the plugin for others to use. Here is a guide to [translating the plugin](http://recipehero.in/docs/translating-recipe-hero/) to help you out!

**Roadmap:** I’d love for you to get involved in the future of Recipe Hero. Please come visit the [Recipe Hero Trello Roadmap](https://trello.com/b/Qv3owrP0/recipe-hero-roadmap)

## Installation

#### Using The WordPress Dashboard

1. Navigate to the 'Add New' in the plugins dashboard
2. Search for 'Recipe Hero'
3. Click 'Install Now'
4. Activate the plugin on the Plugin dashboard

#### Uploading in WordPress Dashboard

1. Navigate to the 'Add New' in the plugins dashboard
2. Navigate to the 'Upload' area
3. Select `recipe-hero.zip` from your computer
4. Click 'Install Now'
5. Activate the plugin in the Plugin dashboard

#### Using FTP

1. Download `recipe-hero.zip`
2. Extract the `recipe-hero` directory to your computer
3. Upload the `recipe-hero` directory to the `/wp-content/plugins/` directory
4. Activate the plugin in the Plugin dashboard

## Usage

After creating your first recipe, you'll normally be able to go to: `http://yourwebsite.com/recipes/` to view an archive of all your recipes.

You can also visit **Recipe Hero > Settings** and choose a Recipe Page. This will turn the chosen page (created through **Pages > Add New**) into a recipe archive, showing all of your recipes. This is useful for then making that page your home page (in **Settings > Reading**).

There are also 2 shortcodes included with Recipe Hero:

* `[recipes]` - displays multiple recipes (see docs below)
* `[recipe]` - displays single recipe (see docs below)

**For more about displaying recipes, check out our [Displaying Recipes](http://recipehero.in/docs/displaying-recipes/) documentation.**

## Frequently Asked Questions

#### I keep getting 404 Page Not Found errors when trying to view the recipes I've added!

You need to re-save your permalinks first! Navigate to `http://yourwebsite.com/wp-admin/options-permalink.php` and re-save your permalink settings.

#### How do I remove the default Recipe Hero styling?

Easy! Just add the code in the following gist to your theme's functions.php file: [Remove Styles Gist](https://gist.github.com/bryceadams/22439ae2efd3433ca29a)

#### How can I translate the plugin?

Just like you would translate any other plugin or theme! I've written [some documentation over here](http://captaintheme.com/docs/general/translating-a-theme-or-plugin/) that will help you get started.

Please feel free to [send me your translation](mailto:info@recipehero.in) afterwards so I can share it with other users, making Recipe Hero more accessible to everyone.

#### Will Google recognise my recipes and show them like the other recipes in Google?

Sure, but on food-steroids. Just check out the screenshots area.

#### How can I thank you?

[Send me your most precious family recipe!](mailto:info@recipehero.in)

## Screenshots

1. Single Recipe
2. Single Recipe #2
3. Single Recipe #3
4. Single Recipe - Gallery
5. Edit Recipe
6. Recipes Admin
7. Recipe Hero Settings
8. Google Rich Snippets Preview

## Changelog 

= 1.0.12 =
* Small security fix (only exploitable by admins though)

= 1.0.11 =
* Add 'pinch' ingredient amount

= 1.0.10 =
* Add 'scoop' ingredient amount
* Finally (hopefully) fixed a bug with fractions for amounts

= 1.0.9 =
* Conflict with WooCommerce + Permalinks - #bryceisstupid

= 1.0.8 =
* Enhancement: Frontend CSS file renaming
* Dev: Filters for post types and tax args
* Bug Fix: Fix gallery thumbnail sizing
* Bug Fix: Featured image width link fix
* Bug Fix: Better margins for featured image
* Bug Fix: Vertically aligned ingredients
* Bug Fix: Point Theme compatible styles
* Bug Fix: Add back 'Discussion' meta box
* Template Change: global/wrapper-start.php
* Template Change: global/wrapper-end.php

= 1.0.7 =
* Bug Fix: Update Settings Link
* Bug Fix: Custom fields not working in PHP 5.2 but now fixed.

= 1.0.6 =
* Bug Fix: More query errors - should be fixed (sorry!)

= 1.0.5 =
* Bug Fix: Add lightbox gallery class to featured image regardless of gallery
* Bug Fix: Storefront compatible styles
* Bug Fix: Twenty Fifteen (2015) compatible styles
* Template Change: single/photo.php
* Template Change: global/wrapper-start.php
* Template Change: global/wrapper-end.php
* Template Change: single-recipe-reviews.php
* RH: Notice that shows after a while asking you to maybe review the plugin - please do! :)

= 1.0.4 =
* Bug Fix: Fix 404s & other errors due to custom queries

= 1.0.3 =
* Bug Fix: Reviews link / summary on archives
* Bug Fix: Include recipe_hero_enable_review_rating option in uninstall.php
* Bug Fix: RH_Query class missing a public var - added it!
* Bug Fix: Ingredients undefined index error
* Template Change: single/ingredients.php
* Template Change: review.php / rating.php / single-recipe-reviews.php

= 1.0.2 =
* New: Recipe Reviews / Ratings
* New: Rating schema.org markup
* Bug Fix: 'Servings type' setting field made a bit bigger
* Bug Fix: Ingredients list style fixes
* Bug Fix: Template Engine improvements
* Bug Fix: Extension Page Styling
* Bug Fix: Shortcode style / comment fixes
* i18n: Couple translation fixes and .pot files used now

= 1.0.1 =
* New: Ingredients layout
* New: Ingredients checkboxes and strikethroughs
* Template Change: single/ingredients.php
* Bug Fix: Translation file searching
* Bug Fix: Ingredients plural translations (again)
* Bug Fix: Remove old settings global variables
* Bug Fix: Update Settings Link
* Bug Fix: Use WP_INSTALL_PLUGIN check in uninstall.php
* Bug Fix: Translation fixes for hours / minutes abbreviations

= 1.0.0 =
* New: Refactored entire core plugin structure / code
* New: Recipe Gallery
* New: Custom Ordering (sorting and in option)
* New: Settings redone - extendable / simpler
* New: 'Custom Labels' moved to free Recipe Hero Labels extension (http://wordpress.org/plugins/recipe-hero-labels)
* New: Updated CMB framework
* New: Lightbox for shortcodes
* New: More image sizes / options
* New: Recipe Template file updates
* New: Pagination
* New: No Recipes Found template file
* New: Only use /recipes/ for archive when no Recipe Page has been set (one or the other - highly requested and better for SEO too)
* New: Custom Permalinks Base
* New: Custom Cuisine / Course Slugs
* i18n: Translation Files fixed / standardised
* Bug Fix: If time <1 hour, don't show 0h
* Bug Fix: Ingredient Plurals (and translations)
* Bug Fix: Hide ingredients title if no ingredients
* Bug Fix: Remove [recipe] shortcode from Jetpack (when active)
* Bug Fix: Remove 'save permalinks' notice and just rewrite / flush rules

= 0.9.0 =
* New: Autocomplete Ingredients when adding in Edit screen
* New: Ingredients Column in Recipes Edit Screen
* New: Custom Image Sizes in Settings
* New: Instructions Image Size
* New: Chosen jQuery Select Included for Admin
* New: Cuisine & Course Custom Labels
* New: Uninstall.php File with New 'Delete Options' Setting
* Bug Fix: Lightbox Option Handling
* Bug Fix: More if ( ! function_exists ) wrappers
* Bug Fix: Plugins Page Settings Link
* Bug Fix: Entire File Re-Structuring

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

## Updates

They'll come automatically through the WordPress dashboard - just relax and cook.
