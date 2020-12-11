<?php echo head(array('title' => metadata('exhibit', 'title'), 'bodyclass'=>'exhibits summary')); ?>
<div class="<?php echo get_theme_option('Exhibit Color');?> container">
<div class="row">
    <div class="col-md-3" id="left-side-exhibit-bar">
        <?php set_exhibit_pages_for_loop_by_exhibit(); ?>
        <?php if (has_loop_records('exhibit_page')): ?>
            <nav id="exhibit-pages">
                <ul class="list-group list-group-root well">
                    <?php foreach (loop('exhibit_page') as $exhibitPage): ?>
                        <?php echo custom_exhibit_builder_page_summary($exhibitPage); ?>
                    <?php endforeach; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
    <div class="col-md-9">
        Content
    <?php
    $theme = get_theme_option('Exhibit Color');
    echo $theme;
    ?>
    </div>
</div>
</div>
<?php echo foot(); ?>
