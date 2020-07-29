<header>
    <h2>Current girls</h2>
</header>

<div class="content">
    <nav class="category">
        <h4>Категории</h4>
        <ul>
            <li><a href="/girls">Все</a>
            <?php foreach($categories as $category) : ?>
                <li class="noadmin <?php if(isset($cat) and $cat == $category['id']) echo 'active' ?>" >
                <a href="<?= 'girls?cat='.$category['id'] ?>">
                <?= $category['name'] ?></a>
            <?php endforeach; ?>
        </ul>
    </nav>
    <article>
<?php if(count($girls) > 0) : ?>
    <?php foreach($girls as $girl) : ?>
       <div class="girl">
           <section class="photo">
            <a title="Full size" target="_blank" href="detail?img=<?=$girl['img'] ?>">
            <img src="img/thumb_<?= $girl['img'] ?>" alt="<?= $girl['img'] ?>">
            </a>
        </section>
            <section class="resume">
                <h4><?= $girl['name'] ?></h4>
                <p>Age : <?= $girl['age'] ?></p>
                <p>Origin : <?= $girl['country'] ?></p>
                <p>Type : <?= $girl['category'] ?></p>
                <p>Price : <?= $girl['price'] ?>&nbsp;$</p>
                <?php if(User::isLogged()) : ?>
                    <p><button data-id="<?= $girl['id'] ?>" class="btn btn-default" >Add to cart</button></p>
                <?php endif; ?>
            </section>
       </div>
    <?php endforeach; ?>
<?php else : ?>
<h3>No current girls</h3>
<?php endif; ?>
    </article>
</div>
<div style="clear: both"></div>
<footer>
    <p><?php if(isset($pagination)) echo $pagination ?></p>
</footer>
