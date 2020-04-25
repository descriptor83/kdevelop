<?php include 'aside.html.php' ?>
<article>
<?php if(isset($girls) and count($girls) > 0) : ?>
    <header>
        <h3>Current Girls</h3>
    </header>    
    <?php foreach($girls as $girl) : ?>
       <div class="girl">
           <section class="photo">
            <a title="Full size" target="_blank" href="detail?img=<?=$girl['img'] ?>">
            <img width="120" height="180" src="img/thumb_<?= $girl['img'] ?>" alt="<?= $girl['img'] ?>">
            </a>   
        </section>
            <section class="resume">
                <h4><?= $girl['name'] ?></h4>
                <p>Age : <?= $girl['age'] ?></p>
                <p>Origin : <?= $girl['country'] ?></p>
                <p>Price : <?= $girl['price'] ?>&nbsp;$</p>
                <p><a class="btn btn-default" href="/editgirl?id=<?= $girl['id'] ?>">Edit</a></p>
            </section>
       </div>
    <?php endforeach; ?>

<?php endif; ?>

</article>
<?php include 'footer.html.php' ?>