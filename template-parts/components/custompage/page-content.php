<?php if(!empty(the_content())) : ?>
   <section id="infographics">
        <div class="container">
            <div class="col-12">
            <?php if(have_posts()) : ?>
                <?php while(have_posts()) : the_post();?>
                    <?php the_content();?>
                <?php endwhile;?>
            <?php endif;?>
            </div>
        </div>
    </section>
<?php endif;?>