// TODO в параметры надо передавать сам инпут через this

function getUpdates() {
    ajax({
        url: "/ajax/GetRegParams?step=1",
        statbox: "status",
        method: "POST",
        data:
        {
            CountryId: document.getElementById("Country").value
        },
        success: function (data) {
            let CitySelect = document.getElementById("City");
            let RegionSelect = document.getElementById("Region");
            let ClubSelect = document.getElementById("Club");
            if (JSON.parse(data).length != 0) {
                let json = JSON.parse(data);
                let RegionName;
                let RegionId;
                let CityId;
                let CityName;
                let ClubId;
                let ClubName;
                CitySelect.innerHTML = "";
                CitySelect.append(new Option("-", ""));
                RegionSelect.innerHTML = "";
                RegionSelect.append(new Option("-", ""));
                ClubSelect.innerHTML = "";
                ClubSelect.append(new Option("-", ""));
                Object.keys(json).forEach(function (key) {
                    for (let i = 0; i < json[key].length; i++) {
                        Object.keys(json[key][i]).forEach(function (key2) {
                            if (key2 == 'RegionId') {
                                RegionId = json[key][i][key2];
                            } else if (key2 == 'RegionName') {
                                RegionName = json[key][i][key2];
                                RegionSelect.append(new Option(RegionName, RegionId));
                            } else if (key2 == 'CityId') {
                                CityId = json[key][i][key2];
                            } else if (key2 == 'CityName') {
                                CityName = json[key][i][key2];
                                CitySelect.append(new Option(CityName, CityId));
                            } else if (key2 == 'ClubId') {
                                CityId = json[key][i][key2];
                            } else if (key2 == 'ClubName') {
                                ClubName = json[key][i][key2];
                                ClubSelect.append(new Option(ClubName, ClubId));
                            }
                        });
                    }
                });
            } else {
                CitySelect.innerHTML = "";
                CitySelect.append(new Option("-", ""));
                RegionSelect.innerHTML = "";
                RegionSelect.append(new Option("-", ""));
                ClubSelect.innerHTML = "";
                ClubSelect.append(new Option("-", ""));
            }
        }
    });
}

// TODO выделил просто. Привязка клуба к стране?

function getRegionUpdate() {
    ajax({
        url: "/ajax/GetRegParams?step=2",
        statbox: "status",
        method: "POST",
        data:
        {
            RegionId: document.getElementById("Region").value
        },
        success: function (data) {
            let CitySelect = document.getElementById("City");
            if (JSON.parse(data).length != 0) {
                let json = JSON.parse(data);
                let CityId;
                let CityName;
                CitySelect.innerHTML = '';
                CitySelect.append(new Option("-", ""));
                for (let i = 0; i < json.length; i++) {
                    Object.keys(json[i]).forEach(function (key2) {
                        if (key2 == 'CityId') {
                            CityId = json[i][key2];
                        } else if (key2 == 'CityName') {
                            CityName = json[i][key2];
                            CitySelect.append(new Option(CityName, CityId));
                        }
                    });
                }
            } else {
                CitySelect.innerHTML = "";
                CitySelect.append(new Option("-", ""));
            }
        }
    });
}

function getContextSearch(el) {
    let div = document.getElementById(el + 'Context');
    if (document.getElementById(el + 'Input').value!=='') {
        ajax({
            url: "/ajax/GetRegParams?step=3",
            statbox: "status",
            method: "POST",
            data:
            {
                Text: document.getElementById(el + 'Input').value,
                Id: el
            },
            success: function (data) {
                let json = JSON.parse(data);
                div.innerHTML = '';
                for (let i = 0; i < json.length; i++) {
                    div.innerHTML = div.innerHTML + '<span onclick="enter(this,\'' + el + '\');" class="res">' + json[i][el + 'Name'] + '</span>';
                }
            }
        });
    } else {
        div.innerHTML = '';
    }
}

function enter(el,id) {
    document.getElementById(id + 'Input').value = el.textContent;
    document.getElementById(id + 'Context').innerHTML = '';
}