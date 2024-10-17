"use strict";(self.webpackChunkLHCReactAPPAdmin=self.webpackChunkLHCReactAPPAdmin||[]).push([[605],{5605:(e,t,a)=>{a.r(t),a.d(t,{default:()=>v});var n=a(296),s=a(4467),c=a(6540),r=a(2505),l=a.n(r),i=a(900),o=function(e){var t=e.message,a=e.index,n=!1;return(0,i.Ay)(t.msg,{replace:function(e){if(e.attribs){var s=Object.assign({},e.attribs);if(e.attribs.class&&(e.attribs.className=e.attribs.class,-1!==e.attribs.className.indexOf("message-row")&&a>0&&(e.attribs.className+=" fade-in-fast",t.msop>0&&t.msop!=t.lmsop&&0==n&&(e.attribs.className+=" operator-changes",n=!0)),delete e.attribs.class),e.attribs.onclick&&delete e.attribs.onclick,e.name&&"img"===e.name)return c.createElement("img",e.attribs);if(e.name&&"a"===e.name&&s.onclick)return c.createElement("a",e.attribs,(0,i.zd)(e.children))}}})};const u=c.memo(o);a(9896);var m=a(3029),d=a(2901),h=new(function(){return(0,d.A)((function e(){(0,m.A)(this,e),this.eventEmitter=new EventEmitter,this.chatsSynchro=[],this.chatsSynchroMsg=[],this.timeoutSync=null,this.syncInProgress=!1,this.fetchStatus=!1}),[{key:"setFetchStatus",value:function(e){this.fetchStatus=e}},{key:"sync",value:function(){var e=this;1!=this.syncInProgress&&(this.syncInProgress=!0,l().post(WWW_DIR_JAVASCRIPT+"groupchat/sync"+(1==this.fetchStatus?"/(opt)/status":""),this.chatsSynchroMsg).then((function(t){e.fetchStatus=!1;var a=[];t.data.result.forEach((function(t){a[t.chat_id]||(a[t.chat_id]={}),a[t.chat_id].msg=t;var n=e.chatsSynchro.indexOf(t.chat_id),s=e.chatsSynchroMsg[n].split(",");s[1]=t.message_id,e.chatsSynchroMsg[n]=s.join(",")})),t.data.result_status.forEach((function(t){a[t.chat_id]||(a[t.chat_id]={}),a[t.chat_id].status=t;var n=e.chatsSynchro.indexOf(t.chat_id),s=e.chatsSynchroMsg[n].split(",");s[2]=t.lgsync,e.chatsSynchroMsg[n]=s.join(",")})),a.forEach((function(t,a){e.eventEmitter.emitEvent("gchat_"+a,[t])})),e.syncInProgress=!1})))}},{key:"startSync",value:function(){var e=this;clearTimeout(this.timeoutSync),this.chatsSynchro.length>0&&(this.timeoutSync=setInterval((function(){e.sync()}),2500))}},{key:"addSubscriber",value:function(e,t){this.chatsSynchro.push(parseInt(e)),this.chatsSynchroMsg.push(e+",0,0"),this.eventEmitter.addListener("gchat_"+e,t),this.startSync()}},{key:"removeSubscriber",value:function(e,t){var a=this.chatsSynchro.indexOf(parseInt(e));-1!==a&&(this.chatsSynchro.splice(a,1),this.chatsSynchroMsg.splice(a,1),this.eventEmitter.removeListener("gchat_"+e,t),this.startSync())}}])}()),p=a(8492);function b(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,n)}return a}function f(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?b(Object(a),!0).forEach((function(t){(0,s.A)(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):b(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}function g(e,t){switch(t.type){case"increment":return{count:e.count+1};case"decrement":case"init":return{count:e.count-1};case"update":return f(f({},e),t.value);case"update_messages":return t.messages.lmsop=e.lmsop||t.value.lmsop,(e=f(f({},e),t.value)).messages.push(t.messages),e;case"update_history":return e=f(f({},e),t.value),""!=t.history.msg&&e.messages.unshift(t.history),e;default:throw new Error("Unknown action!")}}l().defaults.headers.common["X-CSRFToken"]=confLH.csrf_token;const v=function(e){var t=(0,c.useRef)(null),s=(0,c.useRef)(null),r=(0,c.useRef)(null),i=(0,c.useRef)(null),o=(0,c.useReducer)(g,{messages:[],operators:[],supervistors:[],operators_invite:[],chat:{},has_more_messages:!1,old_message_id:0,last_message:"",error:"",last_message_id:0,lmsop:0,lgsync:0}),m=(0,n.A)(o,2),d=m[0],b=m[1],f=function(e){ee.emitEvent("angularStartChatOperatorPublic",[e.user_id])},v=function(e,t){var a,n=document.getElementById("chat-tab-link-"+e),s=!1;null!==n&&t>1&&!n.classList.contains("active")&&null!==(a=n.querySelector(".whatshot"))&&(a.classList.remove("d-none"),ee.emitEvent("supportUnreadChat",[{id:e,unread:!0}]),_(),s=!0),0==s&&null!==(n=document.getElementById("private-chat-tab-link-"+e))&&t>1&&!n.classList.contains("active")&&null!==(a=n.querySelector(".whatshot"))&&(a.classList.remove("d-none"),_())},_=function(){lhinst.playNewMessageSound()};(0,c.useEffect)((function(){if(s.current.scrollTop=s.current.scrollHeight,e.chatPublicId)v(e.chatPublicId,d.messages.length);else{var t=document.getElementById("chat-tab-link-gc"+e.chatId);t&&d.messages.length>1&&!t.classList.contains("active")&&(t.querySelector(".whatshot").classList.remove("d-none"),_())}}),[d.messages.length]);var y=null,E=function(){clearTimeout(y),y=setTimeout((function(){l().get(WWW_DIR_JAVASCRIPT+"groupchat/searchoperator/"+e.chatId+"?"+(e.chatPublicId?"id="+e.chatPublicId+"&":"")+"q="+escape(i.current.value)).then((function(e){b({type:"update",value:{operators_invite:e.data}})}))}),200)},I=function(){b({type:"update",value:{operators_invite:[]}})};(0,c.useEffect)((function(){var n=function(e){if(e.msg&&b({type:"update_messages",messages:{msg:e.msg.content,msop:e.msg.msop},value:{last_message_id:e.msg.message_id,lmsop:e.msg.lmsop}}),e.status){var t={operators:e.status.operators,lgsync:e.status.lgsync};e.status.old_message_id&&(t.has_more_messages=e.status.has_more_messages,t.old_message_id=e.status.old_message_id),b({type:"update",value:t})}},c=function(t){i(e.chatPublicId,null,!0)};l().post(WWW_DIR_JAVASCRIPT+"groupchat/"+(e.chatPublicId?"loadpublichat":"loadgroupchat")+"/"+(e.chatPublicId||e.chatId)).then((function(s){if(e.chatPublicId){var l=document.createElement("div");l.innerHTML='<i class="whatshot blink-ani d-none text-warning material-icons">whatshot</i>',document.getElementById("chat-tab-link-"+e.chatPublicId).prepend(l.firstChild),document.getElementById("private-chat-tab-link-"+e.chatPublicId).addEventListener("click",c)}else!function(e){if(localStorage)try{var t=[],a=localStorage.getItem("gachat_id");null!==a&&""!==a&&(t=a.split(",")),-1===t.indexOf(e)&&(t.push(e),localStorage.setItem("gachat_id",t.join(",")))}catch(e){}}(e.chatId);var i=document.getElementById("private-chat-tab-link-"+e.chatPublicId);if((e.paramsStart&&e.paramsStart.unread||null!==i&&"true"==i.getAttribute("data-unread"))&&v(e.chatPublicId,2),e.paramsStart&&e.paramsStart.default_message&&null!==t.current&&(t.current.focus(),t.current.value="[quote]"+e.paramsStart.default_message+"[/quote]\n"),e.chatId=String(s.data.chat.id),h.addSubscriber(e.chatId,n),h.sync(),!e.chatPublicId){var o=r.current,u=a(272),m=o.querySelectorAll('[data-bs-toggle="tab"]');m.length>0&&Array.prototype.forEach.call(m,(function(e){new u.Tab(e)}))}b({type:"update",value:{chat:s.data.chat,supervisors:s.data.supervisors||[]}})})).catch((function(t){!e.chatPublicId&&lhinst.removeDialogTabGroup("gc"+e.chatId,$("#tabs"),!0),t.response&&t.response.data&&t.response.data.error&&b({type:"update",value:{error:t.response.data.error}})}));var i=function(a,n,c){var r,l;(e.chatPublicId&&a==e.chatPublicId||!e.chatPublicId&&a==e.chatId)&&(null!==s.current&&setTimeout((function(){null!==s.current&&((!e.chatPublicId||c)&&t.current.focus(),s.current.scrollHeight-(s.current.scrollTop+s.current.offsetHeight)<s.current.offsetHeight-50&&(s.current.scrollTop=s.current.scrollHeight))}),2),null!==(r=document.getElementById(e.chatPublicId?"chat-tab-link-"+e.chatPublicId:"chat-tab-link-gc"+e.chatId))&&(null===(l=r.querySelector(".whatshot"))||l.classList.contains("d-none")||(l.classList.add("d-none"),e.chatPublicId&&document.getElementById("private-chat-tab-link-"+e.chatPublicId).click())),e.chatPublicId&&null!==(r=document.getElementById("private-chat-tab-link-"+e.chatPublicId))&&(null===(l=r.querySelector(".whatshot"))||l.classList.contains("d-none")||l.classList.add("d-none")))},o=function(a,n){e.chatPublicId&&a==e.chatPublicId&&t&&t.current&&(t.current.value="[quote]"+n+"[/quote]\n",t.current.focus())};return e.chatPublicId&&ee.addListener("groupChatPrefillMessage",o),ee.addListener(e.chatPublicId?"chatTabClicked":"groupChatTabClicked",i),!e.chatPublicId&&t.current.focus(),function(){!function(e){if(localStorage)try{var t=[],a=localStorage.getItem("gachat_id");null!==a&&""!==a&&(t=a.split(",")),-1!==t.indexOf(e)&&t.splice(t.indexOf(e),1),localStorage.setItem("gachat_id",t.join(","))}catch(e){}}(e.chatId),e.chatPublicId?(ee.removeListener("chatTabClicked",i),ee.removeListener("prefillMessage",o)):ee.removeListener("groupChatTabClicked",i),h.removeSubscriber(e.chatId,n)}}),[]);var N=function(t){l().get(WWW_DIR_JAVASCRIPT+"groupchat/inviteoperator/"+e.chatId+"/"+t.id).then((function(e){h.setFetchStatus(!0),h.sync(),t.invited=!0,b({type:"update",value:{operators_invite:d.operators_invite}})}))},S=function(t){l().get(WWW_DIR_JAVASCRIPT+"groupchat/cancelinvite/"+e.chatId+"/"+t.id).then((function(e){h.setFetchStatus(!0),h.sync(),t.invited=!1,b({type:"update",value:{operators_invite:d.operators_invite}})}))},P=(0,p.B)("group_chat"),k=P.t;return P.i18n,""!=d.error?c.createElement(c.Fragment,null,c.createElement("div",{className:"row"},c.createElement("div",{className:"col-12"},c.createElement("div",{className:"alert alert-info",role:"alert"},d.error)))):c.createElement(c.Fragment,null,c.createElement("div",{className:"row group-chat-"+(e.chatPublicId?"public":"private")},e.chatPublicId&&2==d.chat.type&&c.createElement("div",{className:"col-12 pb-1"},d.operators.map((function(t,a){return c.createElement("button",{className:"btn btn-sm fs12 btn-outline-secondary mb-1 me-1"},e.userId!=t.user_id&&c.createElement("i",{title:"Start chat with an operator directly",onClick:function(e){return f(t)},className:"material-icons action-image"},"chat")," ",d.chat.user_id==t.user_id&&c.createElement("i",{title:"Group owner",className:"material-icons"},"account_balance")," ",t.n_off_full,!t.jtime&&c.createElement("span",{className:"ms-1 badge badge-info fs11"},k("operator.pending_join"))," ",c.createElement("i",{className:"material-icons"},t.hide_online?"flash_off":"flash_on"),t.last_activity_ago)}))),c.createElement("div",{className:e.chatPublicId?"col-12":"col-7"},c.createElement("div",{className:"message-block"},d.has_more_messages&&c.createElement("a",{className:"load-prev-btn",title:"Load more...",onClick:function(t){l().get(WWW_DIR_JAVASCRIPT+"groupchat/loadpreviousmessages/"+e.chatId+"/"+d.old_message_id).then((function(e){b({type:"update_history",value:{has_more_messages:e.data.has_messages,old_message_id:e.data.message_id},history:{msg:e.data.result,msop:e.data.msop,lmsop:e.data.lmsop}})}))}},c.createElement("i",{className:"material-icons"},"")),c.createElement("div",{className:"msgBlock msgBlock-admin msgBlock-group-admin",ref:s},d.messages.map((function(t,a){return c.createElement(u,{key:"msg_"+e.chatId+"_"+a,index:a,message:t})})))),c.createElement("div",{className:"message-container-admin mt-2"},c.createElement("textarea",{ref:t,placeholder:k("message.enter_message"),onKeyDown:function(a){return function(a){if(13==a.keyCode)return l().post(WWW_DIR_JAVASCRIPT+"groupchat/addmessage/"+e.chatId,{msg:t.current.value}).then((function(e){-1!==e.data.result.indexOf("status")&&h.setFetchStatus(!0),h.sync()})),t.current.value="",a.preventDefault(),void a.stopPropagation()}(a)},className:"form-control form-control-sm form-group",rows:"2"}))),!e.chatPublicId&&c.createElement("div",{className:"chat-main-right-column col-5"},c.createElement("div",{role:"tabpanel"},c.createElement("ul",{className:"nav nav-pills",role:"tablist",ref:r},c.createElement("li",{role:"presentation",className:"nav-item"},c.createElement("a",{className:"nav-link active",href:"#group-chat-"+e.chatId,"aria-controls":"#group-chat-"+e.chatId,role:"tab","data-bs-toggle":"tab",title:"Operators"},c.createElement("i",{className:"material-icons me-0"},"face"))),c.createElement("li",{className:"nav-item",role:"presentation"},c.createElement("a",{className:"nav-link ",href:"#group-chat-info-"+e.chatId,"aria-controls":"#group-chat-info-"+e.chatId,title:"Information",role:"tab","data-bs-toggle":"tab"},c.createElement("i",{className:"material-icons me-0"},"info_outline")))),c.createElement("div",{className:"tab-content"},c.createElement("div",{role:"tabpanel",className:"tab-pane active",id:"group-chat-"+e.chatId},c.createElement("ul",{className:"list-group list-group-flush border-0 mw-100 mx275"},d.operators.map((function(t,a){return c.createElement("li",{className:"list-group-item ps-1 py-1"},e.userId!=t.user_id&&c.createElement("i",{title:"Start chat with an operator directly",onClick:function(e){return f(t)},className:"material-icons action-image"},"chat")," ",d.chat.user_id==t.user_id&&c.createElement("i",{title:"Group owner",className:"material-icons"},"account_balance")," ",t.n_off_full,c.createElement("span",{className:"float-end fs11"},!t.jtime&&c.createElement("span",{className:"badge badge-info fs11"},k("operator.pending_join"))," ",t.last_activity_ago," ",c.createElement("i",{className:"material-icons"},t.hide_online?"flash_off":"flash_on")))})))),c.createElement("div",{role:"tabpanel",className:"tab-pane",id:"group-chat-info-"+e.chatId},1==d.chat.type&&c.createElement("div",null,c.createElement("div",{className:"row"},c.createElement("div",{className:"col-9"},c.createElement("input",{ref:i,onKeyUp:E,type:"text",placeholder:k("operator.search_tip"),className:"form-control form-control-sm"})),c.createElement("div",{className:"col-3"},c.createElement("div",{className:"btn-group w-100",role:"group","aria-label":"Basic example"},c.createElement("button",{onClick:E,className:"btn d-block btn-secondary btn-sm"},c.createElement("span",{className:"material-icons"},"search")),c.createElement("button",{disabled:0==d.operators_invite.length,onClick:I,className:"btn d-block btn-secondary btn-sm"},c.createElement("span",{className:"material-icons"},"delete"))))),c.createElement("ul",{className:"m-0 p-0 mt-2 mx275"},d.operators_invite.map((function(e,t){return c.createElement("li",{className:"list-group-item p-2 fs13",title:e.id},e.name_official,!e.member&&!e.invited&&c.createElement("button",{className:"float-end btn btn-xs btn-secondary",onClick:function(t){return N(e)}},k("operator.invite")),!e.member&&e.invited&&c.createElement("button",{className:"float-end btn btn-xs btn-warning",onClick:function(t){return S(e)}},k("operator.cancel_invite")),e.member&&c.createElement("button",{disabled:"disabled",className:"float-end btn btn-xs btn-success"},k("operator.already_member")))}))),c.createElement("hr",null)),c.createElement("button",{className:"btn btn-xs btn-danger",title:k("operator.leave_group_tip"),onClick:function(t){l().get(WWW_DIR_JAVASCRIPT+"groupchat/leave/"+e.chatId).then((function(t){lhinst.removeDialogTabGroup("gc"+e.chatId,$("#tabs"),!0)}))}},k("operator.leave_group")))))),e.chatPublicId&&c.createElement("div",{className:"col-12"},c.createElement("div",{className:"pb-1"},e.chatPublicId&&2==d.chat.type&&d.supervisors.length>0&&d.supervisors.map((function(e,t){return c.createElement(c.Fragment,null,!e.member&&!e.invited&&c.createElement("button",{className:"btn btn-xs btn-secondary",onClick:function(t){return N(e)}},e.nick," | ",k("operator.invite")))}))),c.createElement("div",{className:"row"},c.createElement("div",{className:"col-9"},c.createElement("input",{ref:i,onKeyUp:E,type:"text",placeholder:k("operator.search_tip"),className:"form-control form-control-sm"})),c.createElement("div",{className:"col-3"},c.createElement("div",{className:"btn-group w-100",role:"group","aria-label":"Basic example"},c.createElement("button",{onClick:E,className:"btn d-block btn-secondary btn-sm"},c.createElement("span",{className:"material-icons"},"search")),c.createElement("button",{disabled:0==d.operators_invite.length,onClick:I,className:"btn d-block btn-secondary btn-sm"},c.createElement("span",{className:"material-icons"},"delete"))))),c.createElement("ul",{className:"m-0 p-0 mt-2 mx275"},d.operators_invite.map((function(e,t){return c.createElement("li",{className:"list-group-item p-2 fs13",title:e.id},e.name_official,!e.member&&!e.invited&&c.createElement("button",{className:"float-end btn btn-xs btn-secondary",onClick:function(t){return N(e)}},k("operator.invite")),!e.member&&e.invited&&c.createElement("button",{className:"float-end btn btn-xs btn-warning",onClick:function(t){return S(e)}},k("operator.cancel_invite")),e.member&&c.createElement("button",{disabled:"disabled",className:"float-end btn btn-xs btn-success"},k("operator.already_member")))}))))))}},9896:(e,t,a)=>{a.d(t,{A:()=>s});var n=a(6540);const s=function(e,t){var a=(0,n.useRef)();(0,n.useEffect)((function(){a.current=e}),[e]),(0,n.useEffect)((function(){if(null!==t){var e=setInterval((function(){a.current()}),t);return function(){return clearInterval(e)}}}),[t])}}}]);
//# sourceMappingURL=605.0dc446186fe61c6bc6e2.js.map