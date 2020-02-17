<?php if(isset($girl)) : ?>
  <header>
      <h1>Girl ID : <?= $girl['id'] ?></h1>
  </header>
<?php else : ?>
  <header>
    <h1>Add new girl</h1>
  </header>  
<?php endif; ?>
<?php if(isset($error)) : ?>
  <span style="color: red"><?= $error ?></span>
<?php endif; ?>  
<div style="width:30%; float: left">    
    <img src="<?= isset($girl) ? 'img/'.$girl['img'] : 'img/noimage.png' ?>"
     alt="Photo" width="300" height="450">
</div>
<div style="width: 70%; float:left">
<form enctype="multipart/form-data" class="form-horizontal"
 action="<?= isset($girl) ? "/editgirl?id=".$girl['id'] : "/addgirl" ?>" method="POST">
<div class="form-group">
    <label for="name" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="name"
        value="<?= isset($girl) ? $girl['name'] : '' ?>" >
    </div>
  </div>  
<div class="form-group">
    <label for="age" class="col-sm-2 control-label">Age</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" name="age"
        value="<?= isset($girl) ? $girl['age'] : '' ?>" >
    </div>
  </div>
  <div class="form-group">
    <label for="country" class="col-sm-2 control-label">Country</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="country"
       value="<?= isset($girl) ? $girl['country'] : '' ?>" >
    </div>
  </div>
  <div class="form-group">
    <label for="price" class="col-sm-2 control-label">Price</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="price"
       value="<?= isset($girl) ? $girl['price'] : '' ?>" >
    </div>
  </div>
  <div class="form-group">
    <label for="image" class="col-sm-2 control-label">Photo</label>
    <div class="col-sm-10">
      <input onchange="photoChange()" type="file" class="form-control" name="image" >
    </div>
  </div>
  <div class="form-group">
      
      <div class="col-sm-10">
      <label for="category">Type</label>
      <?php if(isset($girl)) : ?>
      <select name="category">
          <option <?= $girl['category'] == 1 ? 'selected' : '' ?> value="1">Блондинка</option>
          <option <?= $girl['category'] == 2 ? 'selected' : '' ?> value="2">Брюнетка</option>
          <option <?= $girl['category'] == 3 ? 'selected' : '' ?> value="3">Шатенка</option>
          <option <?= $girl['category'] == 4 ? 'selected' : '' ?> value="4">Рыжая</option>
      </select>
      <?php else : ?>
        <select name="category">
          <option value="1">Блондинка</option>
          <option value="2">Брюнетка</option>
          <option value="3">Шатенка</option>
          <option value="4">Рыжая</option>
      </select>
      <?php endif; ?>
      </div>
  </div>
  <input type="hidden"  name="id" value="<?= isset($girl) ? $girl['id'] : '' ?>" >
  <input type="hidden"  name="img" value="<?= isset($girl) ? $girl['img'] : '' ?>" >
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="submit" class="btn btn-default">Save</button>
     
    </div>
  </div>
</form>
  
<a class="btn btn-link" href="/admingirls">Back</a>
<?php if(isset($girl)) : ?>
      <button class="btn btn-danger" 
      data-href="/deletegirl?id=<?= $girl['id'] ?>" onclick="confirmDelete()" >Delete</button>
<?php endif; ?>
</div>
<br>
