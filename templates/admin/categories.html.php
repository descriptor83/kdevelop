<?php include 'aside.html.php' ?>

  <header>
    <h3>Current Categories</h3>
  </header><br><br>
  <div class="adminTable">
  <table>
  <thead>
        <tr><td>ID</td><td>Name</td><td></td><td></td></tr>
      </thead>  
  <?php foreach ($categories as $category) : ?>
      
      <tbody>
      <td><?= $category['id'] ?></td>
      <td><?= $category['name'] ?></td>
        <td>
            <a class="btn btn-link" href="/editcategory?id=<?= $category['id'] ?>">Edit</a>
        </td>
        <td>
            <a class="btn btn-link" href="/deletecategory?id=<?= $category['id'] ?>">Delete</a>
        </td>  
    
  <?php endforeach; ?>
    </tbody>
    </table>
  </div>
    <div class="adminForm" >
     <?php session_start(); ?> 
     
     <?php  if(isset($_SESSION['error'])) : ?>
        <span style="color: red" ><?= $_SESSION['error'] ?></span>
        <?php unset($_SESSION['error']); ?>
     <?php endif; ?>
        <form action="/addcategory" method="post">
       
        <fieldset>
            <legend> + New Category</legend> 
            <div class="form-group">
                <label class="control-label" for="name">Category name : </label>
                <input type="text" name="name" class="form-control">
            </div>
            
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-fefault" value="Save">
            </div>
        </fieldset>
       </form>
  </div>
<?php include 'footer.html.php'  ?>