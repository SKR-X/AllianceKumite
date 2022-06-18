function insertAfter(node, referenceNode) {
    if (!node || !referenceNode) return;
    var parent = referenceNode.parentNode, nextSibling = referenceNode.nextSibling;
    if (nextSibling && parent) {
        parent.insertBefore(node, referenceNode.nextSibling);
    } else if (parent) {
        parent.appendChild(node);
    }

}

function addHidden(theForm, key, value) {
    var input = document.createElement('input');
    input.type = 'hidden';
    input.name = key;
    input.value = value;
    theForm.appendChild(input);
}

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [day, month, year].join('.');
}

function edit(id) {

    let fileInput = document.getElementById('thirdBlockForm');

    let fileInputLink = document.getElementById('redFile');

    let sprtInfo = document.getElementById(id).getElementsByClassName('allInfoSprt')[0].textContent.split(',');

    let prtBoxes = Array.from(document.getElementsByClassName('prt'));

    let inputs = Array.from(document.getElementById('form').querySelectorAll('input'));

    let selects = Array.from(document.getElementById('form').querySelectorAll('select'));

    let sprtBoxes = Array.from(document.getElementsByClassName('sprt'));

    let editLinks = Array.from(document.getElementsByClassName('editSprt'));

    let red = document.getElementById('red');

    let cancel = document.getElementById('cancel');

    inputs.forEach(function (e) {
        if (e.getAttribute('type') != 'file' && e.getAttribute('type') != 'select' && e.getAttribute('type') != 'checkbox' && e.getAttribute('type') != 'text') {
            e.style = "display:none;";
        }
    });

    for (let i = 0; i < sprtBoxes.length; i++) {
        sprtBoxes[i].style = 'display: none;';
    }

    for (i = 0; i < prtBoxes.length; i++) {
        prtBoxes[i].style = 'display: none;';
    }

    for (i = 0; i < editLinks.length; i++) {
        editLinks[i].style = 'margin-right: 18px; transition: 0s;';
    }

    red.style = "display: block;";

    cancel.style = "display: block;";

    inputs[0].value = sprtInfo[0];

    inputs[1].value = formatDate(sprtInfo[1]);

    inputs[2].value = sprtInfo[4];

    if (sprtInfo[2] == "Ж(F)") {
        selects[0].selectedIndex = 1;
    } else {
        selects[0].selectedIndex = 0;
    }

    let gradeSel = selects[1];

    for (i = 0; i < gradeSel.length; i++) {
        if (gradeSel[i].value == sprtInfo[3]) {
            gradeSel.selectedIndex = i;
        }
    }

    inputs[5].checked = parseInt(sprtInfo[5]);

    inputs[6].checked = parseInt(sprtInfo[6]);

    let form = document.getElementById('form');

    addHidden(form, 'ParticipantId', sprtInfo[7]);

    let img = document.createElement('img');

    img.src = '/App/uploadedFiles/IMGFilesFull/' + sprtInfo[8];

    img.style = "margin-left:20px; margin-bottom:10px;";

    img.id = "imgFile";

    insertAfter(img, fileInputLink);

    fileInput.style = "display:none;";

    fileInputLink.style = "display:block;";

}

function showFileInput() {

    let fileInput = document.getElementById('thirdBlockForm');

    fileInput.style = "display:block;";

    let fileInputLink = document.getElementById('redFile');

    fileInputLink.style = "display:none;";

    document.getElementById('imgFile').style = "display:none;";
    
}

