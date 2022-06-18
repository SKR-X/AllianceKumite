<div class="content">
<form class="log" method="POST" action="/login/CheckPostLogin?champ=<?=$queryArr['champ']?>">
    <span>E-Mail</span>
    <input type="email" name="email">
    <span><?=$lang['login']['pass']?></span>
    <input type="password" name="pass">
    <input type="submit" value="<?=$lang['login']['header']?>">
    <a id="lostPass" href="/resetpassword"><?=$lang['login']['lostPass']?></a>
</form>
</div>
