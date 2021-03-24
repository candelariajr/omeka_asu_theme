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
    <div class="card-columns">
        <?php $exhibitCount = 0; ?>
        <?php foreach (loop('exhibit') as $exhibit): ?>
            <div class="card">
                <?php $exhibitCount++; ?>
                <div class="exhibit <?php if ($exhibitCount%2==1) echo ' even'; else echo ' odd'; ?>">
                    <h2 class="card-title"><?php echo link_to_exhibit(); ?></h2>
                    <hr>
                        <?php if ($exhibitImage = record_image($exhibit, 'square_thumbnail')): ?>
                            <div class="card-img-top">
                                <?php echo exhibit_builder_link_to_exhibit($exhibit, $exhibitImage, array('class' => 'image')); ?>
                            </div>
                        <?php endif; ?>
                    <div class="card-body">
                        <?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true))): ?>
                            <div class="description"><?php echo $exhibitDescription; ?></div>
                        <?php endif; ?>
                        <?php if ($exhibitTags = tag_string('exhibit', 'exhibits')): ?>
                            <p class="tags"><?php echo __('Tags: ') . $exhibitTags; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
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
