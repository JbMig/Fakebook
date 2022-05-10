
<body>
	

</html>
<section>
	<!-- page top : profile picture, first & last name -->
</section>

<section>
	<!-- if it's not the page of the current user (he's visiting someone else's page) -->
	<div>
	<!-- interactions -->
		<form action="profile/" class="form" method="post" >
			<button type="submit" id="friend_request" name="friend_request">
				Demande d'ami
			<!-- relation request or remove from relations -->
			</button>
			<button type="submit" id="friend_removal" name="friend_removal">
				Ne plus être ami
			<!-- relation request or remove from relations -->
			</button>
			<button type="submit" id="start_chat" name="start_chat">
				Démarrer la conversation
			<!-- start chat if the person is a relationship -->
			</button>
		</form>
	</div>
</section>

<section>
	<!-- main page -->
	<div>
	<!-- articles -->
		<div>
		<!-- new article -->
			<!-- Form new article-->
			<form id="newPublicationForm" method="post" enctype="multipart/form-data">
				<label id="publicationLabel" for="articleInput">Ecrivez votre message</label><br>
				<textarea id="articleInput" name="articleInput" type="text"></textarea>
				<div id="depose">Déposez vos images ou cliquez pour choisir</div>
				<input type="file" name="fileToUpload" id="fileToUpload" accept="image/jpeg, image/png, image/gif, image/jpg">
				<div id="preview"></div>
				<button type="submit" id="submitPublication" >Envoyer</button>
				<button id="cancel">Annuler</button>
			</form>
		</div>
		<div>
		<!-- past articles -->
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
</body>