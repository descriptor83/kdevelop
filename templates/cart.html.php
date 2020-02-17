<header>
    <h1>Cart Index</h1>
</header><br><br>
<article>
    <?php if(count($cart) > 0) : ?>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Origin</th>
                    <th>Picture</th>
                    <th>Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        <?php foreach($cart as $girl) : ?>
            <tr>
                <td><?= $girl['name'] ?></td>
                <td><?= $girl['age'] ?></td>
                <td><?= $girl['country'] ?></td>
                <td><img width="60" height="90" src="img/<?= $girl['img']?>" alt="<?= $girl['img'] ?>"></td>
                <td><?= $girl['price'] ?>$</td>
                <td><a class="btn btn-default" 
                href="/delete?id=<?= $girl['id']?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
            </tbody>
        </table>
        <div>
            <p style="font-size: 18px">Total : <?= $total ?>$</p>
        </div>
        <br>
        <a class="btn btn-default"  href="/clear">Clear Cart</a>
    <?php else :?>
        <p>No girl selected</p>
    <?php endif; ?>
    <br><br>
    <a class="btn btn-link" href="/girls">Back to Gallery</a>&nbsp;
    <a <?= count($cart) == 0 ? 'disabled' : ''  ?> href="/order" class="btn btn-primary">Order</a>        
</article>