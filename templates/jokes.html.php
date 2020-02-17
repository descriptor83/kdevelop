<aside>
  <form action="/find" method="post">
    <input type="text" name="find">
    <input type="submit" value="Find">
 </form>
 <?php if(isset($find)) : ?>
    <h4>Результаты по запросу &quot;<?= $find ?>&quot;</h4>
 <?php endif; ?> 
</aside>
<?php if(isset($rows) and count($rows) > 0) : ?>
  <header>
    <h2>Current $_SERVER PHP variables</h2>
  </header>  
  <?php foreach ($rows as $row) : ?>
    <h3><?= $row['title'] ?></h3>
    <p><em>Created at  <?= $row['created'] ?></em></p>

      <p>
        <?=$row['body'] ?>
      </p>

  <?php endforeach; ?>
<?php else : ?>
  <p>No rows selected</p>
<?php endif; ?>
<p><?php if(isset($pagination)) echo $pagination ?></p>
