/**
 * Editor Script.
 *
 * This imports all modules for the block editor. The final result gets saved
 * back into `public/js/editor.js`.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

import filterBlockEdit     from './editor/filter-block-edit';
import filterBlockRegister from './editor/filter-block-register';

// Import rich text formats.
import formatFontSizeSmall from './editor/rich-text/format-font-size-small.js';
import formatUnderline     from './editor/rich-text/format-underline.js';

// Import block variations.
import blockVariations from './editor/block-variations';
