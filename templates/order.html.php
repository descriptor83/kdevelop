<header>
    <h1>Here <?= ucfirst($user['name']) ?> you order details</h1>
</header>
<br><br><br>
<div style="width: 40%; padding-left: 40px; float:left">
    <table style="width:90%">
        <thead>
            <tr>
                <th>Order #</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $order->id ?></td>
                <td><?= $order->date ?></td>
                <td><?= $order->done == '1' ? 'bought' : 'pending' ?></td>
            </tr>
        </tbody>
    </table>
</div>
    <div style="width: 60%; float: left">
        
        <table style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Country</th>
                    <th>Photo</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $product) : ?>
                    <tr>
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['age'] ?></td>
                        <td><?= $product['country'] ?></td>
                        <td><img width="120" height="180" 
                        src="img/<?= $product['img'] ?>" alt="<?= $product['img'] ?>"></td>
                        <td><?= $product['price'] ?></td>
                    </tr>
                <?php endforeach; ?>    
            </tbody>
        </table>
    </div>
    <div style="clear: both">
           <span style="font-size: 28px">Total : <?= $order->total ?></span>         
    </div>        
