<?php
// THIS BLOCK - GET THE PREVIOUS AND NEXT ITEMS IN THE COLLECTION
/*
$db = get_db();
$id =  metadata('item', 'id');
$sql = " SELECT count(*) as 'count' FROM  $db->prefix"."items where id = $id";
$result = $db->fetchAll($sql);
$result[1] = array("id" => $id);
echo json_encode($result);
*/
//$sql = "select id from $db->prefix"."items where collection_id = (select collection_id from $db->prefix"."items where id = $id) and public = 1 order by id asc";
//$sql = "SET @a = (select collection_id from omeka_items where id = 37385);
//select id as id, @a as collection_id from omeka_items where collection_id = @a and public = 1 order by id asc;";
//$sql = "select count(*) from $db->prefix"."items where collection_id <= (select collection_id from $db->prefix"."items where id = $id) ";

/*

$db = get_db();
//get item id
$id = metadata('item', 'id');
$sql = "select collection_id from $db->prefix"."items where id = $id";
//get collection id of item
$result = $db->fetchAll($sql);
$noCollection = true;
$collectionId = -1;
$numItems = 0;
//returns empty set instead of no results
if(sizeof($result) != 0 && ($result[0]['collection_id'] != '')) {
    $noCollection = false;
    $collectionId = $result[0]['collection_id'];
}
$currentPos = 0;
//if there is at least one item in the collection
if($noCollection == false){
    //set the current position of the current id to the position of the item in the collection
    $sql = "select id from $db->prefix"."items where collection_id = $collectionId  and public = 1 order by id asc";
    $result = $db->fetchAll($sql);
    $numItems = sizeof($result);
    for($i = 0; $i <= $numItems - 1; $i++){
        if($result[$i]['id'] == $id){
            $currentPos = $i + 1;
        }
    }
}
$previousUrl = "";
$nextUrl = "";
$previousUrlHTML = "ORIGINAL HTML";
$nextUrlHTML = "ORIGINAL HTML";
//TODO: Clean this up with some functions and logic so a single function call per one button can render it accordingly
if($noCollection == false && $numItems != 0){
    //This shouldn't even be called with zero items in the collection
    if($numItems == 1){
        //only one item in the collection
    }else if($currentPos == 1 && $numItems > 1){
        //at the beginning of a collection
        //$previousUrl = $result[$numItems - 1]['id'];
        $nextUrl = $result[$currentPos]['id'];
        $previousUrlHTML = "AT BEGINNING OF COLLECTION";
        $nextUrlHTML = "<br><a href=\"$nextUrl\" class='next'>NEXT</a>";
    }else if($currentPos == $numItems && $numItems > 1){
        //at the end of a collection
        $previousUrl = $result[$currentPos - 2]['id'];
        //$nextUrl = $result[0]['id'];
        $nextUrlHTML = "AT END OF COLLECTION";
        $previousUrlHTML = "<br><a href=\"$previousUrl\" class='next'>PREVIOUS</a>";
    }else{
        //in the middle of a collection\
        $previousUrl = $result[$currentPos - 2]['id'];
        $nextUrl = $result[$currentPos]['id'];
        $previousUrlHTML = "<br><a href=\"$previousUrl\" class='previous'>PREVIOUS</a>";
        $nextUrlHTML = "<br><a href=\"$nextUrl\" class='next'>NEXT</a>";
        // <a href="<?php echo $previousUrl\?\>">
    }
}


function getNextButton(){
    $nextUrlHTML = Zend_Registry::get('App_State_Custom_Next_Url_HTML');;
    echo $nextUrlHTML;
}

getPreviousButton();
getNextButton();

Zend_Registry::set('App_State_Custom_Previous_Url_HTML', $previousUrlHTML);
Zend_Registry::set('App_State_Custom_Next_Url_HTML', $nextUrlHTML);




function getPreviousButton(){
    $previousUrlHTML = Zend_Registry::get('App_State_Custom_Feature_Factory');
    echo parseAdaptiveUrl($previousUrlHTML);
}
*/
/*
 * ===================================================================================================================
 *                                           BEGIN PREVIOUS <-> NEXT BUTTON PHP
 * ===================================================================================================================
 * */
//TODO: Wrap this up in an object. It's not safe having this code out here in the wild naked
$db = get_db();
//get current item id
$currentItem = metadata('item', 'id');
//determine if item is in a collection
$sql = "select collection_id from $db->prefix"."items where id = $currentItem";
$result = $db->fetchAll($sql);
$itemInCollection = false;
$previousItem = -1;
$nextItem = -1;
$singleItem = 0;
$index = 0;
$collectionArray = array();
if($result[0]['collection_id'] != ''){
    $itemInCollection = true;
    $collectionId = $result[0]['collection_id'];
    $sql = "select id from $db->prefix"."items where collection_id = $collectionId  and public = 1 order by id asc";
    //get list of ids in numerical order of items in this collection
    $collectionArray = $db->fetchAll($sql);
    //get the index of the current item within the collection
    if(sizeof($collectionArray) > 1){
        while($currentItem != $collectionArray[$index]['id']){
            $index++;
        }
        echo "Index in Collection: ".$index;
    }else{
        $index = 0;
        $singleItem = 1;
    }
}

