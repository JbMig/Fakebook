<section id="sectionPublication">
    <div id="newPublication">
        <!-- Form new article-->
        <form id="newPublicationForm" method="post" enctype="multipart/form-data">
            <label id="publicationLabel" for="articleInput">Ecrivez votre message</label><br>
            <textarea id="articleInput" name="articleInput" type="text"></textarea>
            <div id="depose">Déposez vos images ou cliquez pour choisir</div>
            <input type="file" name="fileToUpload" id="fileToUpload" accept="image/jpeg, image/png, image/gif, image/jpg">
            <div class="bloc" id="preview"></div>
            <button type="submit" id="submitPublication" >Envoyer</button>
        </form>
    </div>