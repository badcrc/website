<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>elComité</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/dist/css/core.css">
</head>
<body>
<div id="app">


</div>

<script type="text/javascript">
    var last_event    = <?php echo $last_event ? $last_event->toJson() : 'null'; ?>;
    var last_articles = [];

    <?php foreach ($medium_posts as $post){ ?>
        last_articles.push(<?php echo $post->toJson() ?>);
    <?php } ?>


    var sponsors     = <?php echo json_encode($sponsors) ?>;

    var hero_images  = <?php echo json_encode($hero_images) ?>;

    var social_links = <?php echo json_encode($social_links) ?>

</script>

<script type="text/javascript"
        src="/assets/dist/js/bundle.js"></script>
</body>
</html>