    <script type="text/javascript">
      $(document).ready(function ($) {
        $('#pannonces').perfectScrollbar();
      });
    </script>

<div class="span-17 last pa">
    <h2>Petites annonces Lorraines</h2>
    <div id="pannonces" class="span-17">
        <?php
          for ($i=0;$i<8;$i++) {
        ?>    
        <div class="span-7 annonce">
            <p class="titre">Annonce 1</p>
            <p class="date">00/00/0000</p>
            <p class="texte">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis.</p>
        </div>
        <?php          
      }  
    ?>
    </div>
</div>