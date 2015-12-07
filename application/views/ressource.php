<?php
foreach ($diplome as $row) {
    echo '<div class="content">';
    echo '<h2>'.$row->intitule;
    if ($row->details != '') echo ' - '.$row->details;
    echo '</h2>';
    
    if (sizeof($actus)>0) {
        echo '<h4>Quelle est l\'actualité des '.$row->intitule.' ?</h4>';

        foreach ($actus as $row2) {
            $tab_mois=array(1=>'janvier',2=>'février',3=>'mars',4=>'avril',5=>'mai',6=>'juin',7=>'juillet',8=>'août',9=>'septembre',10=>'octobre',11=>'novembre',12=>'décembre');

            echo '<p><strong>'.$tab_mois[date("n", strtotime($row2->date))].' '.date("Y", strtotime($row2->date)).' - '.$row2->titre.'</strong></p>';
            echo '<p>'.$row2->texte.'</p>';
        }
    }

    if (sizeof($options)>0) {
        echo '<h4>Quels sont les '.$row->intitule.' disponibles pour la filière verre en Lorraine ?</h4>';
        foreach ($options as $row2) {
            echo '<p><strong>'.$row->intitule.' '.$row2->option.'</strong><br />';
            echo $row2->texte;
            if (sizeof($orga_options[$row2->id_option])>0) {
                echo '<p>Organismes de formation : ';
                $first=1;
                foreach ($orga_options[$row2->id_option] as $row3) {
                    if ($first==1) $first=0;
                    else echo ' / ';
                    echo '<a href="'.base_url('organisme/'.$row3->id_orga.'-'.url_title(convert_accented_characters($row3->nom)).'.html').'">'.$row3->nom.'</a>';
                }
                echo '<br />';
            }
            
    //        echo '<a href="'.base_url('organisme/1-cerfav.html').'">Cerfav</a> / <a href="'.base_url('organisme/1-cerfav.html').'">LP Sarrebourg</a><br />';
            if ($row2->textes_officiels != '') echo '<a href="'.$row2->textes_officiels.'">Textes officiels</a><br />';
            if ($row2->lien_inma != '') echo '<a href="'.$row2->lien_inma.'" target="blank">Fiche métier "'.$row2->metier_inma.'" sur le site de l\'INMA</a></p>';
        }
    }

    echo '<h4>'.$row->intitule.' : Définition</h4>';
    echo $row->description;
    
    echo '</div>';
}

?>
