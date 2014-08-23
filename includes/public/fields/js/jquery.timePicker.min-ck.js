/**
 * A time picker for jQuery.
 *
 * Dual licensed under the MIT and GPL licenses.
 * Copyright (c) 2009 Anders Fajerson
 *
 * @name    timePicker
 * @author  Anders Fajerson (http://perifer.se)
 * @see     http://github.com/perifer/timePicker
 * @example $("#mytime").timePicker();
 * @example $("#mytime").timePicker({step:30, startTime:"15:00", endTime:"18:00"});
 */(function(e){function t(e){e.setFullYear(2001),e.setMonth(0),e.setDate(0);return e}function n(e,n){if(e){var r=e.split(n.separator),i=parseFloat(r[0]),s=parseFloat(r[1]);n.show24Hours||(i===12&&e.indexOf("AM")!==-1?i=0:i!==12&&e.indexOf("PM")!==-1&&(i+=12));var o=new Date(0,0,0,i,s,0);return t(o)}return null}function r(e,r){return typeof e=="object"?t(e):n(e,r)}function i(e){return(e<10?"0":"")+e}function s(e,t){var n=e.getHours(),r=t.show24Hours?n:(n+11)%12+1,s=e.getMinutes();return i(r)+t.separator+i(s)+(t.show24Hours?"":n<12?" AM":" PM")}function o(t,n,r,i){t.value=e(n).text(),e(t).change(),e.browser.msie||t.focus(),r.hide()}e.fn.timePicker=function(t){var n=e.extend({},e.fn.timePicker.defaults,t);return this.each(function(){e.timePicker(this,n)})},e.timePicker=function(t,n){var r=e(t)[0];return r.timePicker||(r.timePicker=new jQuery._timePicker(r,n))},e.timePicker.version="0.3",e._timePicker=function(i,u){var l=!1,h=!1,p=r(u.startTime,u),d=r(u.endTime,u),v="selected",m="li."+v;e(i).attr("autocomplete","OFF");var y=[],w=new Date(p);while(w<=d)y[y.length]=s(w,u),w=new Date(w.setMinutes(w.getMinutes()+u.step));var E=e('<div class="time-picker'+(u.show24Hours?"":" time-picker-12hours")+'"></div>'),S=e("<ul></ul>");for(var x=0;x<y.length;x++)S.append("<li>"+y[x]+"</li>");E.append(S),E.appendTo("body").hide(),E.mouseover(function(){l=!0}).mouseout(function(){l=!1}),e("li",S).mouseover(function(){h||(e(m,E).removeClass(v),e(this).addClass(v))}).mousedown(function(){l=!0}).click(function(){o(i,this,E,u),l=!1});var T=function(){if(E.is(":visible"))return!1;e("li",E).removeClass(v);var r=e(i).offset();E.css({top:r.top+i.offsetHeight,left:r.left}),E.show();var o=i.value?n(i.value,u):p,l=p.getHours()*60+p.getMinutes(),h=o.getHours()*60+o.getMinutes()-l,m=Math.round(h/u.step),y=t(new Date(0,0,0,0,m*u.step+l,0));y=p<y&&y<=d?y:p;var b=e("li:contains("+s(y,u)+")",E);b.length&&(b.addClass(v),E[0].scrollTop=b[0].offsetTop);return!0};e(i).focus(T).click(T),e(i).blur(function(){l||E.hide()});var N=e.browser.opera||e.browser.mozilla?"keypress":"keydown";e(i)[N](function(t){var n;h=!0;var r=E[0].scrollTop;switch(t.keyCode){case 38:if(T())return!1;n=e(m,S);var s=n.prev().addClass(v)[0];s?(n.removeClass(v),s.offsetTop<r&&(E[0].scrollTop=r-s.offsetHeight)):(n.removeClass(v),s=e("li:last",S).addClass(v)[0],E[0].scrollTop=s.offsetTop-s.offsetHeight);return!1;case 40:if(T())return!1;n=e(m,S);var f=n.next().addClass(v)[0];f?(n.removeClass(v),f.offsetTop+f.offsetHeight>r+E[0].offsetHeight&&(E[0].scrollTop=r+f.offsetHeight)):(n.removeClass(v),f=e("li:first",S).addClass(v)[0],E[0].scrollTop=0);return!1;case 13:if(E.is(":visible")){var l=e(m,S)[0];o(i,l,E,u)}return!1;case 27:E.hide();return!1}return!0}),e(i).keyup(function(e){h=!1}),this.getTime=function(){return n(i.value,u)},this.setTime=function(t){i.value=s(r(t,u),u),e(i).change()}},e.fn.timePicker.defaults={step:30,startTime:new Date(0,0,0,0,0,0),endTime:new Date(0,0,0,23,30,0),separator:":",show24Hours:!0}})(jQuery);