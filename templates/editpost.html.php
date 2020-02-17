<?php if(isset($post)) : ?>
<header>
    <h3>Current post ID : <?= $post['id'] ?></h3>
</header>
<?php else : ?>
    <header>
        <h3>Add new Variable</h3>
    </header>
    <?php $date = new DateTime(); $now = $date->format('Y-m-d'); ?>
<?php endif; ?>    
<br><br>
<?php if(isset($error)) : ?>
    <span style="color: red" ><?= $error ?></span>
<?php endif; ?>
 
<form class="form-horizontal" action="<?= isset($post) ? "/editpost?id=".$post['id'] : 'addpost'?>" method="post" >
    <fieldset>
    
    <div class="form-group">
        <label for="title" class="col-sm-2 control-label" >Post title</label>
        <input name="title" value="<?= isset($post) ? $post['title'] : '' ?>" >
    </div>
    <div class="form-group">
        <label for="created" class="col-sm-2 control-label" >Created</label>
        <input type="date" name="created" value="<?= isset($post) ? $post['created'] : $now  ?>" >
    </div>
    <div class="form-group">
        <label for="body" class="col-sm-2 control-label" >Description</label>
        <textarea  name="body" rows="3" cols="40">
            <?= isset($post) ? $post['body'] : '' ?>
        </textarea>
    </div>
    <div class="form-group">
        <button name="submit" type="submit" class="btn btn-default" >Save</button>
    </div>
    <input type="hidden" name="id" value="<?= isset($post) ? $post['id'] : '' ?>" >
    </fieldset>
</form>
<a class="btn btn-link" href="/adminposts" >Back</a>
<button <?= isset($post) ? '' : 'disabled' ?>  data-href="/deletepost?id=<?= $post['id'] ?>" class="btn btn-danger"
     onclick="confirmDelete()">Delete</button>
