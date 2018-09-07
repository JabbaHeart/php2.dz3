<html>
<body>
<h1>Новости</h1>

<?php
    foreach ($news as $article) : ?>
<h2><a href="<?php echo $article->getLink(); ?>"><?php echo $article->getHeader(); ?> </a></h2>
        <h3>Автор:
            <?php $author = $article->author;
            if ($author !== null) {
                echo $author->getFullname();
            } else {
                echo 'не указан';
            }?>
        </h3>
        <hr>
<?php endforeach; ?>

</body>
</html>
