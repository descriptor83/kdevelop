<p>
      Переменная $_SERVER - это массив, содержащий информацию, такую как
  заголовки, пути и местоположения скриптов. Записи в этом массиве
  создаются веб-сервером. Нет гарантии, что каждый веб-сервер предоставит
  любую из них; сервер может опустить некоторые из них или предоставить
  другие, не указанные здесь. Тем не менее, многие эти переменные
  присутствуют в » спецификации CGI/1.1

  http://www.faqs.org/rfcs/rfc3875, так что вы можете их ожидать их
  реализации и в конкретном веб-сервере.</p>
  <p>
      Переменная $HTTP_SERVER_VARS содержит ту же начальную информацию, но она
  не суперглобальная
  https://php.ru/manual/language.variables.superglobals.html. (Заметьте,
  что $HTTP_SERVER_VARS и $_SERVER являются разными переменными, так что
  PHP обрабатывает их соответственно). Также учтите, что "длинные массивы"
  были удалены в версии PHP 5.4.0, поэтому $HTTP_SERVER_VARS больше не
  существует.
</p>