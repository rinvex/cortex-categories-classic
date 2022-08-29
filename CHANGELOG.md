# Cortex Categories Change Log

All notable changes to this project will be documented in this file.

This project adheres to [Semantic Versioning](CONTRIBUTING.md).


## [v6.2.6] - 2022-08-30
- Clean the breadcrumbs definition and utilize parent features

## [v6.2.5] - 2022-07-24
- Fix datatables checkbox select-row options
- Fix audit ability check for import logs
- Add missing export ability

## [v6.2.4] - 2022-06-22
- Fix datatables ajax method signature

## [v6.2.3] - 2022-06-20
- Update composer dependencies
  - league/fractal to ^0.20.0 from ^0.19.0
  - yajra/laravel-datatables-html to ^9.0.0 from ^4.41.0
  - yajra/laravel-datatables-fractal to ^9.0.0 from ^1.6.0
  - yajra/laravel-datatables-buttons to ^9.0.0 from ^4.13.0
  - yajra/laravel-datatables-oracle to ^10.0.0 from ^9.19.0

## [v6.2.2] - 2022-05-17
- Add support for menu list item attributes

## [v6.2.1] - 2022-03-12
- WIP Refactor & Simplify datatables import functionality
- Update composer dependency codedungeon/phpunit-result-printer
- Enforce form actions routePrefix consistency
- Add datatables routePrefix support

## [v6.2.0] - 2022-02-14
- Update composer dependencies to Laravel v9
- Move Relation::morphMap to module bootstrap
- Fix broadcasts naming convensions
- Update routes to use class based definitions

## [v6.1.2] - 2021-10-22
- Refactor route domain variables to be accessarea specific
- Update .styleci.yml fixers

## [v6.1.1] - 2021-10-11
- Rename route parameter 'central_domain' to 'routeDomain'

## [v6.1.0] - 2021-08-22
- Drop PHP v7 support, and upgrade rinvex package dependencies to next major version

## [v6.0.0] - 2021-08-18
- Update composer dependency cortex/foundation to v7

## [v5.0.17] - 2021-08-18
- Register routes to either central or tenant domains
- Move route binding, patterns, and middleware to module bootstrap

## [v5.0.16] - 2021-08-07
- Upgrade spatie/laravel-activitylog to v4

## [v5.0.15] - 2021-08-06
- Simplify route prefixes
- Update composer dependencies

## [v5.0.14] - 2021-05-25
- Replace deprecated `Breadcrumbs::register` with `Breadcrumbs::for`
- Update composer dependencies diglactic/laravel-breadcrumbs to v7

## [v5.0.13] - 2021-05-24
- Fix datatables export issues
- Drop common blade views in favor for accessarea specific views

## [v5.0.12] - 2021-05-11
- Fix constructor initialization order (fill attributes should come next after merging fillables & rules)

## [v5.0.11] - 2021-05-07
- Rename migrations to always run after rinvex core packages
- Upgrade to GitHub-native Dependabot

## [v5.0.10] - 2021-03-02
- Autoload artisan commands

## [v5.0.9] - 2021-02-28
- Use overridden `FormRequest` instead of native class
- Utilize IoC service container instead of hardcoded models for menu permissions
- Use `request->input()` instead of `request->get()`

## [v5.0.8] - 2021-02-11
- Replace form timestamps with common blade view

## [v5.0.7] - 2021-02-07
- Remove indirect composer dependency

## [v5.0.6] - 2021-02-06
- Add support for runtime configurable model to allow model override (fix abilities/permission issues)
- Skip publishing module resources unless explicitly specified, for simplicity

## [v5.0.5] - 2021-01-15
Add model replication feature
Remove duplicate `setTable` method call override as it's already called in parent class
allow admin to select category parent

## [v5.0.4] - 2021-01-02
- Move cortex:autoload & cortex:activate commands to cortex/foundation module responsibility

## [v5.0.3] - 2021-01-01
- Move cortex:autoload & cortex:activate commands to cortex/foundation module responsibility- Move cortex:autoload & cortex:activate commands to cortex/foundation module responsibility
    - This is because :autoload & :activate commands are registered only if the module already autoloaded, so there is no way we can execute commands of unloaded modules
    - cortex/foundation module is always autoloaded, so it's the logical and reasonable place to register these :autoload & :activate module commands and control other modules from outside

