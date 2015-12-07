<div class="span-10">
    <div class="span-10 last blogtop">
        <div class="blogtopimg">
            <img src="<?php echo base_url('img/blog/post1.jpg'); ?>">
        </div>
        <div>
            <div class="span-3 blogtoptitle">
                <h2>Exemple<br />de post 1</h2>
            </div>
            <div class="span-6 blogtoptxt">
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa</p>
            </div>
        </div>
    </div>

    <div class="span-10 last titreh">
        <h2>Blog</h2>
    </div>

    <?php
    for ($i=2;$i<=4;$i++) {
    ?>
    <div class="span-10 last blogpost">
        <div class="span-5 blogimg">
            <img src="<?php echo base_url('img/blog/post2.jpg'); ?>">
        </div>
        <div class="span-5 last blogtxt">
            <h3>Post <?php echo $i; ?></h3>
            <p class="date">Date - 28 septembre au 19 janvier 2015</p>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>
        </div>
    </div>
    <?php
    }
    ?>
</div>