<!DOCTYPE html>
<html class="<?php echo get_theme_option('Exhibit Color'); ?>" lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=yes" />
    <!-- Global site tag (gtag.js) - Google Analytics This is for tag manager only. See if this can become a plugin-->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-NDSGD12ESL"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-NDSGD12ESL');
    </script>
    <?php if ($description = option('description')): ?>
        <meta name="description" content="<?php echo $description; ?>" />
    <?php endif; ?>

    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <?php fire_plugin_hook('public_head',array('view'=>$this)); ?>
    <!-- Stylesheets -->
    <?php
    queue_css_file(array('bootstrap-grid', 'bootstrap','style'));
    echo head_css();
    ?>
    <!-- JavaScripts -->
    <?php queue_js_file('jquery-3.2.1.min', 'javascripts'); ?>
    <?php queue_js_file('Popper', 'javascripts'); ?>
    <?php queue_js_file('bootstrap', 'javascripts'); ?>
    <?php //queue_js_file('bootstrap.bundle', 'javascripts'); ?>
    <?php echo head_js(); ?>
</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
<?php
function runDbQuery($queryString){
    $db = get_db();
    $sql = $queryString;
    $result = $db->fetchAll($sql);
    return $result;
}

function getExhibitPageEditIdFromPageSlug($slug){
    $db = get_db();
    $results = runDbQuery("select id from $db->prefix"."exhibit_pages where slug = '$slug' limit 1");
    return $results[0]['id'];
}

function getExhibitEditIdFromPageSlug($slug){
    $db = get_db();
    $sql = "select id from $db->prefix"."exhibits where slug = '$slug' limit 1";
    $results = runDbQuery($sql);
    return $results[0]['id'];
}

function getSimplePage($slug){
    $db = get_db();
    $slug = substr($slug,1);
    $queryString = "select id from $db->prefix"."simple_pages_pages where slug = '$slug'";
    $results = runDbQuery($queryString);
    if(!$results){
        return false;
    }else{
        return $results[0]['id'];
    }
}
if(CURRENT_BASE_URL == ""){
    $newURL[1] = url();
}else{
    $newURL = explode(CURRENT_BASE_URL, url());
}
$isAdminPage = sizeof(explode($newURL[1], '/users/')) > 1;
$isContactPage = sizeof(explode($newURL[1], "/contact/")) >1;
//user is authenticated
if(current_user() != null && !$isAdminPage && !$isContactPage){
    $adminURL = CURRENT_BASE_URL."/admin".$newURL[1];
    $simplePage = getSimplePage($newURL[1]);
    if($simplePage){
        $adminURL = CURRENT_BASE_URL."/admin/simple-pages/index/edit/id/".$simplePage;
    }
    //check to see if exhibit
    if(sizeof(explode('/exhibits/show/', $newURL[1])) > 1){

        $exhibitSlug = explode('/exhibits/show/', $newURL[1])[1];
        //test to see if an individual exhibit page
        if(sizeof(explode('/', $exhibitSlug)) > 1){
            //Exhibit Page
            $exhibitPageSlug = explode('/', $exhibitSlug)[1];
            $id = getExhibitPageEditIdFromPageSlug($exhibitPageSlug);
            $adminURL = CURRENT_BASE_URL."/admin/exhibits/edit-page/".$id;
        }else{
            //Exhibit
            $exhibitSlug = explode('/', $exhibitSlug)[0];
            $id = getExhibitEditIdFromPageSlug($exhibitSlug);
            $adminURL = CURRENT_BASE_URL."/admin/exhibits/edit/".$id;
        }
    }
    echo "<div  style='background-color: #111; width: 100%'><div class='container'><span style='padding-left: 16px;'><a href='".$adminURL."' alt='Administration' title='Administration' style='background-color:#fcc900; color: #111; border-radius: 5px; padding: 4px;'>Edit</a></span></div></div>";
}
?>

<!--Generate Admin/Login Bar-->
<!--Admin/Login Bar for mobile (takes up entire screen)-->
<div class="custom-admin-container-top">
    <div class="container">
        <div class="row">
            <div class="col d-block d-sm-block d-md-none d-lg-none d-xl-none">
                <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
            </div>
        </div>
    </div>
</div>
<!--Admin/Login Bar for desktop (is shared with other items)-->
<div class="custom-top-search">
    <div class="container">
        <div class="row">
            <div class="col d-none d-sm-none d-md-none d-lg-block col-lg-2 d-xl-block col-xl-2">
                <a href="https://appstate.edu" title="Appalachian State University Home">
                    <img src="https://library.appstate.edu/profiles/asu/themes/custom/asu_theme/images/appstatelogo.png" alt="ASU" class="custom-top-logo">
                </a>
            </div>
            <div class=" custom-admin-container-mid col d-none d-sm-none d-md-block d-lg-block d-xl-block">
                <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
            </div>
            <div class="col custom-search-box">
                <form class="form-inline custom-form" id="search-form" name="search-form" action="<?php echo CURRENT_BASE_URL;?>/solr-search/results/interceptor" method="get">
                    <div class="input-group">
                        <label for="query" class="sr-only"></label>
                        <input type="text" name="query" placeholder="Search..." class="form-control" aria-label="Search terms" title="Search Terms Input" alt="Search Terms Input" id="query" required>
                        <div class="input-group-append">
                            <button type="submit" name="submit-search" id="submit_search" alt="Search" title="Search" value="Search" class="btn">
                                Go
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="title-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title-header-text">
                    <h5><a class="asu-header-link" title="University Libraries Home" alt="University Libraries Home" href="https://library.appstate.edu">University Libraries</a></h5>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="custom-nav-bar">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="<?php echo url('') ?>">
                        <h4 class="custom-site-name-bar" alt="Digital Collections Home" title="Digital Collections Home">Digital Collections</h4>
                    </a>
                    <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler0" aria-controls="navbarTogglerDemo03" alt="Navigation Menu" title="Navigation Menu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarToggler0">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                            <!--
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                            </li>
                            -->
                            <!--
                            <li class="nav-item" id="navItems">
                                <a class="nav-link asu-link" href="<?php echo url("items")?>">Browse Items</a>
                            </li>
                            -->
                            <li class="nav-item" id="navExhibits">
                                <a class="nav-link asu-link" alt="Browse Exhibits" title="Browse Exhibits" href="<?php echo url("exhibits")?>">Browse Exhibits</a>
                            </li>
                            <li class="nav-item" id="navCollections">
                                <a class="nav-link asu-link" alt="Browse Collections" title="Browse Collections" href="<?php echo url("collections")?>">Browse Collections</a>
                            </li>
                            <li class="nav-item" id="navAbout">
                                <a class="nav-link asu-link" alt="About Us" title="About Us" href="<?php echo url("about")?>">About Us</a>
                            </li>
                            <li class="nav-item" id="navContact">
                                <a class="nav-link asu-link" alt="Contact Us" title="Contact Us" href="<?php echo url("contact")?>">Contact Us</a>
                            </li>
                            <li class="nav-item" id="navCopyright">
                                <a class="nav-link asu-link" alt="Copyright Information" title="Copyright Information" href="<?php echo url("copyright")?>">Copyright Info</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
<?php //fire_plugin_hook('public_body', array('view'=>$this)); ?>
<?php //fire_plugin_hook('public_header', array('view'=>$this)); ?>
<?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>
