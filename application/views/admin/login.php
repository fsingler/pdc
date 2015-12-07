<div class="push-1 span-22 last">
    <h2>Connexion</h2>
<?php

echo validation_errors();

//echo '<p>Document Root = '.$_SERVER['DOCUMENT_ROOT'].'</p>';

echo form_open('admin/index/');

echo '<p>'.form_label('Utilisateur : ','username',array('class' => 'leftlabel')).form_input(array('name'=>'username','size'=>'50','id'=>'titre','value'=>set_value('username'))).'</p>';
echo '<p>'.form_label('Mot de passe : ','password',array('class' => 'leftlabel')).form_password(array('name'=>'password','size'=>'50','id'=>'titre','value'=>set_value('password'))).'</p>';

echo '<p>'.form_submit('valid','Connexion');
echo form_close();
?>
</div>

