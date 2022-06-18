<div class="content">
    <div class="centered">
        <div class="AdminLogin">
            <form method="POST" action=<?= "/Admin/CheckPostLogin" ?>>
                <label for="adminlog">adminlog: </label><input autocomplete="off" id="adminlog" type="text" name="adminlog" required>
                <label for="adminpass">adminpass: </label><input autocomplete="off" id="adminpass" type="password" name="adminpass" required>
                <input autocomplete="off" type="submit" value="Log in" name="login">
            </form>
        </div>
    </div>
</div>