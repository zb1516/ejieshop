(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-user-bind-index"],{"1e30":function(t,e,a){"use strict";var i=a("4ea4");Object.defineProperty(e,"__esModule",{value:!0}),e.image=r,e.sendSmsCaptcha=c;var n=i(a("26a9")),s={image:"captcha/image",sendSmsCaptcha:"captcha/sendSmsCaptcha"};function r(){return n.default.get(s.image,{},{load:!1})}function c(t){return n.default.post(s.sendSmsCaptcha,t,{load:!1})}},"243d":function(t,e,a){"use strict";var i=a("4ea4");Object.defineProperty(e,"__esModule",{value:!0}),e.bindMobile=e.assets=e.info=void 0;var n=i(a("5530")),s=i(a("26a9")),r={userInfo:"user/info",assets:"user/assets",bindMobile:"user/bindMobile"},c=function(t,e){var a=(0,n.default)({isPrompt:!0,load:!0},e);return s.default.get(r.userInfo,t,a)};e.info=c;var o=function(t,e){return s.default.get(r.assets,t,e)};e.assets=o;var u=function(t,e){return s.default.post(r.bindMobile,t,e)};e.bindMobile=u},3355:function(t,e,a){var i=a("947e");i.__esModule&&(i=i.default),"string"===typeof i&&(i=[[t.i,i,""]]),i.locals&&(t.exports=i.locals);var n=a("4f06").default;n("588d2618",i,!0,{sourceMap:!1,shadowMode:!1})},"62e4":function(t,e,a){"use strict";var i=a("3355"),n=a.n(i);n.a},"947e":function(t,e,a){var i=a("24fb");e=i(!1),e.push([t.i,'@charset "UTF-8";\r\n/**\r\n * 这里是uni-app内置的常用样式变量\r\n *\r\n * uni-app 官方扩展插件及插件市场（https://ext.dcloud.net.cn）上很多三方插件均使用了这些样式变量\r\n * 如果你是插件开发者，建议你使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\r\n *\r\n */\r\n/**\r\n * 如果你是App开发者（插件使用者），你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\r\n *\r\n * 如果你的项目同样使用了scss预处理，你也可以直接在你的 scss 代码中使用如下变量，同时无需 import 这个文件\r\n */\r\n/* 颜色变量 */\r\n/* 行为相关颜色 */\r\n/* 文字基本颜色 */\r\n/* 背景颜色 */\r\n/* 边框颜色 */\r\n/* 尺寸变量 */\r\n/* 文字尺寸 */\r\n/* 图片尺寸 */\r\n/* Border Radius */\r\n/* 水平间距 */\r\n/* 垂直间距 */\r\n/* 透明度 */\r\n/* 文章场景相关 */\r\n/* 引入uView全局scss变量文件 */.container[data-v-b82601cc]{padding:%?100?% %?60?%;min-height:100vh;background-color:#fff}.header[data-v-b82601cc]{margin-bottom:%?50?%}.header .title[data-v-b82601cc]{color:#191919;font-size:%?50?%}.header .sub-title[data-v-b82601cc]{margin-top:%?20?%;color:#b3b3b3;font-size:%?25?%}.form-item[data-v-b82601cc]{display:flex;padding:%?18?%;border-bottom:%?1?% solid #f3f1f2;margin-bottom:%?25?%;height:%?96?%}.form-item--input[data-v-b82601cc]{font-size:%?26?%;letter-spacing:%?1?%;flex:1;height:100%}.form-item--parts[data-v-b82601cc]{min-width:%?100?%;height:100%}.form-item .captcha[data-v-b82601cc]{height:100%}.form-item .captcha .image[data-v-b82601cc]{display:block;width:%?192?%;height:100%}.form-item .captcha-sms[data-v-b82601cc]{font-size:%?22?%;line-height:%?50?%;padding-right:%?20?%}.form-item .captcha-sms .activate[data-v-b82601cc]{color:#cea26a}.form-item .captcha-sms .un-activate[data-v-b82601cc]{color:#9e9e9e}.submit-button[data-v-b82601cc]{width:100%;height:%?86?%;margin-top:%?70?%;background:linear-gradient(90deg,#ecb53c,#ff9211);text-align:center;line-height:%?86?%;color:#fff;border-radius:%?80?%;box-shadow:0 10px 20px 0 rgba(0,0,0,.1);letter-spacing:%?5?%}',""]),t.exports=e},a22c:function(t,e,a){"use strict";var i;a.d(e,"b",(function(){return n})),a.d(e,"c",(function(){return s})),a.d(e,"a",(function(){return i}));var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-uni-view",{staticClass:"container"},[a("v-uni-view",{staticClass:"header"},[a("v-uni-view",{staticClass:"title"},[a("v-uni-text",[t._v("绑定您的手机号")])],1),a("v-uni-view",{staticClass:"sub-title"},[a("v-uni-text",[t._v("为了更好的服务您，请绑定手机号")])],1)],1),a("v-uni-view",{staticClass:"submit-form"},[a("v-uni-view",{staticClass:"form-item"},[a("v-uni-input",{staticClass:"form-item--input",attrs:{type:"number",maxlength:"11",placeholder:"请输入手机号码"},model:{value:t.mobile,callback:function(e){t.mobile=e},expression:"mobile"}})],1),a("v-uni-view",{staticClass:"form-item"},[a("v-uni-input",{staticClass:"form-item--input",attrs:{type:"text",maxlength:"5",placeholder:"请输入图形验证码"},model:{value:t.captchaCode,callback:function(e){t.captchaCode=e},expression:"captchaCode"}}),a("v-uni-view",{staticClass:"form-item--parts"},[a("v-uni-view",{staticClass:"captcha",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.getCaptcha()}}},[a("v-uni-image",{staticClass:"image",attrs:{src:t.captcha.base64}})],1)],1)],1),a("v-uni-view",{staticClass:"form-item"},[a("v-uni-input",{staticClass:"form-item--input",attrs:{type:"number",maxlength:"6",placeholder:"请输入短信验证码"},model:{value:t.smsCode,callback:function(e){t.smsCode=e},expression:"smsCode"}}),a("v-uni-view",{staticClass:"form-item--parts"},[a("v-uni-view",{staticClass:"captcha-sms",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.handelSmsCaptcha()}}},[t.smsState?a("v-uni-text",{staticClass:"un-activate"},[t._v("重新发送("+t._s(t.times)+")秒")]):a("v-uni-text",{staticClass:"activate"},[t._v("获取验证码")])],1)],1)],1),a("v-uni-view",{staticClass:"submit-button",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.handleSubmit()}}},[a("v-uni-text",[t._v("确认绑定")])],1)],1)],1)},s=[]},c29c:function(t,e,a){"use strict";a.r(e);var i=a("fe72"),n=a.n(i);for(var s in i)"default"!==s&&function(t){a.d(e,t,(function(){return i[t]}))}(s);e["default"]=n.a},d580:function(t,e,a){"use strict";a("ac1f"),a("466d"),a("498a"),Object.defineProperty(e,"__esModule",{value:!0}),e.isDouble=e.isInteger=e.isPositiveInteger=e.isNumber=e.isEmail=e.isMobile=e.isPhone=e.isEmpty=void 0;var i=function(t){return""==t.trim()};e.isEmpty=i;var n=function(t){var e=/^((0\d{2,3}-\d{7,8})|(1[3456789]\d{9}))$/;return e.test(t)};e.isPhone=n;var s=function(t){var e=/^(1[3456789]\d{9})$/;return e.test(t)};e.isMobile=s;var r=function(t){if(null==t||""==t)return!1;var e=t.match(/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/);return null!=e};e.isEmail=r;var c=function(t){return!(!l(t)&&!u(t))};e.isNumber=c;var o=function(t){return/(^[0-9]\d*$)/.test(t)};e.isPositiveInteger=o;var u=function(t){if(null==t||""==t)return!1;var e=t.match(/^[-\+]?\d+$/);return null!=e};e.isInteger=u;var l=function(t){if(null==t||""==t)return!1;var e=t.match(/^[-\+]?\d+(\.\d+)?$/);return null!=e};e.isDouble=l},e004:function(t,e,a){"use strict";a.r(e);var i=a("a22c"),n=a("c29c");for(var s in n)"default"!==s&&function(t){a.d(e,t,(function(){return n[t]}))}(s);a("62e4");var r,c=a("f0c5"),o=Object(c["a"])(n["default"],i["b"],i["c"],!1,null,"b82601cc",null,!1,i["a"],r);e["default"]=o.exports},fe72:function(t,e,a){"use strict";var i=a("dbce"),n=a("4ea4");a("a9e3"),a("d3b7"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;n(a("1b4b"));var s=i(a("243d")),r=i(a("1e30")),c=i(a("d580")),o=60,u=10,l=20,d={data:function(){return{isLoading:!1,captcha:{},smsState:!1,times:o,mobile:"",captchaCode:"",smsCode:""}},created:function(){this.getCaptcha()},methods:{getCaptcha:function(){var t=this;r.image().then((function(e){return t.captcha=e.data}))},handelSmsCaptcha:function(){var t=this;t.isLoading||t.smsState||!t.formValidation(u)||(t.sendSmsCaptcha(),t.getCaptcha())},formValidation:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:u,e=this;return!!(t!==u||e.validteMobile(e.mobile)&&e.validteCaptchaCode(e.captchaCode))&&!!(t!==l||e.validteMobile(e.mobile)&&e.validteSmsCode(e.smsCode))},validteMobile:function(t){return c.isEmpty(t)?(this.$toast("请先输入手机号"),!1):!!c.isMobile(t)||(this.$toast("请输入正确格式的手机号"),!1)},validteCaptchaCode:function(t){return!c.isEmpty(t)||(this.$toast("请先输入图形验证码"),!1)},validteSmsCode:function(t){return!c.isEmpty(t)||(this.$toast("请先输入短信验证码"),!1)},sendSmsCaptcha:function(){var t=this;t.isLoading=!0,r.sendSmsCaptcha({form:{captchaKey:t.captcha.key,captchaCode:t.captchaCode,mobile:t.mobile}}).then((function(e){t.$toast(e.message),t.timer()})).finally((function(){return t.isLoading=!1}))},timer:function(){var t=this;t.smsState=!0;var e=setInterval((function(){t.times=t.times-1,t.times<=0&&(t.smsState=!1,t.times=o,clearInterval(e))}),1e3)},handleSubmit:function(){var t=this;!t.isLoading&&t.formValidation(l)&&t.onSubmitEvent()},onSubmitEvent:function(){var t=this;t.isLoading=!0,s.bindMobile({form:{smsCode:t.smsCode,mobile:t.mobile}}).then((function(e){t.$toast(e.message),setTimeout((function(){t.onNavigateBack(1)}),2e3)})).finally((function(){return t.isLoading=!1}))},onNavigateBack:function(t){uni.navigateBack({delta:Number(t||1)})}}};e.default=d}}]);