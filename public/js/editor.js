!function(e){var t={};function r(a){if(t[a])return t[a].exports;var n=t[a]={i:a,l:!1,exports:{}};return e[a].call(n.exports,n,n.exports,r),n.l=!0,n.exports}r.m=e,r.c=t,r.d=function(e,t,a){r.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:a})},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.t=function(e,t){if(1&t&&(e=r(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var a=Object.create(null);if(r.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var n in e)r.d(a,n,function(t){return e[t]}.bind(null,n));return a},r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,"a",t),t},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.p="/",r(r.s=2)}({2:function(e,t,r){e.exports=r("pNZs")},"7lq1":function(e,t){var r=wp.richText,a=r.registerFormatType,n=r.toggleFormat,l=wp.blockEditor.RichTextToolbarButton;a("exhale/underline",{title:"Small",tagName:"span",className:"underline",edit:function(e){return React.createElement(l,{icon:"underline",title:"Underline",onClick:function(){e.onChange(n(e.value,{type:"exhale/underline"}))},isActive:e.isActive})}})},QqA1:function(e,t){var r=9007199254740991,a="[object Arguments]",n="[object Function]",l="[object GeneratorFunction]",o=/^(?:0|[1-9]\d*)$/;var i,s,c=Object.prototype,u=c.hasOwnProperty,d=c.toString,g=c.propertyIsEnumerable,p=(i=Object.keys,s=Object,function(e){return i(s(e))}),f=Math.max,m=!g.call({valueOf:1},"valueOf");function b(e,t){var r=x(e)||function(e){return function(e){return function(e){return!!e&&"object"==typeof e}(e)&&w(e)}(e)&&u.call(e,"callee")&&(!g.call(e,"callee")||d.call(e)==a)}(e)?function(e,t){for(var r=-1,a=Array(e);++r<e;)a[r]=t(r);return a}(e.length,String):[],n=r.length,l=!!n;for(var o in e)!t&&!u.call(e,o)||l&&("length"==o||v(o,n))||r.push(o);return r}function y(e,t,r){var a=e[t];u.call(e,t)&&k(a,r)&&(void 0!==r||t in e)||(e[t]=r)}function v(e,t){return!!(t=null==t?r:t)&&("number"==typeof e||o.test(e))&&e>-1&&e%1==0&&e<t}function h(e){var t=e&&e.constructor;return e===("function"==typeof t&&t.prototype||c)}function k(e,t){return e===t||e!=e&&t!=t}var x=Array.isArray;function w(e){return null!=e&&function(e){return"number"==typeof e&&e>-1&&e%1==0&&e<=r}(e.length)&&!function(e){var t=C(e)?d.call(e):"";return t==n||t==l}(e)}function C(e){var t=typeof e;return!!e&&("object"==t||"function"==t)}var E=function(e){return t=function(t,r){var a=-1,n=r.length,l=n>1?r[n-1]:void 0,o=n>2?r[2]:void 0;for(l=e.length>3&&"function"==typeof l?(n--,l):void 0,o&&function(e,t,r){if(!C(r))return!1;var a=typeof t;return!!("number"==a?w(r)&&v(t,r.length):"string"==a&&t in r)&&k(r[t],e)}(r[0],r[1],o)&&(l=n<3?void 0:l,n=1),t=Object(t);++a<n;){var i=r[a];i&&e(t,i,a,l)}return t},r=f(void 0===r?t.length-1:r,0),function(){for(var e=arguments,a=-1,n=f(e.length-r,0),l=Array(n);++a<n;)l[a]=e[r+a];a=-1;for(var o=Array(r+1);++a<r;)o[a]=e[a];return o[r]=l,function(e,t,r){switch(r.length){case 0:return e.call(t);case 1:return e.call(t,r[0]);case 2:return e.call(t,r[0],r[1]);case 3:return e.call(t,r[0],r[1],r[2])}return e.apply(t,r)}(t,this,o)};var t,r}(function(e,t){if(m||h(t)||w(t))!function(e,t,r,a){r||(r={});for(var n=-1,l=t.length;++n<l;){var o=t[n],i=a?a(r[o],e[o],o,r,e):void 0;y(r,o,void 0===i?e[o]:i)}}(t,function(e){return w(e)?b(e):function(e){if(!h(e))return p(e);var t=[];for(var r in Object(e))u.call(e,r)&&"constructor"!=r&&t.push(r);return t}(e)}(t),e);else for(var r in t)u.call(t,r)&&y(e,r,t[r])});e.exports=E},pNZs:function(e,t,r){"use strict";r.r(t);var a={};r.r(a),r.d(a,"cover",function(){return C}),r.d(a,"image",function(){return E}),r.d(a,"gallery",function(){return N}),r.d(a,"group",function(){return S}),r.d(a,"navigation",function(){return j});var n={"gray-darkest":"gray-900","gray-darker":"gray-700","gray-dark":"gray-600",gray:"gray-500","gray-light":"gray-400","gray-lighter":"gray-300","gray-lightest":"gray-100","red-darkest":"red-900","red-darker":"red-700","red-dark":"red-600",red:"red-500","red-light":"red-400","red-lighter":"red-300","red-lightest":"red-100","orange-darkest":"orange-900","orange-darker":"orange-700","orange-dark":"orange-600",orange:"orange-500","orange-light":"orange-400","orange-lighter":"orange-300","orange-lightest":"orange-100","yellow-darkest":"yellow-900","yellow-darker":"yellow-700","yellow-dark":"yellow-600",yellow:"yellow-500","yellow-light":"yellow-400","yellow-lighter":"yellow-300","yellow-lightest":"yellow-100","green-darkest":"green-900","green-darker":"green-700","green-dark":"green-600",green:"green-500","green-light":"green-400","green-lighter":"green-300","green-lightest":"green-100","teal-darkest":"teal-900","teal-darker":"teal-700","teal-dark":"teal-600",teal:"teal-500","teal-light":"teal-400","teal-lighter":"teal-300","teal-lightest":"teal-100","primary-darkest":"primary-900","primary-darker":"primary-700","primary-dark":"primary-600",blue:"primary-500","primary-light":"primary-400","primary-lighter":"primary-300","primary-lightest":"primary-100","indigo-darkest":"indigo-900","indigo-darker":"indigo-700","indigo-dark":"indigo-600",indigo:"indigo-500","indigo-light":"indigo-400","indigo-lighter":"indigo-300","indigo-lightest":"indigo-100","secondary-darkest":"secondary-900","secondary-darker":"secondary-700","secondary-dark":"secondary-600",purple:"secondary-500","secondary-light":"secondary-400","secondary-lighter":"secondary-300","secondary-lightest":"secondary-100","pink-darkest":"pink-900","pink-darker":"pink-700","pink-dark":"pink-600",pink:"pink-500","pink-light":"pink-400","pink-lighter":"pink-300","pink-lightest":"pink-100"},l=wp.tokenList,o=function(e,t){var r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:[],a=new l(e);return 0!==r.length&&a.forEach(function(e){r.includes(e)&&a.remove(e)}),t&&a.add(t),a.value},i=wp.components.SelectControl,s=exhaleEditor.labels,c=wp.components.SelectControl,u=exhaleEditor.labels,d=wp.components.SelectControl,g=exhaleEditor.labels,p=wp.components.SelectControl,f=exhaleEditor.labels,m=[{name:"listType",type:"string",default:"",control:function(e){var t=[{label:f.default,value:""},{label:f.none,value:"none"},{label:f.lists.disc,value:"disc"},{label:f.lists.circle,value:"circle"},{label:f.lists.square,value:"square"}],r=e.attributes.listType;return React.createElement(p,{key:"listType",label:f.listType,value:r,options:t,onChange:function(r){e.setAttributes({listType:r,className:o(e.attributes.className,r?"list-"+r:"",t.filter(function(e){return e.value}).map(function(e){return"list-"+e.value}))})}})},blocks:["core/list"]},{name:"borderRadius",type:"string",default:"",control:function(e){var t=[{label:s.default,value:""},{label:s.none,value:"none"},{label:s.sizes.small,value:"sm"},{label:s.sizes.medium,value:"md"},{label:s.sizes.large,value:"lg"},{label:s.sizes.extraLarge,value:"xl"}],r=e.attributes.borderRadius;return React.createElement(i,{key:"borderRadius",label:s.borderRadius,value:r,options:t,onChange:function(r){e.setAttributes({borderRadius:r,className:o(e.attributes.className,r?"rounded-"+r:"",t.filter(function(e){return e.value}).map(function(e){return"rounded-"+e.value}))})}})},blocks:["core/image","core/gallery","core/group","core/media-text","core/paragraph"]},{name:"boxShadow",type:"string",default:"",control:function(e){var t=[{label:u.default,value:""},{label:u.none,value:"none"},{label:u.sizes.small,value:"sm"},{label:u.sizes.medium,value:"md"},{label:u.sizes.large,value:"lg"},{label:u.sizes.extraLarge,value:"xl"}],r=e.attributes.boxShadow;return React.createElement(c,{key:"boxShadow",label:u.shadow,value:r,options:t,onChange:function(r){e.setAttributes({boxShadow:r,className:o(e.attributes.className,r?"shadow-"+r:"",t.filter(function(e){return e.value}).map(function(e){return"shadow-"+e.value}))})}})},blocks:["core/column","core/group","core/image","core/gallery","core/media-text","core/paragraph"]},{name:"gap",type:"string",default:"",control:function(e){var t=[{label:g.default,value:""},{label:"Gap 0",value:"0"},{label:"Gap 4",value:"4"},{label:"Gap 8",value:"8"},{label:"Gap 12",value:"12"},{label:"Gap 16",value:"16"}],r=e.attributes.gap;return React.createElement(d,{key:"gap",label:"Gap",value:r,options:t,onChange:function(r){e.setAttributes({gap:r,className:o(e.attributes.className,r?"gap-"+r:"",t.filter(function(e){return e.value}).map(function(e){return"gap-"+e.value}))})}})},blocks:["core/query-loop"]}],b=wp.components.PanelBody,y=(wp.i18n.__,exhaleEditor.labels),v=wp.compose.createHigherOrderComponent,h=wp.element.Fragment,k=wp.blockEditor.InspectorControls;(0,wp.hooks.addFilter)("editor.BlockEdit","exhale/block/edit",v(function(e){return function(t){t.attributes.backgroundColor&&t.attributes.backgroundColor in n&&(t.attributes.backgroundColor=n[t.attributes.backgroundColor]),t.attributes.overlayColor&&t.attributes.overlayColor in n&&(t.attributes.overlayColor=n[t.attributes.overlayColor]),t.attributes.mainColor&&t.attributes.mainColor in n&&(t.attributes.mainColor=n[t.attributes.mainColor]),t.attributes.textColor&&t.attributes.textColor in n&&(t.attributes.textColor=n[t.attributes.textColor]),t.attributes.color&&t.attributes.color in n&&(t.attributes.color=n[t.attributes.color]);var r=[];return m.forEach(function(e){e.blocks.includes(t.name)&&r.push(e)}),r.length?React.createElement(h,null,React.createElement(e,t),React.createElement(k,null,function(e,t){return React.createElement(b,{title:y.designSettings,initialOpen:!1},t.map(function(t,r){return t.control(e)}))}(t,r))):React.createElement(e,t)}},"ExhaleBlockEdit"));var x=r("QqA1"),w=r.n(x);(0,wp.hooks.addFilter)("blocks.registerBlockType","exhale/block/register",function(e,t){return m.forEach(function(r){var a,n,l;r.blocks.includes(t)&&(e.attributes=w()(e.attributes,(a={},n=r.name,l={type:r.type,default:r.default},n in a?Object.defineProperty(a,n,{value:l,enumerable:!0,configurable:!0,writable:!0}):a[n]=l,a)))}),e});r("rog+"),r("7lq1");var C={block:"core/cover",variations:[{name:"default",title:"Cover",scope:["block","inserter","transform"],isDefault:!0,attributes:{className:"is-default"},innerBlocks:[["core/paragraph",{align:"center"}]]}]},E={block:"core/image",variations:[{name:"default",title:"Image: Classic",scope:"transform",isDefault:!0,attributes:{className:"is-var-classic"}},{name:"classic",title:"Image: Overlay",scope:["block","inserter","transform"],attributes:{className:"is-var-overlay"}}]},N={block:"core/gallery",variations:[{name:"default",title:"Gallery: Default",scope:"transform",isDefault:!0,attributes:{className:"is-default"}},{name:"classic",title:"Gallery: Classic",scope:["block","inserter","transform"],attributes:{className:"is-classic"}}]},S={block:"core/group",variations:[{name:"default",title:"Group: Default",scope:["block","inserter","transform"],isDefault:!0},{name:"padded",title:"Group: Padded",scope:["block","inserter","transform"],isDefault:!0,attributes:{style:{spacing:{padding:{top:"2rem",bottom:"2rem",left:"2rem",right:"2rem"}}},backgroundColor:"neutral-100",className:"is-var-padded"},innerBlocks:[["core/paragraph",{align:"center"}]]},{name:"site-branding",title:"Site Branding",scope:["inserter"],attributes:{align:"full",style:{spacing:{padding:{top:"0rem",right:"2rem",bottom:"0rem",left:"2rem"},margin:{top:"0px",right:"0px",bottom:"0px",left:"0px"}}},className:"overflow-hidden flex justify-start items-center md:flex-grow-0"},innerBlocks:[["core/site-title",{className:"m-0 mr-2 leading-none",style:{typography:{lineHeight:"1"},spacing:{margin:{top:"0px",right:"8px",bottom:"0px",left:"0px"}}},fontSize:"extra-large"}],["core/site-tagline",{style:{typography:{fontFamily:"var:preset|font-family|secondary",lineHeight:"1"},spacing:{margin:{top:"0px",right:"0px",bottom:"0px",left:"8px"}}},className:"hidden sm:block",fontSize:"sm"}]]}]},j={block:"core/navigation",variations:[{name:"primary",title:"Navigation: Primary",scope:["block","inserter","transform"],attributes:{orientation:"primary-horizontal",isResponsive:!0,className:"menu--primary"},innerBlocks:[["core/home-link",{label:"Home"}],["core/navigation-link",{label:"About",url:"/about",kind:"custom"}],["core/navigation-link",{label:"Blog",url:"/blog",kind:"custom"}]]}]};wp.domReady(function(){Object.keys(a).forEach(function(e){a[e].variations.forEach(function(t){wp.blocks.registerBlockVariation(a[e].block,t)})})})},"rog+":function(e,t){var r=wp.richText,a=r.registerFormatType,n=r.toggleFormat,l=wp.blockEditor.RichTextToolbarButton;a("exhale/font-size-sm",{title:"Small",tagName:"span",className:"has-sm-font-size",edit:function(e){return React.createElement(l,{icon:"verse",title:"Small",onClick:function(){e.onChange(n(e.value,{type:"exhale/font-size-sm"}))},isActive:e.isActive})}})}});