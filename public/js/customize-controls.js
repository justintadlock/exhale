!function(t){var e={};function o(n){if(e[n])return e[n].exports;var c=e[n]={i:n,l:!1,exports:{}};return t[n].call(c.exports,c,c.exports,o),c.l=!0,c.exports}o.m=t,o.c=e,o.d=function(t,e,n){o.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:n})},o.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},o.t=function(t,e){if(1&e&&(t=o(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var n=Object.create(null);if(o.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var c in t)o.d(n,c,function(e){return t[e]}.bind(null,c));return n},o.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return o.d(e,"a",e),e},o.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},o.p="/",o(o.s=1)}({1:function(t,e,o){t.exports=o("H0l3")},BzFl:function(t,e){wp.customize.controlConstructor["exhale-typography"]=wp.customize.Control.extend({ready:function(){var t=exhaleCustomizeControls.fontFamilies,e=exhaleCustomizeControls.fontStyles,o=this,n=o.settings.family,c=o.settings.style;n&&c&&n.bind(function(n){for(var i=t[n],r=document.querySelector(o.selector+" [data-customize-setting-link="+c.id+"]"),a=r.options.length;a>=0;a--)r.remove(a);var l=i.styles[0];-1!==i.styles.indexOf(c.get())&&(l=c.get()),c.set(l),i.styles.forEach(function(t){var o=document.createElement("option");o.value=t,o.innerHTML=e[t].label,t===l&&o.setAttribute("selected","selected"),r.appendChild(o)})})}})},H0l3:function(t,e,o){"use strict";o.r(e);o("vsiy"),o("BzFl"),o("dIaf"),o("N7jc"),o("xQqn")},N7jc:function(t,e){var o=exhaleCustomizeControls,n=o.loopLayouts,c=o.loopQueries,i=o.imageSizes;Object.values(c).forEach(function(t){wp.customize.control("loop_".concat(t,"_layout"),function(e){e.setting.bind(function(e){var o=wp.customize.control("loop_".concat(t,"_width")),c=wp.customize.control("loop_".concat(t,"_columns"));n[e].supportsWidth?o.activate():o.deactivate(),n[e].supportsColumns?c.activate():c.deactivate();var r=wp.customize.control("loop_".concat(t,"_image_size")),a=r.settings.default;if(n[e].imageSizes.length){for(var l=document.querySelector(r.selector+" [data-customize-setting-link="+a.id+"]"),u=l.options.length;u>=0;u--)l.remove(u);var s=n[e].imageSizes[0];n[e].imageSizes.includes(a.get())&&(s=a.get()),a.set(s),n[e].imageSizes.forEach(function(t){var e=document.createElement("option");e.value=t,e.innerHTML=i[t].label,t===s&&e.setAttribute("selected","selected"),l.appendChild(e)}),r.activate()}else r.deactivate()})})})},dIaf:function(t,e){wp.customize.bind("ready",function(){var t=exhaleCustomizeControls.backgroundPatterns,e=function(t,e,o){var n='url("data:image/svg+xml,'+t.replace(/fill="#[a-fA-F0-9_-]*"/,'fill="'+e+'"').replace(/fill-opacity="[0-9.]*"/,'fill-opacity="'+o+'"').replace(/\"/g,"'").replace(/\</g,"%3C").replace(/\>/g,"%3E").replace(/\&/g,"%26").replace(/\#/g,"%23")+'")';return console.log(n),n};["content"].forEach(function(o){var n=wp.customize.control("".concat(o,"_background_svg"));wp.customize.control("color_".concat(o,"_background"),function(t){t.setting.bind(function(t){document.querySelectorAll(n.selector+" .svg-background__block").forEach(function(e){e.style.backgroundColor=t})})}),wp.customize.control("color_".concat(o,"_background_fill"),function(c){c.setting.bind(function(c){var i=wp.customize.control("".concat(o,"_background_fill_opacity")).settings.default.get();document.querySelectorAll(n.selector+" .svg-background__block").forEach(function(o){if(o.dataset.svg){var n=t[o.dataset.svg];o.style.backgroundImage=e(n.svg,c,i)}})})}),wp.customize.control("".concat(o,"_background_fill_opacity"),function(c){c.setting.bind(function(c){var i=wp.customize.control("color_".concat(o,"_background_fill")).settings.default.get();document.querySelectorAll(n.selector+" .svg-background__block").forEach(function(o){if(o.dataset.svg){var n=t[o.dataset.svg];o.style.backgroundImage=e(n.svg,i,c)}})})}),wp.customize.control("".concat(o,"_background_svg"),function(t){t.setting.bind(function(t){t?(wp.customize.control("color_".concat(o,"_background_fill")).activate(),wp.customize.control("".concat(o,"_background_fill_opacity")).activate()):(wp.customize.control("color_".concat(o,"_background_fill")).deactivate(),wp.customize.control("".concat(o,"_background_fill_opacity")).deactivate())})})})})},vsiy:function(t,e){wp.customize.controlConstructor["exhale-image-filter"]=wp.customize.Control.extend({ready:function(){var t=exhaleCustomizeControls.imageFilters,e=this,o=e.settings.function,n=e.settings.default_amount,c=e.settings.hover_amount;o.bind(function(o){var i=e.selector+" .exhale-image-default-filter-amount",r=e.selector+" .exhale-image-hover-filter-amount",a=e.selector+" [data-customize-setting-link="+n.id+"]",l=e.selector+" [data-customize-setting-link="+c.id+"]",u=document.querySelectorAll(i+","+r),s=document.querySelectorAll(a+","+l);n.set(t[o].lacuna),c.set(t[o].lacuna),u.forEach(function(t){t.style.display=o&&"none"!==o?"block":"none"}),s.forEach(function(e){e.setAttribute("min",t[o].min),e.setAttribute("max",t[o].max)})})}})},xQqn:function(t,e){wp.customize.control("powered_by",function(t){t.setting.bind(function(t){var e=wp.customize.control("footer_credit");t?e.deactivate():e.activate()})})}});