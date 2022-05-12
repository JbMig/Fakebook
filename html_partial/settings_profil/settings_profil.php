<section>
    <h2>Modifier profil</h2>
    <button>Valider</button>
    <div>
        <h3>Prénom</h3>
        <form id="" method="get" action="/new_first_name">
            <input type="text" name="modifi_fname" value="<?= $first_name ?>">
            <button class="modifi" type="submit">Modifier</button>
        </form>
        <h3>Nom</h3>
        <form id="" method="get" action="/new_last_name">
            <input type="text" name="modifi_lname" value="<?= $last_name ?>">
            <button class="modifi" type="submit">Modifier</button>
        </form>
        <h3>Email</h3>
        <form id="" method="get" action="/new_email">
            <input type="text" name="modifi_email" value="<?= $email ?>">
            <button class="modifi" type="submit">Modifier</button>
        </form>
        <h3>Mot de passe</h3>
        <form id="" method="get" action="/new_password">
            <input type="text" name="modifi_password" value="<?= $password ?>">
            <button class="modifi" type="submit">Modifier</button>
        </form>
    </div>
</section>