<div class="push-1 span-22 last">
<?php
if (isset($ok)) echo '<div class="success" style="margin-top: 10px;">'.$ok.'</div>';
?>
<div class="span-10">
<?php 
//echo '<h2 class="titreadmin"><a href="'.base_url('admin/listeactus').'">Organisme</a></h2>';
foreach ($organisme as $row) {
    echo '<h2>'.$row->nom.'</h2>';
    echo '<p><img src="'.base_url('img/offres/'.$row->image).'" width="200"></p>';
    echo '<h4>'.$row->details.'</h4>';
    echo '<p>'.$row->adresse1.'<br />'.$row->adresse2.'<br/>'.$row->code_postal.' '.$row->ville.'</p>';
    echo '<p>Tél : '.$row->tel.'<br />Web : '.$row->web.'</p>';
    echo '<p>'.$row->description.'</p>';
    echo '<div class="span-2 last update"><a href="'.base_url('admin/orga_updt/'.$row->id_orga).'">Modifier</a></div>';
}
?>
</div>

<div class="push-1 span-10 last">
    <?php
    echo '<h4>Diplômes préparés</h4>';
    echo '<div class="span-10 last">';
    echo '<table>';
    foreach ($options as $row2) {
        echo '<tr><td><a href="'.base_url('admin/orga_option_updt/'.$row2->id_option.'/'.$row2->id_diplome.'/'.$organisme[0]->id_orga).'">'.$row2->intitule.' '.$row2->option.'</a></td><td><a href="'.base_url('admin/orga_option_updt/'.$row2->id_option.'/'.$row2->id_diplome.'/'.$organisme[0]->id_orga).'"><img src="'.base_url('img/edit.png').'" height="15"></a></td><td><a href="'.base_url('admin/orga_option_suppr/'.$row2->id_option.'/'.$organisme[0]->id_orga.'/'.$row2->id_diplome).'" onClick="return confirm(\'Supprimer le diplôme '.$row2->intitule.' '.$row2->option.' ?\nCette action est irreversible\');"><img src="'.base_url('img/delete.png').'" height="15"></a></td></tr>';
    }
    echo '</table>';
    echo '<div class="span-3 last update"><a href="'.base_url('admin/orga_option_add/'.$organisme[0]->id_orga).'">Ajouter un diplôme</a></div>';
    echo '</div>';
?>
</div>    
</div>
    
<div class="push-1 span-22 last">
<div class="span-10">
<?php echo '<h4>Actualités</h4>'; ?>
    <table>
        <thead>
        <!-- <th>Titre</th><th>Date</th><th>Publié</th><th>Ordre</th></thead> -->
<?php 
foreach ($posts as $row) {
   echo '<tr>';
   echo '<td><a href="'.base_url('admin/actu_updt/'.$row->id_post).'">'.$row->titre.'</a></td>';
//   echo '<td width="65">'.$row->date.'</td>';
   echo '<td><a href="'.base_url('admin/actu_updt/'.$row->id_post).'"><img src="'.base_url('img/edit.png').'" height="15"></a></td>';
   echo '<td><a href="'.base_url('admin/actu_suppr/'.$row->id_post).'" onClick="return confirm(\'Supprimer l\\\'actualité '.$row->titre.' ?\nCette action est irreversible\');"><img src="'.base_url('img/delete.png').'" height="15"></a></td>';
   echo '</tr>';
} 
?>
    </table>
    <?php
    echo '<div class="span-3 last update"><a href="'.base_url('admin/actu_add/').'">Ajouter une actualité</a></div>';
    ?>
</div>

<div class="push-1 span-10 last">
    <?php
    /*
    echo '<h4>Diplômes</h4>';
    echo '<div class="span-10 last">';
    echo '<table>';
    foreach ($liste_options as $row2) {
        echo '<tr><td><a href="'.base_url('admin/option_updt/'.$row2->id_option.'/'.$organisme[0]->id_orga).'">'.$row2->intitule.' '.$row2->option.'</a></td><td><a href="'.base_url('admin/option_updt/'.$row2->id_option.'/'.$organisme[0]->id_orga).'"><img src="'.base_url('img/edit.png').'" height="15"></a></td><td><a href="'.base_url('admin/option_suppr/'.$row2->id_option.'/'.$organisme[0]->id_orga).'" onClick="return confirm(\'Supprimer le diplôme '.$row2->intitule.' '.$row2->option.' ?\nCette action est irreversible\');"><img src="'.base_url('img/delete.png').'" height="15"></a></td></tr>';
    }
    echo '</table>';
    echo '<div class="span-3 last update"><a href="'.base_url('admin/option_add/'.$organisme[0]->id_orga).'">Ajouter un diplôme</a></div>';
    echo '</div>';
    */
?>
</div>    

</div>