function sprt() {

    let add = document.getElementById('add');

    let delSprt = document.getElementById('del1');

    let delPrt = document.getElementById('del2');

    let move = document.getElementById('move');

    let prtBoxes = Array.from(document.getElementsByClassName('prt'));

    let inputs = Array.from(document.getElementById('form').querySelectorAll('input'));

    let sprtBoxes = Array.from(document.getElementsByClassName('sprt'));

    for (let i = 0; i < sprtBoxes.length; i++) {
        if (sprtBoxes[i].checked) {
            prtBoxes.forEach(function (e) {
                e.style = 'display: none;';
            });
            inputs.forEach(function (e) {
                e.removeAttribute('required');
            });
            add.setAttribute('disabled', '');
            add.style.backgroundColor = 'gray';
            delPrt.setAttribute('disabled', '');
            delPrt.style.backgroundColor = 'gray';
            move.removeAttribute('disabled');
            delSprt.removeAttribute('disabled');
            return;
        }
        prtBoxes.forEach(function (e) {
            e.style = 'display: text;';
        });
        inputs.forEach(function (e) {
            if (e.getAttribute('type') != 'file' && e.getAttribute('type') != 'select' && e.getAttribute('type') != 'checkbox') {
                e.setAttribute('required', '');
            }
        });
        add.removeAttribute('disabled');
        add.style.backgroundColor = '#5e5e5e';
        delPrt.setAttribute('disabled', '');
        delPrt.style.backgroundColor = '#5e5e5e';
        delSprt.setAttribute('disabled', '');
        delSprt.style.backgroundColor = '#5e5e5e';
        move.setAttribute('disabled', '');
        move.style.backgroundColor = '#5e5e5e';
    }

}

function prt() {

    let add = document.getElementById('add');

    let delSprt = document.getElementById('del1');

    let delPrt = document.getElementById('del2');

    let move = document.getElementById('move');

    let prtBoxes = Array.from(document.getElementsByClassName('prt'));

    let inputs = Array.from(document.getElementById('form').querySelectorAll('input'));

    let sprtBoxes = Array.from(document.getElementsByClassName('sprt'));

    for (let i = 0; i < prtBoxes.length; i++) {
        if (prtBoxes[i].checked) {
            sprtBoxes.forEach(function (e) {
                e.style = 'display: none;';
            });
            inputs.forEach(function (e) {
                e.removeAttribute('required');
            });
            add.setAttribute('disabled', '');
            add.style.backgroundColor = 'gray';
            move.setAttribute('disabled', '');
            move.style.backgroundColor = 'gray';
            delSprt.setAttribute('disabled', '');
            delSprt.style.backgroundColor = 'gray';
            delPrt.removeAttribute('disabled');
            delPrt.style.backgroundColor = '#5e5e5e';
            return;
        }
        sprtBoxes.forEach(function (e) {
            e.style = 'display: text;';
        });
        inputs.forEach(function (e) {
            if (e.getAttribute('type') != 'file' && e.getAttribute('type') != 'select' && e.getAttribute('type') != 'checkbox') {
                e.setAttribute('required', '');
            }
        });
        add.removeAttribute('disabled');
        add.style.backgroundColor = '#5e5e5e';
        delPrt.setAttribute('disabled', '');
        delPrt.style.backgroundColor = '#5e5e5e';
        delSprt.setAttribute('disabled', '');
        delSprt.style.backgroundColor = '#5e5e5e';
        move.setAttribute('disabled', '');
        move.style.backgroundColor = '#5e5e5e';
    }
}

function getSportsmen(obj, id) {

    let table1 = document.getElementById('table1');

    let sprt = Array.from(table1.getElementsByTagName('tr'));

    for (let i = 0; i < sprt.length; i++) {
        if (sprt[i].id != 'head') {
            sprt[i].remove();
        }
    }

    ajax({
        url: "/ajax/GetSportsmen",
        statbox: "status",
        method: "POST",
        data:
        {
            input: obj.value,
            id: id
        },
        success: function (data) {
            json = JSON.parse(data);
            // document.getElementById('table1').innerHTML = "";
            let tbody = document.getElementById('table1').getElementsByTagName("TBODY")[0];
            for (let i = 0; i < json.length; i++) {
                let id = json[i]['ParticipantId'];
                let row = document.createElement("TR");
                row.setAttribute('id', json[i]['ParticipantId']);
                let td1 = document.createElement("TD");
                td1.appendChild(document.createTextNode(json[i]['FIO']));
                let td2 = document.createElement("TD");
                td2.appendChild(document.createTextNode(json[i]['DateBr']));
                let td3 = document.createElement("TD");
                td3.appendChild(document.createTextNode(json[i]['Grade']));
                let td4 = document.createElement("TD");
                row.appendChild(td1);
                row.appendChild(td2);
                row.appendChild(td3);
                row.appendChild(td4);
                td4.innerHTML = '<td><a class="editSprt" href="#" onClick="edit(' + id + ')">edit.</a><input class="sprt" onClick="sprt()" type="checkbox" form="form" name="' + id + '"></td>';
                tbody.appendChild(row);
            }
        }
    });
}