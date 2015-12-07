<?php

foreach ($organisme as $row) {
echo '<div class="image">';
if ($row->image != '') echo '<img src="'.base_url('img/offres/'.$row->image).'">';
echo '</div>';

echo '<div class="content">';
echo '<h2>'.$row->nom.'</h2>';
echo '<p>'.$row->details.'</p>';

echo '<div class="coordonnees">';
echo '<p>'.$row->adresse1.'<br />';
if ($row->adresse2<>'') echo $row->adresse2.'<br />';
echo $row->code_postal.' '.$row->ville.'<br />';
echo 'Tel :  '.$row->tel.'<br />';
echo '<a href="http://'.$row->web.'" target="blank">'.$row->web.'</a></p>';
echo '</div>';

if (sizeof($options)>0) {
    echo '<div class="diplomes">';
    echo '<p><strong>Diplômes préparés</strong></p>';
    echo '<ul>';
    foreach ($options as $row2) {
        echo '<li><a href="'.base_url('ressource/'.$row2->id_diplome.'-'.url_title(convert_accented_characters($row2->intitule)).'.html').'">'.$row2->intitule.' '.$row2->option.'</a>';
        if ($row2->description != '') '<br />'.$row2->description;
        if ($row2->texte != '') echo '<br />'.$row2->texte;
        echo '</li>';
    }
    echo '</ul>';
    echo '</div>';
}

echo '<div class="observations">';
echo $row->description;
echo '</div>';


echo '</div>';
}

?>
