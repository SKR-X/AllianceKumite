function updateList() {
    var a = getcookie('Limit');
    if (!a) { a = 100 } else {
        for (let i = 1; i <= 50; i++) {
            +a++;
        }
    }
    parseInt(a);
    setcookie('Limit', a);
    location = self.location
}