if($itemInCollection && $index != sizeof($collectionArray) - 1){
    $nextItem = $collectionArray[$index + 1]['id'];
}
if($itemInCollection && $index > 0){
    $previousItem = $collectionArray[$index - 1]['id'];
}

function getPrevious($previousItem){
    if($previousItem == -1){
        echo "At Beginning of Collection";
    }else{
        echo "<a href='$previousItem'>Previous Item</a>";
    }
}

function getNext($nextItem){
    if($nextItem == -1){
        echo "At End of Collection";
    }else{
        echo "<a href='$nextItem'>Next Item</a>";
    }
}

/*
 * ===================================================================================================================
 *                                            END PREVIOUS <-> NEXT BUTTON PHP
 * ===================================================================================================================
 * */




?>
<!-- END LOGIC FOR GETTING POSITION IN COLLECTION INFO -->
<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')), 'bodyid'=>'items','bodyclass' => 'show')); ?>
    <div class="item-title">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="item-title-text">
                        <?php echo metadata('item', array('Dublin Core', 'Title')); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--

    NEW LAYOUT

    -->
    <div class="container">
        <div class="row">
            <div class="col">
                &nbsp;
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- MAIN DISPLAY -->
            <div class="col-lg-8">
                <!-- CONTENT -->
                <?php //echo get_specific_plugin_hook_output('DocsViewer', 'public_items_show', array('view' => $this, 'item' => $item)); ?>
                <?php
                $sketchFab = false;
                $fileExtension = null;
                $itemType = metadata('item', 'item_type_name');
                //echo $itemType;
                if($itemType == 'Sketchfab'){
                    $sketchFab = true;
                    ?>
                    <iframe width="100%" height="400px" src="<?php echo item_type_elements($item)['sf_link'];?>/embed" frameborder="0" allowvr="" allowfullscreen="" mozallowfullscreen="true" webkitallowfullscreen="true" onmousewheel=""></iframe>
                    <?php
                }
                if($item->getFile()){
                    $fileExtension = $item->getFile()->getExtension();
                }
                if(strtoupper($fileExtension) == 'PDF'){
                    echo get_specific_plugin_hook_output('UniversalViewer', 'public_items_show', array('view' => $this, 'item' => $item));
                    //echo "<br>";
                }
                else{
                    echo get_specific_plugin_hook_output('DocsViewer', 'public_items_show', array('view' => $this, 'item' => $item));
                    //echo "<br>";
                }

                // echo get_specific_plugin_hook_output('UniversalViewer', 'public_items_show', array('view' => $this, 'item' => $item));
                ?>
                <?php
                if(!$sketchFab){
                    echo files_for_item(
                        array(
                            'showFilename'=>true,
                            'linkToFile'=>true,
                            'imageSize' => 'fullsize',
                            'linkAttributes'=>array(
                                'rel'=>'lightbox'),
                            'filenameAttributes'=>array(
                                'class'=>'audio-file-div'),
                            'imgAttributes'=>array(
                                'id'=>'foobar'
                            ),
                            'icons' => array(
                                'audio/mpeg'=>img('3a.png'),
                                'application/pdf'=>img('pdficon_large.png'))));
                    // echo "<br>";
                }?>
                <div class="row">
                    <!-- CITATION -->
                    <div class="col">
                        <?php if (metadata($item, 'has tags')): ?>
                            <div id="item-tags" class="element">
                                <h3>Tags</h3>
                                <div class="element-text tags"><?php echo tag_string('item'); ?></div>
                            </div>
                        <?php endif; ?>
                        <!-- If the item belongs to a collection, the following creates a link to that collection. -->
                        <?php if (get_collection_for_item()): ?>
                            <div id="collection" class="element">
                                <h3>Collection</h3>
                                <div class="element-text"><p><?php echo link_to_collection_for_item(); ?></p></div>
                            </div>
                        <?php endif; ?>

                        <!-- The following prints a citation for this item. -->
                        <div id="item-citation" class="element">
                            <h3>Citation</h3>
                            <div id="citation" class="element-text"><?php echo html_entity_decode(metadata($item, 'citation')); ?></div>
                            <!-- Custom code to submit a request and prepopulate duplication form -->
                            <br>
                            <?php if (!$sketchFab): ?>
                                <div class="element-text">
                                    <form id="requestcopy" action="http://collections.library.appstate.edu/duplications">
                                        <input type="hidden" name="item" value=""><input type="submit" value="Request a copy" class="btn btn-asu">
                                    </form>
                                </div>
                                <script>
                                    jQuery("#requestcopy").submit(function(event) {
                                        var citationText = jQuery("#citation").text();
                                    jQuery("input[name='item']").val(citationText); });
                                </script>
                                <br>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php if(plugin_is_active('SocialBookmarking')): ?>
                    <div class="row">
                        <div class="col">
                            <?php echo get_specific_plugin_hook_output('SocialBookmarking', 'public_items_show', array('view' => $this, 'item' => $item)); ?>
                        </div>
                    </div>
                    <br>
                <?php endif; ?>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <!-- METADATA -->
                    <div class="col-12">
                        <?php echo all_element_texts($item,
                            array(
                                'show_empty_elements' => false,
                                'show_element_sets' => 'Dublin Core, Document Item Type Metadata, Still Image Item Type Metadata',
                                'show_element_set_headings' => false
                            ));
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <?php if($itemInCollection):?>
                    <ul class="item-pagination navigation">
                        <li id="previous-item" class="previous">
                            <?php //echo link_to_previous_item_show();
                                getPrevious($previousItem);
                            ?>
                        </li>
                        <li id="next-item" class="next">
                            <?php //echo link_to_next_item_show();
                                getNext($nextItem);
                            ?>
                        </li>
                    </ul>
                <?php endif;?>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            var histcheck = jQuery("#collection a").text();
            if(histcheck=="Appalachian State University Historical Photos"){
                jQuery("div[id*='historical-photo']").each(function(){jQuery(this).addClass("historical");});
            }
            var blacklist=[
                /** "dublin-core-date-created",
                 "dublin-core-date-modified", **/
                "dublin-core-title" /**,
                 "dublin-core-source",
                 "dublin-core-type",
                 "dublin-core-language",
                 "dublin-core-rights",
                 "dublin-core-publisher",
                 "dublin-core-format" **/
            ];
            var blacklist2=[
                "item-type-metadata-reference-url",
                "item-type-metadata-date-digitized",
                "item-type-metadata-digitized-by",
                "upload-date",
                "transcription-date",
                "transcribed-by",
                "scan-date",
                "scanned-by",
                "dimensions---original",
                "dimensions---digital",
                "classification-title",
                "contentdm-number",
                "contentdm-filename",
                "contentdm-filepath",
                "file-size",
                "dimensions-digital",
                "format-digital",
                "series",
                "format-original",
                "dimensions-original",
                "sponsors"
            ];
            var blacklist3=[
                "item-type-metadata-file-name",
                "corporate-names",
                "personal-names",
                "place-names"
            ];
            jQuery.each(blacklist,function (index,value){
                jQuery("#"+value).remove();
            });
            jQuery.each(blacklist3,function (index,value){
                var hcheck = jQuery("div[id*="+value+"]");
                if(!hcheck.hasClass('historical')){
                    /** hcheck.remove(); **/
                }
            });
            jQuery.each(blacklist2,function (index,value){
                /** jQuery("div[id*="+value+"]").remove(); **/
            });

            var vidwidthcheck=0;
            var description = jQuery("#dublin-core-description");
            var subject = jQuery("#dublin-core-subject");
            var alt_title = jQuery("#dublin-core-alternative-title");
            if((description.length>0)&&(subject.length>0)){
                var desc = description;
                description.remove();
                desc.insertBefore(subject);
            }
            if (alt_title.length>0){
                var alt=alt_title;
                var newloc = alt_title.parent();
                alt_title.remove();
                alt.appendTo(newloc);
            }
            vidwidthcheck = jQuery(".video-quicktime object").width();
            if (vidwidthcheck>0){
                jQuery(".video-quicktime").css("margin-left","-75px");
                jQuery("#content").css("overflow","visible");
            }
            jQuery(".application-pdf .audio-file-div").text("Download PDF");
            jQuery(".audio-mpeg").each(function(index){
                var audio = jQuery(this).find(".download-file").attr("href");
                var audioFileDiv = jQuery(this).find(".audio-file-div");
                var audioFileText = audioFileDiv.text();

                audioFileDiv.text("");
                audioFileDiv.html("<a href='" + audio + "'>" + audioFileText + "</a>");
            });
            jQuery('video').css('width','75%');
            jQuery('.element-text').each(function(){
                var chk = jQuery(this).text();
                if(chk=='None'){
                    jQuery(this).parent().hide();
                }
            });
        });
    </script>
    <?php if($itemInCollection): ?>
        <script>
            window.addEventListener("keydown", function(e){
                if(e.key === "ArrowLeft"){
                    <?php if($previousItem !== -1): ?>
                        window.location.href = "<?php echo $previousItem?>";
                    <?php endif; ?>
                }
                if(e.key === "ArrowRight"){
                    <?php if($nextItem !== -1): ?>
                        window.location.href = "<?php echo $nextItem?>";
                    <?php endif; ?>
                }
            }, true);
        </script>
    <?php endif; ?>
</script>
<?php echo foot();
