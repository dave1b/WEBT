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
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="js/ajaxCall.js"></script>
    <!-- Title -->
    <title>Kryptorechner</title>
</head>






<body>
    <!-- Header -->
    <header class="w3-container w3-black">
        <a id="headerTitle" href="index.html">
            <h1 class="headerTitle">Kryptorechner</h1>
        </a>


        <nav class="w3-bar w3-black">
            <button class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="document.getElementById('sub').classList.toggle('w3-hide-small');"> &equiv; </button>
            <a href="index.html#info" class="w3-bar-item w3-button ">Informationen</a>
            <div id="sub" class="  w3-hide-small">
                <a href="index.html#rechner" class="w3-bar-item w3-button  ">Kryptorechner</a>
                <a href="index.html#canvas" class="w3-bar-item w3-button ">Canvas</a>
            </div>
        </nav>

    </header>

    <?php
    # Verarbeitung des Formulars
    $crypto = $_POST['option'];
    $fiat = $_POST['fiat'];
    $menge = $_POST['menge'];

    $cryptoString;
    $fiatString;
    $valueInCrypto;
    $exchangeRate;

    /* switch ($crypto) {
        case 'bitcoin':
            $cryptoString = "Bitcoin";
            break;
        case 'ethereum':
            $cryptoString = "Ether";
            break;
        case 'binancecoin':
            $cryptoString = "Binance Coin";
            break;
    }

    */
    switch ($fiat) {
        case 'CHF':
            $fiatString = "Schweizer Franken";
            break;
        case 'EUR':
            $fiatString = "Euro";
            break;
        case 'USD':
            $fiatString = "US-Dollar";
            break;
    }



/*
    echo $fiat;
    echo $menge;
    echo $crypto;
    echo $exchangeRate;
    echo $valueInCrypto;

*/

    $requestCoinGecko = file_get_contents("https://api.coingecko.com/api/v3/coins/markets?vs_currency=" . $fiat . "&ids=" . $crypto . "&order=market_cap_desc&per_page=100&page=1&sparkline=false");
    #$requestCoinGecko = file_get_contents("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=bitcoin&order=market_cap_desc&per_page=100&page=1&sparkline=false");
    $cryptoArray = json_decode($requestCoinGecko, true);

    #  print_r($cryptoArray);
    $exchangeRate = $cryptoArray[0]['current_price'];
    $valueInCrypto = ($menge / $exchangeRate);


    # echo $cryptoArray[0]['id'];

    ?>

    <main>

        <section id="result" class="w3-container">



            <div class="w3-card-4 w3-center" style="margin:auto;">




                <div class="w3-container w3-center">


                    <div class="w3-row " style="display: inline-flex ;">

                        <div lass="w3-col m5" style="margin: auto;">
                            <img src=" <?php echo $cryptoArray[0]['image']; ?>" style="max-width: 150px;">
                        </div>

                        <div class=" w3-col m5" style="margin: auto;">
                            <?php
                            echo '<h2 class="h2Result" >Umwandlung von ' . $fiatString . ' zu ' . $cryptoArray[0]['name'] . '</h2>';
                            echo ' </div>';
                            ?>
                        </div>

                    </div>

                    <div class="w3-row">


                        <div class="w3-col w3-card m3">
                            <h3>
                                Fiat-Währung
                            </h3>
                            <p>
                                <?php
                                echo $menge . " " . $fiatString;
                                ?>
                            </p>

                        </div>
                        <div class="w3-col w3-card m3">
                            <h3>Wert in
                                <?php
                                echo $cryptoArray[0]['name'];
                                ?>
                            </h3>
                            <p>
                                <?php
                                echo $valueInCrypto . " " . strtoupper($cryptoArray[0]['symbol']);
                                ?>
                            </p>
                        </div>
                        <div class="w3-col w3-card m3">
                            <h3>Preis pro
                                <?php
                                echo strtoupper($cryptoArray[0]['symbol']);
                                ?>
                            </h3>
                            <p>
                                <?php
                                echo $exchangeRate . " " . $fiat;
                                ?>

                            </p>
                        </div>
                        <div class="w3-col w3-card m3">
                            <h3>Marktkapitalisierung</h3>
                            <p>
                                <?php
                                echo $cryptoArray[0]['market_cap'] . " " . $fiat;
                                ?>
                            </p>
                        </div>





                    </div>

                    <div class="link-container"> 

                        <a href="index.html">
                            <button class="w3-button w3-lime " href="index.html">Zurück</button>
                        </a>

                        <a href="<?php echo "https://www.coingecko.com/en/coins/" . $cryptoArray[0]['id']; ?>">
                            <button class="w3-button w3-lime ">
                                <?php
                                echo "mehr Infos zu " . ucfirst($cryptoArray[0]['id']);
                                ?>
                            </button>
                        </a>
                    </div>

                </div>
            </div>


        </section>

    </main>
</body>


<footer>
</footer>

</html>