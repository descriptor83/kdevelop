<?php include 'aside.html.php' ?>
<?php if(isset($posts) and count($posts) > 0) : ?>
  <header>
    <h3>Current $_SERVER PHP variables</h3>
  </header>
  <br><br>
  <table>  
  <?php $n=0; foreach ($posts as $post) : ?>
      <?php if($n==0) echo '<tr>'; $n++ ?>
    <td><a class="btn btn-link" href="/editpost?id=<?= $post['id'] ?>">
        <?= $post['title'] ?></a></td>
      <?php if($n==4) { $n=0; echo '</tr>'; } ?>  
    
  <?php endforeach; ?>
    </table>
<?php endif; ?>
<?php include 'footer.html.php'  ?>