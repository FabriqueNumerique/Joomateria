        <ul>
            <li><span class='bleu'>Collection</span> : <?php echo $metadiverses['relation']; ?></li>
            <li><span class='bleu'>Thème ou série</span> :  <?php echo $metadiverses['isPartOf']; ?></li>
            <li><span class='bleu'>Titre</span> : <?php echo $this->item->title; ?></li>
            <li><span class='bleu'>Type</span> : <?php echo $this->item->type; ?></li>
            <li><span class='bleu'>Support et durée</span> : <?php echo $metadiverses['extent']; ?></li>
			<li><span class='bleu'>Date</span> : <?php echo $this->item->date; ?></li>
            <li><span class='bleu'>Numérisé par</span> : <?php echo $metadiverses['mediator']; ?></li>
            <li><span class='bleu'>Auteur</span> : <?php echo $this->item->creator; ?></li>
            <li><span class='bleu'>Participants</span> : <?php echo $this->item->contributor; ?></li>
            <li><span class='bleu'>Mots clés</span> : <?php // $tmp = str_replace("\n",", ", $this->item->subject); echo substr($tmp, 0, $tmp.length-2);
                echo $this->item->subject;?></li>
            <li><span class='bleu'>Référence</span> : <?php  echo $liens[0]; ?></li>
            <li><span class='bleu'>Nature du support original</span> : <?php echo $metadiverses['medium']; ?></li>
            <li><span class='bleu'>Format du master numérique</span> : <?php echo $metadiverses['hasFormat']; ?></li>
            <li><span class='bleu'>Propriétaire des supports originaux</span> : <?php echo $metadiverses['dateCopyrighted']; ?></li>
            <li><span class='bleu'>Détenteur des droits</span> : <?php echo $metadiverses['rightsHolder']; ?></li>
            <!--<li><span class='bleu'>Conservation des fichiers numériques</span> : <?php // echo $metadiverses['audienceEducationLevel']; ?></li>
            <li><span class='bleu'>Documenté par</span> : (pas de référence vue dans la base)</li>-->
            <li><span class='bleu'>Statut juridique</span> : <?php echo $this->item->rights; ?></li>
        </ul>