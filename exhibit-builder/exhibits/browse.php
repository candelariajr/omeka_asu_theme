<?php
$title = __('Browse Exhibits');
echo head(array('title' => $title, 'bodyclass' => 'exhibits browse'));
?>
<?php if (count($exhibits) > 0): ?>
<div class="header-subtext">
    <div class="container">
        <div class="row">
            <div class="col-5">
                <h4 class="header-subtext-text-padding"><?php echo $title." "; ?><?php echo __('(%s total)', $total_results); ?></h4>
            </div>
            <div class="col-7">
                <nav class="browse-navigation">
                    <?php echo nav(array(
                        array(
                            'label' => __('Browse All'),
                            'uri' => url('exhibits')
                        ),
                        array(
                            'label' => __('Browse by Tag'),
                            'uri' => url('exhibits/tags')
                        )
                    )); ?>
                </nav>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
    <?php $exhibitCount = 0; ?>
    <?php foreach (loop('exhibit') as $exhibit): ?>
        <div class="item">
            <?php if ($exhibitImage = record_image($exhibit, 'square_thumbnail')): ?>
                <div class="item-img">
                    <?php echo exhibit_builder_link_to_exhibit($exhibit, $exhibitImage, array('class' => 'image')); ?>
                </div>
            <?php endif; ?>
            <div class="item-info">
                <h4><?php echo link_to_exhibit(); ?></h4>
                <?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true))): ?>
                    <div class="item-description"><?php echo $exhibitDescription; ?></div>
                <?php endif; ?>
                <?php if ($exhibitTags = tag_string('exhibit', 'exhibits')): ?>
                    <p class="tags"><?php echo __('Tags: ') . $exhibitTags; ?></p>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="container">
    <div class="row">
        <div class="col">
            <?php echo pagination_links(); ?>
            <?php else: ?>
                <p><?php echo __('There are no exhibits available yet.'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php echo foot(); ?>
