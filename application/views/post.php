<?php
$tab_mois=array(1=>'janvier',2=>'février',3=>'mars',4=>'avril',5=>'mai',6=>'juin',7=>'juillet',8=>'août',9=>'septembre',10=>'octobre',11=>'novembre',12=>'décembre');

foreach ($post as $row) {
    echo '<div class="contentblog">';

    echo '<h2>'.$row->titre.'</h2>';
    //echo '<p class="date"> '.date("d", strtotime($row->date)).' '.$tab_mois[date("n", strtotime($row->date))].' '.date("Y", strtotime($row->date)).'</p>';

    echo '<div class="imageblog">';
    echo '<img src="'.base_url('img/blog/'.$row->image).'">';
    echo '</div>';

    echo '<div class="observations">';
//    echo $row->resume;
    echo $row->texte;
    echo '</div>';

    echo '</div>';
}

?>
