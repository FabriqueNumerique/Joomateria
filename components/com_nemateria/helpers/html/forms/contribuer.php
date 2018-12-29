<h3>Contribuer</h3>

<input name="nom" required placeholder="Votre nom complet" type="text">

<input name="email" required type="email" placeholder="Un e-mail ?">

<textarea rows=4 name="message" placeholder="Merci pour votre commentaire"></textarea>

<input type="hidden" value="<?php echo $item->id_notice.":".$item->title; ?>">

<button class="bouton vert" onclick="contribuer(this)">Contribuer</button>