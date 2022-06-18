<div class="marg"></div>
<? if (isset($queryArr['champInfo'][0]['ChampName'])) : ?>
<div class="content">
    <div class="container">
        <? if (isset($queryArr['filename'])) : ?>
        <div class="box">
            <object type="image/svg+xml" data="<?= "/app/uploadedFiles/IMGfiles/" . $queryArr['filename'] ?>" width="100%">
          </object>
    </div>
            <? elseif (isset($queryArr['tatamiOnline'])) : ?>
                <meta http-equiv="Refresh" content="5" />
                <? $i = 0 ?>
                <div id="fightblock">
                    <div class="id">
                        <span>№<?= $queryArr['tatamiOnline'][$i]['NumFight'] ?></span>
                    </div>
                    <div class="nums">
                        <?= (!empty($queryArr['tatamiOnline'][$i]['OrdNumR'])) ? '<span id="R">' . $queryArr['tatamiOnline'][$i]['OrdNumR'] . '</span>' : '' ?><br>
                        <?= (!empty($queryArr['tatamiOnline'][$i]['OrdNumW'])) ? '<span id="W">' . $queryArr['tatamiOnline'][$i]['OrdNumW'] . '</span>' : ''?> 
                    </div>
                        <div class="fio">
                            <?= '<span id="R">' . $queryArr['tatamiOnline'][$i]['FioR'] . '</span><br>'. '<span id="W">' . $queryArr['tatamiOnline'][$i]['FioW'] ?>
                        </div>
                    <div class="clubs">
                        <span><?= (!empty($queryArr['tatamiOnline'][$i]['ClubR'])) ? $queryArr['tatamiOnline'][$i]['ClubR'] : '----' ?></span><br>
                        <span><?= (!empty($queryArr['tatamiOnline'][$i]['ClubW'])) ? $queryArr['tatamiOnline'][$i]['ClubW'] : '----' ?></span>
                    </div>
                </div>
                <div class="containerflex">
                <!--<h1 id=" onlineNum"><?= $lang['champ']['menuTatami'] ?> № <?= $queryArr['tatami'] ?></h1>-->
                <? for ($i = 1; $i < count($queryArr['tatamiOnline']); $i++) : ?>
                <div class="block">
                    <div class="id">
                        <span>№<?= $queryArr['tatamiOnline'][$i]['NumFight'] ?></span>
                    </div>
                    <div class="nums">
                        <?= (!empty($queryArr['tatamiOnline'][$i]['OrdNumR'])) ? '<span>' . $queryArr['tatamiOnline'][$i]['OrdNumR'] . '</span>' : '<span>0000</span>' ?><br>
                        <?= (!empty($queryArr['tatamiOnline'][$i]['OrdNumW'])) ? '<span>' . $queryArr['tatamiOnline'][$i]['OrdNumW'] . '</span>' : '<span>0000</span>'?> 
                    </div>
                        <div class="fio">
                            <?= '<span>' . $queryArr['tatamiOnline'][$i]['FioR'] . '</span><br>'. '<span>' . $queryArr['tatamiOnline'][$i]['FioW'] ?>
                        </div>
                    <div class="clubs">
                        <span><?= (!empty($queryArr['tatamiOnline'][$i]['ClubR'])) ? $queryArr['tatamiOnline'][$i]['ClubR'] : '----' ?></span><br>
                        <span><?= (!empty($queryArr['tatamiOnline'][$i]['ClubW'])) ? $queryArr['tatamiOnline'][$i]['ClubW'] : '----' ?></span>
                    </div>
                </div>
                <? endfor; ?>
                <? elseif (isset($queryArr['tatami'])) : ?>
                <h1><?= $lang['champ']['menuTatami'] . '№' . $queryArr['tatami']['id'] ?></h1>
                <? for ($b = 0; $b < count($queryArr['tatami']['categories']); $b++) : ?>
                <?= $queryArr['tatami']['categories'][$b]['CategoryName'] ?><br>
                <? endfor; ?>
                <? else : ?>
                <table>
                    <tr>
                        <th></th>
                        <th><?= $lang['champ']['partFIO'] ?></th>
                        <th><?= $lang['champ']['partCountry'] ?></th>
                        <th><?= $lang['champ']['partGrade'] ?></th>
                        <th><?= $lang['champ']['partDateBr'] ?></th>
                        <th><?= $lang['champ']['partCategory'] ?></th>
                    </tr>
                    <? for ($i = 0; $i < count($queryArr['participants']); $i++) : ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= $queryArr['participants'][$i]['FIO'] ?></td>
                        <?php $id = $queryArr['participants'][$i]['CountryId'] ?>
                        <? for ($b = 0; $b < count($queryArr['countries']); $b++) : ?>
                        </td>
                        <? if ($queryArr['countries'][$b]['CountryId'] == $id && $lang['champ']['dbId'] == "gb") : ?>
                        <td><?= $queryArr['countries'][$b]['CountryNameEn'] ?></td>
                        <? break; ?>
                        <? elseif ($queryArr['countries'][$b]['CountryId'] == $id && $lang['champ']['dbId'] == "ru") : ?>
                        <td><?= $queryArr['countries'][$b]['CountryNameRu'] ?></td>
                        <? break; ?>
                        <? elseif ($queryArr['countries'][$b]['CountryId'] == $id && $lang['champ']['dbId'] == "ua") : ?>
                        <td><?= $queryArr['countries'][$b]['CountryNameUa'] ?></td>
                        <? break; ?>
                        <? endif; ?>
                        <? endfor; ?>
                        <td><?= $queryArr['participants'][$i]['Grade'] ?></td>
                        <td><?= $queryArr['participants'][$i]['DateBr'] ?></td>
                        <? for ($b = 0; $b < count($queryArr['categories']); $b++) : ?>
                        <? if ($queryArr['participants'][$i]['CategoryId'] == $queryArr['categories'][$b]['CategoryId']) : ?>
                        <td><?= $queryArr['categories'][$b]['CategoryName'] ?></td>
                    </tr>
                    <? break; ?>
                    <? endif; ?>
                    <? endfor; ?>
                    <? endfor; ?>
                </table>
                <? endif; ?>
                <?= (isset($queryArr['count']) && $queryArr['count'] > 50 && !($queryArr['count'] <= $queryArr['countCookie'])) ? "<a href= " . "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . " id=\"update\" onclick=\"updateList()\"><i class=\"fa fa-angle-double-down\" aria-hidden=\"true\" >" . "</i>" : '' ?>
        </div>
    </div>
    <? else : ?>
    <div class="content"> <a href="/"><?= $lang['404err']['onMain'] ?></a></div>
    <? endif; ?>