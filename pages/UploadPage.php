<? for ($i = 0; $i < count($queryArr); $i++) : ?>
<? foreach ($queryArr[$i] as $key => $value) : ?>
<? if ($queryArr[$i][$key] != NULL) : ?>
<?= $queryArr[$i][$key] . ';' ?>
<? endif; ?>
<? endforeach; ?>
<?= '<br>' ?>
<? endfor; ?>