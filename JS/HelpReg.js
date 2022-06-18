function help(id) {
    var el = document.getElementById(id);
    var elInput = document.getElementById(id+'Input');
    el.style.display = 'none';
    var elA = document.getElementById(id+'A');
    elA.style.display = 'none';
    el.style.display = 'none';
    elInput.style.display = 'block';
    if(id!='Region') {
        elInput.setAttribute('required','required');
        el.removeAttribute('required');
    } else {
        document.getElementById('City').removeAttribute('required');
        document.getElementById('City').style.display = 'none';
        let inp =  document.getElementById('CityInput');
        inp.style.display = 'block';
        inp.setAttribute('name','UserCity');
        inp.setAttribute('placeholder','City');
        inp.setAttribute('required','required');
        var elC = document.getElementById('CityA');
        elC.style.display = 'none';
    }
    elInput.setAttribute('name','User'+id);
    elInput.setAttribute('placeholder',id);
}