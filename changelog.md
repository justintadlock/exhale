# Change Log

## [2.2.1] - 2019-09-10

### Fixed

- Don't add a transparent background to the Button block with the "outline" style if the user has chosen a background color.

## [2.2.0] - 2019-09-03

### Added

- Requirement of the [libxml](https://www.php.net/manual/en/book.libxml.php) PHP extension for use of [DomDocument](https://www.php.net/manual/en/class.domdocument.php) (note that this is fairly standard as it enabled by default).
- Gutenberg 6.4 support.
- Custom background color, image, or pattern for the following sections:
	- Body
	- Header
	- Content
	- Footer
	- Footer Sidebar
- New color shades.  Each color now has 9 shades ranging from `{$color}-100` to `{$color}-900`.
- New mobile hamburger-style menu instead of the horizontal-scrolling menu.
- Customizer color options for:
	- Pagination
	- Primary Menu
- `max-w-6xl` and `max-w-7xl` width options for loop layouts and the footer sidebar.
- Sticky header option for allowing the site header to stick to the top of the screen.
- Branding separator option that splits the title and description (replaces the border).
- Adds support for defining the content layout for CPT archives via the customizer.

### Changed

- The entire design system moved to utility-based classes.
	- This changes hard-coded classes throughout the entire code base.
	- Templates in child themes should be checked.
- Vertical rhythm now uses `margin-top` instead of `margin-bottom`.
- Loads of tiny adjustments to styles just to make things smoother.
- Color system is now numeric for shades (e.g., `red-100` instead of `red-lightest`).
	- Back-compat is added in both the editor and front end.
- Support for front-end colors even when child themes don't define them.

## [2.1.1] - 2019-07-18

### Fixed

- Corrected error when customizing the footer credit textarea in the customizer during the sanitization process.

## [2.1.0] - 2019-07-17

### Added

- Gutenberg 6.1 support.
- New content loop layout options:
	- Layouts: Choose between Blog, Grid, or List.
	- Posts Per Page: Select number of posts to show.
	- Width: Choose from a set of predefined widths.
	- Columns: With the grid layout, select 2-6 columns.
	- Featured Image Size: Select size of featured image for page.
- Footer sidebars:
	- Adds 4 new footer sidebars.
	- Sidebar columns auto-adjust based on active sidebars.
	- New color options.
	- Set of predefined width options.
- Editor design settings:
	- Box shadow setting for Image, Paragraph, Gallery, Media & Text blocks.
	- Border radius setting for Image, Paragraph, Gallery, Media & Text blocks.
	- List style setting for List blocks.
- Added new text alignment classes:
	- `.has-text-align-center`
	- `.has-text-align-left`
	- `.has-text-align-right`
- New "Reverse" style for the Gallery block, which can be used to flip the rows of the gallery.
- Began work toward making the theme be more of a utility and component toolkit.
- Rudimentary support for WooCommerce added.
- Added an `.o-content-width` object for styling items and their children that should be the width of the content.
- New "Titanic" font size for the editor.

### Fixed

- Styling for post date in the Latest Posts block.

### Changed

- Upgraded to version 5.1 of the Hybrid Core framework.
- Replaced the Theme Options panel in the customizer with:
	- Theme: Global.
	- Theme: Header.
	- Theme: Content.
	- Theme: Footer.
- Tightened up margins, line-heights, and font sizes.

### Removed

- Editor styles:
	- Shadow style replaced in Design Settings.
	- Rounded style replaced in Design Settings.
	- List styles replaced in Design Settings.
	- Border/Borderless styles removed in favor of Box Shadow settings.
- Removed the blog and archive posts-per-page settings from Appearance > Exhale Settings in favor of the content settings in the customizer.
- Support for the old Subhead block that was never in any version of Gutenberg Exhale supported.

## [2.0.0] - 2019-06-19

### Added

- New typography system to replace font family system.
	- Headings now support family, style, caps, and text transform settings.
	- System is set up for future typography-related settings.
- New block styles:
	- **Image:** Shadow, Rounded.
	- **Gallery:** Shadow
	- **List:** None, Circle, Disc, Square.
	- **Media & Text:** Borderless.
	- **Paragraph:** Shadow.
- New post/page templates (supported for all post types):
	- **Content Canvas:** Only the post content is shown in the content area.
	- **Landing: Content Canvas:** Only the post content is shown for the entire page.
- Use the native `loading` (lazy-loading) attribute for featured images.
- New Google fonts:
	- Abril Fatface
	- Aguafina Script
	- Alfa Slab One
	- Almendra Display
	- Almendra Small Caps
	- Archivo Black
	- Arizonia
	- Averia Gruesa Libre
	- Bangers
	- Berkshire Swash
	- Bitter
	- Bree Serif
	- Cabin Condensed
	- Cabin Sketch
	- Caveat
	- Caveat Brush
	- Cherry Swash
	- Comfortaa
	- Cookie
	- Cormorant Small Caps
	- Cormorant Upright
	- Cormorant Unicase
	- Dancing Script
	- Elsie
	- Elsie Swash Caps
	- Fira Mono
	- Give You Glory
	- Gloria Hallelujah
	- Great Vibes
	- Handlee
	- Henny Penny
	- Indie Flower
	- Libre Baskerville
	- Mali
	- Nothing You Could Do
	- Oleo Script
	- Oleo Script Swash Caps
	- Open Sans Condensed
	- Oswaled
	- Overlock Small Caps
	- Overpass Mono
	- Pacifico
	- Patua One
	- Playball
	- Prata
	- PT Sans Caption
	- PT Sans Narrow
	- PT Serif Caption
	- Quattrocento
	- Quicksand
	- Righteous
	- Roboto Slab
	- Rouge Script
	- Sacremento
	- Satisfy
	- Slabo 27px
	- Shadows Into Light
	- Source Code Pro
	- Source Serif Pro
	- Tangerine
	- Ubuntu Condensed
	- Ultra
	- Work Sans
	- Yellowtail
- `Exhale\Tools\Mod::fallback()` method for grabbing the default/fallback theme mod.
- `config/settings-mods.php` now supports configuring all default theme mods other than fonts and colors.

### Fixed

- Added a `?ver` parameter to screenshot images on the Exhale Settings > Themes page for cache busting.
- Blockquotes now appear with their proper left/right padding.
- Columns block nested within group block with padding left/right margins corrected.

### Changed

- WordPress 5.2 as a minimum requirement.
- `config/settings-font-family.php` is now `config/settings-typography.php`.
- `<code>` output has a font size of `15px`.
- "No Post Header/Footer" template is now "Content Canvas".

## [1.2.1] - 2019-05-30

### Fixed

- JavaScript error when no menu is assigned to the `primary` location.
- Corrected the missing left/right margins for archive headers and entry lists on mobile.
- Fixed Heading block custom text color being overwritten.
- Paragraph blocks with backgrounds should extend to the edge of the screen on mobile.
- Corrected the post title width to `900px` in the block editor.
- Pagination anchor color should be content background color on hover.  This is how it was originally, at least until we added support for a body background.

### Added

- Gutenberg 5.8 compatibility.
- Added the [Manuscript](https://themehybrid.com/themes/manuscript) child theme to the Exhale Settings > Themes view.

### Changed

- Moved media display to within the `.entry__content` container on attachment pages.
- Added a consistent `<figure>` wrapper around the media display on attachment pages.
- Added a wrapper `<div>` around entry lists on archive pages.  Structure is now:
	- `<div class="entry-list">`
	- `<ul class="entry-list__items">`
	- `<li class="entry-list__item">`

## [1.2.0] - 2019-05-23

### Fixed

- Running `array_map()` over customizer settings and controls when it can be done once.
- Fixed bottom margin for the Pullquote block when it has a solid background.
- Correct font CSS for item author in RSS block.
- Corrected the vertical alignments not working in the editor for the Columns block.
- Fixed Pullquote font size, line height, and margins in editor.
- Removed rounded corners from wide-aligned Image and Cover blocks so that the edges are flush with the container.

### Added

- Core `custom-background` support.
- Layouts features that allows the selection between the following layouts:
	- Wide (default)
	- Boxed
	- Boxed Content
- New color options:
	- Footer: Text
	- Footer: Background
	- Footer: Border
	- Footer: Link
	- Footer: Link Hover
- Support for background and text colors with the Heading block.
- Early version of theme manager via Appearance > Exhale Settings > Themes, which will primarily be used for showcasing new child themes.
- Added `block-styles` and `wide-blocks` to the theme tags list.

### Changed

- Gutenberg 5.6+ is now required.
- Overhaul of the CSS block system. Primarily, this made the `.entry__content` container a full-width block container.  This is so that we can avoid a lot of negative margin hacks and better prep blocks to work within any block container in the future with little addition of code.
- New screenshot.
- Reordered the customizer sections under Theme Options to better control them.

### Removed

- Took out `config/settings-font-family.php`, which falls back to `config/_settings-font-family.php`.

## [1.1.0] - 2019-05-07

### Fixed

- Corrected bottom margins of elements within the Columns block.
- Fixed center alignment of images not working.
- Removed top margin of headings when following a `</div>`.
- Clear floats when using a wide or full-aligned block.
- Fixed a fatal error on PHP 5.6 when importing the `Hybrid\Tools\Collection` class from Hybrid Core under the `Exhale\Tools` namespace instead of the `Exhale\Tools\Collection` class.
- Fall back to `transparent` when a color is set to nothing.
- Lowered the padding for `<code>` elements, which was bumping into before/after lines when used inline.
- Fixed weird white panel over editor when using an unaligned image within a full-width columns block.

### Added

- New block styles:
	- Borderless style for the image block.
	- Highlight style for the paragraph block.
	- Dashed and Double styles for the separator block.
- Created a new system for child themes to override config files while merging with the defaults:
	- `config/editor-colors.php`
	- `config/settings-color.php`
	- `config/settings-font-family.php`
- Google fonts integration with the font settings.  Brings in 106 new fonts that are suitable for body copy (includes Regular, Regular Italic, Bold, and Bold Italic styles).
- Added a `CssCustomProperty` interface use alongside the `CustomProperties` collection.

## Changed

- Unregister the core block styles on the `enqueue_block_assets` hook. This stopped working on `enqueue_block_editor_assets` at some point. See: https://github.com/WordPress/gutenberg/issues/15007

## Removed

- Removed old `classic.css` file that's no longer in use (got renamed to `screen-classic.css`).

## [1.0.2] - 2019-04-22

### Fixed

- Use font size for the post title input in editor.
- Use correct color when post title input in editor is focused.
- Removed unnecessary padding from Media & Text block content area.
- Adds max width to "content" area of Media & Text block for better alignment on mobile.
- Added left/right padding to footer area to fix mobile spacing.
- Contains the margin for paragraph blocks with backgrounds inside of the Columns block.
- Target only direct descendants on the no post header/footer template when using negative margin.
- Several alignment and width fixes for the Columns block.

### Added

- Support for the Group block in Gutenberg 5.5.0.
- Support for vertical alignment with the Media & Text block in Gutenberg 5.5.0.
- Support for the image fill option in the Media & Text block added to Gutenberg 5.5.0.

## [1.0.1] - 2019-04-04

### Fixed

- Fixed the theme mod colors not showing correctly within the editor for those that are also editor colors.

## [1.0.0] - 2019-04-03

### Added

- Theme launch.  Everything's new!
