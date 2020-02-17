<h2>Registration</h2>
<?php if(isset($errors)) : ?>
    <span style="color: red"><?= $errors ?></span>
<?php  endif;?>    
<form class="form-horizontal" action="/register" method="POST">
<div class="form-group">
    <label for="name" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="name"
       placeholder="Name" value="<?= isset($name) ? $name : '' ?>" >
    </div>
  </div>  
<div class="form-group">
    <label for="email" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="email"
       placeholder="Email" value="<?= isset($email) ? $email : '' ?>" >
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="password" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <label for="repeat" class="col-sm-2 control-label">Repeat Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="repeat" placeholder="Repeat Password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="submit" class="btn btn-default">Sign in</button>
    </div>
  </div>
</form>