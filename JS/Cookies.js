function setcookie(a, b, c) { if (c) { var d = new Date(); d.setTime(d.getTime() + c); } if (a && b) document.cookie = a + '=' + b + (c ? '; expires=' + d.toUTCString() : ''); else return false; }
function getcookie(a) { var b = new RegExp(a + '=([^;]){1,}'); var c = b.exec(document.cookie); if (c) c = c[0].split('='); else return false; return c[1] ? c[1] : false; }
document.cookie = "menu=closed";
document.cookie = "menu2=closed";