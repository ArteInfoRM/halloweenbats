# Art Halloween Bats

Art Halloween Bats (`halloweenbats`) by Tecnoacquisti.com® adds animated bats to PrestaShop storefront pages. The source currently identifies itself as version 1.0.3.

## Compatibility

The existing documented compatibility is PrestaShop 1.7.0 through 9.0. The PHP module metadata separately declares a minimum of 1.6 and a maximum equal to the installed PrestaShop version. These declarations have not been changed or reconciled during the documentation review. No compatibility tests were performed in this review. Use a PHP version supported by your installed PrestaShop release; a separate module PHP minimum is not declared.

## Installation and configuration

Install the module through the PrestaShop Module Manager and open Configure. The module registers `displayHeader`; it does not install overrides or custom database tables.

- **Load jQUERY:** disabled by default. When enabled, the browser loads jQuery 3.6.0 from Google Hosted Libraries. Leave it disabled when the theme already supplies a compatible jQuery instance. Verify script ordering and theme compatibility in a staging shop.
- **Bat amount:** default 5. Keep the number low; each bat creates two animation timers and consumes browser resources.
- **Speed:** default 20. Higher values increase movement speed.

Configuration is stored in `HALLOWEEN_JQUERY`, `HALLOWEEN_AMOUNT`, and `HALLOWEEN_SPEED` through PrestaShop Configuration. Check the selected shop context in multistore installations. Disabling the module stops its storefront hook; uninstalling deletes these configuration keys.

## Data and external requests

The module does not implement customer tracking, customer records, custom logs, or server-side API calls. When the optional Google CDN setting is enabled, visitors' browsers contact Google to download jQuery and transmit normal HTTP connection metadata. JavaScript, CSS, and bat images are otherwise served by the shop. Administrative credits contain links to the vendor website.

## Updates and recovery

Back up shop files and the database before installing an update, and test it on a staging copy first. Obtain a compatible package through the original module delivery channel. If animation causes display or performance problems, disable the module from Module Manager. A source-directory review is not an installation or upgrade test of a release ZIP.

## Security and notices

Report suspected vulnerabilities privately as described in [SECURITY.md](SECURITY.md). See [THIRD-PARTY-NOTICES.md](THIRD-PARTY-NOTICES.md) for bundled and external dependencies and [CRA.md](CRA.md) for the scope of the readiness documentation.

The module-owned code is distributed under the [MIT License](LICENSE), confirmed by the owner on 2026-10-05. Third-party MIT and AFL-3.0 components retain their own licenses and attributions; see [THIRD-PARTY-NOTICES.md](THIRD-PARTY-NOTICES.md).

Support: [helpdesk@tecnoacquisti.com](mailto:helpdesk@tecnoacquisti.com). [Help center](https://help.tecnoacquisti.com/).
