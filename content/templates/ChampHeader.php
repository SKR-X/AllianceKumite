<html>
<head>
    <title><?= $config['title'] ?></title>
    <link rel="stylesheet" type="text/css" href=<?= '/app/content/styles/' . $config['css'] . '.css' ?>>
    <link rel="shortcut icon" href="/app/content/images/logo2.png" type="image/png">
    <script type="text/javascript" src="/app/JS/LangScript.js"></script>
    <script type="text/javascript" src="/app/JS/Cookies.js"></script>
    <script type="text/javascript" src="/app/JS/Scroll.js"></script>
    <script type="text/javascript" src="/app/JS/MenuMobile.js"></script>
    <script type="text/javascript" src="/app/JS/UpdateList.js"></script>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=1200">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <? if (isset($queryArr['filename'])) : ?>
        <style>
            .content {
                margin-top: 20px;
            }
        </style>
    <?endif;?>
</head>

<body>
    <header>
        <div class="headercontent">
            <div class="hdrlogo"><a href="/">
                    <img src="/app/content/images/logo2.png"></a>
            </div>
            <? if (isset($queryArr['champInfo'][0]['ChampName'])) : ?>
                <div class="CONF_header"><span><?= $queryArr['champInfo'][0]['ChampName'] ?></span>
                    <div class="hdrdates"><span><?= $queryArr['champInfo'][0]['DateBeginChamp'] ?></span> <span>-</span> <span><?= $queryArr['champInfo'][0]['DateEndChamp'] ?></span></div>
                </div>
                <form method="GET" name="menuForm">
                    <ul>
                        <li><input autocomplete="off" type="submit" name="main" value=" <?= $lang['champ']['menuMain'] ?> "></li>
                        <li><select name="tatami" onchange="document.forms['menuForm'].submit()">
                                <option style="display: none;">
                                    <?= $lang['champ']['menuTatami'] ?>
                                </option>
                                <? for ($b = 0; $b < count($queryArr['tatamiMenu']); $b++) : ?>
                                    <option value=<?= $queryArr['tatamiMenu'][$b]['id'] ?>>
                                        <?= $lang['champ']['menuTatami'] . '#' . $queryArr['tatamiMenu'][$b]['id'] ?>
                                    </option>
                                <? endfor; ?>
                            </select></li>
                        <li><select name="draw" onchange="document.forms['menuForm'].submit()">
                                <option style="display: none;">
                                    <?= $lang['champ']['menuDraw'] ?>
                                </option>
                                <? for ($b = 0; $b < count($queryArr['categories']); $b++) : ?>
                                    <? if ($b == 0 || !($queryArr['categories'][$b]['CategoryId'] == $queryArr['categories'][$b - 1]['CategoryId'])) : ?>
                                        <option value=<?= urlencode($queryArr['categories'][$b]['CategoryFileDraw']) ?>>
                                            <?= $queryArr['categories'][$b]['CategoryName'] ?>
                                        </option>
                                    <? endif; ?>
                                <? endfor; ?>
                            </select></li>
                        <li><select name="categories" onchange="document.forms['menuForm'].submit()">
                                <option style="display: none;">
                                    <?= $lang['champ']['menuCategories'] ?>
                                </option>
                                <? for ($b = 0; $b < count($queryArr['categories']); $b++) : ?>
                                    <? if ($b == 0 || !($queryArr['categories'][$b]['CategoryId'] == $queryArr['categories'][$b - 1]['CategoryId'])) : ?>
                                        <option value=<?= $queryArr['categories'][$b]['CategoryId'] ?>>
                                            <?= $queryArr['categories'][$b]['CategoryName'] ?>
                                        </option>
                                    <? endif; ?>
                                <? endfor; ?>
                            </select></li>
                        <li><select name="results" onchange="document.forms['menuForm'].submit()">
                                <option style="display: none;">
                                    <?= $lang['champ']['menuResults'] ?>
                                </option>
                                <option value="1">
                                    <?= $lang['champ']['menuStand'] ?>
                                </option>
                                <option value="2">
                                    <?= $lang['champ']['menuTrainer'] ?>
                                </option>
                                <option value="3">
                                    <?= $lang['champ']['menuClub'] ?>
                                </option>
                                <option value="4">
                                    <?= $lang['champ']['menuCountries'] ?>
                                </option>
                            </select></li>
                            <li><select name="online" onchange="document.forms['menuForm'].submit()">
                                <option style="display: none;">
                                    <?= $lang['champ']['menuOnline'] ?>
                                </option>
                              <? for ($b = 0; $b < count($queryArr['tatamiMenuOnline']); $b++) : ?>
                                    <option value=<?= $queryArr['tatamiMenuOnline'][$b]['TatamiId'] ?>>
                                        <?= $lang['champ']['menuTatami'] . '#' . $queryArr['tatamiMenuOnline'][$b]['TatamiId'] ?>
                                    </option>
                                <? endfor; ?>
                            </select></li>
                        <? if ($queryArr['champInfo'][0]['TypeChamp'] == 5) : ?>
                            <li><select name="countries" onchange="document.forms['menuForm'].submit()">
                                    <option style="display: none;">
                                        <?= $lang['champ']['countriesHead'] ?>
                                    </option>
                                    <? for ($b = 0; $b < count($queryArr['countries']); $b++) : ?>
                                        <? $rp = str_replace('Png', 'png', $queryArr['countries'][$b]['CountryFlag']); ?>
                                        <? if ($b == 0 && $lang['champ']['dbId'] == "ru") : ?>
                                            <option value=<?= $queryArr['countries'][$b]['CountryId'] ?>><span><?= $queryArr['countries'][$b]['CountryNameRu'] ?></span></option>
                                            <? continue; ?>
                                        <? elseif ($b == 0 && $lang['champ']['dbId'] == "gb") : ?>
                                            <option value=<?= $queryArr['countries'][$b]['CountryId'] ?>><span><?= $queryArr['countries'][$b]['CountryNameEn'] ?></span></option>
                                            <? continue; ?>
                                        <? elseif ($b == 0 && $lang['champ']['dbId'] == "ua") : ?>
                                            <option value=<?= $queryArr['countries'][$b]['CountryId'] ?>><span><?= $queryArr['countries'][$b]['CountryNameUa'] ?></span></option>
                                            <? continue; ?>
                                        <? endif; ?>
                                        <? if ($lang['champ']['dbId'] == "ru" && !($queryArr['countries'][$b]['CountryId'] == $queryArr['countries'][$b - 1]['CountryId'])) : ?>
                                            <option value=<?= $queryArr['countries'][$b]['CountryId'] ?>><span><?= $queryArr['countries'][$b]['CountryNameRu'] ?></span></option>
                                        <? elseif ($lang['champ']['dbId'] == "ua" && !($queryArr['countries'][$b]['CountryId'] == $queryArr['countries'][$b - 1]['CountryId'])) : ?>
                                            <option value=<?= $queryArr['countries'][$b]['CountryId'] ?>><span><?= $queryArr['countries'][$b]['CountryNameUa'] ?></span></option>
                                        <? elseif ($lang['champ']['dbId'] == "gb" && !($queryArr['countries'][$b]['CountryId'] == $queryArr['countries'][$b - 1]['CountryId'])) : ?>
                                            <option value=<?= $queryArr['countries'][$b]['CountryId'] ?>><span><?= $queryArr['countries'][$b]['CountryNameEn'] ?></span></option>
                                        <? endif; ?>
                                    <? endfor; ?>
                                <? else : ?>
                            <li><select name="clubs" onchange="document.forms['menuForm'].submit()">
                                    <option style="display: none;">
                                        <?= $lang['champ']['clubsHead'] ?>
                                    </option>
                                    <? for ($b = 0; $b < count($queryArr['clubs']); $b++) : ?>
                                        <? if ($b == 0) : ?>
                                            <option value=<?= $queryArr['clubs'][$b]['ClubId'] ?>><span><?= $queryArr['clubs'][$b]['ClubName'] ?></span></option>
                                            <? continue; ?>
                                        <? endif; ?>
                                        <? if (!($queryArr['clubs'][$b]['ClubId'] == $queryArr['clubs'][$b - 1]['ClubId'])) : ?>
                                            <option value=<?= $queryArr['clubs'][$b]['ClubId'] ?>><span><?= $queryArr['clubs'][$b]['ClubName'] ?></span></option>
                                            <? continue; ?>
                                        <? endif; ?>
                                    <? endfor; ?>
                                <? endif; ?>
                                </select>
                            </li>
                    </ul>
                </form>
                <div class="mobmenubtn" onclick="menu()">
                    <i class="fas fa-bars"></i>
                </div>
            <? else : ?>
                <div class="CONF_header"><span><?= $lang['champ']['error'] ?></span></div>
            <? endif; ?>
            <div class="lang">
                <div class="dropdown" id="specmob">
                    <div class="dropbtn" onclick="menu2()"><?= $lang['lang']['name'] ?></div>
                    <div class="dropdown-content" id="cntmenu">
                        <span id="ua" onclick="setLang('ua')">UA</span><span id="gb" onclick="setLang('gb')">EN</span><span id="ru" onclick="setLang('ru')">RU</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div id="menumob">
        <form method="GET" name="menuForm2">
            <ul>
                <li><input autocomplete="off" type="submit" name="main" value=" <?= $lang['champ']['menuMain'] ?> "></li>
                <li><select name="tatami" onchange="document.forms['menuForm2'].submit()">
                        <option style="display: none;">
                            <?= $lang['champ']['menuTatami'] ?>
                        </option>
                        <? for ($b = 0; $b < count($queryArr['tatamiMenu']); $b++) : ?>
                            <option value=<?= $queryArr['tatamiMenu'][$b]['id'] ?>>
                                <?= $lang['champ']['menuTatami'] . '#' . $queryArr['tatamiMenu'][$b]['id'] ?>
                            </option>
                        <? endfor; ?>
                    </select></li>
                <li><select name="draw" onchange="document.forms['menuForm2'].submit()">
                        <option style="display: none;">
                            <?= $lang['champ']['menuDraw'] ?>
                        </option>
                        <? for ($b = 0; $b < count($queryArr['categories']); $b++) : ?>
                            <? if ($b == 0 || !($queryArr['categories'][$b]['CategoryId'] == $queryArr['categories'][$b - 1]['CategoryId'])) : ?>
                                <option value=<?= urlencode($queryArr['categories'][$b]['CategoryFileDraw']) ?>>
                                    <?= $queryArr['categories'][$b]['CategoryName'] ?>
                                </option>
                            <? endif; ?>
                        <? endfor; ?>
                    </select></li>
                <li><select name="categories" onchange="document.forms['menuForm2'].submit()">
                        <option style="display: none;">
                            <?= $lang['champ']['menuCategories'] ?>
                        </option>
                        <? for ($b = 0; $b < count($queryArr['categories']); $b++) : ?>
                            <? if ($b == 0 || !($queryArr['categories'][$b]['CategoryId'] == $queryArr['categories'][$b - 1]['CategoryId'])) : ?>
                                <option value=<?= $queryArr['categories'][$b]['CategoryId'] ?>>
                                    <?= $queryArr['categories'][$b]['CategoryName'] ?>
                                </option>
                            <? endif; ?>
                        <? endfor; ?>
                    </select></li>
                <li><select name="results" onchange="document.forms['menuForm2'].submit()">
                        <option style="display: none;">
                                    <?= $lang['champ']['menuResults'] ?>
                                </option>
                                <option value="1">
                                    <?= $lang['champ']['menuStand'] ?>
                                </option>
                                <option value="2">
                                    <?= $lang['champ']['menuTrainer'] ?>
                                </option>
                                <option value="3">
                                    <?= $lang['champ']['menuClub'] ?>
                                </option>
                                <option value="4">
                                    <?= $lang['champ']['menuCountries'] ?>
                                </option>
                        <option value="1">
                            <?= $lang['champ']['menuStand'] ?>
                        </option>
                    </select></li>
                     <li><select name="online" onchange="document.forms['menuForm2'].submit()">
                                <option style="display: none;">
                                    <?= $lang['champ']['menuOnline'] ?>
                                </option>
                              <? for ($b = 0; $b < count($queryArr['tatamiMenuOnline']); $b++) : ?>
                                    <option value=<?= $queryArr['tatamiMenuOnline'][$b]['TatamiId'] ?>>
                                        <?= $lang['champ']['menuTatami'] . '#' . $queryArr['tatamiMenuOnline'][$b]['TatamiId'] ?>
                                    </option>
                                <? endfor; ?>
                            </select></li>
                <? if ($queryArr['champInfo'][0]['TypeChamp'] == 5) : ?>
                <li><select name="countries" onchange="document.forms['menuForm2'].submit()">
                        <option style="display: none;">
                            <?= $lang['champ']['countriesHead'] ?>
                        </option>
                        <? for ($b = 0; $b < count($queryArr['countries']); $b++) : ?>
                            <? $rp = str_replace('Png', 'png', $queryArr['countries'][$b]['CountryFlag']); ?>
                            <? if ($b == 0 && $lang['champ']['dbId'] == "ru") : ?>
                                <option value=<?= $queryArr['countries'][$b]['CountryId'] ?>><span><?= $queryArr['countries'][$b]['CountryNameRu'] ?></span></option>
                                <? continue; ?>
                            <? elseif ($b == 0 && $lang['champ']['dbId'] == "gb") : ?>
                                <option value=<?= $queryArr['countries'][$b]['CountryId'] ?>><span><?= $queryArr['countries'][$b]['CountryNameEn'] ?></span></option>
                                <? continue; ?>
                            <? elseif ($b == 0 && $lang['champ']['dbId'] == "ua") : ?>
                                <option value=<?= $queryArr['countries'][$b]['CountryId'] ?>><span><?= $queryArr['countries'][$b]['CountryNameUa'] ?></span></option>
                                <? continue; ?>
                            <? endif; ?>
                            <? if ($lang['champ']['dbId'] == "ru" && !($queryArr['countries'][$b]['CountryId'] == $queryArr['countries'][$b - 1]['CountryId'])) : ?>
                                <option value=<?= $queryArr['countries'][$b]['CountryId'] ?>><span><?= $queryArr['countries'][$b]['CountryNameRu'] ?></span></option>
                            <? elseif ($lang['champ']['dbId'] == "ua" && !($queryArr['countries'][$b]['CountryId'] == $queryArr['countries'][$b - 1]['CountryId'])) : ?>
                                <option value=<?= $queryArr['countries'][$b]['CountryId'] ?>><span><?= $queryArr['countries'][$b]['CountryNameUa'] ?></span></option>
                            <? elseif ($lang['champ']['dbId'] == "gb" && !($queryArr['countries'][$b]['CountryId'] == $queryArr['countries'][$b - 1]['CountryId'])) : ?>
                                <option value=<?= $queryArr['countries'][$b]['CountryId'] ?>><span><?= $queryArr['countries'][$b]['CountryNameEn'] ?></span></option>
                            <? endif; ?>
                        <? endfor; ?>
                        <? else : ?>
                <li><select name="clubs" onchange="document.forms['menuForm2'].submit()">
                        <option style="display: none;">
                            <?= $lang['champ']['clubsHead'] ?>
                        </option>
                        <? for ($b = 0; $b < count($queryArr['clubs']); $b++) : ?>
                            <? if ($b == 0) : ?>
                                <option value=<?= $queryArr['clubs'][$b]['ClubId'] ?>><span><?= $queryArr['clubs'][$b]['ClubName'] ?></span></option>
                                <? continue; ?>
                            <? endif; ?>
                            <? if (!($queryArr['clubs'][$b]['ClubId'] == $queryArr['clubs'][$b - 1]['ClubId'])) : ?>
                                <option value=<?= $queryArr['clubs'][$b]['ClubId'] ?>><span><?= $queryArr['clubs'][$b]['ClubName'] ?></span></option>
                                <? continue; ?>
                            <? endif; ?>
                        <? endfor; ?>
                        <? endif; ?>

                    </select>
                </li>
            </ul>
        </form>
    </div>