<div class="span-7 last offresformations">

    <?php
    for ($i=1;$i<=3;$i++) {
//        $orga=array(1=>'Cerfav',2=>'EEIGM',3=>'ENSAN');
    ?>
    <div class="offre">
        <a href="<?php echo base_url('organisme/1-cerfav.html'); ?>"><img src="<?php echo base_url('img/offres/cerfav-p.jpg'); ?>" width="270"></a>
        <h2><a href="<?php echo base_url('organisme/1-cerfav.html'); ?>">Cerfav</a></h2>
        <p>Centre Européen de Recherches et de Formations aux Arts Verriers</p>
        <p><a href="http://www.cerfav.fr">www.cerfav.fr</a></p>
    </div>

    <div class="offre">
        <a href="<?php echo base_url('organisme/2-lp-hurlevent.html'); ?>"><img src="<?php echo base_url('img/offres/lp-hurlevent-p.jpg'); ?>" width="270"></a>
        <h2><a href="<?php echo base_url('organisme/1-cerfav.html'); ?>">Lycée Professionnel Hurlevent</a></h2>
        <p><a href="http://www4-test.ac-nancy-metz.fr/lyc-hurlevent-behren/">www4-test.ac-nancy-metz.fr/lyc-hurlevent-behren/</a></p>
    </div>

    <div class="offre">
        <a href="<?php echo base_url('organisme/3-ensan.html'); ?>"><img src="<?php echo base_url('img/offres/ensan-p.jpg'); ?>" width="270"></a>
        <h2><a href="<?php echo base_url('organisme/1-cerfav.html'); ?>">ENSAN</a></h2>
        <p>Ecole Nationale Supérieure d'Architecture de Nancy</p>
        <p><a href="http://www.nancy.archi.fr/">www.nancy.archi.fr</a></p>
    </div>
    <?php
    }
    ?>

</div>