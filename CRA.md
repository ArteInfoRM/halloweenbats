# CRA readiness note

Art Halloween Bats (`halloweenbats`), source version 1.1.0, reviewed on 2026-10-05 by Tecnoacquisti.com® (Arte e Informatica di Loris Modena e C. s.a.s.).

This note records a documentation and inventory review. It is not an EU Cyber Resilience Act declaration of conformity or a completed product conformity assessment.

## Product scope

The module adds decorative storefront animations through `displayHeader`, with administrative settings for animation engine, jQuery loading, bat count, and speed. It stores four configuration values in the shop database. No custom customer storage, authentication service, payment processing, or security filtering function is implemented. The selectable Vanilla engine has no jQuery dependency. Optional CDN loading in jQuery mode creates a third-party browser request.

Existing compatibility declarations are preserved and documented in [README.md](README.md). [SECURITY.md](SECURITY.md) provides the private reporting channel; [THIRD-PARTY-NOTICES.md](THIRD-PARTY-NOTICES.md) distinguishes included material from environment and external dependencies.

## Evidence and limitations

A CycloneDX 1.5 inventory, original source snapshot, hashes, risk register, verification results, and an assessment manifest are held in the restricted local internal archive, outside the module. The SBOM is not published with these documents; future repository inclusion requires an explicit visibility decision. No historical distribution ZIP was available. The initial review had no local Git history; the existing GitHub history was subsequently recovered for release preparation.

The owner confirmed MIT for module-owned code on 2026-10-05; third-party licenses are preserved. The owner left the security support period and maintained lines undefined. Compatibility metadata and release readiness still require resolution. Internal findings also require remediation and functional verification before a release can be approved. Release packaging checks are recorded separately in the internal manifest. No completed dependency vulnerability scan, clean installation/upgrade test, successful Marketplace validator result, or independent backup is asserted here.

Product applicability/classification, support rationale, incident handling responsibilities and cover, technical documentation, and retention arrangements require a separate owner assessment. These documents alone do not complete those activities.
