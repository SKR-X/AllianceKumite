<div class="content">
    <div class="editpages">
        <form method="POST" action="/admin/checkPostPanel">
            <p> Create ChampPage: </p><br>
            <input autocomplete="off" type="text" name="urlName" placeholder="urlName" required><br><br>
            <input autocomplete="off" type="submit" name="CreatePage" value="Create">
        </form>
        <br>
        <form method="POST" action="/admin/checkPostPanel">
            <p> Delete ChampPage: </p><br>
            <input autocomplete="off" type="text" name="urlNameDel" placeholder="urlName" required><br><br>
            <input autocomplete="off" type="submit" name="DelPage" value="Delete">
        </form>
        <br>
        <p>cup_brovary</p>
        <form method="POST" action="/upload/cup_brovary" enctype="multipart/form-data">
        <input autocomplete="off" type="hidden" name="MAX_FILE_SIZE" value="3000000" />
            <input autocomplete="off" type="text" placeholder="Title" name="Title"><br><br>
            <input autocomplete="off" type="text" placeholder="url" name="url"><br><br>
            <input autocomplete="off" type="text" placeholder="int" name="CurrFight"><br><br>
            <input autocomplete="off" type="text" placeholder="Tatami" name="Tatami"><br><br>
            <input autocomplete="off" type="file" name="file"><br><br>
            <input autocomplete="off" type="submit"><br>
        </form>
    </div>
</div>