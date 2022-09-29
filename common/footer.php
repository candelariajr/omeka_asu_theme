<?php
$navArray = array();
$navArray[] = array('class'=>'class', 'label'=>'Browse Items', 'uri'=>url('items'));
$navArray[] = array('label'=>'Browse Collections', 'uri'=>url('collections?sort_field=Dublin+Core%2CTitle'));
$navArray[] = array('label'=>'Contact Us', 'uri'=>url('contact'));
$navArray[] = array('label'=>'Contribute', 'uri'=>url('contribution'));
?>
<?php //echo nav($navArray); ?>
<?php fire_plugin_hook('public_footer', array('view' => $this)); ?>
<div class="footer-wrapper" alt="Page Foot" title="Page Foot">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3">
                © 2022 Appalachian State University Boone, NC 28608 | 828-262-2000
                Proudly powered by <a class="asu-link" alt="Omeka Platform Home (Outside Link)" title="Omeka Platform Home (Oustide Site)" href="https://omeka.org">Omeka</a> and Laminas MVC
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <h1 class="footer-links-title">Links</h1>
                <ul class="footer-links-menu">
                    <li><a alt="Browse All Items" title="Browse All Items" href="<?php echo url('items')?>">Browse Items</a></li>
                    <!--   Had to hard wire this. For some reason it keeps overwriting this with a random URL -->
                    <li><a alt="Browse Collections" title="Browse Collections" href="<?php echo "https://omeka.library.appstate.eudu/collections"?>">Browse Collections</a></li>
                    <li><a alt="Contact Us" title="Contact Us" href="<?php echo url('contact')?>">Contact</a></li>
                    <li><a alt="Contribute" title="Contribute" href="<?php echo url('contribution')?>">Contribute</a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">

            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 pull-right" id="footer-university">
                <a alt="Appalachian State University Home" title="Appalachian State University Home" href="https://appstate.edu" title="Appalacian State University">
                    <img src="https://library.appstate.edu/profiles/asu/themes/custom/asu_theme/images/appstatelogo.png"
                         id="asu-footer-logo" class="pull-right" alt="Appalachian State University">
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div style="font-size: 10px; color: #404040 ;cursor: auto;">Architecture and UI adapted to AppState Theme by Jonathan Candelaria</div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
