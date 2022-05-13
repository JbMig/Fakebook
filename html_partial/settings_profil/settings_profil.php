<section>
    <img id="" src="img_profil/<?= $profil_picture ?>" alt="">
    <?php if ($profil_id === $_SESSION["user"]["user_id"]) { ?>
        <button>Modifier photo</button>
        <form action="/edit_profl" id="edit_profil" method="post">
            <input type="file" name="upload_picture" accept="image/jpeg, image/png, image/gif, image/jpg">
            <button type="submit" id="valider_picture">Valider</button>
        </form>
    <?php } ?>
    </div>
    <form action="">
        <img src="img_baniere/<?= $profile["banner"] ?>" alt="">
        <button class="modifi" type="submit">Modifier</button>
    </form>
    <h2>Modifier profil</h2>
    <button>Valider</button>
    <div>
        <h3>Prénom</h3>
        <form id="new_first_name" method="post" action="/new_first_name">
            <input type="text" name="modifi_fname" value="<?= $first_name ?>">
            <button class="modifi" type="submit">Modifier</button>
        </form>
        <h3>Nom</h3>
        <form id="new_last_name" method="post" action="/new_last_name">
            <input type="text" name="modifi_lname" value="<?= $last_name ?>">
            <button class="modifi" type="submit">Modifier</button>
        </form>
        <h3>Email</h3>
        <form id="new_email" method="post" action="/new_email">
            <input type="email" name="modifi_email" value="<?= $email ?>">
            <button class="modifi" type="submit">Modifier</button>
        </form>
        <h3>Mot de passe</h3>
        <form id="new_password" method="post" action="/new_password">
            <button class="modifi" type="submit">Modifier</button>
            <input type="text" name="password" placeholder="Mot de passe actuel">
            <input type="text" name="new_password" placeholder="Nouveau mot de passe">
            <input type="text" name="confirm_password" placeholder="Confirm mot de passe">
        </form>
    </div>
</section>