<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => 'Справочники', 'header' => true],
                    [
                        'label' => 'Языки',
                        'icon' => 'tachometer-alt',
//                        'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'Список языков', 'url' => ['site/index'], 'iconStyle' => 'far'],
                            ['label' => 'Добавить язык', 'iconStyle' => 'far'],
                        ]
                    ],
                    [
                        'label' => 'Страны',
                        'icon' => 'tachometer-alt',
//                        'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'Список стран', 'url' => ['site/index'], 'iconStyle' => 'far'],
                            ['label' => 'Добавить страну', 'iconStyle' => 'far'],
                        ]
                    ],
                    [
                        'label' => 'Языки',
                        'icon' => 'tachometer-alt',
//                        'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'Список языков', 'url' => ['site/index'], 'iconStyle' => 'far'],
                            ['label' => 'Добавить язык', 'iconStyle' => 'far'],
                        ]
                    ],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>