<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title><?= (isset($config['title'])) ? $config['title'] : "Alliance Kumite" ?></title>
  <link rel="shortcut icon" href="/app/content/images/logo2.png" type="image/png">
  <script type="text/javascript" src="/app/JS/LangScript.js"></script>
  <link rel="stylesheet" type="text/css" href=<?= '/app/content/styles/' . $config['css'] . '.css' ?>>
  <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=800">
    <script type="text/javascript" src="/app/JS/Cookies.js"></script>
    <script type="text/javascript" src="/app/JS/MenuMobile.js"></script>
    <script type="text/javascript" src="/app/JS/Ajax.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>

<body>
  <header>
    <div class="headercontent">
      <div class="hdrlogo"><a href="/">
          <img src="/app/content/images/logo2.png"></a></div>
      <div class="CONF_header"><span><?=$lang[$config['header']]['header']?></span></div>
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