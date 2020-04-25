
<?php if(isset($user)) : ?>
<header>
    <h2>Welcome <?= ucfirst($user['name']) ?> </h2>
</header>
<?php else :?>
    <header>
        <h2>User Orders</h2>
    </header>
<?php endif; ?>
<br><br>
<div class="content">
    <nav class="category">
        <a class="btn btn-link" href="/cabinet"> Опции</a>
        <ul class="treeline">
            <li> 
                <ul>
                    <li>Заказы
                        
                        <ul>
                            <li><a href="/cabinetall">Все</a></li>
                            <li><a href="/cabinetlast">Последний</a></li>
                        </ul>    
                    </li>
                 <li>Информация
                     <ul>
                         <li><a href="/editinfo">Изменить контактные данные</a></li>
                         <li><a href="/sendinfo">Отправить письмо в службу поддержки</a></li>
                     </ul>
                 </li>
                 
               </ul>
            </li>
        </ul>  
    </nav>
    <?php if(isset($user)) : ?>
    <article>
        <p style="font-size: 18px">Email : <?= $user['email'] ?></p>
        <p style="font-size: 18px">Registered at : <?= $user['registration'] ?></p>
    </article>
    <?php endif; ?>
    <?php if(isset($orders)) :?>
        <?php if(count($orders) > 0) : ?>
    <article>
        <table>
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Payed</th>
                    <th>Details</th>     
                </tr>
            </thead>
            <tbody>
                <?php foreach($orders as $order): ?>
                    <tr>
                        <td><?= $order['id'] ?></td>
                        <td><?= $order['date'] ?></td>
                        <td><?= $order['total'] ?>&nbsp;$</td>
                        <td><?= $order['done'] == '1' ? 'Yes' : 'No' ?></td>
                        <td><a href="/cabinetorder?id=<?= $order['id'] ?>" class="btn btn-link">See details</a></td>
                    </tr>
                <?php endforeach; ?>    
            </tbody>
        </table>
    </article>
    <?php else: ?>
        <p>No orders</p>
    <?php endif;?>
    <?php endif; ?>
    <?php if(isset($products) and count($products) > 0) : ?>
        <article>
           
        <?php foreach ($products as $girl) : ?>
        <div style="float: left; margin-left: 100px">     
         <p><strong>Name : </strong><?= $girl['name'] ?></p>
         <p><strong>Age : </strong><?= $girl['age'] ?></p>
         <p><strong>Country : </strong><?= $girl['country'] ?></p>
         <p><strong>Prcie : </strong><?= $girl['price'] ?>&nbsp;$</p>
        </div>
        <div style="float: left; margin-left: 50px"> 
         <img width="120" height="180" src="img/<?= $girl['img'] ?>" alt="<?= $girl['img'] ?>" > 
        </div> 
         <br style="clear: both"><hr>  
        <?php endforeach; ?>
        </article>    
    <?php endif; ?>
               
</div>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
    
