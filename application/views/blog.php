<div class="span-10">
<?php
//$tab_mois=array(1=>'janvier',2=>'février',3=>'mars',4=>'avril',5=>'mai',6=>'juin',7=>'juillet',8=>'août',9=>'septembre',10=>'octobre',11=>'novembre',12=>'décembre');

foreach ($lastpost as $row) {
    echo '<div class="span-10 last blogtop">';
    echo '<div class="blogtopimg">';
    echo '<a href="'.base_url('blog/'.$row->id_post.'-'.url_title(convert_accented_characters($row->titre)).'.html').'"><img src="'.base_url('img/blog/'.$row->image).'" width="400"></a>';
    echo '</div>';
    echo '<div>';
    echo '<div class="span-3 blogtoptitle">';
    echo '<h2><a href="'.base_url('blog/'.$row->id_post.'-'.url_title(convert_accented_characters($row->titre)).'.html').'">'.$row->titre.'</a></h2>';
    echo '</div>';
    echo '<div class="span-6 blogtoptxt">';
    if ($row->resume=='') echo word_limiter($row->texte,40);
    else echo $row->resume;
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
?>
    <div class="span-10 last titreh">
        <h2>Actualités</h2>
    </div>

<?php
foreach ($posts as $row) {
    echo '<div class="span-10 last blogpost">';
    echo '<div class="span-5 blogimg">';
    echo '<a href="'.base_url('blog/'.$row->id_post.'-'.url_title(convert_accented_characters($row->titre)).'.html').'"><img src="'.base_url('img/blog/'.$row->image).'" width="190"></a>';
    echo '</div>';
    echo '<div class="span-5 last blogtxt">';
    echo '<h3><a href="'.base_url('blog/'.$row->id_post.'-'.url_title(convert_accented_characters($row->titre)).'.html').'">'.$row->titre.'</a></h3>';
    echo '<p class="date">&nbsp;</p>';
//    echo '<p class="date"> '.date("d", strtotime($row->date)).' '.$tab_mois[date("n", strtotime($row->date))].' '.date("Y", strtotime($row->date)).'</p>';
//    echo '<p class="date">'.$row->date.'</p>';
//    echo '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>';
    if ($row->resume=='') echo word_limiter($row->texte,40);
    else echo $row->resume;
    echo '</div>';
    echo '</div>';
}
?>
<!--
    <div class="span-10 last blogpost">
        <div class="span-5 blogimg">
            <img src="<?php // echo base_url('img/blog/post2.jpg'); ?>">
        </div>
        <div class="span-5 last blogtxt">
            <h3>Post <?php // echo $i; ?></h3>
            <p class="date">Date - 28 septembre au 19 janvier 2015</p>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>
        </div>
    </div>
-->
</div>