<?php if ($_SESSION["user"]["user_id"] === $profile["user_id"]) :?>
	<button><a style="text-decoration: none; color: black;" href="/settings_profil">Paramètres</a></button>
<?php endif; ?>
<section>
	<!-- page top : profile picture, first & last name -->
<<<<<<< HEAD
	<img id="profilPic" src="img_profil/<?= $profile["profil_picture"] ?>" alt="" width="40px">
	<img src="img_baniere/<?= $profile["banner"] ?>" alt="" >
=======
	<img src="img_profil/<?= $profile["profil_picture"] ?>" alt="" width="100px">
	<img src="img_baniere/<?= $profile["banner"] ?>" alt="" heigth="200px" width="1000px">
>>>>>>> 19c17460d073ee631404749f2d41946a06bfc396
</section>
<h1 id="h1"><?=$h1?></h1>
<!-- stats -->
<section>
	<div> <?=$profile["first_name"]?> a <?=$profile_stats["nb_friends"]?> relation(s). </div>
	<div> <?=$profile["first_name"]?> a publié <?=$profile_stats["nb_articles"]?> article(s). </div>
	<div> <?=$profile["first_name"]?> a commenté <?=$profile_stats["nb_comments"]?> article(s). </div>
	<div> <?=$profile["first_name"]?> a mis <?=$profile_stats["nb_likes"]?> like(s). </div>
	<div> Les articles de <?=$profile["first_name"]?> ont reçu <?=$profile_stats["comments_on_articles"]?> commentaire(s). </div>
	<div> Les articles de <?=$profile["first_name"]?> ont reçu <?=$profile_stats["likes_on_articles"]?> like(s). </div>
	<div> Les commentaires de <?=$profile["first_name"]?> ont reçu <?=$profile_stats["likes_on_comments"]?> like(s). </div>
</section> <br> <!-- we will remove this br when the css is done-->
<section>
	<!-- if it's not the page of the current user (he's visiting someone else's page) -->
	<div>
	<!-- interactions -->
	<?php if ($profile["status"]==='active') :?>
		<!-- if the person's page is inactive, there's no button -->
		<?php if ($_SESSION["user"]["user_id"] != $profile["user_id"]) :?>
			<?php if (Count($profile_friend) >= 1): ?>
				<!-- remove from relations -->
				<form action="/friend_removal" class="form" method="post" >
					<button type="submit" id="friend_removal" name="friend_removal">
						Ne plus être ami
					</button>
					<input type="hidden" name="friend_removal" value="<?= $profile_id ?>">
				</form>
				<!-- start chat if the person is a relationship -->
				<form action="/start_chat" class="form" method="post" >
					<button type="submit" id="start_chat" name="start_chat">
						Démarrer la conversation
					</button>
					<input type="hidden" name="start_chat" value="<?= $user_id ?>">
				</form>
			<?php else :?>
				<?php if (Count($profile_friend_request) >= 1): ?>
					<!-- accept relation request -->
					<?php if ($_SESSION["user"]["user_id"] === $profile_friend_request[0]["user_id_b"] && $profile_friend_request[0]["blocked"] === 'no') : ?>
						<form action="/friend_approval" class="form" method="post" >
							<button type="submit" id="friend_approval" name="friend_approval">
								Accepter la demande d'ami
							</button>
							<input type="hidden" name="friend_approval" value="<?= $profile_id ?>">
						</form>
					<?php endif ?>
					<!-- refuse or cancel the relation request if it hasn't been approved yet -->
					<?php if ($_SESSION["user"]["user_id"] === $profile_friend_request[0]["user_id_b"] && $profile_friend_request[0]["blocked"] === 'no'): ?>
						<form action="/friend_removal" class="form" method="post">
							<button type="submit" id="friend_removal" name="friend_removal">
								Refuser la demande d'ami
							</button>
							<input type="hidden" name="friend_removal" value="<?= $profile_id ?>">
						</form>
					<?php else :?>
						<!-- un-block -->
						<?php if ($profile_friend_request[0]["blocked"] === 'yes' && $_SESSION["user"]["user_id"] === $profile_friend_request[0]["user_id_a"]): ?>
							<form action="/friend_removal" class="form" method="post">
								<button type="submit" id="friend_removal" name="friend_removal">
									Débloquer
								</button>
								<input type="hidden" name="friend_removal" value="<?= $profile_id ?>">
							</form>
						<?php endif ?>
						<!-- cancel relation request -->
						<?php if ($_SESSION["user"]["user_id"] === $profile_friend_request[0]["user_id_a"] && $profile_friend_request[0]["blocked"] === 'no'): ?>
							<form action="/friend_removal" class="form" method="post">
								<button type="submit" id="friend_removal" name="friend_removal">
									Annuler la demande d'ami
								</button>
								<input type="hidden" name="friend_removal" value="<?= $profile_id ?>">
							</form>
						<?php endif ?>
					<?php endif ?>
				<?php else :?>
					<?php if (Count($profile_friend_request) < 1 || $profile_friend_request[0]["blocked"] === 'no'): ?>
						<!-- send a relation request -->
						<form action="/friend_request" class="form" method="post" >
							<button type="submit" id="friend_request" name="friend_request">
								Demande d'ami
							</button>
						<input type="hidden" name="friend_request" value="<?= $profile_id ?>">
						</form>
					<?php endif ?>
					<!-- block someone -->
					<form action="/block" class="form" method="post" >
						<button type="submit" id="block" name="block">
							Bloquer
						</button>
					<input type="hidden" name="block" value="<?= $profile_id ?>">
					</form>
				<?php endif ?>
			<?php endif ?>
		<!-- if it's the user's own profile -->
		<?php else : ?>
			<button type="button" id="open_new_page">Créer une page publique</button>
			<section id="new_page_section">
				<!-- require un truc ici -->
				<?php require __DIR__ . "/../php_partial/create_page.php"?>
			</section>
		<?php endif ?>
	<?php endif ?>
	</div>
