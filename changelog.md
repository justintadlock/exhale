# Change Log

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
