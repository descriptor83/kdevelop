<h3>Add a new post here</h3>
<?php if(isset($form_error)) : ?>
	<span style="color: red" ><?= $form_error ?></span>
<?php endif; ?>
 
<form class="form-horizontal" action="/add" method="post" >
	<fieldset>
	
	<div class="form-group">
		<label for="title" class="col-sm-2 control-label" >Post title</label>
		<input name="title" placeholder="Title" >
	</div>
	<div class="form-group">
		<label for="body" class="col-sm-2 control-label" >Description</label>
		<textarea  name="body" rows="3" cols="40"></textarea>
	</div>
	<div class="form-group">
		<button name="submit" type="submit" class="btn btn-default" >Save</button>
	</div>
	</fieldset>
</form>
