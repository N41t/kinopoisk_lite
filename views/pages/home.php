<?php
// подсказка для php с помощью php docs (чтобы не было ошибок и php корректно определял какого типа переменная $view)
/**
 * @var \App\Kernel\View\View $view
 */
?>

<?php $view->component('start') ?>
<h1>Home page</h1>
<?php $view->component('end') ?>