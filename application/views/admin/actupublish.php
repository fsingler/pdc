<div class="push-1 span-22 last">
<?php
foreach ($post as $row) {
    echo validation_errors();

    $hidden=array('id_post'=>$row->id_post); // Champs cachés du formulaire
    echo form_open_multipart('admin/actu_publish/'.$row->id_post,'',$hidden);
    echo '<div class="span-22 last"><p>'.form_submit('valid','Publier l\'actualité').'</p></div>';
    echo form_close();
}
?>
</div>

