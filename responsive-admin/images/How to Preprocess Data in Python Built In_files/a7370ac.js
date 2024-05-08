(window.webpackJsonp=window.webpackJsonp||[]).push([[206,207],{1146:function(e,t,r){e.exports={}},1338:function(e,t,r){"use strict";r(1146)},1393:function(e,t,r){"use strict";r.r(t);var n=r(2),c=Object(n.b)({props:{article:{type:Object,required:!0},topic:{type:String,required:!0}}}),o=(r(1338),r(14)),component=Object(o.a)(c,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("li",{staticClass:"recent-articles-card"},[r("BixLink",{directives:[{name:"track-click",rawName:"v-track-click:recent_articles_widget",value:{article_id:e.article.id,category:e.topic,recommendation_strategy:"recent_articles"},expression:"{\n      article_id: article.id,\n      category: topic,\n      recommendation_strategy: 'recent_articles',\n    }",arg:"recent_articles_widget"}],staticClass:"rac-link",attrs:{href:e.article.alias,"data-test-id":"rac-link"}},[r("BixImg",{attrs:{src:e.article.thumbnail,width:"380",height:"210",alt:"",lazy:!0,"region-id":e.article.region_id,"drupal-src":!0}}),e._v(" "),r("div",{staticClass:"rac-title-container"},[r("h3",{staticClass:"rac-title"},[e._v(e._s(e.article.title))])]),e._v(" "),e._t("default")],2)],1)}),[],!1,null,"faefd838",null);t.default=component.exports;installComponents(component,{BixImg:r(161).default,BixLink:r(89).default})},1483:function(e,t,r){"use strict";r.d(t,"a",(function(){return l})),r.d(t,"b",(function(){return d}));var n=r(3),c=(r(40),r(8),r(26),r(16)),o=r(4),l=function(){var e=Object(n.a)(regeneratorRuntime.mark((function e(t){var r,n,o,l;return regeneratorRuntime.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return r=t.topic_id,n=t.region_id,o=t.limit,e.prev=1,e.next=4,fetch("".concat(c.a.RecentArticles,"?region_id=").concat(n,"&topic_id=").concat(r,"&limit=").concat(o));case 4:return l=e.sent,e.abrupt("return",l.json());case 8:return e.prev=8,e.t0=e.catch(1),e.abrupt("return",e.t0.response);case 11:case"end":return e.stop()}}),e,null,[[1,8]])})));return function(t){return e.apply(this,arguments)}}(),d=function(){var e=Object(n.a)(regeneratorRuntime.mark((function e(){var t;return regeneratorRuntime.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,fetch("".concat(c.a.RealtimeFeatureFlags,"?name=RecentArticles&region_id=").concat(o.b.getCurrentRegionID()));case 3:return t=e.sent,e.abrupt("return",t.json());case 7:return e.prev=7,e.t0=e.catch(0),e.abrupt("return",e.t0.response);case 10:case"end":return e.stop()}}),e,null,[[0,7]])})));return function(){return e.apply(this,arguments)}}()},1556:function(e,t,r){e.exports={}},1740:function(e,t,r){"use strict";r(1556)},1845:function(e,t,r){"use strict";r.r(t);var n=r(1),c=r(3),o=(r(40),r(90),r(8),r(22),r(62),r(23),r(52),r(20),r(29),r(18),r(30),r(2)),l=r(1483),d=r(663),f=r(4),v=r(459),track=r(103),m=r(146);function O(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function _(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?O(Object(r),!0).forEach((function(t){Object(n.a)(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):O(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}var j=Object(o.b)({setup:function(){var e=Object(o.k)(null),t=Object(o.j)({articles:[],topic:""});return Object(o.h)(Object(c.a)(regeneratorRuntime.mark((function r(){var n,c,o,O,_,j,y,h,w,k;return regeneratorRuntime.wrap((function(r){for(;;)switch(r.prev=r.next){case 0:if(r.prev=0,document.querySelector("body.page-node-type-blog-post")||document.querySelector("body.page-node-type-blog")){r.next=3;break}return r.abrupt("return");case 3:if(n=document.querySelector(".recent-articles-container"),c=document.querySelector('meta[name="keywords"]'),o=null==c?void 0:c.getAttribute("content"),!n||!e.value){r.next=22;break}return O=Object.assign({},d.AllowedTopics,d.AdditionalBlogTopics),_="",o&&(_=o.split(",")[0]||""),j="/".concat(Object(v.a)(_)),y=Object.keys(O).find((function(e){return O[e]===j}))||"",r.next=14,Object(l.b)();case 14:if(h=r.sent,!h.value){r.next=22;break}return w={region_id:Object(f.e)(),topic_id:y,limit:4},r.next=20,Object(l.a)(w);case 20:k=r.sent,Array.isArray(k)&&k.length?(t.articles=k.filter((function(data){return data.alias!==Object(f.d)()})).slice(0,3),t.topic=Object(m.h)(_,{ALLOWED_TAGS:["a"]}),n.appendChild(e.value),track.a.logEvent("recent_articles_widget_view",{category:t.topic,articles:k.map((function(article){return article.id}))})):t.articles=[];case 22:r.next=27;break;case 24:r.prev=24,r.t0=r.catch(0),console.error(r.t0);case 27:case"end":return r.stop()}}),r,null,[[0,24]])})))),_(_({},Object(o.m)(t)),{},{recentArticlesContent:e})}}),y=(r(1740),r(14)),component=Object(y.a)(j,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("section",{ref:"recentArticlesContent",staticClass:"recent-articles"},[e.articles.length?r("div",{staticClass:"recent-articles-wrapper"},[r("h2",[e._v("\n      Recent "),r("span",{domProps:{innerHTML:e._s(e.topic)}},[e._v(e._s(e.topic))]),e._v(" articles\n    ")]),e._v(" "),r("ul",{staticClass:"recent-articles-list"},e._l(e.articles,(function(article){return r("RecentArticlesCard",{key:article.title,attrs:{article:article,topic:e.topic}})})),1)]):e._e()])}),[],!1,null,"9015443c",null);t.default=component.exports;installComponents(component,{RecentArticlesCard:r(1393).default})}}]);