function menu() {
    var menu = document.getElementById('menumob');
    var a = document.getElementById('partlink');
    var cookie = getcookie('menu');
    if (cookie != "opened" && cookie != "closed" && a != null) {
        document.cookie = "menu=opened";
        a.style.display = "inline";
        menu.style.display = "block";
    } else if(cookie != "opened" && cookie != "closed" && a === null) {
        document.cookie = "menu=opened";
        menu.style.display = "block";
    }  else if(cookie == "opened" && a!=null) {
        document.cookie = "menu=closed";
        a.style.top = "80";
        a.style.display = "inline";
        menu.style.display = "none";
    } else if(cookie == "closed" && a!=null) {
        document.cookie = "menu=opened";
        a.style.display = "none";
        menu.style.display = "block";
    } else if(cookie == "opened") {
        document.cookie = "menu=closed";
        menu.style.display = "none";
    } else if(cookie == "closed") {
        document.cookie = "menu=opened";
        menu.style.display = "block";
    }
}
function menu2() {
    var menu = document.getElementById('cntmenu');
    var cookie = getcookie('menu2');
    if (cookie != "opened" && cookie != "closed") {
        document.cookie = "menu2=opened";
        menu.style.display = "block";
    } else if(cookie != "opened" && cookie != "closed") {
        document.cookie = "menu2=opened";
        menu.style.display = "block";
    }  else if(cookie == "opened") {
        document.cookie = "menu2=closed";
        menu.style.display = "none";
    } else if(cookie == "closed") {
        document.cookie = "menu2=opened";
        menu.style.display = "block";
    } else if(cookie == "opened") {
        document.cookie = "menu2=closed";
        menu.style.display = "none";
    } else if(cookie == "closed") {
        document.cookie = "menu2=opened";
        menu.style.display = "block";
    }
}
