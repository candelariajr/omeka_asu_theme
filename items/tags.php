<?php
$pageTitle = __('Browse Items');
echo head(array('title'=>$pageTitle, 'bodyclass'=>'items tags'));
?>
ITEMS\TAGS.PHP
<h1><?php echo $pageTitle; ?></h1>

<div class="container">
    <div class="row">
        <div class="col">
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
        <div id="loading">Loading...</div>
        <?php
        $db = get_db();
        $sql = "";
        $dbName = $db->prefix;
        $tags = isset($GET_['tags']) ? $_GET['tags'] : false;
        if(!$tags){
            $sql = "
            SELECT 
	          -- records_tags.id, 
              -- records_tags.record_id, 
              -- records_tags.tag_id, 
              -- records_tags.record_type, 
              tags.name as t_name,
              count(*) as t_count 
            FROM 
	          $dbName"."records_tags as records_tags 
              inner join $dbName"."tags as tags on tags.id = records_tags.tag_id
            WHERE
	          records_tags.record_type = 'Item'
            GROUP BY
	          t_name
            ORDER BY 
	          t_name ASC;
        ";
        }
        $result = $db->fetchAll($sql);
        echo "<table id='tagTable' class='table table-striped table-bordered' style='display: none;'>";
        echo "<thead><tr><th>Tag Name</th><th>Tag Count</th></tr></thead><tbody>";
        $counter = 0;
        foreach ($result as $itemRecord){
            //echo "<tr id='record$counter'><td id='name$counter'>".$itemRecord['t_name']."</td><td id='count$counter'>".$itemRecord['t_count']."</td></tr>";
            echo "<tr><td><a href='".CURRENT_BASE_URL."/items/browse?tags=".$itemRecord['t_name']."'>".$itemRecord['t_name']."</a></td><td>".$itemRecord['t_count']."</td></tr>";
            $counter++;
        }
        echo "</tbody></table>"
        ?></div>
        <script>
            var tagTable = $("#tagTable");
            tagTable.DataTable({
                "initComplete" : function(settings, json){
                    $('#loading').hide();
                    tagTable.show();
                }
            });

        </script>
    </div>
</div>


<nav class="tags-navigation">
    <?php echo public_nav_items(); ?>
</nav>
<br/><br/><br/><br/>
<?php echo tag_cloud($tags, 'items/browse'); ?>
END ITEMS\TAGS.PHP
<?php echo foot(); ?>
