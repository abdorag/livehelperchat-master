(window.webpackJsonpLHCReactAPPAdmin=window.webpackJsonpLHCReactAPPAdmin||[]).push([[5],{64:function(e,t,a){"use strict";a.r(t);var n=a(14),l=a.n(n),c=a(2),r=a.n(c),s=a(0),o=a.n(s),m=a(15),i=a.n(m),u=a(65),d=(a(24),o.a.memo((function(e){e.message,e.index;return o.a.createElement("p",null,"Mail chat message")})));function p(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,n)}return a}function f(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?p(Object(a),!0).forEach((function(t){r()(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):p(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}function v(e,t){switch(t.type){case"increment":return{count:e.count+1};case"decrement":return{count:e.count-1};case"update":return f({},e,{},t.value);case"update_messages":return t.messages.lmsop=e.lmsop||t.value.lmsop,(e=f({},e,{},t.value)).messages.push(t.messages),e;case"update_history":return e=f({},e,{},t.value),""!=t.history.msg&&e.messages.unshift(t.history),e;case"init":return{count:e.count-1};default:throw new Error("Unknown action!")}}t.default=function(e){Object(s.useRef)(null),Object(s.useRef)(null);var t=Object(s.useRef)(null),n=Object(s.useReducer)(v,{messages:[],operators:[],conv:null,has_more_messages:!1,old_message_id:0,last_message:"",last_message_id:0,lmsop:0,lgsync:0}),c=l()(n,2),r=c[0],m=c[1];Object(s.useEffect)((function(){i.a.post(WWW_DIR_JAVASCRIPT+"mailconv/loadmainconv/"+e.chatId).then((function(e){m({type:"update",value:{conv:e.data.conv,messages:e.data.messages}})})).catch((function(e){}));var n=t.current,l=a(27),c=n.querySelectorAll('[data-toggle="tab"]');return c.length>0&&Array.prototype.forEach.call(c,(function(e){new l.Tab(e)})),function(){}}),[]);var p=Object(u.a)("mail_chat");p.t,p.i18n;return console.log(r.conv),o.a.createElement(o.a.Fragment,null,o.a.createElement("div",{className:"row"},o.a.createElement("div",{className:"col-7 chat-main-left-column"},o.a.createElement("div",null,r.messages.map((function(t,a){return o.a.createElement(d,{key:"msg_mail_"+e.chatId+"_"+a,index:a,message:t})})))),o.a.createElement("div",{className:"chat-main-right-column col-5"},o.a.createElement("div",{role:"tabpanel"},o.a.createElement("ul",{className:"nav nav-pills",role:"tablist",ref:t},o.a.createElement("li",{role:"presentation",className:"nav-item"},o.a.createElement("a",{className:"nav-link active",href:"#mail-chat-info-"+e.chatId,"aria-controls":"#mail-chat-info-"+e.chatId,title:"Information",role:"tab","data-toggle":"tab"},o.a.createElement("i",{className:"material-icons mr-0"},"info_outline"))),o.a.createElement("li",{role:"presentation",className:"nav-item"},o.a.createElement("a",{className:"nav-link",href:"#mail-chat-"+e.chatId,"aria-controls":"#mail-chat-"+e.chatId,role:"tab","data-toggle":"tab",title:"Operators"},o.a.createElement("i",{className:"material-icons mr-0"},"face")))),o.a.createElement("div",{className:"tab-content"},o.a.createElement("div",{role:"tabpanel",className:"tab-pane",id:"mail-chat-"+e.chatId},"Other info"),o.a.createElement("div",{role:"tabpanel",className:"tab-pane active",id:"mail-chat-info-"+e.chatId},r.conv&&o.a.createElement("table",{className:"table table-sm"},o.a.createElement("tr",null,o.a.createElement("td",null,"Sender"),o.a.createElement("td",null,r.conv.from_address," <",r.conv.from_name,">")),o.a.createElement("tr",null,o.a.createElement("td",null,"Received"),o.a.createElement("td",null,r.conv.udate_front)),o.a.createElement("tr",null,o.a.createElement("td",null,"ID"),o.a.createElement("td",null,r.conv.id)),o.a.createElement("tr",null,o.a.createElement("td",null,"Chat owner"),o.a.createElement("td",null,r.conv.plain_user_name)))))))))}}}]);