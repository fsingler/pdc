<div class="push-1 span-22 last">
<?php
foreach($diplomes as $row2) {
    $diplome[$row2->id_diplome] = $row2->intitule;
}

foreach ($option as $row) {
    echo '<h2>Modification '.$row->option.'</h2>';
    echo validation_errors();

    $hidden=array('id_orga'=>$organisme[0]->id_orga,'id_option'=>$row->id_option); // Champs cachés du formulaire
    echo form_open_multipart('admin/option_updt/'.$row->id_option.'/'.$organisme[0]->id_orga,'',$hidden);

//    echo '<p>'.form_label('Diplôme : ','diplome',array('class' => 'leftlabel')).form_input(array('name'=>'diplome','size'=>'90','id'=>'nom','value'=>set_value('diplome',$row->diplomes_id_diplome))).'</p>';
    echo '<p>'.form_label('Diplôme : ','diplome',array('class' => 'leftlabel')).form_dropdown('diplome',$diplome,set_value('diplome',$row->diplomes_id_diplome)).'</p>';
    echo '<p>'.form_label('Option : ','option',array('class' => 'leftlabel')).form_input(array('name'=>'option','size'=>'90','id'=>'details','value'=>set_value('option',$row->option))).'</p>';
    echo '<p>'.form_label('Lien vers les textes officiels : ','textes_officiels',array('class' => 'leftlabel')).form_input(array('name'=>'textes_officiels','size'=>'90','id'=>'textes_officiels','value'=>set_value('textes_officiels',$row->textes_officiels))).'</p>';
    echo '<p>'.form_label('Intitulé INMA : ','metier_inma',array('class' => 'leftlabel')).form_input(array('name'=>'metier_inma','size'=>'90','id'=>'metier_inma','value'=>set_value('metier_inma',$row->metier_inma))).'</p>';
    echo '<p>'.form_label('Lien fiche métier INMA : ','lien_inma',array('class' => 'leftlabel')).form_input(array('name'=>'lien_inma','size'=>'90','id'=>'lien_inma','value'=>set_value('lien_inma',$row->lien_inma))).'</p>';
    echo '<p>'.form_label('Texte complémentaire : ','texte').'<br />'.form_textarea(array('name'=>'texte','rows'=>'1','cols'=>'1','id'=>'texte','value'=>set_value('texte',$row->texte))).'</p>';
    
    echo '<div class="span-22 last"><p>'.form_submit('valid','Enrsgistrer le diplôme').'</p></div>';
    echo form_close();
}
?>
</div>

