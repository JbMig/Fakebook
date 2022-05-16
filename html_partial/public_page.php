<section>
	<form id="deco_form" method="post" action="/sign_out">
		<button class="nav_deco" id="deconnection" type="submit">Deconnection</button>
		<input type="hidden" name="deco">
	</form>
	<a href="timeline">Fil d'actualité</a>
	<form id="search" method="post" action="/search">
		<label id="search" for="search"></label>
    	<input id="search" type="text" name="search">
    	<button id="search" type="submit">Chercher</button>
</form>
</section>
<section>
	<!-- page top : profile picture, first & last name -->
	<img src="img_profil/<?= $page["picture"] ?>" alt="" width="40px">
	<img src="img_baniere/<?= $page["banner"] ?>" alt="" >
</section>
<h1 id="h1"><?=$h1?></h1>
<!-- stats -->
<section> 
<div> <?=$page["name"]?> compte <?=$nb_articles?> articles. </div>
<div> <?=$page["name"]?> est suivie par <?=$nb_followers?> personnes. </div>
</section> <br> <!-- we will remove this br when the css is done-->
<section>
	<div>
	<!-- interactions -->
		<?php if ($is_follower) :?>
			<!-- unfollow -->
			<form action="/unfollow" class="form" method="post" >
				<button type="submit" id="unfollow" name="unfollow">
					Ne plus suivre cette page
				</button>
				<input type="hidden" name="unfollow" value="<?= $page_id ?>">
			</form>
			<!-- i leave that here because we may use it for the group's page later, and i don't want to type it again -->
			<!-- <form action="/start_chat" class="form" method="post" >
				<button type="submit" id="start_chat" name="start_chat">
					Démarrer la conversation
				</button>
				<input type="hidden" name="start_chat" value="<?= $user_id ?>">
			</form> -->
		<?php> else :?>
			<form action="/follow" class="form" method="post" >
				<button type="submit" id="follow" name="follow">
					Suivre cette page
				</button>
				<input type="hidden" name="follow" value="<?= $page_id ?>">
			</form>
		<?php> endif ?>
	</div>
</section>
<!-- on s'est arrêtés là pr ce matin -->
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
			<!-- you can't see the person's past articles if they blocked you or if you blocked them -->
			<?php if (Count($profile_friend_request) >= 1 && $profile_friend_request[0]["blocked"] === 'yes'): ?>
				<?php if ($_SESSION["user"]["user_id"] === $profile_friend_request[0]["user_id_b"]): ?>  <!-- you've been blocked-->
					<span>Cette personne vous a bloqué.</span>
				<?php else :?>
					<span>Vous avez bloqué cette personne.</span>
				<?php endif ?>
			<!-- past articles -->
			<?php else :?>
				<!-- we don't show articles from inactive accounts. -->
				<?php if ($profile["status"]==='inactive') :?>
					<span>Le compte de cette personne est inactif.</span>
				<?php else :?>
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
				<?php endif ?>
			<?php endif ?>
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