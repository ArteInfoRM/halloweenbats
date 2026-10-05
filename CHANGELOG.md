# Changelog

## [1.1.0] - 2026-10-05

### Added

- Add a selectable Vanilla JavaScript animation engine without a jQuery dependency; preserve jQuery for existing installations.
- Load only the selected engine, defer initialization until the DOM is ready, and pass configuration through escaped data attributes.
- Validate engine, jQuery switch, bat count and speed server-side; constrain numeric settings to 1-100 and add matching form controls.
- Translate the engine selector and validation messages in all eight catalogs.

### Translations

- Complete the empty Italian catalog and add English, Spanish, French, German, Polish, European Portuguese, and Romanian catalogs for module and credit strings.
- Localize the vendor link title and normalize whitespace in credit translation sources.

### Fixed

- Add the missing author and copyright tags before the MIT license tag in the documentation and license directory guards, as required by the PrestaShop validator.

## [1.0.3] - 2026-10-05

### Documentation and packaging

- Add security reporting instructions, third-party notices, and a CRA readiness note.
- Inventory bundled assets, CMS dependencies, and the optional jQuery CDN dependency in a CycloneDX 1.5 SBOM held in the internal archive pending a repository visibility decision.
- Normalize `Readme.md` to `README.md`, document configuration and external requests, and generate HTML documentation.
- Align module-owned PHP/template headers with the owner-confirmed MIT license and correct root license transcription errors. Preserve third-party notices and include the AFL-3.0 text referenced by legacy PrestaShop source headers.
- Extend release exclusions for runtime configuration, source artwork, SBOM, and internal evidence; correct Apache access protection.

- Apply short PHP array syntax, align directory guard comments, and protect documentation/license directories.

## [1.0.2] - Release date unknown

Version observed in the module constructor and local `config.xml`. The supplied README also names 1.0.2. The initial source review had no local Git history or historical distribution ZIP; the PHP header originally named 1.0.0. Existing GitHub history and tag v1.0.2 were recovered during release preparation. The historical distribution date and package bytes remain unverified.
