<div id="newComment">
    <!-- Form new article-->
    <form id="newcommentForm" method="post" action="/new_comment">
        <label id="commentLabel" for="commentInput">Ecrivez votre commentaire</label><br>
        <textarea id="commentInput" name="commentInput" type="text"></textarea>
        <input type="hidden" id="new_comment_input" name="article_id" value="<?= $article["article_id"] ?>">
        <button type="submit" id="submitPublication">Envoyer</button>
    </form>
</div>
<?php foreach ($comments as $comment) :
    foreach ($comment_profiles as $comment_profile) {
        if ($comment_profile["user_id"] === $comment["user_id"]) {
            $profil_picture = $comment_profile["profil_picture"];
            $first_name = $comment_profile["first_name"];
            $last_name = $comment_profile["last_name"];
        }
        foreach ($comment_user_likes as $comment_user_like) {
            if ($comment_user_like["comment_id"] === $comment["comment_id"]) {
                $comment_like = "unLike";
                break;
            } else {
                $comment_like = "like";
            }
        }
    } ?>
    <div id="comment" style="margin-top:20px; border: solid 1px black; padding: 10px; width: 300px">
        <form id="goToProfile" action="/profile" method="post">
            <input type="hidden" name="profil_id" value="<?= $comment["user_id"] ?>" />
            <button type="submit" id="comment_profil_picture" style="background: white; border:0; padding:5px;">
                <img id="profilPic" src="img_profil/<?= $profil_picture ?>" alt="" width="30px">
            </button>
            <button type="submit" id="comment_name" style="background: white; border:0; padding:0;">
                <?= $first_name . " " . $last_name ?>
            </button>
        </form>
        <span id="date"><?= $comment["date"] ?></span>
        <br>
        <span id="data"><?= $comment["content"] ?></span>
        <form action="/like_comment" method="post" id="like_comment">
            <button id="like_btn_comment" type="submit"><?= $comment_like . " " . $comment["like_count"] ?></button>
            <input type="hidden" name="like_comment_id" value="<?= $comment["comment_id"] ?>">
        </form>
        <?php if ($comment["user_id"] === $_SESSION["user"]["user_id"]) : ?>
            <form id="delete_comment" method="post" action="/delete_comment">
                <button type="submit" id="delete_btn_comment">Supprimer</button>
                <input type="hidden" name="comment_id" value="<?= $comment["comment_id"] ?>">
                <input type="hidden" name="comment_user" value="<?= $comment["user_id"] ?>">
            </form>
            <button type="button" id="open_modify_comment">Modifier</button>
            <form id="form_modify_comment" method="post" action="/modify_comment">
                <label id="label_modify_comment" for="modify_comment_input">Ecrivez votre message</label>
                <textarea id="modify_comment_input" type="text" name="modify_comment" value=""><?= $comment["content"] ?></textarea>
                <button id="modify_btn_comment" type="submit">Valider</button>
                <input type="hidden" name="comment_id" value="<?= $comment["comment_id"] ?>">
                <input type="hidden" name="comment_user" value="<?= $comment["user_id"] ?>">
            </form>

        <?php endif ?>

    </div>
<?php endforeach; ?>