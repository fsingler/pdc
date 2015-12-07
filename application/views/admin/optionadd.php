<div class="push-1 span-22 last">
<?php
foreach($diplomes as $row2) {
    $diplome[$row2->id_diplome] = $row2->intitule;
}

foreach ($organisme as $row) {
//    extract($row,EXTR_OVERWRITE);

    echo '<h2>Ajout d\'un diplôme</h2>';
    echo validation_errors();

    $hidden=array('id_orga'=>$row->id_orga); // Champs cachés du formulaire
    echo form_open_multipart('admin/option_add/'.$row->id_orga,'',$hidden);

    echo '<p>'.form_label('Diplôme : ','diplome',array('class' => 'leftlabel')).form_dropdown('diplome',$diplome,set_value('diplome')).'</p>';
    echo '<p>'.form_label('Option : ','option',array('class' => 'leftlabel')).form_input(array('name'=>'option','size'=>'90','id'=>'details','value'=>set_value('option'))).'</p>';
    echo '<p>'.form_label('Lien vers les textes officiels : ','textes_officiels',array('class' => 'leftlabel')).form_input(array('name'=>'textes_officiels','size'=>'90','id'=>'textes_officiels','value'=>set_value('textes_officiels'))).'</p>';
    echo '<p>'.form_label('Intitulé INMA : ','metier_inma',array('class' => 'leftlabel')).form_input(array('name'=>'metier_inma','size'=>'90','id'=>'metier_inma','value'=>set_value('metier_inma'))).'</p>';
    echo '<p>'.form_label('Lien fiche métier INMA : ','lien_inma',array('class' => 'leftlabel')).form_input(array('name'=>'lien_inma','size'=>'90','id'=>'lien_inma','value'=>set_value('lien_inma'))).'</p>';
    echo '<p>'.form_label('Texte complémentaire : ','texte').'<br />'.form_textarea(array('name'=>'texte','rows'=>'1','cols'=>'1','id'=>'texte','value'=>set_value('texte'))).'</p>';
    
    echo '<div class="span-22 last"><p>'.form_submit('valid','Enrsgistrer le diplôme').'</p></div>';
    echo form_close();
}
?>
</div>

