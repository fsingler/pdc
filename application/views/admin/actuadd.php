<script>
$(function() {
    $( "#datepicker" ).datepicker({
    altField: "#datepicker",
    closeText: 'Fermer',
    prevText: 'Précédent',
    nextText: 'Suivant',
    currentText: 'Aujourd\'hui',
    monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
    monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
    dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
    dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
    dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
    weekHeader: 'Sem.',
    dateFormat: 'yy-mm-dd',
    firstDay : 1
    });
});
</script>

<div class="push-1 span-22 last">
<?php
//foreach ($post as $row) {
    echo '<h2>Nouvelle actualité</h2>';
    echo validation_errors();

    echo form_open_multipart('admin/actu_add/');

    echo '<p>'.form_label('Titre : ','titre',array('class' => 'leftlabel')).form_input(array('name'=>'titre','size'=>'90','id'=>'titre','value'=>set_value('titre'))).'</p>';
    echo '<p>'.form_label('Date de validité : ','datepicker',array('class' => 'leftlabel')).form_input(array('name'=>'date','size'=>'15','id'=>'datepicker')).'</p>';
 //   echo '<p>'.form_label('Résumé : ','resume').'<br />'.form_textarea(array('name'=>'resume','rows'=>'1','cols'=>'1','id'=>'texte','value'=>set_value('resume',$row->resume))).'</p>';
    echo '<p>'.form_label('Texte : ','texte').'<br />'.form_textarea(array('name'=>'texte','rows'=>'1','cols'=>'1','id'=>'texte','value'=>set_value('texte'))).'</p>';
    
    echo '<div class="span-22 last"><p><strong>Image :</strong></p>';
    echo '<p>Choisissez parmis les images existantes</p></div>';
    $dirname = 'img/blog/defaut/';
    $dir = opendir($dirname); 

    while($file = readdir($dir)) {
        if($file != '.' && $file != '..' && !is_dir($dirname.$file))
        {
            $legende=substr(substr($file,0,-4),2);
            $file=htmlentities($file);
            echo '<div class="choiximages span-4"><img src="'.base_url('img/blog/defaut/'.$file).'" alt=""><br />';
            echo form_radio('defimage', $file);
            echo '</div>';
        }
    }
//    echo '<div class="span-1 last"></div>';
    closedir($dir);

    echo '<div class="span-22" last"><p>Où importez une image ';
//        echo '<div class="span-24 last">';
//        echo '<p>'.form_label('Choisir une autre image : ','image',array('class' => 'rightlabel')).form_upload(array('name'=>'image','size'=>'70','id'=>'image')).'</p>';
    echo form_upload(array('name'=>'image','size'=>'70','id'=>'image')).'</p>';
    echo '</div>';
    
    echo '<div class="span-22 last"><p>'.form_submit('valid','Prévisualiser l\'actualité').'</p></div>';
    echo form_close();
//}
?>
</div>

