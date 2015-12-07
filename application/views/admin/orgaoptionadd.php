<div class="push-1 span-22 last">
<?php
$diplome[0] = 'Choisissez...';
foreach($diplomes as $row2) {
    $diplome[$row2->id_diplome] = $row2->intitule;
}

$option[0] = 'Choisissez...';
foreach($liste_options as $row3) {
    $option[$row3->id_option] = $row3->option;
}

//foreach ($organisme as $row) {
//    extract($row,EXTR_OVERWRITE);

    echo '<h2>Ajout d\'un diplôme</h2>';
    echo validation_errors();

    echo validation_errors();

    $hidden=array('id_orga'=>$organisme[0]->id_orga); // Champs cachés du formulaire
    echo form_open_multipart('admin/orga_option_add/'.$organisme[0]->id_orga,'',$hidden);

    echo '<p>'.form_label('Diplôme : ','id_diplome',array('class' => 'leftlabel')).form_dropdown('id_diplome',$diplome).'</p>';
    echo '<p>'.form_label('Option : ','id_option',array('class' => 'leftlabel')).form_dropdown('id_option',$option).'</p>';
    echo '<p>'.form_label('Description : ','description').'<br />'.form_textarea(array('name'=>'description','rows'=>'1','cols'=>'1','id'=>'texte','value'=>set_value('description'))).'</p>';
    
    echo '<div class="span-22 last"><p>'.form_submit('valid','Ajouter le diplôme').'</p></div>';
    echo form_close();
//}
?>
</div>

