<?php include 'aside.html.php' ?>

  <header>
    <h1>Add new girl</h1>
  </header>
<?php if(isset($error)) : ?>
  <span style="color: red"><?= $error ?></span>
<?php endif; ?>
<article>
<div style="width:30%; float: left">
    <img src="img/noimage.png"  alt="Photo" width="300" height="450">
</div>
<div style="width:65%; float: right">
<form enctype="multipart/form-data" class="form-horizontal" action="/addgirl" method="POST">
<div class="form-group">
    <label for="name" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="name" value="" >
    </div>
  </div>
<div class="form-group">
    <label for="age" class="col-sm-2 control-label">Age</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" name="age" value="" >
    </div>
  </div>
  <div class="form-group">
    <label for="country" class="col-sm-2 control-label">Country</label>
    <div class="col-sm-10">
    <select name="country">

        <?php  foreach($countries as $country) :?>
          <option  value="<?= $country['id'] ?>"><?= $country['name'] ?></option>
        <?php endforeach; ?>

      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="price" class="col-sm-2 control-label">Price</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="price" value="" >
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

        <select name="category">
          <?php foreach($categories as $category) : ?>
          <option value="<?= $category['id']?>"><?= $category['name'] ?></option>
          <?php endforeach; ?>
        </select>

      </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="submit" class="btn btn-default">Save</button>

    </div>
  </div>
</form>

<a class="btn btn-link" href="/admingirls">Back</a>

</div>
</article>
<?php include 'footer.html.php' ?>
