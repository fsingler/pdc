<div class="push-1 span-22 last">
<?php

foreach ($organisme as $row) {
//    extract($row,EXTR_OVERWRITE);

    echo '<h2>Modification '.$row->nom.'</h2>';
    echo validation_errors();

    $hidden=array('id_orga'=>$row->id_orga); // Champs cachés du formulaire
    echo form_open_multipart('admin/orga_updt/'.$row->id_orga,'',$hidden);

    echo '<p>'.form_label('Nom : ','titre',array('class' => 'leftlabel')).form_input(array('name'=>'nom','size'=>'90','id'=>'nom','value'=>set_value('nom',$row->nom))).'</p>';
    echo '<p>'.form_label('Détails : ','details',array('class' => 'leftlabel')).form_input(array('name'=>'details','size'=>'90','id'=>'details','value'=>set_value('details',$row->details))).'</p>';
    echo '<p>'.form_label('Adresse : ','adresse1',array('class' => 'leftlabel')).form_input(array('name'=>'adresse1','size'=>'90','id'=>'adresse1','value'=>set_value('adresse1',$row->adresse1))).'</p>';
    echo '<p>'.form_label('Complément d\'adresse : ','adresse2',array('class' => 'leftlabel')).form_input(array('name'=>'adresse2','size'=>'90','id'=>'adresse2','value'=>set_value('adresse2',$row->adresse2))).'</p>';
    echo '<p>'.form_label('Code postal : ','code_postal',array('class' => 'leftlabel')).form_input(array('name'=>'code_postal','size'=>'7','id'=>'code_postal','value'=>set_value('code_postal',$row->code_postal)));
    echo form_label('Ville : ','ville',array('class' => 'rightlabel')).form_input(array('name'=>'ville','size'=>'70','id'=>'ville','value'=>set_value('ville',$row->ville))).'</p>';
    echo '<p>'.form_label('Téléphone : ','tel',array('class' => 'leftlabel')).form_input(array('name'=>'tel','size'=>'12','id'=>'tel','value'=>set_value('tel',$row->tel)));
    echo form_label('Site web : ','web',array('class' => 'rightlabel')).form_input(array('name'=>'web','size'=>'62','id'=>'web','value'=>set_value('web',$row->web))).'</p>';

    if ($row->image=='') echo '<p>'.form_label('Image : ','image',array('class' => 'leftlabel')).form_upload(array('name'=>'image','size'=>'70','id'=>'image','value'=>$this->input->post('image'))).'</p>';
    else {
        echo '<div class="span-24 last">';
        echo '<div class="span-8">';
        echo '<p>'.form_label('Image : ','image',array('class' => 'leftlabel')).'<img src="'.base_url('img/offres/'.$row->image).'" width="300"></p>';
        echo '</div>';
        echo '<div class="span-16 last" style="padding-top: 50px;">';
        echo '<p>'.form_label('Choisir une autre image : ','image',array('class' => 'rightlabel')).form_upload(array('name'=>'image','size'=>'70','id'=>'image')).'</p>';
        echo '</div>';
        echo '</div>';
    }
//    echo '<p>'.form_label('Texte image : ','alt_image',array('class' => 'leftlabel')).form_input(array('name'=>'alt_image','size'=>'70','id'=>'alt_image','value'=>set_value('alt_image',$alt_image))).'</p>';
    echo '<p>'.form_label('Description : ','description').'<br />'.form_textarea(array('name'=>'description','rows'=>'1','cols'=>'1','id'=>'description','value'=>set_value('description',$row->description))).'</p>';
    
//    echo '<h4>Diplômes préparés</h4>';
//    echo '<div class="span-10 last">';
//    echo '<table>';
//    foreach ($options as $row2) {
//        echo '<tr><td>'.$row2->intitule.' '.$row2->option.'</td><td><img src="'.base_url('img/delete.png').'" height="15"></td></tr>';
//    }
//    echo '</table>';
//    echo '</div>';
    
    echo '<div class="span-22 last"><p>'.form_submit('valid','Enrsgistrer les modifications').'</p></div>';
    echo form_close();
}
?>
</div>

