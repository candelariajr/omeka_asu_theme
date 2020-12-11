<?php
$pageTitle = __('Browse Items');
echo head(array('title'=>$pageTitle, 'bodyclass'=>'items tags'));
?>
<div class="header-subtext">
    <div class="container">
        <div class="row">
            <div class="col-5">
                <h4 class="header-subtext-text-padding"><?php echo $pageTitle;?></h4>
            </div>
            <div class="col-7">
                <nav class="browse-navigation">
                    <?php echo public_nav_items(); ?>
                </nav>
            </div>
        </div>
    </div>
</div>
<br>
<br>
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
        foreach ($result as $itemRecord){
            echo "<tr><td><a href='".CURRENT_BASE_URL."/items/browse?tags=".$itemRecord['t_name']."'>".$itemRecord['t_name']."</a></td><td>".$itemRecord['t_count']."</td></tr>";
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
<br>
<?php echo foot(); ?>
