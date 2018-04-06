<?php
$title = metadata('exhibit', 'title');
echo head(array(
    'title' => $title,
    'bodyclass' => 'exhibits summary',
));
?>
    <div class="custom-exhibit-title">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 id="custom-exhibit-title-container"><?php //echo $title;
                       echo exhibit_builder_link_to_exhibit($exhibit);?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="custom-primary-image">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div >
                        <div class="item active">
                            <img id="header-image" src="http://localhost/omeka_themes/files/custom/bmc_toolbar_dome.jpg" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="custom-main-content">
        <div class="container">
            <div class="row">
                <div id="page-content" class="col-12 order-1 col-sm-8 col-md-9 order-sm-2 order-md-2 order-lg-2">
                    <br>
                    <?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true))): ?>
                        <div class="exhibit-description">
                            <?php echo $exhibitDescription; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (($exhibitCredits = metadata('exhibit', 'credits'))): ?>
                        <div class="exhibit-credits">
                            <h3><?php echo __('Credits'); ?></h3>
                            <p><?php echo $exhibitCredits; ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <aside id="sidebar-first" class="col-12 order-2 col-sm-4 col-md-3 order-sm-1 order-md-1 order-lg-1">
                    <?php
                    $pageTree = exhibit_builder_page_tree();
                    if ($pageTree):
                        echo $pageTree;?>
                    <?php endif; ?>
                    <script>
                        $("#sidebar-first > ul").each(function(){
                            $(this).addClass("nav nav-pills flex-column");
                            $(this).find("li").addClass("nav-item");
                            $(this).find("a").addClass("nav-link");
                            $(this).find("ul").addClass("nav nav-pills flex-column custom-nest");
                        })
                    </script>
                </aside>
            </div>
        </div>
    </div>
<?php //echo foot();