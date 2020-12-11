<?php echo head(array('bodyid'=>'home'));
/*
 * The reason for this is to reduce the number of database/view generator calls by 1-
 * And (mainly) to prevent the "featured item/exhibit" from changing when you flip from
 * portrait to landscape view on larger smartphones and smaller tablets
 *
 * */
//get the display setting for the exhibits and collections
$displayFeaturedCollection = get_theme_option('Display Featured Collection');
$displayFeaturedExhibit = get_theme_option('Display Featured Exhibit');
$displayFeaturedItem = get_theme_option('Display Featured Item');
//create a place to store the retrieved views
$randomCollectionView = "";
$randomExhibitView = "";
$randomItemView = "";
//put the static views into the variables
if($displayFeaturedCollection){
    $randomCollectionView = random_featured_collection();
}
if($displayFeaturedExhibit){
    $randomExhibitView = asu_exhibit_builder_display_random_featured_exhibit();
}
if($displayFeaturedItem){
    $randomItemView = random_featured_items(1, true);
}
?>
<div class="container">
    <div class="row">
        <div class="col-s-12 col-lg-12 right-index-panel">
            <!-- Right Side in Desktop: Full Middle in Mobile-->
            <?php if ($homepageText = get_theme_option('Homepage Text')): ?>
                <!-- Homepage Text -->
                <?php echo "<div id='homepage-text'>".
                    $homepageText.
                    "</div><br>"; ?>
            <?php endif; ?>

            <div id="recent-items">
                <?php
                $recentItems = get_theme_option('Homepage Recent Items');
                if ($recentItems === null || $recentItems === ''):
                    $recentItems = 3;
                else:
                    $recentItems = (int) $recentItems;
                endif;
                if ($recentItems):
                    ?>
                    <div id="recent-items" class="items-list">
                        <h2><?php echo __('Recently Added Items'); ?></h2>
                        <?php
                        set_loop_records('items', get_recent_items(5));
                        foreach (loop('items') as $item): ?>
                            <div class="item">
                                <?php //if (metadata($item, 'has thumbnail')): ?>
                                    <div class="item-img">
                                        <?php echo link_to_item(item_image('square_thumbnail')); ?>
                                    </div>
                                <?php //endif; ?>
                                <div class="item-info">
                                    <h4><?php echo link_to_item(); ?></h4>
                                    <?php if ($desc = metadata($item, array('Dublin Core', 'Description'), array('snippet'=>150))): ?>
                                        <div class="item-description"><?php echo $desc; ?><p><?php echo link_to_item('see more',(array('class'=>'show'))) ?></p></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <p class="view-items-link item">
                            <a href="<?php echo html_escape(url('items')); ?>"><?php echo __('View All Items'); ?></a>
                        </p>
                    </div><!--end recent-items -->
                <?php endif; ?>

                <?php fire_plugin_hook('public_home', array('view' => $this)); ?>
            </div>
        </div>
    </div>
    <div class="row">

        <!-- Left Side Bottom in Desktop: Full Bottom in Mobile-->
        <div class="d-none d-lg-block col-lg-4 left">
            <hr>
            <div class="quick">
                <h3>Contact Information</h3>
                <p>For questions about the ASU <br />Digital Collections, please contact Pam Mitchem.
                    <br>
                    pricemtchemp@appstate.edu
                    <br>
                    <!--href="https://mail.google.com/mail/?view=cm&fs=1&to=someone@example.com&su=SUBJECT&body=BODY&bcc=someone.else@example.com"-->
                    <a
                            target="_blank"
                            href="https://mail.google.com/mail/?view=cm&fs=1&to=pricemtchemp@appstate.edu&su=Contact Regarding Omeka"
                            data-toggle="tooltip"
                            data-placement="right"
                            title="Use Gmail to compose message">
                        (Web Version)</a>
                    <br>
                    <a
                            href="mailto:pricemtchemp@appstate.edu"
                            data-toggle="tooltip"
                            data-placement="right"
                            title="Use your Desktop Client (Thunderbird, Outlook) to compose message">
                        (Desktop Version)</a>
                </p>
                <p>Phone: 828.262.7422</p>
            </div>
        </div>
        <div class="col d-xs-block d-lg-none left-index-panel">
            <div class="quick">
                <h3>Contact Information</h3>
                <p>For questions about the ASU <br />Digital Collections, please contact Pam Mitchem.
                    <br>
                    pricemtchemp@appstate.edu
                    <br>
                    <a
                            href="mailto:pricemtchemp@appstate.edu"
                            title="Use your Mobile Client (Gmail, Outlook) to compose message">
                        (Mobile Version)</a>
                    <br>

                </p>
                <p>Phone: 828.262.7422</p>
            </div>
        </div>
    </div>
    <!--
    <button class="btn btn-info" data-toggle="modal" data-target="#mobileEmailHelp">?</button>
    <div class="modal fade" id="mobileEmailHelp" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Email Links</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <b>Web Version</b>
                    <p>This opens a Gmail window in your browser</p>
                    <hr>
                    <b>Desktop Version</b>
                    <p>This opens up your default Desktop client (Thunderbird, Outlook)</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    -->
    <script>
        $('[data-toggle="tooltip"]').tooltip();
    </script>
</div>
<?php echo foot();
