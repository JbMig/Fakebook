<button id="new_chat">
    <a href="/new_chat">nouvelle conversation</a>
</button>
<section id="conversation">
    <?php foreach ($conversations as $conversation): ?>
        <form id="goToChat" action="/conversation" method="post">
            <input type="hidden" name="chat_id" value="<?= $conversation["chat_id"] ?>" />
            <button type="submit" id="chat_picture" style="background: white; border:0; padding:5px;">
                <img src="img_chat_profil/<?= $conversation["chat_pic"] ?>" alt="" width="40px">
            </button>
            <button type="submit" id="chat_name" style="background: white; border:0; padding:0;"> 
                <?= $conversation["name"] ?> 
            </button>
            <span></span>
        </form>
    <?php endforeach ?>
</section>