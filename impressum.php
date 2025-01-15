<?php
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <?php include("includes/head.php"); ?>

    <title>Impressum</title>
</head>

<body>
    <header>
        <?php include("includes/nav.php"); ?>
    </header>
    
    <h1 class="text-center">Impressum</h1>
    <section class="container my-5">
      <div class="row">
        <div class="col-md-6">
            <h2>Hotelinformationen</h2>
            <p><div class="fw-bold">Hotelname:</div> WEB Hotel GmbH</p>
            <p><div class="fw-bold">Inhaber:</div></p>
            <div class="d-flex">
                <div class="text-center me-4">
                    <img src="resources/img/kamil_bienias.png" alt="Kamil Bienias" class="img-fluid rounded-circle" width="400">
                    <p><div class="fw-bold">Kamil Bienias</div></p>
                </div>
                <!--
                <div class="text-center">
                    <img src="resources/img/kilian_baumann.png" alt="Kilian Baumann" class="img-fluid rounded-circle" width="250">
                    <p>Kilian Baumann</p>
                </div>
                -->
                
            </div>
        </div>
        <div class="col-md-6">
          <p><div class="fw-bold">Adresse:</div> H&ouml;chst&auml;dtplatz 6, 1200 Wien, &Ouml;sterreich</p>
          <p><div class="fw-bold">Telefon:</div> +43 1 23456789</p>
          <p><div class="fw-bold">E-Mail:</div> office@web-hotel.at</p>
        </div>        
      </div>
      <div class="row">
        <div class="col-md-6">
          <h2>Informationen zum Unternehmen</h2>
          <p><div class="fw-bold">Rechtsform:</div> Einzelunternehmen</p>
          <p><div class="fw-bold">Firmenbuchnummer:</div> FN 123456a</p>
          <p><div class="fw-bold">Firmenbuchgericht:</div> Handelsgericht Wien</p>
          <p><div class="fw-bold">Umsatzsteuer-Identifikationsnummer (UID):</div> ATU12345678</p>
          <p><div class="fw-bold">Mitglied der Wirtschaftskammer:</div> Wien</p>
          <p><div class="fw-bold">Gewerbebeh&ouml;rde:</div> Magistratisches Bezirksamt f&uuml;r den 2. und 20. Bezirk</p>
        </div>
        <div class="col-md-6">
          <h2>Aufsichtsbeh&ouml;rde</h2>
          <p>Magistratisches Bezirksamt f&uuml;r den 2. und 20. Bezirk, Wien</p>
          
          <h2>Haftungsausschluss</h2>
          <p>Alle Inhalte auf dieser Website wurden sorgf&auml;ltig gepr&uuml;ft. Trotzdem wird keine Gew&auml;hr für die Richtigkeit, Vollst&auml;ndigkeit und Aktualit&auml;t der Informationen &uuml;bernommen. F&uuml;r Inhalte externer Links &uuml;bernehmen wir keine Haftung. F&uuml;r den Inhalt der verlinkten Seiten sind ausschließlich deren Betreiber verantwortlich.</p>
  
          <h2>Urheberrecht</h2>
          <p>Die Inhalte dieser Website sind urheberrechtlich gesch&uuml;tzt. Jede Vervielf&auml;ltigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der Grenzen des Urheberrechtes bed&uuml;rfen der schriftlichen Zustimmung des Autors bzw. Erstellers.</p>
          
          <h2>Alternative Streitbeilegung</h2>
          <p>Verbraucher haben die M&ouml;glichkeit, Beschwerden an die Online-Streitbeilegungsplattform der EU zu richten: <a href="https://ec.europa.eu/odr" target="_blank">https://ec.europa.eu/odr</a>. Sie können allf&auml;llige Beschwerde auch an die oben angegebene E-Mail-Adresse richten.</p>
        </div>
      </div>
    </section>
    <?php include("includes/footer.php"); ?>
</body>
</html>