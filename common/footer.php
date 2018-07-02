
<?php
$navArray = array();
$navArray[] = array('class'=>'class', 'label'=>'Browse Items', 'uri'=>url('items'));
$navArray[] = array('label'=>'Browse Collections', 'uri'=>url('collections?sort_field=Dublin+Core%2CTitle'));
$navArray[] = array('label'=>'Contact Us', 'uri'=>url('contact'));
$navArray[] = array('label'=>'Contribute', 'uri'=>url('contribution'));
?>
<?php //echo nav($navArray); ?>
<?php fire_plugin_hook('public_footer', array('view' => $this)); ?>
<div class="footer-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3">
                © 2018 Appalachian State University Boone, NC 28608 | 828-262-2000
                Proudly powered by <a class="asu-link" href="http://omeka.org">Omeka</a>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <h1 class="footer-links-title">Links</h1>
                <ul class="footer-links-menu">
                    <li><a href="<?php echo url('items')?>">Browse Items</a></li>
                    <li><a href="<?php url('collections?sort_field=Dublin+Core%2CTitle')?>">Browse Collections</a></li>
                    <li><a href="<?php echo url('contact')?>">Contact</a></li>
                    <li><a href="<?php echo url('contribution')?>">Contribute</a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">

            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 pull-right" id="footer-university">
                <a href="http://appstate.edu" title="Appalacian State University">
                    <img src="https://library.appstate.edu/profiles/asu/themes/custom/asu_theme/images/appstatelogo.png"
                         id="asu-footer-logo" class="pull-right" alt="Appalachian State University"
                </a>
            </div>
        </div>
        <div class="row">
        </div>
    </div>
</div>
</body>
</html>
