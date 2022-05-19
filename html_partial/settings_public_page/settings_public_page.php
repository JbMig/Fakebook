<section>
    <img id="" src="img_page_group/<?= $picture ?>" alt="" width="40px">
    <form action="/edit_photo" id="edit_profil" method="post" enctype="multipart/form-data">
        <input type="file" name="upload_picture" accept="image/jpeg, image/png, image/gif, image/jpg">
        <button type="submit" id="valider_picture">Valider</button>
    </form>
    <img id="" src="img_baniere/<?= $banner ?>" alt="" width=" 200px">
    <form action="/edit_banniere" id="edit_banniere" method="post" enctype="multipart/form-data">
        <input type="file" name="upload_ban" accept="image/jpeg, image/png, image/gif, image/jpg">
        <button type="submit" id="valider_banniere">Valider</button>
    </form>
    <div>
        <h3>Nom</h3>
        <form id="new_name" method="post" action="/new_name">
            <input type="text" name="modify_name" value="<?= $name ?>">
            <button class="modify" type="submit">modifier</button>
        </form>
    </div>