## [v5.0.2] - 2020-12-31
- Rename seeders directory
- Enable StyleCI risky mode
- Add module activate, deactivate, autoload, unload artisan commands

## [v5.0.1] - 2020-12-25
- Add support for PHP v8

## [v5.0.0] - 2020-12-22
- Upgrade to Laravel v8

## [v4.3.2] - 2020-12-11
- Move custom eloquent model events to module layer from core package layer
- Rename broadcast channels file to avoid accessarea naming
- Rename routes, channels, menus, breadcrumbs, datatable & form IDs to follow same modular naming conventions
- Tweak datatables realtime
- Move Eloquent Events to core package responsibility
- Enforce consistent datatables request object usage
- Override datatable ajax method to adjust custom order column: 'name'

## [v4.3.1] - 2020-08-25
- Enforce controller API consistency
- Activate module after installation

## [v4.3.0] - 2020-07-16
- Utilize timezones
- Use app('request.user') instead of $currentUser

## [v4.2.2] - 2020-06-20
- Add macroable support for Tag model

## [v4.2.1] - 2020-06-19
- Update composer dependencies
- Stick to composer version constraints recommendations and ease minimum required version of modules

## [v4.2.0] - 2020-06-15
- Autoload config, views, language, menus, breadcrumbs, and migrations
    - This is now done automatically through cortex/foundation, so no need to manually wire it here anymore
- Merge additional fillable, casts, and rules instead of overriding
- Drop PHP 7.2 & 7.3 support from travis

## [v4.1.1] - 2020-05-30
- Update composer dependencies

## [v4.1.0] - 2020-05-30
- With the significance of recent updates, new minor release required

## [v4.0.8] - 2020-05-30
- Add datatables checkbox column for bulk actions
- Use getRouteKey() attribute for all redirect identifiers
- Drop using strip_tags on redirect identifiers as they will use ->getRouteKey() which is already safe
- Add support for datatable listing get and post requests
- Refactor model CRUD dispatched events
- Remove useless "DT_RowId" fielld from transformers
- Register channel broadcasting routes
- Fire custom model events from CRUD actions
- Rename datatables container names
- Load module routes automatically
- Strip tags breadcrumbs of potential user inputs
- Strip tags of language phrase parameters with potential user inputs
- Escape language phrases
- Update model validation rules
- Add strip_tags validation rule to string fields
- Remove default indent size config
- Fix compatibility with recent rinvex/laravel-menus package update

## [v4.0.7] - 2020-04-12
- Fix ServiceProvider registerCommands method compatibility

## [v4.0.6] - 2020-04-09
- Tweak artisan command registration
- Add missing config publishing command
- Refactor publish command and allow multiple resource values

## [v4.0.5] - 2020-04-04
- Enforce consistent artisan command tag namespacing
- Enforce consistent package namespace
- Drop laravel/helpers usage as it's no longer used
- Upgrade silber/bouncer composer package

## [v4.0.4] - 2020-03-20
- Add shortcut -f (force) for artisan publish commands
- Fix migrations path condition
- Convert database int fields into bigInteger
- Upgrade spatie/laravel-medialibrary to v8.x
- Fix couple issues and enforce consistency

## [v4.0.3] - 2020-03-16
- Update proengsoft/laravel-jsvalidation composer package

## [v4.0.2] - 2020-03-15
- Fix incompatible package version league/fractal

## [v4.0.1] - 2020-03-15
- Fix wrong package version laravelcollective/html

## [v4.0.0] - 2020-03-15
- Upgrade to Laravel v7.1.x & PHP v7.4.x

## [v3.0.5] - 2020-03-13
- Tweak TravisCI config
- Add migrations autoload option to the package
- Tweak service provider `publishesResources` & `autoloadMigrations`
- Update StyleCI config
- Check if ability exists before seeding

## [v3.0.4] - 2019-12-18
- Add DT_RowId field to datatables
- Fix route regex pattern to include underscores
    - This way it's compatible with validation rule `alpha_dash`
- Fix `migrate:reset` args as it doesn't accept --step

## [v3.0.3] - 2019-10-14
- Update menus & breadcrumbs event listener to accessarea.ready
- Fix wrong dependencies letter case

## [v3.0.2] - 2019-10-06
- Refactor menus and breadcrumb bindings to utilize event dispatcher

## [v3.0.1] - 2019-09-23
- Fix outdated package version

