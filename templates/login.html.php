<h2>Log in</h2>
<?php if(isset($errors)) : ?>
    <span style="color: red"><?= $errors ?></span>
<?php  endif;?>    
<form class="form-horizontal" action="/login" method="POST">
  
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
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="submit" class="btn btn-default">Log in</button>
    </div>
  </div>
</form>