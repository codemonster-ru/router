# Changelog

All significant changes to this project will be documented in this file.

# Changelog

## [2.1.0] – 2025-10-19

### Added

-   **Controller Factory support** — Router can now use an external factory to create controllers, allowing it to integrate with DI containers (such as Annabel) without a direct dependency.
-   Router::setControllerFactory() and Router::getControllerFactory() methods.
-   Dispatcher now supports passing a Router instance and calling the factory when creating controllers.

### Changed

-   Dispatcher now accepts a Router in its constructor.
-   Controller creation is now flexible and safe.
-   Full backward compatibility has been preserved—if a factory isn't specified, the controller is created using new.

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
