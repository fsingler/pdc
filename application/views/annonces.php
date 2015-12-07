    <script type="text/javascript">
      $(document).ready(function ($) {
        $('#pannonces').perfectScrollbar();
      });
    </script>

<div class="span-17 last pa">
    <h2>Petites annonces Lorraines</h2>
    <div id="pannonces" class="span-17">
        <?php
        foreach ($annonces as $row) {
            echo '<div class="span-7 annonce">';
            echo '<p class="titre"><a href="'.base_url('annonces#'.$row->ID).'" class="titre">'.$row->titre.'</a></p>';
            echo '<p class="date"><a href="'.base_url('annonces#'.$row->ID).'" class="date">'.date("d/m/Y", strtotime($row->date)).'</a></p>';
            //echo '<p class="texte"><a href="'.base_url('annonces#'.$row->ID).'" class="texte">'.nl2br(word_limiter(stripslashes($row->annonce),20)).'</a></p>';
            echo '</div>';
        }  
    ?>
    </div>
</div>