<section>
	<form id="deco_form" method="post" action="/sign_out">
		<button class="nav_deco" id="deconnection" type="submit">Deconnection</button>
		<input type="hidden" name="deco">
	</form>
	<a href="timeline">Fil d'actualité</a>
</section>
<section>
	<!-- page top : profile picture, first & last name -->
	<img src="img_profil/<?= $profile["profil_picture"] ?>" alt="" width="40px">
	<img src="img_baniere/<?= $profile["banner"] ?>" alt="" >
</section>
<h1 id="h1"><?=$h1?></h1>
<section>
	<!-- if it's not the page of the current user (he's visiting someone else's page) -->
	<div>
	<!-- interactions -->
	<?php if ($_SESSION["user"]["user_id"] != $profile["user_id"]) :?>
		<form action="/friend_request" class="form" method="post" >
			<button type="submit" id="friend_request" name="friend_request">
				Demande d'ami
			<!-- relation request or remove from relations -->
			</button>
			<input type="hidden" name="friend_request" value="<?= $profile_id ?>">
		</form>
		<form action="/friend_removal" class="form" method="post" >
			<button type="submit" id="friend_removal" name="friend_removal">
				Ne plus être ami
			<!-- relation request or remove from relations -->
			</button>
			<input type="hidden" name="friend_removal" value="<?= $profile_id ?>">
		</form>
		<form action="/start_chat" class="form" method="post" >
			<button type="submit" id="start_chat" name="start_chat">
				Démarrer la conversation
			<!-- start chat if the person is a relationship -->
			</button>
			<input type="hidden" name="start_chat" value="<?= $user_id ?>">
		</form>
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
				<button id="cancel">Annuler</button>
			</form>
			<?php endif ?>
		</div>
		<div>
		<!-- past articles -->
			<?php foreach ($articles as $article): ?>
				<div id="article" style="margin-top:20px; border: solid 1px black; padding: 10px; width: 500px">
					<form id="goToProfile" action="/profile" method="post">
						<input type="hidden" name="profil_id" value="<?= $article["user_id"] ?>" />
						<button type="submit" id="profil_picture" style="background: white; border:0; padding:5px;">
							<img src="img_profil/<?= $profile["profil_picture"] ?>" alt="" width="40px">
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
					<?php endif ?>

				</div>
			<?php endforeach;?>


		</div>
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
