(window.webpackJsonpLHCReactAPPAdmin=window.webpackJsonpLHCReactAPPAdmin||[]).push([[5],{62:function(e,t,a){"use strict";a.r(t);var l=a(14),n=a.n(l),c=a(2),r=a.n(c),s=a(0),m=a.n(s),o=a(15),i=a.n(o),u=a(63),d=a(24),p=a.n(d),E=m.a.memo((function(e){var t=e.message,a=e.index,l=e.totalMessages,c=Object(s.useState)(!1),r=n()(c,2),o=r[0],i=r[1],u=Object(s.useState)(a+1==l),E=n()(u,2),b=E[0],f=E[1];Object(s.useEffect)((function(){}),[]);return m.a.createElement("div",{className:"row pb-2 mb-2 border-bottom"+(0==a?" border-top pt-2":"")},m.a.createElement("div",{className:"col-6 action-image",onClick:function(){return f(!b)}},m.a.createElement("span",{title:"Expand message "+t.id},m.a.createElement("i",{className:"material-icons"},b?"expand_less":"expand_more")),m.a.createElement("b",null,t.from_name),m.a.createElement("small",null," <",t.from_address,">"),m.a.createElement("small",null,m.a.createElement("span",{className:"text-muted action-image",onClick:function(e){e.stopPropagation(),i(!o)}},m.a.createElement("i",{className:"material-icons"},o?"expand_less":"expand_more")))),m.a.createElement("div",{className:"col-6 text-right text-muted"},m.a.createElement("small",{className:"pr-2"},t.udate_front," | ",t.udate_ago," ago."),m.a.createElement("i",{className:"material-icons settings text-muted"},"reply"),m.a.createElement("div",{className:"dropdown float-right"},m.a.createElement("i",{className:"material-icons settings text-muted",id:"message-id-"+t.id,"data-toggle":"dropdown","aria-haspopup":"true","aria-expanded":"false"},"more_vert"),m.a.createElement("div",{className:"dropdown-menu","aria-labelledby":"message-id-"+t.id},m.a.createElement("a",{className:"dropdown-item",href:"#"},"Action"),m.a.createElement("a",{className:"dropdown-item",href:"#"},"Another action"),m.a.createElement("a",{className:"dropdown-item",href:"#"},"Something else here")))),o&&m.a.createElement("div",{className:"col-12"},m.a.createElement("div",{className:"row"},m.a.createElement("div",{className:"col-6"},m.a.createElement("ul",{className:"fs13 text-muted"},m.a.createElement("li",null,"from: ",m.a.createElement("b",null,t.from_name)," <",t.from_address,">"),m.a.createElement("li",null,"to: ",t.toaddress),m.a.createElement("li",null,"reply-to: ",t.reply_toaddress),m.a.createElement("li",null,"mailed-by: ",t.from_host))),m.a.createElement("div",{className:"col-6"},m.a.createElement("ul",{className:"fs13 text-muted"},m.a.createElement("li",null,"Accepted at: ",t.accept_time_front),m.a.createElement("li",null,"Accepted by: ",t.plain_user_name),m.a.createElement("li",null,"Responded by: ",t.plain_user_name))))),b&&m.a.createElement("div",{className:"col-12 pt-2 pb-2"},p()(t.body_front,{replace:function(e){if(e.attribs){Object.assign({},e.attribs);if(e.attribs.class&&(e.attribs.className=e.attribs.class,delete e.attribs.class),e.attribs.style&&console.log((t=e.attribs.style,a={},t.split(";").forEach((function(e){var t=e.split(":"),l=n()(t,2),c=l[0],r=l[1];if(c){var s=function(e){var t=e.split("-");return 1===t.length?t[0]:t[0]+t.slice(1).map((function(e){return e[0].toUpperCase()+e.slice(1)})).join("")}(c.trim());a[s]=r.trim()}})),a)),e.name&&"blockquote"===e.name)return m.a.createElement("blockquote",e.attribs,Object(d.domToReact)(e.children))}var t,a}})),a+1==l&&m.a.createElement("div",{className:"btn-group mt-2",role:"group","aria-label":"Mail actions"},m.a.createElement("button",{type:"button",className:"btn btn-sm btn-outline-secondary"},m.a.createElement("i",{className:"material-icons"},"reply"),"Reply"),m.a.createElement("button",{type:"button",className:"btn btn-sm btn-outline-secondary"},m.a.createElement("i",{className:"material-icons"},"forward"),"Forward")))}));function b(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var l=Object.getOwnPropertySymbols(e);t&&(l=l.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,l)}return a}function f(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?b(Object(a),!0).forEach((function(t){r()(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):b(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}function v(e,t){switch(t.type){case"increment":return{count:e.count+1};case"decrement":return{count:e.count-1};case"update":return f({},e,{},t.value);case"update_messages":return t.messages.lmsop=e.lmsop||t.value.lmsop,(e=f({},e,{},t.value)).messages.push(t.messages),e;case"update_history":return e=f({},e,{},t.value),""!=t.history.msg&&e.messages.unshift(t.history),e;case"init":return{count:e.count-1};default:throw new Error("Unknown action!")}}t.default=function(e){Object(s.useRef)(null),Object(s.useRef)(null);var t=Object(s.useRef)(null),a=Object(s.useReducer)(v,{messages:[],operators:[],conv:null,loaded:!1,old_message_id:0,last_message:"",last_message_id:0,lmsop:0,lgsync:0}),l=n()(a,2),c=l[0],r=l[1];Object(s.useEffect)((function(){return i.a.post(WWW_DIR_JAVASCRIPT+"mailconv/loadmainconv/"+e.chatId).then((function(e){r({type:"update",value:{conv:e.data.conv,messages:e.data.messages,loaded:!0}})})).catch((function(e){})),function(){}}),[]),Object(s.useEffect)((function(){if(1==c.loaded)t.current}),[c.loaded]);var o=Object(u.a)("mail_chat");o.t,o.i18n;return 0==c.loaded?m.a.createElement("span",null,"..."):m.a.createElement(m.a.Fragment,null,m.a.createElement("div",{className:"row"},m.a.createElement("div",{className:"col-7 chat-main-left-column"},m.a.createElement("h1",{className:"pb-2"},m.a.createElement("i",{className:"material-icons"},1==c.conv.start_type?"call_made":"call_received"),c.conv.subject),m.a.createElement("div",null,c.messages.map((function(t,a){return m.a.createElement(E,{key:"msg_mail_"+e.chatId+"_"+a,totalMessages:c.messages.length,index:a,message:t})})))),m.a.createElement("div",{className:"chat-main-right-column col-5"},m.a.createElement("div",{role:"tabpanel"},m.a.createElement("ul",{className:"nav nav-pills",role:"tablist",ref:t},m.a.createElement("li",{role:"presentation",className:"nav-item"},m.a.createElement("a",{className:"nav-link active",href:"#mail-chat-info-"+e.chatId,"aria-controls":"#mail-chat-info-"+e.chatId,title:"Information",role:"tab","data-toggle":"tab"},m.a.createElement("i",{className:"material-icons mr-0"},"info_outline"))),m.a.createElement("li",{role:"presentation",className:"nav-item"},m.a.createElement("a",{className:"nav-link",href:"#mail-chat-"+e.chatId,"aria-controls":"#mail-chat-"+e.chatId,role:"tab","data-toggle":"tab",title:"Operators"},m.a.createElement("i",{className:"material-icons mr-0"},"face")))),m.a.createElement("div",{className:"tab-content"},m.a.createElement("div",{role:"tabpanel",className:"tab-pane",id:"mail-chat-"+e.chatId},"Other info"),m.a.createElement("div",{role:"tabpanel",className:"tab-pane active",id:"mail-chat-info-"+e.chatId},c.conv&&m.a.createElement("table",{className:"table table-sm"},m.a.createElement("tr",null,m.a.createElement("td",null,"Sender"),m.a.createElement("td",null,c.conv.from_address," <",c.conv.from_name,">")),m.a.createElement("tr",null,m.a.createElement("td",null,"Status"),m.a.createElement("td",null,!c.conv.status&&m.a.createElement("span",null,m.a.createElement("i",{className:"material-icons chat-pending"},"mail_outline"),"Pending"),1==c.conv.status&&m.a.createElement("span",null,m.a.createElement("i",{className:"material-icons chat-active"},"mail_outline"),"Active"),2==c.conv.status&&m.a.createElement("span",null,m.a.createElement("i",{className:"material-icons chat-closed"},"mail_outline"),"Closed"))),m.a.createElement("tr",null,m.a.createElement("td",null,"Department"),m.a.createElement("td",null,c.conv.department_name)),m.a.createElement("tr",null,m.a.createElement("td",null,"Received"),m.a.createElement("td",null,c.conv.udate_front)),m.a.createElement("tr",null,m.a.createElement("td",null,"ID"),m.a.createElement("td",null,c.conv.id)),c.conv.accept_time&&m.a.createElement("tr",null,m.a.createElement("td",null,"Accepted at"),m.a.createElement("td",null,c.conv.accept_time_front)),c.conv.cls_time&&m.a.createElement("tr",null,m.a.createElement("td",null,"Closed at"),m.a.createElement("td",null,c.conv.cls_time_front)),m.a.createElement("tr",null,m.a.createElement("td",null,"Chat owner"),m.a.createElement("td",null,c.conv.plain_user_name)))))))))}}}]);