<div class="span-7 last offresformations">
<?php
foreach ($organismes as $row) {
    echo '<div class="offre">';
    if ($row->image != '') echo '<a href="'.base_url('organisme/'.$row->id_orga.'-'.url_title(convert_accented_characters($row->nom)).'.html').'"><img src="'.base_url('img/offres/'.$row->image).'" width="270"></a>';
    echo '<h2><a href="'.base_url('organisme/'.$row->id_orga.'-'.url_title(convert_accented_characters($row->nom)).'.html').'">'.$row->nom.'</a></h2>';
    echo '<p>'.$row->details.'</p>';
    echo '<p><a href="http://'.$row->web.'">'.$row->web.'</a></p>';
    echo '</div>';
}
?>
    
</div>