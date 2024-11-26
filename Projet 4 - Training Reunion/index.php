<?php
// Starts a session to check if the user is logged in
session_start();

// Includes the header file containing the database
require 'assets/addons/header.php';
?>

<main>
    <div class="container">
        <!------------------Home Page-------------------->
        <div class="welcome-section">
        <div class="trail begin">
            <h2 class="accueil">Les plus belles randonnées avec Training Réunion</h2>
            <p>Vous venez ou vivez à La Réunion ? Vous randonnez ou vous vous promenez pour visiter l'île ? : Voici quelques centaines d'idées de sorties pour se reposer de la randonnée ou lorsque la randonnée du jour est terminée. Ne sont proposés que les lieux qui se visitent sans randonner, qui empruntent des itinéraires très courts ne nécessitant jamais de gros efforts, de petites balades ne demandant aucun entraînement particulier. Dans le cas contraire, des précisions sont apportées dans le texte sous la photo.
                Pour des renseignements concernant les vols, l'hébergement, la restauration, les conseils pour réussir des vacances, reportez-vous au site IleReunionVoyage.fr.<br><br></p>
        </div>

        <!--------Direct access to the login page-------->
            <?php if (!isset($_SESSION['name'])): ?>
                <div class="columns">
                    <!---------Left column for connection---------->
                    <div class="column column-left">
                        <h3>Déjà inscrit ?</h3>
                        <p id="connect-title">Accédez à votre espace personnel.</p><br>
                        <a href="connexion.php" class="btn">Connexion</a>
                    </div>

        <!-------Registration form---------->                
                    <!--------Right column for registration------->
                    <div class="column column-right">
                        <h3>Nouveau sur notre site ?</h3><br>
                        <p>Créez un compte pour explorer nos randonnées !</p><br><br>
                        <form action="assets/addons/exec_inscription.php" method="POST">
                            <!-----Field for name----->
                            <label for="name">Nom d'utilisateur :</label>
                            <input type="text" id="name" name="name" required>

                            <!-----Field for email----->
                            <label for="email">Email :</label>
                            <input type="email" id="email" name="email" required>

                            <!-----Field for passwrod----->
                            <label for="password">Mot de passe :</label>
                            <input type="password" id="password" name="password" required>

                            <!-----Validation button----->
                            <input type="submit" class="btn" value="Créer un compte">

                            <?php
                            // Error message if bad email
                            if (!empty($_SESSION['errorMessage'])) {
                                echo "<p class='error-message'>{$_SESSION['errorMessage']}</p>";
                                unset($_SESSION['errorMessage']); // Delete the message to prevent it from persisting
                            }
                            ?>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!---------------------------Image de séparation-------------------------->
    <div class="welcome-section">
    <img class="randos-bis-img" src="assets/images/rando.jpg" alt="reunion" title="reunion"><br>
    </div>

    <!----------------------Sélection des meilleures randonnée----------------->
    <div class="container">
        <div class="welcome-section">
            <h2 class="accueil"><a id="toprandos" href="#toprandos">Sélection Top Randonnées</a></h2>


            <!----------------------Fourth hike----------------->

            <section class="article">
                <div class="section-container">
                    <div class="row">
                        <div class="column trail">
                            <h2>Le tour des Sources du Grand Bras par le Piton des Merles</h2>
                            <h3>Itinéraire</h3>
                            <p>Quitter la Route des Tamarins à l’Étang Salé les Bains et remonter jusqu’aux Avirons - Poursuivre par la route jusqu'au Tévelave puis continuer sur la RF du Tévelave jusqu'au départ du sentier du Piton des Merles - Rejoindre le piton puis le sentier du Piton de la Croix - Quitter le sentier vers les sources du Grand Bras et remonter au Piton des Merles par un sentier moins connu à l'ouest du précédent - Revenir au point de départ à la rencontre du sentier pris en début de boucle.</p>
                            <img class="randos-img" src="assets/images/rando1.jpg" alt="source" title="source">
                            <img class="randos-img" src="assets/images/rando2.jpg" alt="source2" title="source2">
                            <table class="table-hikes top-tab">
                                <thead>
                                    <tr>
                                        <th>Difficulté</th>
                                        <th>Distance</th>
                                        <th>Durée</th>
                                        <th>Dénivelé</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Difficile</td>
                                        <td>6,3 km</td>
                                        <td>6h30</td>
                                        <td>1580 m</td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="https://randopitons.re/randonnee/1916-tour-sources-grand-bras-piton-merles" target="_blank" id="infos" class="btn">En savoir plus</a>
                        </div>
                    </div>
            </section>

            <!----------------------Second hike----------------->

            <section class="article">
                <div class="section-container">
                    <div class="row">
                        <div class="column trail">
                            <h2>Maurice - La cascade Minissy près de Moka</h2>
                            <h3>Itinéraire</h3>
                            <p>Se rendre à Moka et emprunter la M1 vers le Sud – Sortir à l'échangeur de Réduit pour emprunter l'A17 – Rouler jusqu'au rond-point proche de PWC (Price Waterhouse Coopers) et y stationner – Emprunter la piste vers la Rivière Cascade – Partir à gauche jusqu'au sentier descendant aux berges – Visiter le bassin, la cascade et le haut avant de faire demi-tour par le même itinéraire.</p>
                            <img class="randos-img" src="assets/images/rando3.jpg" alt="cascade" title="cascade">
                            <img class="randos-img" src="assets/images/rando4.jpg" alt="cascade2" title="cascade2">
                            <table class="table-hikes top-tab">
                                <thead>
                                    <tr>
                                        <th>Difficulté</th>
                                        <th>Distance</th>
                                        <th>Durée</th>
                                        <th>Dénivelé</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Très Facile</td>
                                        <td>2,7 km</td>
                                        <td>1h</td>
                                        <td>360 m</td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="https://randopitons.re/randonnee/1899-maurice-cascade-minissy-pres-moka" target="_blank" id="infos" class="btn">En savoir plus</a>
                        </div>
                    </div>
            </section>

            <!----------------------Third hike------------------>

            <section class="article">
                <div class="section-container">
                    <div class="row">
                        <div class="column trail">
                            <h2>La boucle du Moulin Kader à la Montagne par le sentier des Cordistes</h2>
                            <h3>Itinéraire</h3>
                            <p>Se rendre à Saint-Denis puis à la Montagne pour rejoindre les abords du rempart pour le longer en dominant très souvent l'océan. Poursuivre jusqu'aux kiosques, franchir une passerelle puis bifurquer à droite au croisement et effectuer une longue boucle qui mène au belvédère au-dessus de la Grande Ravine. Poursuivre vers la DZ puis traverser la clairière avant de reprendre le sentier avant de retrouver la passerelle et les kiosques</p>
                            <img class="randos-img" src="assets/images/rando5.jpg" alt="moulin" title="moulin">
                            <img class="randos-img" src="assets/images/rando6.jpg" alt="moulin2" title="moulin2">
                            <table class="table-hikes top-tab">
                                <thead>
                                    <tr>
                                        <th>Difficulté</th>
                                        <th>Distance</th>
                                        <th>Durée</th>
                                        <th>Dénivelé</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Moyen</td>
                                        <td>5,6 km</td>
                                        <td>2h30</td>
                                        <td>350 m</td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="https://randopitons.re/randonnee/1189-boucle-moulin-kader-montagne-sentier-cordistes" target="_blank" id="infos" class="btn">En savoir plus</a>
                        </div>
                    </div>
            </section>

            <!----------------------Fourth hike----------------->

            <section class="article">
                <div class="section-container">
                    <div class="row">
                        <div class="column trail">
                            <h2>Le circuit de la Pointe de la Table et des coulées de 1986</h2>
                            <h3>Itinéraire</h3>
                            <p>Se rendre à Saint Philippe puis au Puits Arabe en roulant vers le Tremblet - Garer le véhicule sur le grand parking proche des kiosques - Suivre le balisage en céramique sur le sentier qui part vers le nord – Obliquer sur le plateau basaltique pour se rapprocher de l'océan puis regagner le sentier officiel - Poursuivre le long de l'océan en suivant ce sentier jusqu'à la piste forestière n°3 de Takamaka remontant vers la RN2. </p>
                            <img class="randos-img" src="assets/images/rando7.jpg" alt="pointe" title="pointe">
                            <img class="randos-img" src="assets/images/rando8.jpg" alt="pointe2" title="pointe2">
                            <table class="table-hikes top-tab">
                                <thead>
                                    <tr>
                                        <th>Difficulté</th>
                                        <th>Distance</th>
                                        <th>Durée</th>
                                        <th>Dénivelé</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Facile</td>
                                        <td>5,8 km</td>
                                        <td>2h00</td>
                                        <td>30 m</td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="https://randopitons.re/randonnee/1061-circuit-pointe-table-coulees-1986" target="_blank" id="infos" class="btn">En savoir plus</a>
                        </div>
                    </div>
            </section>

            <!----------------------Fifth hike----------------->

            <section class="article">
                <div class="section-container">
                    <div class="row">
                        <div class="column trail">
                            <h2>D'Aurère à Dos d'Ane par le Bras des Merles</h2>
                            <h3>Itinéraire</h3>
                            <p>Depuis Aurère, prendre la direction du Sentier Augustave - Marcher jusqu'au lieu-dit La Réserve - Emprunter le sentier du Bras des Merles, fermé par l'ONF mais toujours indiqué sur leurs poteaux - Descendre la forte pente jusqu'au bras à sec, poursuivre soit par le sentier lorsqu'il est visible, soit par le fond rocheux de la ravine - Rejoindre le Bras de Sainte-Suzanne puis Deux Bras - Partir à droite vers l'Îlet Albert puis entamer la longue et difficile remontée vers Dos d’Âne - Terminer à l'église ou à l'arrêt de bus.</p>
                            <img class="randos-img" src="assets/images/rando9.jpg" alt="dos" title="dos">
                            <img class="randos-img" src="assets/images/rando10.jpg" alt="dos2" title="dos2">
                            <table class="table-hikes top-tab">
                                <thead>
                                    <tr>
                                        <th>Difficulté</th>
                                        <th>Distance</th>
                                        <th>Durée</th>
                                        <th>Dénivelé</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Très Difficile</td>
                                        <td>10,2 km</td>
                                        <td>8h00</td>
                                        <td>940 m</td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="https://randopitons.re/randonnee/1919-d-aurere-dos-ane-bras-merles" target="_blank" id="infos" class="btn">En savoir plus</a>
                        </div>
                    </div>
            </section>

</main>

<?php
// Includes footer
require 'assets/addons/footer.php'; 
?>