<div class="push-1 span-22 last">
<?php
foreach($diplomes as $row2) {
    $diplome[$row2->id_diplome] = $row2->intitule;
}

foreach($liste_options as $row3) {
    $option[$row3->id_option] = $row3->option;
}

foreach ($orga_diplome_option as $row) {
    echo '<h2>Modification '.$diplome[$row->id_diplome].' '.$option[$row->id_option].'</h2>';
    echo validation_errors();

    $hidden=array('id_orga'=>$row->id_orga,'id_option'=>$row->id_option,'id_diplome'=>$row->id_diplome); // Champs cachés du formulaire
    echo form_open_multipart('admin/orga_option_updt/'.$row->id_option.'/'.$row->id_diplome.'/'.$row->id_orga,'',$hidden);

//    echo '<p>'.form_label('Diplôme : ','id_diplome',array('class' => 'leftlabel')).form_dropdown('id_diplome',$diplome,set_value('id_diplome',$row->id_diplome)).'</p>';
//    echo '<p>'.form_label('Option : ','id_option',array('class' => 'leftlabel')).form_dropdown('id_option',$option,set_value('id_option',$row->id_option)).'</p>';
    echo '<p>'.form_label('Description : ','description').'<br />'.form_textarea(array('name'=>'description','rows'=>'1','cols'=>'1','id'=>'texte','value'=>set_value('description',$row->description))).'</p>';
    
    echo '<div class="span-22 last"><p>'.form_submit('valid','Enrsgistrer les modifications').'</p></div>';
    echo form_close();
}
?>
</div>

