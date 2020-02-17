<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" >
    <link rel="stylesheet" href="navlist.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
     integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
      crossorigin="anonymous">
    <script src="functions.js"></script>  
    <title>Virtual Girls</title>
  </head>
  <body>
    <header>
      <h1>PHP $_SERVER variables</h1>
    </header>
    <nav class="login">
      <ul>
        <?php if(User::isLogged()) : ?>
          <li><a href="<?= User::isAdmin() ? '/admin' : '/cabinet' ?>"><?= ucfirst(User::getUser('name')) ?></a></li>
          <?php if(!User::isAdmin()) : ?>
          <li><a href="/cart">Cart</a>&nbsp;<span><?= Cart::countCart() ?></span></li>
          <?php endif;?>
          <li><a href="/logout">Logout</a></li>
        <?php else : ?>  
          <li><a href="/login">Login</a> </li>
          <li><a href="/register">Registration</a></li>
        <?php endif; ?>  
          
      </ul>
    </nav>
    <br>
    <nav class="menu">
      <ul>
        <li><a href="/home">Home</a></li>
        <li><a href="/posts">Posts</a> </li>
        <li><a href="/girls">Girls</a> </li>
        <li><a href="/add">Add new post</a></li>
        
        
      </ul>
    </nav>
    <main>
    <?php if(isset($error)) : ?>
        <?= $error ?>
    <?php else : ?>
        <?= $output ?>
    <?php endif; ?>
  </main>
  
  </body>
</html>
