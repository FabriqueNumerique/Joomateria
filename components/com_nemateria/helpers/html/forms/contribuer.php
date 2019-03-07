<h3>Contribuer</h3>
<p>
	<input name="nom" required placeholder="Votre nom complet" type="text">
</p>
<p>
	<input name="email" required type="email" placeholder="Un e-mail ?">
</p>
	<textarea rows=4 name="message" placeholder="Merci pour votre commentaire"></textarea>
<p>
	<input type="hidden" value="<?php echo $item->id_notice.":".$item->title; ?>">
</p>
<button class="bouton vert" onclick="contribuer(this)">Contribuer</button>