<?php
// подсказка для php с помощью php docs (чтобы не было ошибок и php корректно определял какого типа переменная $view)
/**
 * @var \App\Kernel\View\View $view
 */
?>

<?php $view->component('start') ?>
<h1>Register</h1>

<form action="/register" method="post">
    <p>email</p>
    <input type="text" name="email">
    <p>password</p>
    <input type="password" name="password">
    <button>Register</button>
</form>
<?php $view->component('end') ?>