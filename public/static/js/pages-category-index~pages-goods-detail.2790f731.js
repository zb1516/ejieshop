(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-category-index~pages-goods-detail"],{"1b64":function(t,e,o){"use strict";o.r(e);var i=o("dee6"),a=o("a98d");for(var n in a)"default"!==n&&function(t){o.d(e,t,(function(){return a[t]}))}(n);o("cd09");var r,s=o("f0c5"),c=Object(s["a"])(a["default"],i["b"],i["c"],!1,null,"09f76367",null,!1,i["a"],r);e["default"]=c.exports},2909:function(t,e,o){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=c;var i=s(o("6005")),a=s(o("db90")),n=s(o("06c5")),r=s(o("3427"));function s(t){return t&&t.__esModule?t:{default:t}}function c(t){return(0,i.default)(t)||(0,a.default)(t)||(0,n.default)(t)||(0,r.default)()}},2959:function(t,e,o){"use strict";var i=o("4ea4");Object.defineProperty(e,"__esModule",{value:!0}),e.clear=e.update=e.add=e.total=e.list=void 0;var a=i(o("26a9")),n={list:"cart/list",total:"cart/total",add:"cart/add",update:"cart/update",clear:"cart/clear"},r=function(){return a.default.get(n.list,{},{load:!1})};e.list=r;var s=function(){return a.default.get(n.total,{},{load:!1})};e.total=s;var c=function(t,e,o){return a.default.post(n.add,{goodsId:t,goodsSkuId:e,goodsNum:o})};e.add=c;var u=function(t,e,o){return a.default.post(n.update,{goodsId:t,goodsSkuId:e,goodsNum:o},{isPrompt:!1})};e.update=u;var l=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];return a.default.post(n.clear,{cartIds:t})};e.clear=l},3207:function(t,e,o){"use strict";var i=o("6622"),a=o.n(i);a.a},3427:function(t,e,o){"use strict";function i(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}Object.defineProperty(e,"__esModule",{value:!0}),e.default=i},6005:function(t,e,o){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=n;var i=a(o("6b75"));function a(t){return t&&t.__esModule?t:{default:t}}function n(t){if(Array.isArray(t))return(0,i.default)(t)}},6622:function(t,e,o){var i=o("6bb8");i.__esModule&&(i=i.default),"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var a=o("4f06").default;a("1a53aeb2",i,!0,{sourceMap:!1,shadowMode:!1})},"6bb8":function(t,e,o){var i=o("24fb");e=i(!1),e.push([t.i,'@charset "UTF-8";\r\n/**\r\n * 这里是uni-app内置的常用样式变量\r\n *\r\n * uni-app 官方扩展插件及插件市场（https://ext.dcloud.net.cn）上很多三方插件均使用了这些样式变量\r\n * 如果你是插件开发者，建议你使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\r\n *\r\n */\r\n/**\r\n * 如果你是App开发者（插件使用者），你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\r\n *\r\n * 如果你的项目同样使用了scss预处理，你也可以直接在你的 scss 代码中使用如下变量，同时无需 import 这个文件\r\n */\r\n/* 颜色变量 */\r\n/* 行为相关颜色 */\r\n/* 文字基本颜色 */\r\n/* 背景颜色 */\r\n/* 边框颜色 */\r\n/* 尺寸变量 */\r\n/* 文字尺寸 */\r\n/* 图片尺寸 */\r\n/* Border Radius */\r\n/* 水平间距 */\r\n/* 垂直间距 */\r\n/* 透明度 */\r\n/* 文章场景相关 */\r\n/* 引入uView全局scss变量文件 */.number-box[data-v-7e1a60fc]{display:inline-flex;align-items:center}.u-number-input[data-v-7e1a60fc]{position:relative;text-align:center;padding:0;margin:0 %?6?%;display:flex;align-items:center;justify-content:center}.u-icon-plus[data-v-7e1a60fc],\r\n.u-icon-minus[data-v-7e1a60fc]{width:%?60?%;display:flex;justify-content:center;align-items:center}.u-icon-plus[data-v-7e1a60fc]{border-radius:0 %?8?% %?8?% 0}.u-icon-minus[data-v-7e1a60fc]{border-radius:%?8?% 0 0 %?8?%}.u-icon-disabled[data-v-7e1a60fc]{color:#c8c9cc!important;background:#f7f8fa!important}.u-input-disabled[data-v-7e1a60fc]{color:#c8c9cc!important;background-color:#f2f3f5!important}.num-btn[data-v-7e1a60fc]{font-weight:550;position:relative;top:%?-4?%}',""]),t.exports=e},"76d4":function(t,e,o){"use strict";o.r(e);var i=o("8f14"),a=o.n(i);for(var n in i)"default"!==n&&function(t){o.d(e,t,(function(){return i[t]}))}(n);e["default"]=a.a},"8f14":function(t,e,o){"use strict";o("c975"),o("a9e3"),o("d3b7"),o("ac1f"),o("25f0"),o("1276"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var i={name:"NumberBox",emits:["update:modelValue","input","change","blur","plus","minus"],props:{value:{type:Number,default:1},modelValue:{type:Number,default:1},bgColor:{type:String,default:"#F2F3F5"},min:{type:Number,default:0},max:{type:Number,default:99999},step:{type:Number,default:1},stepFirst:{type:Number,default:0},stepStrictly:{type:Boolean,default:!1},disabled:{type:Boolean,default:!1},size:{type:[Number,String],default:26},color:{type:String,default:"#323233"},inputWidth:{type:[Number,String],default:80},inputHeight:{type:[Number,String],default:50},index:{type:[Number,String],default:""},disabledInput:{type:Boolean,default:!1},cursorSpacing:{type:[Number,String],default:100},longPress:{type:Boolean,default:!0},pressTime:{type:[Number,String],default:250},positiveInteger:{type:Boolean,default:!0}},watch:{value:function(t,e){this.changeFromInner||(this.inputVal=t,this.$nextTick((function(){this.changeFromInner=!1})))},modelValue:function(t,e){this.changeFromInner||(this.inputVal=t,this.$nextTick((function(){this.changeFromInner=!1})))},inputVal:function(t,e){var o=this;if(""!=t){var i=0,a=this.isNumber(t);i=a&&t>=this.min&&t<=this.max?t:e,this.positiveInteger&&(t<0||-1!==String(t).indexOf("."))&&(i=e,this.$nextTick((function(){o.inputVal=e}))),this.handleChange(i,"change")}},min:function(t){void 0!==t&&""!=t&&this.getValue()<t&&this.$emit("input",t)},max:function(t){void 0!==t&&""!=t&&this.getValue()>t&&this.$emit("input",t)}},data:function(){return{inputVal:1,timer:null,changeFromInner:!1,innerChangeTimer:null}},created:function(){this.inputVal=Number(this.getValue())},computed:{getCursorSpacing:function(){return Number(uni.upx2px(this.cursorSpacing))}},methods:{getValue:function(){return this.value},btnTouchStart:function(t){var e=this;this[t](),this.longPress&&(clearInterval(this.timer),this.timer=null,this.timer=setInterval((function(){e[t]()}),this.pressTime))},clearTimer:function(){var t=this;this.$nextTick((function(){clearInterval(t.timer),t.timer=null}))},minus:function(){this.computeVal("minus")},plus:function(){this.computeVal("plus")},calcPlus:function(t,e){var o,i,a;try{i=t.toString().split(".")[1].length}catch(r){i=0}try{a=e.toString().split(".")[1].length}catch(r){a=0}o=Math.pow(10,Math.max(i,a));var n=i>=a?i:a;return((t*o+e*o)/o).toFixed(n)},calcMinus:function(t,e){var o,i,a;try{i=t.toString().split(".")[1].length}catch(r){i=0}try{a=e.toString().split(".")[1].length}catch(r){a=0}o=Math.pow(10,Math.max(i,a));var n=i>=a?i:a;return((t*o-e*o)/o).toFixed(n)},computeVal:function(t){if(uni.hideKeyboard(),!this.disabled){var e=0;if("minus"===t?e=this.stepFirst>0&&this.inputVal==this.stepFirst?this.min:this.calcMinus(this.inputVal,this.step):"plus"===t&&(e=this.stepFirst>0&&this.inputVal<this.stepFirst?this.stepFirst:this.calcPlus(this.inputVal,this.step)),this.stepStrictly){var o=e%this.step;o>0&&(e-=o)}e>this.max?e=this.max:e<this.min&&(e=this.min),this.inputVal=e,this.handleChange(e,t)}},onBlur:function(t){var e=this,o=0,i=t.detail.value;if(/(^\d+$)/.test(i)&&0!=i[0]||(o=this.min),o=+i,this.stepFirst>0&&this.inputVal<this.stepFirst&&this.inputVal>0&&(o=this.stepFirst),this.stepStrictly){var a=o%this.step;a>0&&(o-=a)}o>this.max?o=this.max:o<this.min&&(o=this.min),this.$nextTick((function(){e.inputVal=o})),this.handleChange(o,"blur")},handleChange:function(t,e){var o=this;this.disabled||(this.innerChangeTimer&&(clearTimeout(this.innerChangeTimer),this.innerChangeTimer=null),this.changeFromInner=!0,this.innerChangeTimer=setTimeout((function(){o.changeFromInner=!1}),150),this.$emit("input",Number(t)),this.$emit("update:modelValue",Number(t)),this.$emit(e,{value:Number(t),index:this.index}))},isNumber:function(t){return/^(?:-?\d+|-?\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test(t)}}};e.default=i},9911:function(t,e,o){var i=o("a864");i.__esModule&&(i=i.default),"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var a=o("4f06").default;a("7d417d5d",i,!0,{sourceMap:!1,shadowMode:!1})},a623:function(t,e,o){"use strict";var i=o("23e7"),a=o("b727").every,n=o("a640"),r=o("ae40"),s=n("every"),c=r("every");i({target:"Array",proto:!0,forced:!s||!c},{every:function(t){return a(this,t,arguments.length>1?arguments[1]:void 0)}})},a864:function(t,e,o){var i=o("24fb");e=i(!1),e.push([t.i,'@charset "UTF-8";\r\n/**\r\n * 这里是uni-app内置的常用样式变量\r\n *\r\n * uni-app 官方扩展插件及插件市场（https://ext.dcloud.net.cn）上很多三方插件均使用了这些样式变量\r\n * 如果你是插件开发者，建议你使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\r\n *\r\n */\r\n/**\r\n * 如果你是App开发者（插件使用者），你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\r\n *\r\n * 如果你的项目同样使用了scss预处理，你也可以直接在你的 scss 代码中使用如下变量，同时无需 import 这个文件\r\n */\r\n/* 颜色变量 */\r\n/* 行为相关颜色 */\r\n/* 文字基本颜色 */\r\n/* 背景颜色 */\r\n/* 边框颜色 */\r\n/* 尺寸变量 */\r\n/* 文字尺寸 */\r\n/* 图片尺寸 */\r\n/* Border Radius */\r\n/* 水平间距 */\r\n/* 垂直间距 */\r\n/* 透明度 */\r\n/* 文章场景相关 */\r\n/* 引入uView全局scss变量文件 */\r\n/*  sku弹出层 */.goods-sku-popup[data-v-09f76367]{position:fixed;left:var(--window-left);right:var(--window-right);top:0;bottom:0;z-index:21;overflow:hidden}.goods-sku-popup.show[data-v-09f76367]{display:block}.goods-sku-popup.show .mask[data-v-09f76367]{-webkit-animation:showPopup-data-v-09f76367 .2s linear both;animation:showPopup-data-v-09f76367 .2s linear both}.goods-sku-popup.show .layer[data-v-09f76367]{-webkit-animation:showLayer-data-v-09f76367 .2s linear both;animation:showLayer-data-v-09f76367 .2s linear both;bottom:var(--window-bottom)}.goods-sku-popup.hide .mask[data-v-09f76367]{-webkit-animation:hidePopup-data-v-09f76367 .2s linear both;animation:hidePopup-data-v-09f76367 .2s linear both}.goods-sku-popup.hide .layer[data-v-09f76367]{-webkit-animation:hideLayer-data-v-09f76367 .2s linear both;animation:hideLayer-data-v-09f76367 .2s linear both}.goods-sku-popup.none[data-v-09f76367]{display:none}.goods-sku-popup .mask[data-v-09f76367]{position:fixed;left:var(--window-left);right:var(--window-right);top:0;height:100%;z-index:1;background-color:rgba(0,0,0,.65)}.goods-sku-popup .layer[data-v-09f76367]{display:flex;flex-direction:column;position:fixed;left:var(--window-left);right:var(--window-right);bottom:0;z-index:99;border-radius:%?10?% %?10?% 0 0;background-color:#fff;padding-bottom:constant(safe-area-inset-bottom);padding-bottom:env(safe-area-inset-bottom)}.goods-sku-popup .layer .specification-wrapper[data-v-09f76367]{width:100%;padding:%?30?% %?25?%;box-sizing:border-box}.goods-sku-popup .layer .specification-wrapper .specification-wrapper-content[data-v-09f76367]{width:100%;max-height:%?900?%;min-height:%?300?%}.goods-sku-popup .layer .specification-wrapper .specification-wrapper-content[data-v-09f76367]::-webkit-scrollbar{\r\n  /*隐藏滚轮*/display:none}.goods-sku-popup .layer .specification-wrapper .specification-wrapper-content .specification-header[data-v-09f76367]{width:100%;display:flex;flex-direction:row;position:relative;margin-bottom:%?40?%}.goods-sku-popup .layer .specification-wrapper .specification-wrapper-content .specification-header .specification-left[data-v-09f76367]{width:%?180?%;height:%?180?%;flex:0 0 %?180?%}.goods-sku-popup .layer .specification-wrapper .specification-wrapper-content .specification-header .specification-left .product-img[data-v-09f76367]{width:%?180?%;height:%?180?%}.goods-sku-popup .layer .specification-wrapper .specification-wrapper-content .specification-header .specification-right[data-v-09f76367]{flex:1;padding:0 %?35?% %?10?% %?28?%;box-sizing:border-box;display:flex;flex-direction:column;justify-content:flex-end;font-weight:500}.goods-sku-popup .layer .specification-wrapper .specification-wrapper-content .specification-header .specification-right .price-content[data-v-09f76367]{color:#fe560a;margin-bottom:%?10?%}.goods-sku-popup .layer .specification-wrapper .specification-wrapper-content .specification-header .specification-right .price-content .sign[data-v-09f76367]{font-size:%?28?%;margin-right:%?4?%}.goods-sku-popup .layer .specification-wrapper .specification-wrapper-content .specification-header .specification-right .price-content .price[data-v-09f76367]{margin-left:%?4?%;font-size:%?48?%}.goods-sku-popup .layer .specification-wrapper .specification-wrapper-content .specification-header .specification-right .price-content .price2[data-v-09f76367]{margin-left:%?4?%;font-size:%?36?%}.goods-sku-popup .layer .specification-wrapper .specification-wrapper-content .specification-header .specification-right .inventory[data-v-09f76367]{font-size:%?24?%;color:#525252;margin-bottom:%?14?%}.goods-sku-popup .layer .specification-wrapper .specification-wrapper-content .specification-header .specification-right .choose[data-v-09f76367]{font-size:%?24?%;color:#525252;min-height:%?32?%}.goods-sku-popup .layer .specification-wrapper .specification-wrapper-content .specification-content[data-v-09f76367]{font-weight:500}.goods-sku-popup .layer .specification-wrapper .specification-wrapper-content .specification-content .specification-item[data-v-09f76367]{margin-bottom:%?40?%}.goods-sku-popup .layer .specification-wrapper .specification-wrapper-content .specification-content .specification-item[data-v-09f76367]:last-child{margin-bottom:0}.goods-sku-popup .layer .specification-wrapper .specification-wrapper-content .specification-content .specification-item .item-title[data-v-09f76367]{margin-bottom:%?20?%;font-size:%?28?%;color:#999}.goods-sku-popup .layer .specification-wrapper .specification-wrapper-content .specification-content .specification-item .item-wrapper[data-v-09f76367]{display:flex;flex-direction:row;flex-flow:wrap;margin-bottom:%?-20?%}.goods-sku-popup .layer .specification-wrapper .specification-wrapper-content .specification-content .specification-item .item-wrapper .item-content[data-v-09f76367]{display:inline-block;padding:%?10?% %?35?%;font-size:%?24?%;border-radius:%?10?%;background-color:#fff;color:#333;margin-right:%?20?%;margin-bottom:%?20?%;border:%?2?% solid #f4f4f4;box-sizing:border-box}.goods-sku-popup .layer .specification-wrapper .specification-wrapper-content .specification-content .specification-item .item-wrapper .item-content.actived[data-v-09f76367]{border-color:#fe560a;color:#fe560a}.goods-sku-popup .layer .specification-wrapper .specification-wrapper-content .specification-content .specification-item .item-wrapper .item-content.noactived[data-v-09f76367]{color:#c8c9cc;background:#f2f3f5;border-color:#f2f3f5}.goods-sku-popup .layer .specification-wrapper .specification-wrapper-content .specification-content .number-box-view[data-v-09f76367]{display:flex;padding-top:%?20?%}.goods-sku-popup .layer .specification-wrapper .close[data-v-09f76367]{position:absolute;top:%?30?%;right:%?25?%;width:%?50?%;height:%?50?%;text-align:center;line-height:%?50?%}.goods-sku-popup .layer .specification-wrapper .close .close-item[data-v-09f76367]{width:%?40?%;height:%?40?%}.goods-sku-popup .layer .btn-wrapper[data-v-09f76367]{display:flex;width:100%;height:%?120?%;flex:0 0 %?120?%;align-items:center;justify-content:space-between;padding:0 %?26?%;box-sizing:border-box}.goods-sku-popup .layer .btn-wrapper .layer-btn[data-v-09f76367]{width:%?335?%;height:%?76?%;border-radius:%?38?%;color:#fff;line-height:%?76?%;text-align:center;font-weight:500;font-size:%?28?%}.goods-sku-popup .layer .btn-wrapper .layer-btn.add-cart[data-v-09f76367]{background:#ffbe46}.goods-sku-popup .layer .btn-wrapper .layer-btn.buy[data-v-09f76367]{background:#fe560a}.goods-sku-popup .layer .btn-wrapper .sure[data-v-09f76367]{margin:0 auto;width:95%;max-width:%?1200?%;height:%?80?%;border-radius:%?38?%;color:#fff;line-height:%?80?%;text-align:center;font-weight:500;font-size:%?28?%;background:#fe560a}.goods-sku-popup .layer .btn-wrapper .sure.add-cart[data-v-09f76367]{background:#ff9402}@-webkit-keyframes showPopup-data-v-09f76367{0%{opacity:0}100%{opacity:1}}@keyframes showPopup-data-v-09f76367{0%{opacity:0}100%{opacity:1}}@-webkit-keyframes hidePopup-data-v-09f76367{0%{opacity:1}100%{opacity:0}}@keyframes hidePopup-data-v-09f76367{0%{opacity:1}100%{opacity:0}}@-webkit-keyframes showLayer-data-v-09f76367{0%{-webkit-transform:translateY(120%);transform:translateY(120%)}100%{-webkit-transform:translateY(0);transform:translateY(0)}}@keyframes showLayer-data-v-09f76367{0%{-webkit-transform:translateY(120%);transform:translateY(120%)}100%{-webkit-transform:translateY(0);transform:translateY(0)}}@-webkit-keyframes hideLayer-data-v-09f76367{0%{-webkit-transform:translateY(0);transform:translateY(0)}100%{-webkit-transform:translateY(120%);transform:translateY(120%)}}@keyframes hideLayer-data-v-09f76367{0%{-webkit-transform:translateY(0);transform:translateY(0)}100%{-webkit-transform:translateY(120%);transform:translateY(120%)}}',""]),t.exports=e},a88a:function(t,e,o){"use strict";o.r(e);var i=o("de22"),a=o("76d4");for(var n in a)"default"!==n&&function(t){o.d(e,t,(function(){return a[t]}))}(n);o("3207");var r,s=o("f0c5"),c=Object(s["a"])(a["default"],i["b"],i["c"],!1,null,"7e1a60fc",null,!1,i["a"],r);e["default"]=c.exports},a98d:function(t,e,o){"use strict";o.r(e);var i=o("fee5"),a=o.n(i);for(var n in i)"default"!==n&&function(t){o.d(e,t,(function(){return i[t]}))}(n);e["default"]=a.a},cd09:function(t,e,o){"use strict";var i=o("9911"),a=o.n(i);a.a},db90:function(t,e,o){"use strict";function i(t){if("undefined"!==typeof Symbol&&Symbol.iterator in Object(t))return Array.from(t)}o("a4d3"),o("e01a"),o("d28b"),o("a630"),o("d3b7"),o("3ca3"),o("ddb0"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=i},dbbc:function(t,e,o){"use strict";var i=o("4ea4");Object.defineProperty(e,"__esModule",{value:!0}),e.specData=e.detail=e.list=void 0;var a=i(o("26a9")),n={list:"goods/list",detail:"goods/detail",specData:"goods/specData"},r=function(t){return a.default.get(n.list,t)};e.list=r;var s=function(t){return a.default.get(n.detail,{goodsId:t})};e.detail=s;var c=function(t){return a.default.get(n.specData,{goodsId:t})};e.specData=c},de22:function(t,e,o){"use strict";var i;o.d(e,"b",(function(){return a})),o.d(e,"c",(function(){return n})),o.d(e,"a",(function(){return i}));var a=function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("v-uni-view",{staticClass:"number-box"},[o("v-uni-view",{staticClass:"u-icon-minus",class:{"u-icon-disabled":t.disabled||t.inputVal<=t.min},style:{background:t.bgColor,height:t.inputHeight+"rpx",color:t.color,fontSize:t.size+"rpx",minHeight:"1.4em"},on:{touchstart:function(e){e.preventDefault(),arguments[0]=e=t.$handleEvent(e),t.btnTouchStart("minus")},touchend:function(e){e.stopPropagation(),e.preventDefault(),arguments[0]=e=t.$handleEvent(e),t.clearTimer.apply(void 0,arguments)}}},[o("v-uni-view",{staticClass:"num-btn",style:"font-size:"+(Number(t.size)+10)+"rpx"},[t._v("－")])],1),o("v-uni-input",{staticClass:"u-number-input",class:{"u-input-disabled":t.disabled},style:{color:t.color,fontSize:t.size+"rpx",background:t.bgColor,height:t.inputHeight+"rpx",width:t.inputWidth+"rpx"},attrs:{disabled:t.disabledInput||t.disabled,"cursor-spacing":t.getCursorSpacing,type:"number"},on:{blur:function(e){arguments[0]=e=t.$handleEvent(e),t.onBlur.apply(void 0,arguments)}},model:{value:t.inputVal,callback:function(e){t.inputVal=e},expression:"inputVal"}}),o("v-uni-view",{staticClass:"u-icon-plus",class:{"u-icon-disabled":t.disabled||t.inputVal>=t.max},style:{background:t.bgColor,height:t.inputHeight+"rpx",color:t.color,fontSize:t.size+"rpx",minHeight:"1.4em"},on:{touchstart:function(e){e.preventDefault(),arguments[0]=e=t.$handleEvent(e),t.btnTouchStart("plus")},touchend:function(e){e.stopPropagation(),e.preventDefault(),arguments[0]=e=t.$handleEvent(e),t.clearTimer.apply(void 0,arguments)}}},[o("v-uni-view",{staticClass:"num-btn",style:"font-size:"+(Number(t.size)+10)+"rpx"},[t._v("＋")])],1)],1)},n=[]},dee6:function(t,e,o){"use strict";var i;o.d(e,"b",(function(){return a})),o.d(e,"c",(function(){return n})),o.d(e,"a",(function(){return i}));var a=function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("v-uni-view",{staticClass:"goods-sku-popup",class:t.getValue()&&t.complete?"show":"none",attrs:{catchtouchmove:"true"},on:{touchmove:function(e){e.stopPropagation(),e.preventDefault(),arguments[0]=e=t.$handleEvent(e),t.moveHandle.apply(void 0,arguments)},click:function(e){e.stopPropagation(),arguments[0]=e=t.$handleEvent(e),t.stop.apply(void 0,arguments)}}},[o("v-uni-view",{staticClass:"mask",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.close("mask")}}}),o("v-uni-view",{staticClass:"layer attr-content",style:{borderRadius:t.borderRadius+"rpx "+t.borderRadius+"rpx 0 0"}},[o("v-uni-view",{staticClass:"specification-wrapper"},[o("v-uni-scroll-view",{staticClass:"specification-wrapper-content",attrs:{"scroll-y":"true"}},[o("v-uni-view",{staticClass:"specification-header"},[o("v-uni-view",{staticClass:"specification-left"},[o("v-uni-image",{staticClass:"product-img",style:{backgroundColor:t.goodsThumbBackgroundColor},attrs:{src:t.selectShop.image?t.selectShop.image:t.goodsInfo[t.goodsThumbName],mode:"aspectFill"},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.previewImage.apply(void 0,arguments)}}})],1),o("v-uni-view",{staticClass:"specification-right"},[o("v-uni-view",{staticClass:"price-content",style:{color:t.themeColorFn("priceColor")}},[o("v-uni-text",{staticClass:"sign"},[t._v("¥")]),o("v-uni-text",{staticClass:"price",class:t.priceCom.length>16?"price2":""},[t._v(t._s(t.priceCom))])],1),t.hideStock?o("v-uni-view",{staticClass:"inventory"}):o("v-uni-view",{staticClass:"inventory"},[t._v(t._s(t.stockText)+"："+t._s(t.stockCom))]),o("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.isManyCom,expression:"isManyCom"}],staticClass:"choose"},[t.selectArr.every((function(t){return""==t}))?t._e():o("v-uni-text",[t._v("已选："+t._s(t.selectArr.join(" ")))])],1)],1)],1),o("v-uni-view",{staticClass:"specification-content"},[t._l(t.goodsInfo[t.specListName],(function(e,i){return o("v-uni-view",{directives:[{name:"show",rawName:"v-show",value:t.isManyCom,expression:"isManyCom"}],key:i,staticClass:"specification-item"},[o("v-uni-view",{staticClass:"item-title"},[t._v(t._s(e.name))]),o("v-uni-view",{staticClass:"item-wrapper"},t._l(e.list,(function(e,a){return o("v-uni-view",{key:a,staticClass:"item-content",class:[e.ishow?"":"noactived",t.subIndex[i]==a?"actived":""],style:[e.ishow?"":t.themeColorFn("disableStyle"),e.ishow?t.themeColorFn("btnStyle"):"",t.subIndex[i]==a?t.themeColorFn("activedStyle"):""],on:{click:function(o){arguments[0]=o=t.$handleEvent(o),t.skuClick(e,i,a)}}},[t._v(t._s(e.name))])})),1)],1)})),o("v-uni-view",{staticClass:"number-box-view"},[o("v-uni-view",{staticStyle:{flex:"1"}},[t._v("数量")]),o("v-uni-view",{staticStyle:{flex:"4","text-align":"right"}},[o("number-box",{attrs:{min:t.minBuyNum||1,max:t.maxBuyNumCom,step:t.stepBuyNum||1,"step-strictly":t.stepStrictly,"positive-integer":!0},model:{value:t.selectNum,callback:function(e){t.selectNum=e},expression:"selectNum"}})],1)],1)],2)],1),0!=t.showClose?o("v-uni-view",{staticClass:"close",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.close("close")}}},[o("v-uni-image",{staticClass:"close-item",attrs:{src:t.closeImage}})],1):t._e()],1),t.outFoStock||4==t.mode?o("v-uni-view",{staticClass:"btn-wrapper"},[o("v-uni-view",{staticClass:"sure",staticStyle:{color:"#ffffff","background-color":"#cccccc"}},[t._v(t._s(t.noStockText))])],1):1==t.mode?o("v-uni-view",{staticClass:"btn-wrapper"},[o("v-uni-view",{staticClass:"sure add-cart",staticStyle:{"border-radius":"38rpx 0rpx 0rpx 38rpx"},style:{color:t.themeColorFn("addCartColor"),backgroundColor:t.themeColorFn("addCartBackgroundColor")},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.addCart.apply(void 0,arguments)}}},[t._v(t._s(t.addCartText))]),o("v-uni-view",{staticClass:"sure",staticStyle:{"border-radius":"0rpx 38rpx 38rpx 0rpx"},style:{color:t.themeColorFn("buyNowColor"),backgroundColor:t.themeColorFn("buyNowBackgroundColor")},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.buyNow.apply(void 0,arguments)}}},[t._v(t._s(t.buyNowText))])],1):2==t.mode?o("v-uni-view",{staticClass:"btn-wrapper"},[o("v-uni-view",{staticClass:"sure add-cart",style:{color:t.themeColorFn("addCartColor"),backgroundColor:t.themeColorFn("addCartBackgroundColor")},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.addCart.apply(void 0,arguments)}}},[t._v(t._s(t.addCartText))])],1):3==t.mode?o("v-uni-view",{staticClass:"btn-wrapper"},[o("v-uni-view",{staticClass:"sure",style:{color:t.themeColorFn("buyNowColor"),backgroundColor:t.themeColorFn("buyNowBackgroundColor")},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.buyNow.apply(void 0,arguments)}}},[t._v(t._s(t.buyNowText))])],1):t._e()],1)],1)},n=[]},fee5:function(t,e,o){"use strict";var i=o("4ea4");o("99af"),o("a623"),o("4de4"),o("c975"),o("d81d"),o("13d5"),o("a9e3"),o("acd8"),o("ac1f"),o("5319"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a=i(o("2909"));o("96cf");var n,r=i(o("1da1")),s=i(o("a88a")),c={},u={name:"GoodsSkuPopup",components:{NumberBox:s.default},emits:["update:modelValue","input","update-goods","open","close","add-cart","buy-now"],props:{value:{Type:Boolean,default:!1},modelValue:{Type:Boolean,default:!1},goodsId:{Type:String,default:""},action:{Type:String,default:""},noStockText:{Type:String,default:"该商品已抢完"},stockText:{Type:String,default:"库存"},goodsIdName:{Type:String,default:"_id"},skuIdName:{Type:String,default:"_id"},skuListName:{Type:String,default:"sku_list"},specListName:{Type:String,default:"spec_list"},stockName:{Type:String,default:"stock"},skuArrName:{Type:String,default:"sku_name_arr"},defaultSingleSkuName:{Type:String,default:"默认"},mode:{Type:Number,default:1},maskCloseAble:{Type:Boolean,default:!0},borderRadius:{Type:[String,Number],default:0},goodsThumbName:{Type:[String],default:"goods_thumb"},goodsThumbBackgroundColor:{Type:String,default:"#999999"},minBuyNum:{Type:[Number,String],default:1},maxBuyNum:{Type:[Number,String],default:1e5},stepBuyNum:{Type:[Number,String],default:1},stepStrictly:{Type:Boolean,default:!1},customAction:{Type:[Function],default:null},localdata:{type:Object},priceColor:{Type:String},buyNowText:{Type:String,default:"立即购买"},buyNowColor:{Type:String},buyNowBackgroundColor:{Type:String},addCartText:{Type:String,default:"加入购物车"},addCartColor:{Type:String},addCartBackgroundColor:{Type:String},disableStyle:{Type:Object,default:null},activedStyle:{Type:Object,default:null},btnStyle:{Type:Object,default:null},showClose:{Type:Boolean,default:!0},closeImage:{Type:String,default:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACoAAAAqCAYAAADFw8lbAAAEyUlEQVR42sSZeWwNURTGp4OqtBo7sSXELragdkpQsRRJ1Zr4hyJiJ9YgxNIg1qANiT+E1i5IY0kVVWtQEbuEKLFGUSH27/ANN5PXmTvzupzkl/tm8t6b7517lnvvC0lKSjJ8WmnQAUSDFqABqALKgl8gD7wE90E2SAeXwFf1SxISErQeVtKHwCgwFsSDSIf3hYFKoCkYDBaDdyAViHdueHmoF6FtwDLQ23b/E7gM7oIcejIERIDaoBFoC8qA8mA8SQNz6W1XC9GY+nCQCCYAk/c+gF0gBZwH312+IxR0BCPBUIaH2A+wHsxHCHxx+gLT5QGN6a2JfG8uvVCDws9oiDQYlxkMGfHyQvARlADTwcXk5OT6foV2kS8ATXidymlcyen1a/Jjl9IJh3hPkjELYqO8Cu0KjjNZvtETw5jFBWXPmGSTGQKSeOn5iQ0kVLL0CINfPNcPbDMKyRCbGzEMBJ+ZD8cChYFdqGTqfsWT8otPGoVsEHsMwxDFs3shNsxJ6BrQ0Po8OGUUkVHsNCVml+cntB1jUWwn2GEUsTEMrASbDK+2CCQ0kYX6nfLLisMmKqUr0S60M+jG10vAm+JSCa8+x7CKlzHwaktV6DiObzUzPJIxFO1BQ12wGtTReO9GetVgY/kjNJzZbcWmTjHfxw51AsRqvL8eOAtmsJuFu3g1l+1ZLB5eDTVZ3K0P7tL0TkWOpSg61kVkBtuuNRthGs+wtJST5aQI7cEbkkRXNYVKgX6kIdYuUhYzMQwxN8tiExCLFqHNeSF9/aem0BzGp5PYQCJ7c/Gsk1RfuSD6U1dNpcDf9ZigTmKbMRZ9iVTsHscGJluW2FMf1SSQWGnBmaB6kCJVTVVNJZE++Cx9drEllS1KMCINpURFmEbBWA63Fz9s95cGIdJgp/zXmT4pZcOvSUzuZttTbblmnc3PIjjmidDXvKgdhMh0JdbzuCjWrbNOVovjS5P7bkPJ/mBESkz2BO0166ybNeJ431S2q+01NntuIq3E0amzjiZtk9tssWyTDzO4525bACK9NAUn68TtkNhpEXpOSagRml+S6iLSSeweHv242Qhl13rRyvoDvDlKyTQny/ZQJ+1iH7vVbEx7OR5UiKVIO7VicgvHCtwrudloMIV7/0uadVYW57O4Wvvi8v4pymlKkrpwvsDeLLZAY2pkwbAB3PSQfC+4cH7l4k1ZH8zkZRq8ecO+Z5rN40JJqnXFuGfaxPCTLjcn0OZOpnArXw8HY4paIbw5CcMgXq6HN2/mt6+XGLrN15tBryIUGavMpCTrfKcDCKkAceA9S8nhAOehhSUyhXpkBxxnP4YM1InugP7cBkjBPcqVUWFYCEROxXiQz5JlXV+IfKh7mpfJac+lZ6V87QXVClBkTc7YWsWTPSDyitfzUTlJlj8TbvE6jluDOdwZ+jX57GLO3ADeuyZrDYi86vV81FD2UVGsmT+5Zl0BnkhoseOEaogL46pqO4v/IqUEyalIR4h85BgjHv6+aUWRMbb7EstX6O0cpT1Gco0ry8fWygLDMjmDnQeBt3Qe7uVfkeugDwVLcsVzGsuwLXbV+I63XNAkG5r/hvgRqgqWs6pJPKrsbvz/Q6yyun0w/h6lP+BnzrCpfPMT2L8FGAA7k1GZ/vnaqAAAAABJRU5ErkJggg=="},hideStock:{Type:Boolean,default:!1},theme:{Type:String,default:"default"},actionTips:{Type:String,default:"请求中..."},defaultSelect:{Type:Object},useCache:{Type:Boolean,default:!0},defaultGoods:{Type:Object},amountType:{Type:Number,default:1},selectedInit:{Type:Boolean,default:!1}},data:function(){return{complete:!1,goodsInfo:{},isShow:!1,initKey:!0,shopItemInfo:{},selectArr:[],subIndex:[],selectShop:{},selectNum:this.minBuyNum||1,outFoStock:!1,openTime:0,themeColor:{default:{priceColor:"rgb(254, 86, 10)",buyNowColor:"#ffffff",buyNowBackgroundColor:"rgb(254, 86, 10)",addCartColor:"#ffffff",addCartBackgroundColor:"rgb(255, 148, 2)",btnStyle:{color:"#333333",borderColor:"#f4f4f4",backgroundColor:"#ffffff"},activedStyle:{color:"rgb(254, 86, 10)",borderColor:"rgb(254, 86, 10)",backgroundColor:"rgba(254,86,10,0.1)"},disableStyle:{color:"#c3c3c3",borderColor:"#f6f6f6",backgroundColor:"#f6f6f6"}},"red-black":{priceColor:"rgb(255, 68, 68)",buyNowColor:"#ffffff",buyNowBackgroundColor:"rgb(255, 68, 68)",addCartColor:"#ffffff",addCartBackgroundColor:"rgb(85, 85, 85)",activedStyle:{color:"rgb(255, 68, 68)",borderColor:"rgb(255, 68, 68)",backgroundColor:"rgba(255,68,68,0.1)"}},"black-white":{priceColor:"rgb(47, 47, 52)",buyNowColor:"#ffffff",buyNowBackgroundColor:"rgb(47, 47, 52)",addCartColor:"rgb(47, 47, 52)",addCartBackgroundColor:"rgb(235, 236, 242)",activedStyle:{color:"rgb(47, 47, 52)",borderColor:"rgba(47,47,52,0.12)",backgroundColor:"rgba(47,47,52,0.12)"}},coffee:{priceColor:"rgb(195, 167, 105)",buyNowColor:"#ffffff",buyNowBackgroundColor:"rgb(195, 167, 105)",addCartColor:"rgb(195, 167, 105)",addCartBackgroundColor:"rgb(243, 238, 225)",activedStyle:{color:"rgb(195, 167, 105)",borderColor:"rgb(195, 167, 105)",backgroundColor:"rgba(195, 167, 105,0.1)"}},green:{priceColor:"rgb(99, 190, 114)",buyNowColor:"#ffffff",buyNowBackgroundColor:"rgb(99, 190, 114)",addCartColor:"rgb(99, 190, 114)",addCartBackgroundColor:"rgb(225, 244, 227)",activedStyle:{color:"rgb(99, 190, 114)",borderColor:"rgb(99, 190, 114)",backgroundColor:"rgba(99, 190, 114,0.1)"}}}}},created:function(){var t=this;n=t.vk,t.getValue()&&t.open()},mounted:function(){},methods:{init:function(t){var e=this;e.selectArr=[],e.subIndex=[],e.selectShop={},e.selectNum=e.minBuyNum||1,e.outFoStock=!1,e.shopItemInfo={};var o=e.specListName;e.goodsInfo[o].map((function(t){e.selectArr.push(""),e.subIndex.push(-1)})),e.checkItem(),e.checkInpath(-1),t||e.autoClickSku()},getValue:function(){return this.value},findGoodsInfo:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},e=this,o=t.useCache;if("undefined"==typeof n)return e.toast("custom-action必须是function","none"),!1;var i=e.actionTips,a="",r=!1;"custom"!==i?a=o?"":"请求中...":r=!o,n.callFunction({url:e.action,title:a,loading:r,data:{goods_id:e.goodsId},success:function(t){e.updateGoodsInfo(t.goodsInfo),c[e.goodsId]=t.goodsInfo,e.$emit("update-goods",t.goodsInfo)},fail:function(){e.updateValue(!1)}})},updateValue:function(t){var e=this;t?(e.$emit("open",!0),e.$emit("input",!0),e.$emit("update:modelValue",!0)):(e.$emit("input",!1),e.$emit("close","close"),e.$emit("update:modelValue",!1))},updateGoodsInfo:function(t){var e=this,o=e.skuListName;"{}"===JSON.stringify(e.goodsInfo)||e.goodsInfo[e.goodsIdName]!==t[e.goodsIdName]?(e.goodsInfo=t,e.initKey=!0):e.goodsInfo[o]=t[o],e.initKey&&(e.initKey=!1,e.init(e.isManyCom));var i=e.getListItem(e.goodsInfo[o],e.skuIdName,e.selectShop[e.skuIdName]);Object.assign(e.selectShop,i),e.defaultSelectSku(),e.complete=!0},open:function(){var t=this;return(0,r.default)(regeneratorRuntime.mark((function e(){var o,i,a,n,r,s;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:if(o=t,o.openTime=(new Date).getTime(),i=!0,o.skuListName,a=!1,n=c[o.goodsId],n&&o.useCache?(a=!0,o.updateGoodsInfo(n)):o.complete=!1,!o.customAction||"function"!==typeof o.customAction){e.next=33;break}return e.prev=8,e.next=11,o.customAction({useCache:a,goodsId:o.goodsId,goodsInfo:n,close:function(){setTimeout((function(){o.close()}),500)}}).catch((function(t){setTimeout((function(){o.close()}),500)}));case 11:n=e.sent,e.next=21;break;case 14:if(e.prev=14,e.t0=e["catch"](8),r=e.t0.message,s=void 0===r?"":r,!(s.indexOf(".catch is not a function")>-1)){e.next=21;break}return o.toast("custom-action必须返回一个Promise","none"),setTimeout((function(){o.close()}),500),e.abrupt("return",!1);case 21:if(c[o.goodsId]=n,!n||"object"!=typeof n||"{}"==JSON.stringify(n)){e.next=28;break}i=!1,o.updateGoodsInfo(n),o.updateValue(!0),e.next=31;break;case 28:return o.toast("未获取到商品信息","none"),o.$emit("input",!1),e.abrupt("return",!1);case 31:e.next=47;break;case 33:if("undefined"===typeof o.localdata||null===o.localdata){e.next=46;break}if(n=o.localdata,!n||"object"!=typeof n||"{}"==JSON.stringify(n)){e.next=41;break}i=!1,o.updateGoodsInfo(n),o.updateValue(!0),e.next=44;break;case 41:return o.toast("未获取到商品信息","none"),o.$emit("input",!1),e.abrupt("return",!1);case 44:e.next=47;break;case 46:i&&o.findGoodsInfo({useCache:a});case 47:case"end":return e.stop()}}),e,null,[[8,14]])})))()},close:function(t){var e=this;if((new Date).getTime()-e.openTime<400)return!1;"mask"==t?!1!==e.maskCloseAble&&(e.$emit("input",!1),e.$emit("close","mask"),e.$emit("update:modelValue",!1)):(e.$emit("input",!1),e.$emit("close","close"),e.$emit("update:modelValue",!1))},moveHandle:function(){},skuClick:function(t,e,o){var i=this;t.ishow&&(i.selectArr[e]!=t.name?(i.$set(i.selectArr,e,t.name),i.$set(i.subIndex,e,o)):(i.$set(i.selectArr,e,""),i.$set(i.subIndex,e,-1)),i.checkInpath(e),i.checkSelectShop())},checkSelectShop:function(){var t=this;if(t.selectArr.every((function(t){return""!=t}))){t.selectShop=t.shopItemInfo[t.getArrayToSting(t.selectArr)];var e=t.selectShop[t.stockName];"undefined"!==typeof e&&t.selectNum>e&&(t.selectNum=e),t.selectNum>t.maxBuyNum&&(t.selectNum=t.maxBuyNum),t.selectNum<t.minBuyNum&&(t.selectNum=t.minBuyNum),t.selectedInit&&(t.selectNum=t.minBuyNum||1)}else t.selectShop={}},checkInpath:function(t){for(var e=this,o=e.specListName,i=e.goodsInfo[o],n=0,r=i.length;n<r;n++)if(n!=t)for(var s=i[n].list.length,c=0;c<s;c++)if(-1==e.subIndex[n]||c!=e.subIndex[n]){var u=(0,a.default)(e.selectArr);e.$set(u,n,i[n].list[c].name);var l=u.filter((function(t){return""!==t&&"undefined"!==typeof t}));e.shopItemInfo.hasOwnProperty(e.getArrayToSting(l))?i[n].list[c].ishow=!0:i[n].list[c].ishow=!1}e.$set(e.goodsInfo,o,i)},checkItem:function(){var t=this,e=t.stockName,o=t.skuListName,i=t.goodsInfo[o],n=[],r=0;i.map((function(t,o){t[e]>0&&(n.push(t),r+=t[e])})),r<=0&&(t.outFoStock=!0);n.reduce((function(e,o){return e.concat(o[t.skuArrName].reduce((function(e,i){return e.concat(e.map((function(e){return t.shopItemInfo.hasOwnProperty(t.getArrayToSting([].concat((0,a.default)(e),[i])))||(t.shopItemInfo[t.getArrayToSting([].concat((0,a.default)(e),[i]))]=o),[].concat((0,a.default)(e),[i])})))}),[[]]))}),[[]])},getArrayToSting:function(t){var e="";return t.map((function(t,o){t=t.replace(/\./g,"。"),e+=0==o?t:","+t})),e},checkSelectComplete:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},e=this,o=(new Date).getTime();if(e.clickTime&&o-e.clickTime<400)return!1;e.clickTime=o;var i=e.selectShop,a=e.selectNum,n=e.stockText,r=e.stockName;return i&&i[e.skuIdName]?a<=0?(e.toast("购买数量必须>0","none"),!1):a>i[r]?(e.toast(n+"不足","none"),!1):void("function"==typeof t.success&&t.success(i)):(e.toast("请先选择对应规格","none"),!1)},addCart:function(){var t=this;t.checkSelectComplete({success:function(e){e.buy_num=t.selectNum,t.$emit("add-cart",e)}})},buyNow:function(){var t=this;t.checkSelectComplete({success:function(e){e.buy_num=t.selectNum,t.$emit("buy-now",e)}})},toast:function(t,e){uni.showToast({title:t,icon:e})},getListItem:function(t,e,o){var i;for(var a in t)if("object"==typeof o){if(JSON.stringify(t[a][e])===JSON.stringify(o)){i=t[a];break}}else if(t[a][e]===o){i=t[a];break}return i},getListIndex:function(t,e,o){for(var i=-1,a=0;a<t.length;a++)if(t[a][e]===o){i=a;break}return i},autoClickSku:function(){var t=this,e=t.goodsInfo[t.skuListName],o=t.goodsInfo[t.specListName];if(1==o.length)for(var i=o[0].list,a=0;a<i.length;a++){var n=t.getListItem(e,t.skuArrName,[i[a].name]);if(n){t.skuClick(i[a],0,a);break}}},themeColorFn:function(t){var e=this,o=e.theme,i=e.themeColor,a=e[t]?e[t]:i[o][t];return a},defaultSelectSku:function(){var t=this,e=t.defaultSelect;e&&e.sku&&e.sku.length>0&&t.selectSku(e)},selectSku:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},e=this,o=t.sku,i=t.num,a=e.goodsInfo[e.specListName];if(o&&a.length===o.length){for(var n=[],r=!0,s=0;s<o.length;s++){var c=o[s],u=a[s].list,l=s,p=e.getListIndex(u,"name",c);if(-1==p){r=!1;break}n.push({spec:u[p],index1:l,index2:p})}r&&(e.init(!0),n.map((function(t){e.skuClick(t.spec,t.index1,t.index2)})))}i>0&&(e.selectNum=i)},priceFilter:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:0,e=this;return"string"==typeof t&&(t=parseFloat(t)),0===e.amountType?t.toFixed(2):(t/100).toFixed(2)},pushGoodsCache:function(t){var e=this,o=e.goodsIdName;c[t[o]]=t},stop:function(){},previewImage:function(){var t=this,e=t.selectShop,o=t.goodsInfo,i=t.goodsThumbName,a=e.image?e.image:o[i];a&&uni.previewImage({urls:[a]})}},computed:{maxBuyNumCom:function(){var t=this,e=t.maxBuyNum||1e5,o=t.stockName;return t.selectShop&&"undefined"!==typeof t.selectShop[o]&&e>t.selectShop[o]&&(e=t.selectShop[o]),e},isManyCom:function(){var t=this,e=t.goodsInfo,o=t.defaultSingleSkuName,i=t.specListName,a=!0;return e[i]&&1===e[i].length&&1===e[i][0].list.length&&e[i][0].name===o&&(a=!1),a},priceCom:function(){var t="",e=this,o=e.selectShop,i=void 0===o?{}:o,a=e.goodsInfo,n=void 0===a?{}:a,r=e.skuListName,s=e.skuIdName;if(i[s])t=e.priceFilter(i.price);else{var c=n[r];if(c&&c.length>0){var u=[];c.map((function(t,e){u.push(t.price)}));var l=e.priceFilter(Math.min.apply(Math,u)),p=e.priceFilter(Math.max.apply(Math,u));t=l===p?l+"":"".concat(l," - ").concat(p)}}return t},stockCom:function(){var t="",e=this,o=e.selectShop,i=void 0===o?{}:o,a=e.goodsInfo,n=void 0===a?{}:a,r=e.skuListName,s=e.stockName;if(i[s])t=i[s];else{var c=n[r];if(c&&c.length>0){var u=[];c.map((function(t,e){u.push(t[s])}));var l=Math.min.apply(Math,u),p=Math.max.apply(Math,u);t=l===p?l:"".concat(l," - ").concat(p)}}return t}},watch:{value:function(t,e){var o=this;t&&o.open()},modelValue:function(t,e){var o=this;t&&o.open()},defaultGoods:{immediate:!0,handler:function(t,e){var o=this,i=o.goodsIdName;"object"===typeof t&&t&&t[i]&&!c[t[i]]&&o.pushGoodsCache(t)}}}};e.default=u}}]);