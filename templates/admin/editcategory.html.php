<?php include 'aside.html.php' ?>
<header>
    <h3>Current category ID : <?= $category['id'] ?></h3>
</header>
 
<form   method="post" >
    <fieldset>
    
    <div class="form-group">
        <label for="title" class="control-label" >Category</label>
        <input class="form-control" name="name" value="<?= $category['name'] ?>" >
    </div>
    
    <div class="form-group">
        <button name="submit" type="submit" class="btn btn-default" >Save</button>
    </div>
    <input type="hidden" name="id" value="<?= $category['id'] ?>" >
    </fieldset>
</form>
<a class="btn btn-link" href="/admincategories" >Back</a>
<button   data-href="/deletecategory?id=<?= $category['id'] ?>" class="btn btn-danger"
     onclick="confirmDelete()">Delete</button>
     <?php include 'footer.html.php' ?>     
