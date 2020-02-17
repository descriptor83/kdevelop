<header>
    <h1>Welcome to admin page</h1>
</header>
<br>
<div class="content">
    <nav class="category">
        
        <ul class="treeline">
            <li> Категории
                <ul>
                    <li>Girls
                        
                        <ul>
                            <li><a href="/admingirls">List</a></li>
                            <li><a href="/addgirl">Add</a></li>
                        </ul>    
                    </li>
                 <li>Posts
                     <ul>
                         <li><a href="/adminposts">List</a></li>
                         <li><a href="/addpost">Add</a></li>
                     </ul>
                 </li>
                 <li>Users
                     <ul>
                         <li><a href="/adminusers">List</a></li>
                         <li><a href="/adduser">Add</a></li>
                     </ul>
                 </li>
                 <li>Orders
                     <ul>
                         <li><a href="/adminorders">List</a></li>
                         <li><a href="/addorder">Add</a></li>
                     </ul>
                 </li>
               </ul>
            </li>
        </ul>  
    </nav>
</div>
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
</article>
<div style="clear: both"></div>
<footer>
    <p><?php if(isset($pagination)) echo $pagination ?></p>
</footer>