/**
 * Customize controls script.
 *
 * This imports all modules for the customize controls pane. The final result
 * gets saved back into `public/js/customize-controls.js`.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

import controlImageFilter from './customize-controls/control-image-filter';
import controlTypography  from './customize-controls/control-typography';
import contentLayout      from './customize-controls/content-layout';
import footer             from './customize-controls/footer';

// Hybrid Customize controls.
//
// Uncomment any of the below to import scripts for specific controls if using
// the `hybrid-customize` add-on.

// import checkboxMultiple from 'hybrid-customize/js/controls/checkbox-multiple.js';
// import palette          from 'hybrid-customize/js/controls/palette.js';
// import radioImage       from 'hybrid-customize/js/controls/radio-image.js';
// import selectGroup      from 'hybrid-customize/js/controls/select-group.js';
// import selectMultiple   from 'hybrid-customize/js/controls/select-multiple.js';