## [v3.0.0] - 2019-09-23
- Upgrade to Laravel v6 and update dependencies

## [v2.2.1] - 2019-08-03
- Tweak menus & breadcrumbs performance

## [v2.2.0] - 2019-08-03
- Upgrade composer dependencies

## [v2.1.3] - 2019-06-03
- Enforce latest composer package versions

## [v2.1.2] - 2019-06-03
- Update publish commands to support both packages and modules natively

## [v2.1.1] - 2019-06-02
- Fix yajra/laravel-datatables-fractal and league/fractal compatibility

## [v2.1.0] - 2019-06-02
- Update composer deps
- Drop PHP 7.1 travis test
- Refactor migrations and artisan commands, and tweak service provider publishes functionality

## [v2.0.0] - 2019-03-03
- Require PHP 7.2 & Laravel 5.8
- Utilize includeWhen blade directive
- Refactor abilities seeding

## [v1.0.3] - 2019-01-04
- Remove useless migration, this is confusing (why we introduced this migration at first place?!)
    - 75944d928478cb8a02d9ec62dd8da046c411e5c5
    - 7693524076ac1164bc60bfd1d719a0ed2593d3ae

## [v1.0.2] - 2019-01-03
- Rename environment variable QUEUE_DRIVER to QUEUE_CONNECTION
- Simplify and flatten create & edit form controller actions
- Tweak and simplify FormRequest validations
- Enable tinymce on all description and text area fields

## [v1.0.1] - 2018-12-22
- Update composer dependencies
- Add PHP 7.3 support to travis

## [v1.0.0] - 2018-10-01
- Support Laravel v5.7, bump versions and enforce consistency

## [v0.0.2] - 2018-09-22
- Too much changes to list here!!

## v0.0.1 - 2017-09-09
- Tag first release