</section>

<section>
	<!-- main page -->
	<div>
	<!-- articles -->
		<div>
		<!-- new article -->
			<!-- Form new article-->
			<?php if ($_SESSION["user"]["user_id"] == $profile["user_id"]) :?>
			<form id="newPublicationForm" method="post" enctype="multipart/form-data" action="/new_article">
				<label id="publicationLabel" for="articleInput">Ecrivez votre message</label><br>
				<textarea id="articleInput" name="articleInput" type="text"></textarea>
				<div id="depose">Déposez vos images ou cliquez pour choisir</div>
				<input type="file" name="fileToUpload" id="fileToUpload" accept="image/jpeg, image/png, image/gif, image/jpg">
				<div id="preview"></div>
				<button type="submit" id="submitPublication" >Envoyer</button>
				<button type="button" id="cancel">Annuler</button>
			</form>
			<?php endif ?>
		</div>
		<div>
			<!-- you can't see the person's past articles if they blocked you or if you blocked them -->
			<?php if (Count($profile_friend_request) >= 1 && $profile_friend_request[0]["blocked"] === 'yes'): ?>
				<?php if ($_SESSION["user"]["user_id"] === $profile_friend_request[0]["user_id_b"]): ?>  <!-- you've been blocked-->
					<span>Cette personne vous a bloqué.</span>
				<?php else :?>
					<span>Vous avez bloqué cette personne.</span>
				<?php endif ?>
			<!-- past articles -->
			<?php else :?>
				<!-- we don't show articles from inactive pages. -->
				<?php if ($profile["status"]==='inactive') :?>
					<span>Le compte de cette personne est inactif.</span>
				<?php else :?>
					<?php foreach ($articles as $article): ?>
						<?php if ($article["page_id"] === NULL AND $article["group_id"] === NULL) :?>
							<?php
							foreach ($user_likes as $user_like) {
								if ($user_like["article_id"] === $article["article_id"]) {
									$like = "unLike";
									break;
								} else {
									$like = "like";
								}
							} ?>
							<div id="article" style="margin-top:20px; border: solid 1px black; padding: 10px; width: 500px">
								<form id="goToProfile" action="/profile" method="post">
									<input type="hidden" name="profil_id" value="<?= $article["user_id"] ?>" />
									<button type="submit" id="profil_picture" style="background: white; border:0; padding:5px;">
										<img id="profilPic" src="img_profil/<?= $profile["profil_picture"] ?>" alt="" width="40px">
									</button>
									<button type="submit" id="first_name" style="background: white; border:0; padding:0;"> 
										<?= $profile["first_name"] . " " . $profile["last_name"] ?> 
									</button>
								</form>
								<span id="date"><?= $article["date"] ?></span>
								<br>
								<span id="data"><?= $article["content"] ?></span>
								<br>
								<?php if($article["picture"]) :?>
									<img id="image_article" width="300px" src="img_post/<?=$article["picture"]?>" >
								<?php endif; ?>
								<?php if($article["user_id"] === $_SESSION["user"]["user_id"]) :?>
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
								<?php endif ?>
								<form action="/like_article" method="post" id="like_article">
									<button id="like_btn" type="submit"><?= $like . " " . $article["like_count"] ?></button>
									<input type="hidden" name="like_article_id" value="<?= $article["article_id"] ?>">
								</form>
								<button type="button" id="open_comment">Comment</button>
								<section id="comment_section">
									<!-- require un truc ici -->
									<?php require __DIR__ . "/../php_partial/comment.php"?>
								</section>
							</div>
						<?php endif ?>
					<?php endforeach;?>
				<?php endif ?>
			<?php endif ?>
		</div>
	</div>
	<div>
		<!-- showing the list of pages, with a link to their profile -->
		<button type="button" id="open_pages_list">Afficher les pages suivies</button>
		<section id="pages_list" style="display: none">
			<?php foreach ($pages as $page) : ?>
				<form id="goToPage" action="/public_page" method="post"> <!-- needs to be modified to match a page -->
					<input type="hidden" name="page_id" value="<?= $page["page_id"] ?>" />
					<button type="submit" id="picture" style="background: white; border:0; padding:5px;">
						<img src="img_pages_groups/<?= $page["picture"] ?>" alt="" width="40px">
					</button>
					<button type="submit" id="first_name" style="background: white; border:0; padding:0;"> 
						<?= $page["name"] ?> 
					</button>
				</form>
			<?php endforeach; ?>
		</section>
	</div>
	<div>
	<!-- stats -->
		<div>
		<!-- articles published through time -->
		</div>
		<div>
		<!-- likes / the person put through time -->
		</div>
		<div>
		<!-- likes / the person obtained through time -->
		</div>
	</div>
</section>
