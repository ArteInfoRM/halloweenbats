# Third-party notices

Inventory of the Art Halloween Bats 1.0.3 source reviewed on 2026-10-05 by Tecnoacquisti.com®. No Composer/npm manifests, lockfiles, vendor directory, SDK, or bundled font was found.

## Bundled material

| Component | Version and location | Origin and attribution | License and local modifications |
| --- | --- | --- | --- |
| jQuery Halloween Bats | Unversioned local copy: `views/js/halloween-bats.js` | [Artimon/jquery-halloween-bats](https://github.com/Artimon/jquery-halloween-bats), Pascal Dittrich | MIT; full original notice in `views/js/license.txt`. Local copy uses `$.fn.halloweenBats`, a module image path, target `html`, and z-index 100000. Exact imported upstream revision is unknown; current upstream is not a version identifier for this copy. |
| Bat artwork | `views/img/bats.png`; source `views/img/bats.psd` excluded from future release archives | Same upstream project, copyright (c) 2015 Pascal Dittrich | MIT; both files match upstream bytes checked on the review date. Notice in `views/js/license.txt` covers these assets. |
| Legacy PrestaShop scaffold | Unversioned `index.php` guards throughout the module and `views/css/halloween-bats.css` | PrestaShop SA, copyright 2007-2018 according to preserved file headers; [PrestaShop project](https://github.com/PrestaShop/PrestaShop) | AFL-3.0; full text in `licenses/AFL-3.0.txt`. Exact source revision and modification history are unavailable. Existing headers referring to `LICENSE.txt` are resolved by this notice. |

The JavaScript header names 2025 and `LICENSE.txt`, whereas the preserved original notice names 2015 and is located at `views/js/license.txt`. Both records are retained; no third-party copyright was rewritten.

The remaining logo files carry module/vendor branding; no separate provenance record was supplied. The inventory does not establish ownership or trademark redistribution rights for those files.

## Environment and external dependencies

| Component | Version | Distribution and use | License/source |
| --- | --- | --- | --- |
| PrestaShop, PHP, database, Smarty | Determined by the installed shop; no environment inspected | Host platform, runtime, configuration persistence, and template rendering; not bundled | Respective upstream licenses, distributed with the shop. |
| jQuery supplied by the theme | Installed version unknown | Required browser dependency when the optional CDN switch is off; not bundled | [jQuery](https://jquery.com/), MIT. |
| jQuery from Google Hosted Libraries | 3.6.0 | Optional external browser download at `https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js`; not bundled or locally modified | [jQuery source/license](https://github.com/jquery/jquery/tree/3.6.0), MIT; [hosting documentation](https://developers.google.com/speed/libraries). |

No server-side remote API call was found. The CDN browser request shares connection metadata with its provider. Inventory inclusion does not certify that a dependency is vulnerability-free.

## Module licensing

The owner confirmed MIT for module-owned code on 2026-10-05. The main PHP and module template headers have been aligned with the root `LICENSE`, whose transcription errors were corrected. PrestaShop scaffold headers and the Pascal Dittrich notice remain unchanged; third-party MIT and AFL-3.0 licenses are independent of the module license.