[v6.2.6]: https://github.com/rinvex/cortex-categories/compare/v6.2.5...v6.2.6
[v6.2.5]: https://github.com/rinvex/cortex-categories/compare/v6.2.4...v6.2.5
[v6.2.4]: https://github.com/rinvex/cortex-categories/compare/v6.2.3...v6.2.4
[v6.2.3]: https://github.com/rinvex/cortex-categories/compare/v6.2.2...v6.2.3
[v6.2.2]: https://github.com/rinvex/cortex-categories/compare/v6.2.1...v6.2.2
[v6.2.1]: https://github.com/rinvex/cortex-categories/compare/v6.2.0...v6.2.1
[v6.2.0]: https://github.com/rinvex/cortex-categories/compare/v6.1.2...v6.2.0
[v6.1.2]: https://github.com/rinvex/cortex-categories/compare/v6.1.1...v6.1.2
[v6.1.1]: https://github.com/rinvex/cortex-categories/compare/v6.1.0...v6.1.1
[v6.1.0]: https://github.com/rinvex/cortex-categories/compare/v6.0.0...v6.1.0
[v6.0.0]: https://github.com/rinvex/cortex-categories/compare/v5.0.17...v6.0.0
[v5.0.17]: https://github.com/rinvex/cortex-categories/compare/v5.0.16...v5.0.17
[v5.0.16]: https://github.com/rinvex/cortex-categories/compare/v5.0.15...v5.0.16
[v5.0.15]: https://github.com/rinvex/cortex-categories/compare/v5.0.14...v5.0.15
[v5.0.14]: https://github.com/rinvex/cortex-categories/compare/v5.0.13...v5.0.14
[v5.0.13]: https://github.com/rinvex/cortex-categories/compare/v5.0.12...v5.0.13
[v5.0.12]: https://github.com/rinvex/cortex-categories/compare/v5.0.11...v5.0.12
[v5.0.11]: https://github.com/rinvex/cortex-categories/compare/v5.0.10...v5.0.11
[v5.0.10]: https://github.com/rinvex/cortex-categories/compare/v5.0.9...v5.0.10
[v5.0.9]: https://github.com/rinvex/cortex-categories/compare/v5.0.8...v5.0.9
[v5.0.8]: https://github.com/rinvex/cortex-categories/compare/v5.0.7...v5.0.8
[v5.0.7]: https://github.com/rinvex/cortex-categories/compare/v5.0.6...v5.0.7
[v5.0.6]: https://github.com/rinvex/cortex-categories/compare/v5.0.5...v5.0.6
[v5.0.5]: https://github.com/rinvex/cortex-categories/compare/v5.0.4...v5.0.5
[v5.0.4]: https://github.com/rinvex/cortex-categories/compare/v5.0.3...v5.0.4
[v5.0.3]: https://github.com/rinvex/cortex-categories/compare/v5.0.2...v5.0.3
[v5.0.2]: https://github.com/rinvex/cortex-categories/compare/v5.0.1...v5.0.2
[v5.0.1]: https://github.com/rinvex/cortex-categories/compare/v5.0.0...v5.0.1
[v5.0.0]: https://github.com/rinvex/cortex-categories/compare/v4.3.2...v5.0.0
[v4.3.2]: https://github.com/rinvex/cortex-categories/compare/v4.3.1...v4.3.2
[v4.3.1]: https://github.com/rinvex/cortex-categories/compare/v4.3.0...v4.3.1
[v4.3.0]: https://github.com/rinvex/cortex-categories/compare/v4.2.2...v4.3.0
[v4.2.2]: https://github.com/rinvex/cortex-categories/compare/v4.2.1...v4.2.2
[v4.2.1]: https://github.com/rinvex/cortex-categories/compare/v4.2.0...v4.2.1
[v4.2.0]: https://github.com/rinvex/cortex-categories/compare/v4.1.1...v4.2.0
[v4.1.1]: https://github.com/rinvex/cortex-categories/compare/v4.1.0...v4.1.1
[v4.1.0]: https://github.com/rinvex/cortex-categories/compare/v4.0.8...v4.1.0
[v4.0.8]: https://github.com/rinvex/cortex-categories/compare/v4.0.7...v4.0.8
[v4.0.7]: https://github.com/rinvex/cortex-categories/compare/v4.0.6...v4.0.7
[v4.0.6]: https://github.com/rinvex/cortex-categories/compare/v4.0.5...v4.0.6
[v4.0.5]: https://github.com/rinvex/cortex-categories/compare/v4.0.4...v4.0.5
[v4.0.4]: https://github.com/rinvex/cortex-categories/compare/v4.0.3...v4.0.4
[v4.0.3]: https://github.com/rinvex/cortex-categories/compare/v4.0.2...v4.0.3
[v4.0.2]: https://github.com/rinvex/cortex-categories/compare/v4.0.1...v4.0.2
[v4.0.1]: https://github.com/rinvex/cortex-categories/compare/v4.0.0...v4.0.1
[v4.0.0]: https://github.com/rinvex/cortex-categories/compare/v3.0.5...v4.0.0
[v3.0.5]: https://github.com/rinvex/cortex-categories/compare/v3.0.4...v3.0.5
[v3.0.4]: https://github.com/rinvex/cortex-categories/compare/v3.0.3...v3.0.4
[v3.0.3]: https://github.com/rinvex/cortex-categories/compare/v3.0.2...v3.0.3
[v3.0.2]: https://github.com/rinvex/cortex-categories/compare/v3.0.1...v3.0.2
[v3.0.1]: https://github.com/rinvex/cortex-categories/compare/v3.0.0...v3.0.1
[v3.0.0]: https://github.com/rinvex/cortex-categories/compare/v2.2.1...v3.0.0
[v2.2.1]: https://github.com/rinvex/cortex-categories/compare/v2.2.0...v2.2.1
[v2.2.0]: https://github.com/rinvex/cortex-categories/compare/v2.1.2...v2.2.0
[v2.1.2]: https://github.com/rinvex/cortex-categories/compare/v2.1.1...v2.1.2
[v2.1.1]: https://github.com/rinvex/cortex-categories/compare/v2.1.0...v2.1.1
[v2.1.0]: https://github.com/rinvex/cortex-categories/compare/v2.0.0...v2.1.0
[v2.0.0]: https://github.com/rinvex/cortex-categories/compare/v1.0.3...v2.0.0
[v1.0.3]: https://github.com/rinvex/cortex-categories/compare/v1.0.2...v1.0.3
[v1.0.2]: https://github.com/rinvex/cortex-categories/compare/v1.0.1...v1.0.2
[v1.0.1]: https://github.com/rinvex/cortex-categories/compare/v1.0.0...v1.0.1
[v1.0.0]: https://github.com/rinvex/cortex-categories/compare/v0.0.2...v1.0.0
[v0.0.2]: https://github.com/rinvex/cortex-categories/compare/v0.0.1...v0.0.2
