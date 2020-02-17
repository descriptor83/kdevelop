<?php if(isset($page)) : ?>
<h1>Page <?= $page ?> not found</h1>
<?php endif; ?>

<?php if(isset($access)) : ?>
<h1>Access denied for this page</h1>
<?php endif; ?>