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
    <link rel="stylesheet" href="css/stylesheet.css">

    <!-- Title -->
    <title>Kryptorechner</title>
</head>


<body>
    <!-- Header -->
    <header class="w3-container w3-teal">
        <a href="index.html" style="font-style: inherit;">
            <h1 id="headerTitle">Kryptorechner</h1>
        </a>


        <nav class="w3-bar w3-teal myNav">
            <button class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="document.getElementById('sub').classList.toggle('w3-hide-small');"> &equiv; </button>
            <a href="index.html#info" class="w3-bar-item w3-button myNavItem">Informationen</a>
            <div id="sub" class="  w3-hide-small">
                <a href="index.html#rechner" class="w3-bar-item w3-button  myNavItem">Kryptorechner</a>
                <a href="index.html#canvas" class="w3-bar-item w3-button myNavItem">Canvas</a>
            </div>
        </nav>

    </header>

    <?php


    # Validierung der Eingaben im Formular

    if (!isset($_POST['option']) || !isset($_POST['fiat']) || !isset($_POST['option'])) {

        echo '<script> alert("Geben Sie gültige Eingaben in das Formular!");  </script>';
        echo '<script> window.location = "index.html";  </script>';
    } else {

        # Verarbeitung des Formulars
        $crypto = $_POST['option'];
        $fiat = $_POST['fiat'];
        $menge = $_POST['menge'];
    }


    if (0 < $menge && $menge <= 1000000000) {
        # alles I.O
    } else {
        echo '<script> alert("Geben Sie eine gültige Fiat-Menge ein!");  </script>';
        echo '<script> window.location = "index.html";  </script>';
        return;
    }

    if ($crypto == 'bitcoin' || $crypto == 'ethereum'  || $crypto == 'binancecoin') {
        # alles I.O
    } else {
        echo '<script> alert("Geben Sie eine Kryptowährung  ein!");  </script>';
        echo '<script> window.location = "index.html";  </script>';
        return;
    }

    if ($fiat == 'CHF' || $fiat == 'USD'  || $fiat == 'EUR') {
        # alles I.O
    } else {
        echo '<script> alert("Geben Sie eine Fiat-Währung an!");  </script>';
        echo '<script> window.location = "index.html";  </script>';
        return;
    }
    if (isset($_POST['newsletter'])) {
        if ($_POST['newsletter'] == 'on') {


            if (!isset($_POST['email']) || !isset($_POST['email'])) {
                echo '<script> alert("Geben Sie Ihre gültige E-Mail Adressen an!");  </script>';
                echo '<script> window.location = "index.html";  </script>';
                return;
            }
            if ($_POST['email'] != $_POST['email2'] || $_POST['email'] == "") {
                echo '<script> alert("Ihre E-Mail Adressen stimmen nicht überrrein!");  </script>';
                echo '<script> window.location = "index.html";  </script>';
                return;
            }
        }
    }



    # Variablen deklarieren
    $fiatString;
    $valueInCrypto;
    $exchangeRate;



    # Cookie erstellen
    if (!(isset($_COOKIE['anzahlAnfragen']))) {

        setcookie("anzahlAnfragen", 1, time() + 3600);
    } else {
        setcookie("anzahlAnfragen", $_COOKIE['anzahlAnfragen'] + 1, time() + 3600);
    }


    # $fiat Variable initalisieren
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


    # API Aufrufen
    $requestCoinGecko = file_get_contents("https://api.coingecko.com/api/v3/coins/markets?vs_currency=" . $fiat . "&ids=" . $crypto . "&order=market_cap_desc&per_page=100&page=1&sparkline=false");
    $cryptoArray = json_decode($requestCoinGecko, true);


    #  (Test)   print_r($cryptoArray);
    $exchangeRate = $cryptoArray[0]['current_price'];
    $valueInCrypto = ($menge / $exchangeRate);


    # Formular-Anfrage in Datenbank einschreiben
    $conn = mysqli_connect("localhost", "root", "", "cryptorechner");
    $query = "insert into requests ( fiat, fiatTyp, crypto, cryptoTyp) values ( ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'dsds',  $menge, $fiat, $valueInCrypto, $cryptoArray[0]['name']);
    if (!$res = mysqli_stmt_execute($stmt)) {
        echo '<script> alert("Verbindung mit DB fehlgeschlagen") </script>';
    }
    ?>

    <main>

        <section id="result" class="w3-container">
            <br>
            <h2>Ergebnis</h2>
            <div class="w3-card-4 w3-center" style="margin:auto;">
                <div class="w3-container w3-center">
                    <div class="w3-row " style="display: inline-flex ;">

                        <div lass="w3-col m5" style="margin: auto;">
                            <img src=" <?php echo $cryptoArray[0]['image']; ?>" style="max-width: 150px; padding: 10px;0">
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
                        <a href="index.html"><button class="w3-button w3-lime" style="margin: 5px;">Zurück</button></a>

                        <a href="<?php echo "https://www.coingecko.com/en/coins/" . $cryptoArray[0]['id']; ?>" style="margin: 5px;">
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

        <section id="history" class="w3-container">

            <h2>Verlauf aller Benutzer</h2>
            <div class="w3-card-4 w3-center" style="margin:auto;">
                <div class="w3-container w3-center">

                    <table class="w3-table-all w3-centered">
                        <tr>
                            <th>Uhrzeit</th>
                            <th>Fiat</th>
                            <th>Crypto</th>
                        </tr>

                        <?php
                        # DB Einträge holen und als Tabelle ausgeben.
                        $query = "select * from requests order by id DESC";
                        $stmt = mysqli_prepare($conn, $query);
                        mysqli_stmt_execute($stmt);
                        $res = mysqli_stmt_get_result($stmt);

                        if ($res) {
                            while ($row = mysqli_fetch_assoc($res)) {
                                echo '<tr>
                                <td>';
                                echo $row['zeit'] . '</td>
                                <td>';
                                echo $row['fiat'] . " " . $row['fiatTyp'] . '</td>
                                <td>';
                                echo $row['crypto'] . " " . $row['cryptoTyp'] . ' </td>
                              </tr>';
                            }
                        } else {
                            echo '<script>  alert("Verbindung mit DB fehlgeschlagen") </script>';
                        }
                        ?>
                    </table>
                </div>
            </div>
        </section>
    </main>
</body>


<footer class="w3-container w3-teal">
    <div class="w3-container w3-center">
        <p class="copyright"> HSLU FS2021 - Dave Brunner Copyright &copy;</p>
    </div>

</footer>

</html>