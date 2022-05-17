<section id="message">
    <h1><?= $_SESSION["chat"]["name"] ?></h1>
    <section id="section_message" style="overflow: scroll; border: 1px solid black; padding: 10px; height: 200px; width: 600px;">
        
    </section>
    <form action="/new_message" method="post" id="new_message" style="margin: 30px;">
        <textarea rows="2" cols="50"  name="new_message" id="new_message" required></textarea><br>
        <input type="hidden" name="chat_id" value="<?= $chat_id ?>">
        <button id="new_message_btn" type="button">Envoyer</button>
    </form>
</section>