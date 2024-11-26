<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("includes/head.php"); ?>

    <title>Hilfe zur Hotelreservierung</title>
</head>

<body>
    <header>
        <?php include("includes/nav.php"); ?>
    </header>
    
    <section class="container my-4">
        <header class="mb-4">
            <h2 class="text-center">Hilfe zur Hotelreservierung</h2>
            <ul class="nav nav-tabs justify-content-center">
                <li class="nav-item"><a class="nav-link" href="#reservierung">Reservierung vornehmen</a></li>
                <li class="nav-item"><a class="nav-link" href="#aenderungen">Buchungs&auml;nderungen und -stornierungen</a></li>
                <li class="nav-item"><a class="nav-link" href="#zahlung">Zahlungsinformationen</a></li>
                <li class="nav-item"><a class="nav-link" href="#zimmer">Zimmertypen und -ausstattungen</a></li>
                <li class="nav-item"><a class="nav-link" href="#anforderungen">Spezielle Anforderungen</a></li>
                <li class="nav-item"><a class="nav-link" href="#probleme">H&auml;ufige Probleme und L&ouml;sungen</a></li>
                <li class="nav-item"><a class="nav-link" href="#kontakt">Kontaktieren Sie uns</a></li>
            </ul>
        </header>

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- Reservierung -->
                <section id="reservierung" class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">Reservierung vornehmen</h2>
                        <p>Folgen Sie diesen Schritten, um eine Reservierung vorzunehmen:</p>
                        <ul>
                            <li><div class="fw-bold">W&auml;hlen Sie Ihre Reisedaten:</div> Geben Sie das Ankunfts- und Abreisedatum ein.</li>
                            <li><div class="fw-bold">Suchen Sie nach verf&uuml;gbaren Zimmern:</div> Klicken Sie auf „Suchen“.</li>
                            <li><div class="fw-bold">W&auml;hlen Sie ein Zimmer:</div> W&auml;hlen Sie das gew&uuml;nschte Zimmer aus.</li>
                            <li><div class="fw-bold">Geben Sie Ihre Daten ein:</div> F&uuml;llen Sie die erforderlichen Felder aus.</li>
                            <li><div class="fw-bold">Best&auml;tigen Sie Ihre Buchung:</div> &Uuml;berpr&uuml;fen Sie die Angaben und klicken Sie auf „Buchen“.</li>
                        </ul>
                        <p><div class="fw-bold">Tipp:</div> Stellen Sie sicher, dass Ihre Reisedaten korrekt eingegeben sind.</p>        
                    </div>
                </section>

                <!-- Buchungsänderungen -->
                <section id="aenderungen" class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">Buchungsänderungen</h2>
                        <p><div class="fw-bold">&Auml;nderungen vornehmen:</div></p>
                        <ul>
                            <li><div class="fw-bold">Online:</div> Melden Sie sich in Ihrem Konto an, um &auml;nderungen vorzunehmen.</li>
                            <li><div class="fw-bold">Telefonisch:</div> Rufen Sie unser Kundenservice-Team an und halten Sie Ihre Buchungsnummer bereit.</li>
                        </ul>
                        <p><div class="fw-bold">Stornierungen:</div></p>
                        <ul>
                            <li><div class="fw-bold">Online:</div> Melden Sie sich in Ihrem Konto an und klicken Sie auf „Stornieren“.</li>
                            <li><div class="fw-bold">Telefonisch:</div> Kontaktieren Sie unser Kundenservice-Team und geben Sie Ihre Buchungsnummer an.</li>
                        </ul>
                        <p>Bitte beachten Sie die Stornierungsbedingungen, die je nach Hotel variieren k&ouml;nnen.</p>
        
                    </div>
                </section>

                <!-- Zahlung -->
                <section id="zahlung" class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">Zahlungsinformationen</h2>
                        <p><div class="fw-bold">Akzeptierte Zahlungsmethoden:</div> Kreditkarten, Debitkarten, Online-Zahlungsdienste.</p>
                        <p><div class="fw-bold">Zahlungsprozess:</div> Ihre Kreditkarte wird bei der Buchung belastet, es sei denn, es handelt sich um eine „bezahlt bei Ankunft“-Buchung.</p>
                        <p><div class="fw-bold">Sicherheit und Datenschutz:</div> Wir verwenden moderne Sicherheitsmaßnahmen zum Schutz Ihrer Zahlungsinformationen.</p>        
                    </div>
                </section>

                <!-- Zimmer -->
                <section id="zimmer" class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">Zimmertypen und -ausstattungen</h2>
                        <p><div class="fw-bold">Zimmertypen:</div></p>
                        <ul>
                            <li><div class="fw-bold">Einzelzimmer:</div> Ideal f&uuml;r Alleinreisende.</li>
                            <li><div class="fw-bold">Doppelzimmer:</div> Geeignet f&uuml;r Paare oder Freunde.</li>
                            <li><div class="fw-bold">Suite:</div> Ger&auml;umiger Raum mit zus&auml;tzlichen Annehmlichkeiten.</li>
                        </ul>
                        <p><div class="fw-bold">Ausstattung:</div> Kostenloses WLAN, Klimaanlage, TV, Minibar.</p>        
                    </div>
                </section>

                <!-- Anforderungen -->
                <section id="anforderungen" class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">Spezielle Anforderungen</h2>
                        <p><div class="fw-bold">Barrierefreiheit:</div> Geben Sie spezielle Anforderungen bei Ihrer Buchung an.</p>
                        <p><div class="fw-bold">Allergien und Di&auml;ten:</div> Informieren Sie uns bitte im Voraus &uuml;ber besondere Di&auml;tbed&uuml;rfnisse oder Allergien.</p>        
                    </div>
                </section>

                <!-- Probleme -->
                <section id="probleme" class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">H&auml;ufige Probleme und L&ouml;sungen</h2>
                        <p><div class="fw-bold">Problem: Buchung wurde nicht best&auml;tigt:</div></p>
                        <ul>
                            <li>&Uuml;berpr&uuml;fen Sie Ihre E-Mail und Ihren Spam-Ordner. Kontaktieren Sie unser Kundenservice-Team, wenn n&ouml;tig.</li>
                        </ul>
                        <p><div class="fw-bold">Problem: Schwierigkeiten bei der Zahlung:</div></p>
                        <ul>
                            <li>Stellen Sie sicher, dass Ihre Kreditkarte g&uuml;ltig ist. Bei Problemen kontaktieren Sie Ihre Bank oder unser Support-Team.</li>
                        </ul>
                        <p><div class="fw-bold">Problem: Fehlerhafte Buchungsdaten:</div></p>
                        <ul>
                            <li>&Uuml;berpr&uuml;fen Sie Ihre Buchungsdetails und nehmen Sie bei Bedarf Korrekturen vor.</li>
                        </ul>        
                    </div>
                </section>

                <!-- Kontakt -->
                <section id="kontakt" class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">Kontaktieren Sie uns</h2>
                        <p>F&uuml;r weitere Fragen oder Unterst&uuml;tzung k&ouml;nnen Sie uns wie folgt erreichen:</p>
                        <ul>
                            <li><div class="fw-bold">Telefon:</div> +43 1 23456789</li>
                            <li><div class="fw-bold">E-Mail:</div> <a href="mailto:office@web-hotel.at">office@web-hotel.at</a></li>
                            <li><div class="fw-bold">Postanschrift:</div> H&ouml;chst&auml;dtpl. 6, 1200 Wien</li>
                        </ul>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <?php include("includes/footer.php"); ?>
</body>
</html>