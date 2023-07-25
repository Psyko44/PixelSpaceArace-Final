<main class="contact">
    <div class="contactTitle">
        <img src="/ressources/svg/contact.svg" alt="">
    </div>
    <section class="contactForm">
        <h1>Pour touts renseignement ou toutes réclamations</h1>
        <!-- <div id="successMessageF" class="taskDone">Message envoyé avec succè</div> -->
        <form method="post" action="/soscontact">
            <input type="text" id="name" name="name" placeholder="Entrez Votre Nom" required>
            <input type="email" id="mail" name="mail" placeholder="Entre un email valide" required>
            <textarea name="message" id="message" cols="30" rows="7" placeholder="Entrez votre message" required></textarea>
            <button name="submit" class="btn" type="submit">Envoyer</button>
        </form>
    </section>
    <section class="contactAdress">
        <h1>Retrouvez-nous en magasin</h1>
        <div class="adress">
            <p>SpacePixelArcade</p>
            <address>Blv de pac man 44600 Saint-Nazaire</address>
            <a href="tel"> +33 02 44 ** ** 45</a>
            <a href="mail">contact@SpacePixelArcade.fr</a>
        </div>
        <div class="map">
            <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=-2.273011207580567%2C47.25342692387274%2C-2.2138738632202153%2C47.28027712813545&amp;layer=mapnik" style="border: 1px solid black"></iframe><br /><small><a href="https://www.openstreetmap.org/#map=15/47.2669/-2.2434">Afficher une carte plus
                    grande</a></small>
        </div>
    </section>
</main>