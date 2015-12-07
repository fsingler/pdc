<div class="push-1 span-22 last">
<h2>Petites annonces Lorraines</h2>
    <?php
    $cat_annonces=array('bourseaffaire'=>'Bourse aux affaires' , 'apprentissage'=>'Apprentissage', 'remploistage'=>'Recherche d\'emploi et stage', 'oemploistage'=>'Offre d\'emploi et stage', 'offremarche'=>'Offre de marché', 'repriseentr'=>'Reprise d\'entreprise');
    
    foreach ($annonces as $row) {
        echo '<div class="span-20 last all_annonces">';
        echo '<a name="'.$row->ID.'"></a>';
        echo '<p class="titre">'.$cat_annonces[$row->categorie].' - '.stripslashes($row->titre).'</p>';
        echo '<p class="date">'.date("d/m/Y", strtotime($row->date)).'</p>';
        echo '<p class="texte">'.stripslashes(nl2br($row->annonce)).'</p>';
        echo '<div class="span-8">';
        echo '<p class="texte">'.stripslashes($row->nom).' '.stripslashes($row->prenom).'<br />';
        echo stripslashes($row->adresse).'<br />';
        echo stripslashes($row->codepostal).' '.stripslashes($row->ville).'</p>';
        echo '</div>';

        echo '<div class="span-8 last">';
        echo '<p class="texte">';
        if ($row->tel) echo 'Téléphone : '.$row->tel.'<br />';
        if ($row->portable) echo 'Portable : '.$row->portable.'<br />';
        if ($row->email) echo 'E-mail : <a href="mailto:'.$row->email.'">'.stripslashes($row->email).'</a><br />';
        echo '</div>';
        
        echo '</div>';
    }  
?>
</div>