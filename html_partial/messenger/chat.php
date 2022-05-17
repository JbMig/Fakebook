<section id="message">
    <h1><?= $_SESSION["chat"]["name"] ?></h1>
    <section style="border: 1px solid #black; padding: 4px;">
        <?php foreach ($messages as $message):
            if ($message["user_id"] === $user_id) {
                $name = $_SESSION["user"]["first_name"] . " " . $_SESSION["user"]["last_name"];
                $color = "#3CFEAF";
                $margin = "400px";
            } else {
                foreach ($members as $member){
                    if ($member["user_id"] === $message["user_id"]) {
                        $name = $member["first_name"] . " " . $member["last_name"];
                        $color = "#99E7FF";
                        $margin = "0px";
                        break;
                    }
                }
            } ?>

            <div style=" margin: 10px; margin-left: <?= $margin ?>;">
                <span style=" border: 1px solid black; border-radius:10px; background-color: <?= $color ?>; padding: 4px;">
                    <?= $name . ": " . $message["content"] ?>
                </span>
            </div>
        <?php endforeach ?>
        <form action="/new_message" method="post" style="margin: 30px;">
            <textarea rows="2" cols="50"  name="new_message" id="new_message"></textarea><br>
            <input type="hidden" name="chat_id" value="<?= $chat_id ?>">
            <button>Envoyer</button>
        </form>
    </section>
</section>