<!DOCTYPE html>
<html lang="de">

<head>
    <!-- META -->
    <meta charset="UTF-8" />
    <meta name="author" content="Dave Brunner">
    <meta name="description" content="Kryptorechner">
    <meta name="keywords" content="Krypto, Crypto, Bitcoin, Calculator">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <!-- Links -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Title -->
    <title>Kryptorechner</title>
</head>

<body>
    <!-- Header -->
    <header class="w3-container w3-black">
        <a id="headerTitle" href="index.php">
            <h1 class="headerTitle">Kryptorechner</h1>
        </a>
        <h3 id="userName">Hallo <?php if (!isset($_COOKIE["vorname"])) {
                                    echo "Gast";
                                } else {
                                    echo htmlspecialchars($_COOKIE["vorname"]);
                                } ?></h3>
        <!-- <br><br><br><br><br><br> -->

        <nav class="w3-bar w3-black">
            <button class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="document.getElementById('sub').classList.toggle('w3-hide-small');"> &equiv; </button>
            <a href="index.php#info" class="w3-bar-item w3-button ">Informationen</a>
            <div id="sub" class="  w3-hide-small">
                <a href="index.php#rechner" class="w3-bar-item w3-button  ">Kryptorechner</a>
                <a href="index.php#canvas" class="w3-bar-item w3-button ">Canvas</a>
            </div>
        </nav>

    </header>
</body>

<main>

    <section id="info" class="w3-container">

        <h2>Informationen</h2>

        <div class="w3-card-4" style="margin:auto;">
            <div class="w3-container w3-center" style="width:50%; max-width: 500px; margin:auto; padding-top: 20px;">
                <img src="img/coins.jpg" alt="cryptoCoins" style="width:100%; max-width: 500px;">
            </div>
            <div class="w3-container w3-center">
                <p>Herzlich Willkommen!</p>
                <p>Kryptorechner.ch ist der Ort für dich um Fiat-Währungen einfach in Kryptowährungen umzurechnen. Seit 5 Jahren stehen unsere Website und Kryptorechner für Effizienz, Geschwindigkeit und Datenschutz. Du benötigst für die Dienstleistung keinen Benutzeraccount und kannst direkt die gewünschte Währung umrechnen.</p>
            </div>
        </div>

    </section>

    <section id="rechner" class="w3-container">
        <div class="w3-row">
            <h2>Kryptorechner</h2>

 

            <form action="form.html" method="post" class="w3-container w3-card-4" onsubmit="returnisValid();" style="padding: 10px 10px;">

                <br>
                <div class="w3-col m3" style="padding-left: 10px;">
                    <label class="w3-text-blue">Fiat-Währung</label>
                    <br>
                    <label style="display: inline-block;">
                        <input class="w3-radio" type="radio" name="fiat" value="chf" checked>
                        CHF</label>
                    <label style="display: inline-block;">
                        <input class="w3-radio" type="radio" name="fiat" value="euro">
                        Euro</label>
                    <label style="display: inline-block;">
                        <input class="w3-radio" type="radio" name="fiat" value="usd">
                        USD</label>

                </div>


                <div class="w3-col m3" style="padding-left: 10px;">
                    <label class="w3-text-blue">Menge</label>
                    <input class="w3-input" type="text" style="max-width: 250px;">
                </div>

                <div class="w3-col m3" style="padding-left: 10px;">
                    <label class="w3-text-blue">Umwandeln nach:</label>
                    <br>
                    <select class="w3-select w3-text" name="option" style="padding-bottom:10px; max-width: 250px;">
                        <option value="" disabled selected>Choose </option>
                        <option value="1">BTC</option>
                        <option value="2">ETH</option>
                        <option value="3">BNB</option>
                    </select>
                </div>

                <div class="w3-col m3" style="padding-left: 10px;">
                    <p class="w3-center" "><button type=" submit" class="w3-btn w3-teal " style="width: 90%; margin-top:8px;">Umrechnen</button></p>
                </div>







            </form>




        </div>
    </section>




</main>


<footer>
</footer>

</html>