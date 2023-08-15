<!DOCTYPE html>
<html lang="en">
<head>
    <title>RSS feed reader</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        .rss_element{
            margin-left: 50px;
            margin-bottom: 30px;
            left: 50px;
            width: calc(100% - 100px);
        }
    </style> 
</head>
<body >
<?php 
    $url = "";
    if(isset($_POST["rss_url"])){
        $url = $_POST["rss_url"];
    }
    ?>

    <div class="w-50 p-5" >
    <form target="_self" action="index.php" method="post">
        <div class="form-text">URL</div>
        <div class="input-group" >
            <input type="text" class="form-control" name="rss_url" value="<?php echo $url;?>">
            <input type="submit" class="btn btn-primary" value="Add">
        </div>
    </form>
    </div>
 
    <?php 
    if($url){
        $rss = new DOMDocument();
        $rss->load($url);
        $list = array();
            
        foreach ($rss->getElementsByTagName('item') as $node) {
        $item = array ( 
        'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
        'descript' => $node->getElementsByTagName('description')->item(0)->nodeValue,
        'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
        'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
        );

        array_push($list, $item);
        }

        for($i=0; $i < sizeof($list); $i++){
            $title = $list[$i]['title'];
            $link = $list[$i]['link'];
            $description = $list[$i]['descript'];
           // $date = date('l F d, Y', strtotime($list[$i]['date']));
            echo '<div class="rss_element"><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong><br />';
            echo '<small><em>Posted on '.$list[$i]['date'].'</em></small></br>';
            echo $list[$i]['descript'].'</div>';
        }

    }
?>
</body>

</html>