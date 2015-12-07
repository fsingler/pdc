<div class="span-7 ressources">
<?php
foreach ($diplomes as $row) {
    echo '<div class="ressource">';
    if ($row->image != '') echo '<div class="image"><a href="'.base_url('ressource/'.$row->id_diplome.'-'.url_title(convert_accented_characters($row->intitule)).'.html').'"><img src="'.base_url('img/ressources/'.$row->image).'" width="270" height="140"></a></div>';
    echo '<h2>'.$row->intitule.'</h2>';
    if ($row->resume=='') echo word_limiter($row->description,40);
    else echo $row->resume;
    echo '<p><a href="'.base_url('ressource/'.$row->id_diplome.'-'.url_title(convert_accented_characters($row->intitule)).'.html').'">En savoir plus</a></p>';
    echo '</div>';
}
?>
</div>