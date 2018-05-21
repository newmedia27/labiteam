<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [

                    ['label' => 'Blog', 'icon' => 'file-code-o', 'url' => ['/blog']],]]

        ) ?>

    </section>

</aside>
