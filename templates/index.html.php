<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>elComité</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab" rel="stylesheet">
    <link rel="stylesheet" href="/assets/dist/core.css">
    <link rel="stylesheet" href="/assets/dist/comp.css">
</head>
<body>
<div id="app">


</div>

<script type="text/javascript">
    var last_event = <?php echo $last_event->toJson(); ?>;
    var last_articles = [];

    <?php foreach ($medium_posts as $post){ ?>
        last_articles.push(<?php echo $post->toJson() ?>);
    <?php } ?>


    var sponsors = <?php echo json_encode($sponsors) ?>;

    var hero_images = <?php echo json_encode($hero_images) ?>;

</script>

<script type="text/javascript"
        src="/assets/dist/bundle.js"></script>
</body>
</html>