<?php include 'aside.html.php' ?>
  <header>
    <h3>Current Conutries</h3>
  </header>
  <br><br>
  <div class="adminTable" >
  <table>
      <thead>
          <tr>
              <th>Code</th><th>Name</th><th></th><th></th>
          </tr>
      </thead>
      <tbody>  
  <?php foreach ($countries as $country) : ?>
      <tr>
        <td>
            <?= $country['id'] ?>
        </td>
        <td>
            <?= $country['name'] ?>
        </td>
        <td><a class="btn btn-link" href="/editcountry?id=<?= $country['id'] ?>">Edit</a>
       </td>
       <td><a class="btn btn-link" href="/deletecountry?id=<?= $country['id'] ?>">Delete</a>
       </td>
      </tr> 
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
        <form action="/addcountry" method="post">
       
        <fieldset>
            <legend> + New Country</legend> 
            <div class="form-group">
                <label class="control-label" for="name">Name : </label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label class="control-label" for="code">Code : </label>
                <input type="text" name="id" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-fefault" value="Save">
            </div>
        </fieldset>
       </form>
  </div>
<?php include 'footer.html.php'  ?>