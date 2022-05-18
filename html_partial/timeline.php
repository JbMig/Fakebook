<!-- link to the current user's profile page -->
<form id="goToProfile" action="/profile" method="post">
	<input type="hidden" name="profil_id" value="<?= $_SESSION["user"]["user_id"] ?>" />
	<button type="submit" id="profil_picture" style="background: white; border:0; padding:5px;">
		<img src="img_profil/<?=  $_SESSION["user"]["profil_picture"] ?>" alt="" width="40px">
	</button>
	<button type="submit" id="first_name" style="background: white; border:0; padding:0;"> 
		<?=$user_name?> 
	</button>
</form>
<section id="sectionPublication">
    <div id="newPublication">
        <!-- Form new article-->
        <form id="newPublicationForm" method="post" enctype="multipart/form-data" action="/new_article">
            <label id="publicationLabel" for="articleInput">Ecrivez votre message</label><br>
            <textarea id="articleInput" name="articleInput" type="text"></textarea>
            <div id="depose">Déposez vos images ou cliquez pour choisir</div>
            <input type="file" name="fileToUpload" id="fileToUpload" accept="image/jpeg, image/png, image/gif, image/jpg">
            <div id="preview"></div>
            <button type="submit" id="submitPublication" >Envoyer</button>
            <button type="button" id="cancel">Annuler</button>
        </form>
    </div>
    <?php foreach ($articles as $article):
        foreach ($profiles as $profile) { 
            if ($profile["user_id"] === $article["user_id"]) {
                $profil_picture = $profile["profil_picture"];
                $first_name = $profile["first_name"];
                $last_name = $profile["last_name"];
                $status = $profile["status"];
            }
        }
        foreach ($user_likes as $user_like) {
            if ($user_like["article_id"] === $article["article_id"]) {
                $like = "unLike";
                break;
            } else {
                $like = "like";
            }
        }
		
		if($article["page_id"] !== NULL) {
			$maRequete = $pdo->prepare(
				"SELECT `name` from `pages` WHERE `page_id` = :pageId ");
				$maRequete->execute([
					":pageId" => $article["page_id"]
				]);
			$name = $maRequete->fetch();

			$maRequete = $pdo->prepare(
				"SELECT `picture` from `pages` WHERE `page_id` = :pageId ");
				$maRequete->execute([
					":pageId" => $article["page_id"]
				]);
			$picture = $maRequete->fetch();
		} else if ($article["group_id"] !== NULL) {
			$maRequete = $pdo->prepare(
				"SELECT `name` from `groups` WHERE `group_id` = :groupId ");
				$maRequete->execute([
					":groupId" => $article["group_id"]
				]);
			$name = $maRequete->fetch();

			$maRequete = $pdo->prepare(
				"SELECT `picture` from `groups` WHERE group_id` = :groupId ");
				$maRequete->execute([
					":groupId" => $article["group_id"]
				]);
			$picture = $maRequete->fetch();
		}
		
		
		?>
		<!-- articles -->
		<?php if ($article["page_id"] === NULL && $article["group_id"] === NULL) {
			$show_name = $first_name . " " . $last_name;
			$show_picture = "img_profil/" . $profil_picture;
			$picture_id = "profil_picture";
			$action = "/profile";
			$actionId = "goToProfile";
			$action_name = "profil_id";
			$action_value = $article["user_id"];
		} else  if ($article["page_id"] !== NULL){
			$show_name = $name; // à créer !!!
			$show_picture =  "img_pages_groups/" . $picture; // à créer !!!
			$picture_id = "picture";
			$action = "/public_page";
			$actionId = "goToPage";
			$action_name = "page_id";
			$action_value = $article["page_id"];
		} else {
			$show_name = $name; // à créer !!!
			$show_picture =  "img_pages_groups/" . $picture; // à créer !!!
			$picture_id = "picture";
			$action = "/group";
			$actionId = "goToGroup";
			$action_name = "group_id";
			$action_value = $article["group_id"];
		};
		var_dump($show_name, $show_picture, $picture_id, $action, $actionId, $action_name, $action_value);
		?>
		<div id="article" style="margin-top:20px; border: solid 1px black; padding: 10px; width: 500px">
			<form id="<?= $actionId ?>" action="<?= $action ?>" method="post">
				<input type="hidden" name="<?= $action_name ?>" value="<?= $action_value ?>" />
				<button type="submit" id="<?= $picture_id ?>" style="background: white; border:0; padding:5px;">
					<img src="<?= $show_picture ?>" alt="" width="40px">
				</button>
				<button type="submit" id="first_name" style="background: white; border:0; padding:0;"> 
					<?= $show_name ?> 
				</button>
			</form>
			<span id="date"><?= $article["date"] ?></span>
			<br>
			<span id="data"><?= $article["content"] ?></span>
			<br>
			<?php if($article["picture"]) :?>
				<img id="image_article" width="300px" src="img_post/<?=$article["picture"]?>" >
			<?php endif; ?>
			<form action="/like_article" method="post" id="like_article">
				<button id="like_btn" type="submit"><?= $like . " " . $article["like_count"] ?></button>
				<input type="hidden" name="like_article_id" value="<?= $article["article_id"] ?>">
			</form>

			<?php if($user_id === $article["user_id"]) : ?>
				<form id="delete_article" method="post" action="/delete_article">
					<button type="submit" id="delete_btn">Supprimer</button>
					<input type="hidden" name="article_id" value="<?=$article["article_id"]?>">
					<input type="hidden" name="article_user" value="<?=$article["user_id"]?>">
				</form>
				<button type="button" id="open_modify_article">Modifier</button>
				<form id="form_modify_article" method="post" action="/modify_article">
					<label id="label_modify" for="modify_input">Ecrivez votre message</label>
					<textarea id="modify_article_input" type="text" name="modify_article" value=""><?= $article["content"] ?></textarea>
					<button id="modify_btn" type="submit">Valider</button>
					<input type="hidden" name="article_id" value="<?=$article["article_id"]?>">
					<input type="hidden" name="article_user" value="<?=$article["user_id"]?>">
				</form>
			<?php endif; ?>


			<button type="button" id="open_comment">Comment</button>
			<section id="comment_section">
				<!-- require un truc ici -->
				<?php require __DIR__ . "/../php_partial/comment.php"?>
			</section>
		</div>



		<!-- partie supprimée (gardée dans brouillon_html.php par sécurité) -->



    <?php endforeach;?>
</section>