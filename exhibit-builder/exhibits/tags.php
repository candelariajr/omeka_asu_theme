<?php
$title = __('Browse Exhibits by Tag');
echo head(array('title' => $title, 'bodyclass' => 'exhibits tags'));
?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2><?php echo $title; ?></h2>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col">
            <?php echo tag_cloud($tags, 'exhibits/browse'); ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col">
            <?php echo nav(array(
                    array(
                        'label' => __('Browse All'),
                        'uri' => url('exhibits/browse')
                    ),
                    array(
                        'label' => __('Browse by Tag'),
                        'uri' => url('exhibits/tags')
                    )
                )
            ); ?>
        </div>
    </div>
</div>
<?php echo foot(); ?>
