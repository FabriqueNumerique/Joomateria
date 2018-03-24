        <ul>
            <li><span class='bleu'>Collection</span> : <?php echo $vars['relation']; ?></li>
            <li><span class='bleu'>Série</span> :  <?php echo $vars['isPartOf']; ?></li>
            <li><span class='bleu'>Titre</span> : <?php echo $this->item->title; ?></li>
            <li><span class='bleu'>Auteur</span> : <?php echo $this->item->creator; ?></li>
            <li><span class='bleu'>Type de contenu</span> : <?php echo $this->item->type; ?></li>
            <li><span class='bleu'>Date de parution</span> : <?php echo $this->item->date; ?></li>
            <li><span class='bleu'>Support</span> : <?php echo $vars['extent']; ?></li>
			<li><span class='bleu'>Caractéistiques</span> : <?php echo $vars['medium']; ?></li>
           	<li><span class='bleu'>Mots clés</span> : <?php $tmp = str_replace("\n",", ", $this->item->subject); echo substr($tmp, 0, $tmp.length-2); ?></li>
           	<li><span class='bleu'>Référence</span> : <?php  echo $liens[0]; ?></li>
           	<li><span class='bleu'>Format du master numérique</span> : <?php echo $vars['hasFormat']; ?></li>
            <li><span class='bleu'>Propriétaire du support</span> : <?php echo $vars['dateCopyrighted']; ?></li>
            <li><span class='bleu'>Détenteur des droits</span> : <?php echo $vars['rightsHolder']; ?></li>
            <li><span class='bleu'>Statut juridique</span> : <?php echo $this->item->rights; ?></li>
        </ul>