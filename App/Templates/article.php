<html>
<body>
<h1>Новости</h1>

<h2> <?php echo $article->getHeader(); ?> </h2>
<article> <?php echo $article->getMessage(); ?> </a></article>
<hr>
<footer><?php
    if ($article->author !== null) {
    echo $article->author->getFullname();
    } else {
        echo 'Автор не указан';
    }
    ?></footer>

</body>
</html>
