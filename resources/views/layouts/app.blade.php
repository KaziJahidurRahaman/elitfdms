<!DOCTYPE html>
<html lang="en">
<head>
  <title>Failed Delivery Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{asset('images/favicon.png')}}" rel="shortcut icon" type="image/png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!--<script src="{{ asset('js/jquery.min.js')}}"></script>-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
  <script>!function(e){e(["jquery"],function(e){return function(){function t(e,t,n){return g({type:O.error,iconClass:m().iconClasses.error,message:e,optionsOverride:n,title:t})}function n(t,n){return t||(t=m()),v=e("#"+t.containerId),v.length?v:(n&&(v=d(t)),v)}function o(e,t,n){return g({type:O.info,iconClass:m().iconClasses.info,message:e,optionsOverride:n,title:t})}function s(e){C=e}function i(e,t,n){return g({type:O.success,iconClass:m().iconClasses.success,message:e,optionsOverride:n,title:t})}function a(e,t,n){return g({type:O.warning,iconClass:m().iconClasses.warning,message:e,optionsOverride:n,title:t})}function r(e,t){var o=m();v||n(o),u(e,o,t)||l(o)}function c(t){var o=m();return v||n(o),t&&0===e(":focus",t).length?void h(t):void(v.children().length&&v.remove())}function l(t){for(var n=v.children(),o=n.length-1;o>=0;o--)u(e(n[o]),t)}function u(t,n,o){var s=!(!o||!o.force)&&o.force;return!(!t||!s&&0!==e(":focus",t).length)&&(t[n.hideMethod]({duration:n.hideDuration,easing:n.hideEasing,complete:function(){h(t)}}),!0)}function d(t){return v=e("<div/>").attr("id",t.containerId).addClass(t.positionClass),v.appendTo(e(t.target)),v}function p(){return{tapToDismiss:!0,toastClass:"toast",containerId:"toast-container",debug:!1,showMethod:"fadeIn",showDuration:100,showEasing:"swing",onShown:void 0,hideMethod:"fadeOut",hideDuration:500,hideEasing:"swing",onHidden:void 0,closeMethod:!1,closeDuration:!1,closeEasing:!1,closeOnHover:!0,extendedTimeOut:1e3,iconClasses:{error:"toast-error",info:"toast-info",success:"toast-success",warning:"toast-warning"},iconClass:"toast-info",positionClass:"toast-top-center",timeOut:5e3,titleClass:"toast-title",messageClass:"toast-message",escapeHtml:!1,target:"body",closeHtml:'<button type="button">&times;</button>',closeClass:"toast-close-button",newestOnTop:!0,preventDuplicates:!1,progressBar:!1,progressClass:"toast-progress",rtl:!1}}function f(e){C&&C(e)}function g(t){function o(e){return null==e&&(e=""),e.replace(/&/g,"&amp;").replace(/"/g,"&quot;").replace(/'/g,"&#39;").replace(/</g,"&lt;").replace(/>/g,"&gt;")}function s(){c(),u(),d(),p(),g(),C(),l(),i()}function i(){var e="";switch(t.iconClass){case"toast-success":case"toast-info":e="polite";break;default:e="assertive"}I.attr("aria-live",e)}function a(){E.closeOnHover&&I.hover(H,D),!E.onclick&&E.tapToDismiss&&I.click(b),E.closeButton&&j&&j.click(function(e){e.stopPropagation?e.stopPropagation():void 0!==e.cancelBubble&&e.cancelBubble!==!0&&(e.cancelBubble=!0),E.onCloseClick&&E.onCloseClick(e),b(!0)}),E.onclick&&I.click(function(e){E.onclick(e),b()})}function r(){I.hide(),I[E.showMethod]({duration:E.showDuration,easing:E.showEasing,complete:E.onShown}),E.timeOut>0&&(k=setTimeout(b,E.timeOut),F.maxHideTime=parseFloat(E.timeOut),F.hideEta=(new Date).getTime()+F.maxHideTime,E.progressBar&&(F.intervalId=setInterval(x,10)))}function c(){t.iconClass&&I.addClass(E.toastClass).addClass(y)}function l(){E.newestOnTop?v.prepend(I):v.append(I)}function u(){if(t.title){var e=t.title;E.escapeHtml&&(e=o(t.title)),M.append(e).addClass(E.titleClass),I.append(M)}}function d(){if(t.message){var e=t.message;E.escapeHtml&&(e=o(t.message)),B.append(e).addClass(E.messageClass),I.append(B)}}function p(){E.closeButton&&(j.addClass(E.closeClass).attr("role","button"),I.prepend(j))}function g(){E.progressBar&&(q.addClass(E.progressClass),I.prepend(q))}function C(){E.rtl&&I.addClass("rtl")}function O(e,t){if(e.preventDuplicates){if(t.message===w)return!0;w=t.message}return!1}function b(t){var n=t&&E.closeMethod!==!1?E.closeMethod:E.hideMethod,o=t&&E.closeDuration!==!1?E.closeDuration:E.hideDuration,s=t&&E.closeEasing!==!1?E.closeEasing:E.hideEasing;if(!e(":focus",I).length||t)return clearTimeout(F.intervalId),I[n]({duration:o,easing:s,complete:function(){h(I),clearTimeout(k),E.onHidden&&"hidden"!==P.state&&E.onHidden(),P.state="hidden",P.endTime=new Date,f(P)}})}function D(){(E.timeOut>0||E.extendedTimeOut>0)&&(k=setTimeout(b,E.extendedTimeOut),F.maxHideTime=parseFloat(E.extendedTimeOut),F.hideEta=(new Date).getTime()+F.maxHideTime)}function H(){clearTimeout(k),F.hideEta=0,I.stop(!0,!0)[E.showMethod]({duration:E.showDuration,easing:E.showEasing})}function x(){var e=(F.hideEta-(new Date).getTime())/F.maxHideTime*100;q.width(e+"%")}var E=m(),y=t.iconClass||E.iconClass;if("undefined"!=typeof t.optionsOverride&&(E=e.extend(E,t.optionsOverride),y=t.optionsOverride.iconClass||y),!O(E,t)){T++,v=n(E,!0);var k=null,I=e("<div/>"),M=e("<div/>"),B=e("<div/>"),q=e("<div/>"),j=e(E.closeHtml),F={intervalId:null,hideEta:null,maxHideTime:null},P={toastId:T,state:"visible",startTime:new Date,options:E,map:t};return s(),r(),a(),f(P),E.debug&&console&&console.log(P),I}}function m(){return e.extend({},p(),b.options)}function h(e){v||(v=n()),e.is(":visible")||(e.remove(),e=null,0===v.children().length&&(v.remove(),w=void 0))}var v,C,w,T=0,O={error:"error",info:"info",success:"success",warning:"warning"},b={clear:r,remove:c,error:t,getContainer:n,info:o,options:{},subscribe:s,success:i,version:"2.1.3",warning:a};return b}()})}("function"==typeof define&&define.amd?define:function(e,t){"undefined"!=typeof module&&module.exports?module.exports=t(require("jquery")):window.toastr=t(window.jQuery)});</script>
  
<style>

.toast-title{font-weight:700}.toast-message{-ms-word-wrap:break-word;word-wrap:break-word}.toast-message a,.toast-message label{color:#FFF}.toast-message a:hover{color:#CCC;text-decoration:none}.toast-close-button{position:relative;right:-.3em;top:-.3em;float:right;font-size:20px;font-weight:700;color:#FFF;-webkit-text-shadow:0 1px 0 #fff;text-shadow:0 1px 0 #fff;opacity:.8;-ms-filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=80);filter:alpha(opacity=80);line-height:1}.toast-close-button:focus,.toast-close-button:hover{color:#000;text-decoration:none;cursor:pointer;opacity:.4;-ms-filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=40);filter:alpha(opacity=40)}.rtl .toast-close-button{left:-.3em;float:left;right:.3em}button.toast-close-button{padding:0;cursor:pointer;background:0 0;border:0;-webkit-appearance:none}.toast-top-center{top:0;right:0;width:100%}.toast-bottom-center{bottom:0;right:0;width:100%}.toast-top-full-width{top:0;right:0;width:100%}.toast-bottom-full-width{bottom:0;right:0;width:100%}.toast-top-left{top:12px;left:12px}.toast-top-right{top:12px;right:12px}.toast-bottom-right{right:12px;bottom:12px}.toast-bottom-left{bottom:12px;left:12px}#toast-container{position:fixed;z-index:999999;pointer-events:none}#toast-container *{-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box}#toast-container>div{position:relative;pointer-events:auto;overflow:hidden;margin:0 0 6px;padding:15px 15px 15px 50px;width:300px;-moz-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;background-position:15px center;background-repeat:no-repeat;-moz-box-shadow:0 0 12px #999;-webkit-box-shadow:0 0 12px #999;box-shadow:0 0 12px #999;color:#FFF;opacity:.8;-ms-filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=80);filter:alpha(opacity=80)}#toast-container>div.rtl{direction:rtl;padding:15px 50px 15px 15px;background-position:right 15px center}#toast-container>div:hover{-moz-box-shadow:0 0 12px #000;-webkit-box-shadow:0 0 12px #000;box-shadow:0 0 12px #000;opacity:1;-ms-filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=100);filter:alpha(opacity=100);cursor:pointer}#toast-container>.toast-info{background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAGwSURBVEhLtZa9SgNBEMc9sUxxRcoUKSzSWIhXpFMhhYWFhaBg4yPYiWCXZxBLERsLRS3EQkEfwCKdjWJAwSKCgoKCcudv4O5YLrt7EzgXhiU3/4+b2ckmwVjJSpKkQ6wAi4gwhT+z3wRBcEz0yjSseUTrcRyfsHsXmD0AmbHOC9Ii8VImnuXBPglHpQ5wwSVM7sNnTG7Za4JwDdCjxyAiH3nyA2mtaTJufiDZ5dCaqlItILh1NHatfN5skvjx9Z38m69CgzuXmZgVrPIGE763Jx9qKsRozWYw6xOHdER+nn2KkO+Bb+UV5CBN6WC6QtBgbRVozrahAbmm6HtUsgtPC19tFdxXZYBOfkbmFJ1VaHA1VAHjd0pp70oTZzvR+EVrx2Ygfdsq6eu55BHYR8hlcki+n+kERUFG8BrA0BwjeAv2M8WLQBtcy+SD6fNsmnB3AlBLrgTtVW1c2QN4bVWLATaIS60J2Du5y1TiJgjSBvFVZgTmwCU+dAZFoPxGEEs8nyHC9Bwe2GvEJv2WXZb0vjdyFT4Cxk3e/kIqlOGoVLwwPevpYHT+00T+hWwXDf4AJAOUqWcDhbwAAAAASUVORK5CYII=)!important}#toast-container>.toast-error{background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAHOSURBVEhLrZa/SgNBEMZzh0WKCClSCKaIYOED+AAKeQQLG8HWztLCImBrYadgIdY+gIKNYkBFSwu7CAoqCgkkoGBI/E28PdbLZmeDLgzZzcx83/zZ2SSXC1j9fr+I1Hq93g2yxH4iwM1vkoBWAdxCmpzTxfkN2RcyZNaHFIkSo10+8kgxkXIURV5HGxTmFuc75B2RfQkpxHG8aAgaAFa0tAHqYFfQ7Iwe2yhODk8+J4C7yAoRTWI3w/4klGRgR4lO7Rpn9+gvMyWp+uxFh8+H+ARlgN1nJuJuQAYvNkEnwGFck18Er4q3egEc/oO+mhLdKgRyhdNFiacC0rlOCbhNVz4H9FnAYgDBvU3QIioZlJFLJtsoHYRDfiZoUyIxqCtRpVlANq0EU4dApjrtgezPFad5S19Wgjkc0hNVnuF4HjVA6C7QrSIbylB+oZe3aHgBsqlNqKYH48jXyJKMuAbiyVJ8KzaB3eRc0pg9VwQ4niFryI68qiOi3AbjwdsfnAtk0bCjTLJKr6mrD9g8iq/S/B81hguOMlQTnVyG40wAcjnmgsCNESDrjme7wfftP4P7SP4N3CJZdvzoNyGq2c/HWOXJGsvVg+RA/k2MC/wN6I2YA2Pt8GkAAAAASUVORK5CYII=)!important}#toast-container>.toast-success{background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAADsSURBVEhLY2AYBfQMgf///3P8+/evAIgvA/FsIF+BavYDDWMBGroaSMMBiE8VC7AZDrIFaMFnii3AZTjUgsUUWUDA8OdAH6iQbQEhw4HyGsPEcKBXBIC4ARhex4G4BsjmweU1soIFaGg/WtoFZRIZdEvIMhxkCCjXIVsATV6gFGACs4Rsw0EGgIIH3QJYJgHSARQZDrWAB+jawzgs+Q2UO49D7jnRSRGoEFRILcdmEMWGI0cm0JJ2QpYA1RDvcmzJEWhABhD/pqrL0S0CWuABKgnRki9lLseS7g2AlqwHWQSKH4oKLrILpRGhEQCw2LiRUIa4lwAAAABJRU5ErkJggg==)!important}#toast-container>.toast-warning{background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAGYSURBVEhL5ZSvTsNQFMbXZGICMYGYmJhAQIJAICYQPAACiSDB8AiICQQJT4CqQEwgJvYASAQCiZiYmJhAIBATCARJy+9rTsldd8sKu1M0+dLb057v6/lbq/2rK0mS/TRNj9cWNAKPYIJII7gIxCcQ51cvqID+GIEX8ASG4B1bK5gIZFeQfoJdEXOfgX4QAQg7kH2A65yQ87lyxb27sggkAzAuFhbbg1K2kgCkB1bVwyIR9m2L7PRPIhDUIXgGtyKw575yz3lTNs6X4JXnjV+LKM/m3MydnTbtOKIjtz6VhCBq4vSm3ncdrD2lk0VgUXSVKjVDJXJzijW1RQdsU7F77He8u68koNZTz8Oz5yGa6J3H3lZ0xYgXBK2QymlWWA+RWnYhskLBv2vmE+hBMCtbA7KX5drWyRT/2JsqZ2IvfB9Y4bWDNMFbJRFmC9E74SoS0CqulwjkC0+5bpcV1CZ8NMej4pjy0U+doDQsGyo1hzVJttIjhQ7GnBtRFN1UarUlH8F3xict+HY07rEzoUGPlWcjRFRr4/gChZgc3ZL2d8oAAAAASUVORK5CYII=)!important}#toast-container.toast-bottom-center>div,#toast-container.toast-top-center>div{width:300px;margin-left:auto;margin-right:auto}#toast-container.toast-bottom-full-width>div,#toast-container.toast-top-full-width>div{width:96%;margin-left:auto;margin-right:auto}.toast{background-color:#030303}.toast-success{background-color:#51A351}.toast-error{background-color:#BD362F}.toast-info{background-color:#2F96B4}.toast-warning{background-color:#F89406}.toast-progress{position:absolute;left:0;bottom:0;height:4px;background-color:#000;opacity:.4;-ms-filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=40);filter:alpha(opacity=40)}@media all and (max-width:240px){#toast-container>div{padding:8px 8px 8px 50px;width:11em}#toast-container>div.rtl{padding:8px 50px 8px 8px}#toast-container .toast-close-button{right:-.2em;top:-.2em}#toast-container .rtl .toast-close-button{left:-.2em;right:.2em}}@media all and (min-width:241px) and (max-width:480px){#toast-container>div{padding:8px 8px 8px 50px;width:18em}#toast-container>div.rtl{padding:8px 50px 8px 8px}#toast-container .toast-close-button{right:-.2em;top:-.2em}#toast-container .rtl .toast-close-button{left:-.2em;right:.2em}}@media all and (min-width:481px) and (max-width:768px){#toast-container>div{padding:15px 15px 15px 50px;width:25em}#toast-container>div.rtl{padding:15px 50px 15px 15px}}




.fdms-btn{text-decoration:none; color:#444; font-weight:bold; background:#C4C4C4; padding:7px 30px; display: inline-block; margin-bottom:20px; border:none;}
.fdms-btn:hover{text-decoration:none; color:#444;}
body{background:#FAFBFD;}

.fdms-inputs{display:flex; flex-wrap:wrap; justify-content:space-between; column-gap:50px;}
.fdms-inputs .form-group{width:calc(50% - 25px);}
.fdms-inputs label{font-weight:bold;}
.fdms-inputs input, .fdms-inputs select{
	background:#C4C4C4;
	border:none;
	outline:none;
	box-shadow:none !important;
	padding:10px;
	height:auto;
	border-radius:0;
	font-weight: bold;
    font-size: 18px;
}



.sidebar{position:fixed; left:0; top:0; bottom:0; width:200px;background:#2366B5; overflow-y:auto;}
.page-content{width:calc(100% - 200px); height:300px; margin-left:200px; padding:30px;}

.sidebar ul{margin:0; padding:0}
.sidebar ul li a{display:inline-block; text-decoration:none; color:#fff; width:100%; border-right:6px solid #2366B5; padding-left:35px; padding-top: 8px; padding-bottom: 8px;}
.sidebar ul li.active a{text-decoration:underline; background: #fff; color:#2366B5; font-style: italic; border-right:6px solid #09AE07; font-weight:bold;}

.sidebar ul li a::before{
	content: "";
    position: absolute;
    width: 17px;
    height: 17px;
    display: inline-block;
    border-radius: 30px;
    background: #fff;
    margin-left: -24px;
    margin-top: 5px;
}

.sidebar ul li.active a::before{
	background:#2366B5;
}

</style>

</head>
<body>

<header>

</header>
<div class="main">
	<div class="sidebar">
		<div style="text-align:center; margin-bottom:30px; margin-top:30px;"><svg width="74" height="85" viewBox="0 0 74 85" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M41.5531 11.498C41.5531 4.92649 36.6233 1.64145 36.6233 1.64145C26.7668 8.21299 26.7668 27.9247 25.125 37.7813C24.5099 41.4778 24.1232 43.0947 23.1903 43.8153C21.6334 45.0192 18.5534 43.7362 10.3401 45.4468C-2.8015 48.1856 2.12679 62.4212 2.12679 62.4212C11.9834 52.5646 15.2684 59.1362 15.2684 59.1362C20.1967 73.921 30.0533 72.2778 30.0533 72.2778C31.6951 78.8493 30.0533 82.1344 30.0533 82.1344C34.9816 87.0627 69.4781 77.2061 52.366 76.1106C35.254 75.0165 36.6233 60.7809 36.6233 60.7809C42.6867 57.4124 47.7687 53.9194 52.0248 50.4015C52.0248 50.4015 53.05 47.6393 49.765 39.426" stroke="white" stroke-width="2.0022" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M23.4819 44.3529C25.1252 32.8531 43.1951 18.0697 43.1951 18.0697C43.1951 18.0697 61.265 4.92807 72.7634 4.92807C72.7634 4.92807 72.7633 29.568 57.9785 45.9947C57.9785 45.9947 57.9785 36.1381 54.6934 32.8531" stroke="white" stroke-width="2.0022" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
</svg></div>
		<ul>
			<li class="@if (Request::is('/')) active @endif"><a href="{{url('/')}}">Overview</a></li>
			@if(Auth::user()->type == 'superadmin' || Auth::user()->type == 'admin' || Auth::user()->type == 'huboperator')
				<li class="@if (Request::path()=='inbound' || Request::is('inbound-details/*')) active @endif"><a href="{{url('/inbound')}}">Inbound</a></li>
				<li class="@if (Request::path()=='bin-change') active @endif"><a href="{{url('/bin-change')}}">Bin/Case Change</a></li>
				<li class="@if (Request::path()=='handover') active @endif"><a href="{{url('/handover')}}">Handover</a></li>
				<li class="@if (Request::path()=='scrap') active @endif"><a href="{{url('/scrap')}}">Scrap</a></li>
			@endif
			@if(Auth::user()->type == 'superadmin' || Auth::user()->type == 'admin')
			<li class="@if (Request::path()=='upload-fd') active @endif"><a href="{{url('/upload-fd')}}">Upload FD</a></li>
			@endif
			<li class="@if (Request::path()=='report') active @endif"><a href="{{url('/report')}}">Report</a></li>
			@if(Auth::user()->type == 'superadmin' || Auth::user()->type == 'admin')
			<li class="@if (Request::path()=='admin' || Request::is('admin/*')) active @endif"><a href="{{url('/admin/bin-config')}}">Admin</a></li>
			@endif
		</ul>
		<div>
			<a style="display:inline-block; margin-top:100px; margin-bottom:50px; margin-left:30px; color:#2366B5; background:#fff; border-radius:100px; padding:5px 20px; text-decoration:none !important;" href="{{url('/auth/logout')}}"><svg style="margin-top: -4px; margin-right: 5px;" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M2.44604 7.92969H9.88501C10.0103 7.92969 10.1133 7.88717 10.1938 7.80212C10.2744 7.71708 10.3147 7.61414 10.3147 7.49329C10.3147 7.37244 10.2744 7.27173 10.1938 7.19116C10.1133 7.1106 10.0103 7.07031 9.88501 7.07031H2.4729L4.03052 5.5127C4.11108 5.43213 4.15137 5.33142 4.15137 5.21057C4.15137 5.08972 4.11108 4.98901 4.03052 4.90845C3.96785 4.85474 3.90072 4.81669 3.8291 4.79431C3.75749 4.77193 3.68363 4.77193 3.60754 4.79431C3.53145 4.81669 3.46655 4.85474 3.41284 4.90845L0.875 7.51343L3.41284 10.1184C3.4576 10.1542 3.50684 10.1833 3.56055 10.2057C3.61426 10.2281 3.66797 10.2393 3.72168 10.2393C3.83805 10.2393 3.941 10.199 4.03052 10.1184C4.05737 10.0916 4.07975 10.0602 4.09766 10.0244C4.11556 9.98861 4.12899 9.9528 4.13794 9.91699C4.14689 9.88118 4.15137 9.84538 4.15137 9.80957C4.15137 9.77376 4.14689 9.73796 4.13794 9.70215C4.12899 9.66634 4.11556 9.63053 4.09766 9.59473C4.07975 9.55892 4.05737 9.52759 4.03052 9.50073L2.44604 7.92969ZM13.7656 0.625H6.46094C6.21924 0.625 6.01558 0.707804 5.84998 0.873413C5.68437 1.03902 5.60156 1.24268 5.60156 1.48438V5.35156H6.46094V2.00806C6.46094 1.91854 6.48332 1.8335 6.52808 1.75293C6.57284 1.67236 6.6355 1.60746 6.71606 1.55823C6.79663 1.50899 6.88615 1.48438 6.98462 1.48438H13.2285C13.3717 1.48438 13.4926 1.53585 13.5911 1.63879C13.6895 1.74174 13.7388 1.86483 13.7388 2.00806L13.7522 12.9919C13.7522 13.1352 13.703 13.2583 13.6045 13.3612C13.506 13.4642 13.3852 13.5156 13.2419 13.5156H6.98462C6.84139 13.5156 6.7183 13.4642 6.61536 13.3612C6.51241 13.2583 6.46094 13.1352 6.46094 12.9919V9.63501H5.60156V13.5156C5.60156 13.7573 5.68437 13.961 5.84998 14.1266C6.01558 14.2922 6.21924 14.375 6.46094 14.375H13.7656C13.8193 14.375 13.8753 14.3683 13.9335 14.3549C13.9917 14.3414 14.0454 14.3258 14.0946 14.3079C14.1438 14.29 14.1931 14.2653 14.2423 14.234C14.2915 14.2027 14.3341 14.1669 14.3699 14.1266C14.4057 14.0863 14.4392 14.0438 14.4706 13.999C14.5019 13.9543 14.5288 13.905 14.5511 13.8513C14.5735 13.7976 14.5914 13.7439 14.6049 13.6902C14.6183 13.6365 14.625 13.5783 14.625 13.5156V1.48438C14.625 1.13525 14.4683 0.880127 14.155 0.718994C14.0297 0.656331 13.8999 0.625 13.7656 0.625Z" fill="#2366B5"/>
</svg> Log Out</a>
		</div>
	</div>
	<div class="page-content">
		<h3 style="margin-bottom:30px;">Welcome to Failed Delivery Management System (FDMS)</h3>
		@yield('content')
	</div>
</div>
</body>
</html>
