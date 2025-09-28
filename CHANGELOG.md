# Changelog

All significant changes to this project will be documented in this file.

## [2.0.0] - 2025-09-28

### Changed

-   Raised minimum PHP version to >= 8.2. No public API changes.

## [1.0.0] - 2025-09-26

### Added

-   First release of the `codemonster-ru/router` package.
-   Route support (`get`, `post`, `any`).
-   Handler support: `callable`, `[Controller::class, method]`, `Controller@method`.
-   Minimal `Router`, `Route`, `RouteCollection`, `Dispatcher`.
-   Unit tests (`phpunit`).
-   Documentation (`README.md`).
