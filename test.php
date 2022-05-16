<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
</head>
<body>
    <form method="post" action="/test" id="test_form">
        <input type="text" required name="name" >
        <input type="hidden" id="test" required>
        <button id="button" >envoyer</button>
    </form>
    <form method="post">
        <select id="select">
            <option value="<?= $_SESSION["user"]["user_id"] ?>">option1</option>
            <option value="<?= $_SESSION["user"]["first_name"] ?>">option2</option>
            <option value="<?= $_SESSION["user"]["last_name"] ?>">option3</option>
        </select>
        <button type="button" id="add_test">ajouter un test</button>
    </form>
</body>
</html>
<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        foreach ($_POST as $key => $value) {
            if ($_POST["name"] !== $value) {
                echo $_POST["name"] . " " . $value . "\n";
            }
        }
    }
?>

<script>
    let firstTest = document.querySelector("#test");
    let button = document.querySelector("#button");
    let add_test = document.querySelector("#add_test");
    let test_form = document.querySelector("#test_form");
    let select = document.querySelector("#select");
    function addValue() {
        if (!firstTest.value){
            firstTest.value = select.value
            document.querySelector("#test").type = "text";
        } else {
            newInput = document.createElement("input");
            newInput.id = "test";
            newInput.type = "text";
            newInput.value = select.value;
            test_form.appendChild(newInput);
        }
    }

add_test.addEventListener("click", addValue);
    
    function changeName() {
        if (!firstTest.value){
            alert("Ajouter un ami");
        }
        let input = document.querySelectorAll("#test");
        row = input.length;
        for (let i = 0; i < row; i++) {
            let name = "test" + i;
            input[i].name = name;
        }
        
    }
    
    button.addEventListener("click", changeName);
    
</script>