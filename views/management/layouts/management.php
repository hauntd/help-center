<?php

use yii\widgets\Menu;
use app\widgets\Alert;
use app\controllers\management\DashboardController;
use app\controllers\management\UserController;
use app\controllers\management\CategoryController;
use app\models\User;
use rmrevin\yii\fontawesome\FA;

/** @var string $content */
/** @var \yii\web\View $this */

?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>

<div class="container container-management">
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-3">
            <div class="sidebar-block">
                <nav class="sidebar-nav">
                    <?= Menu::widget([
                        'options' => [
                            'class' => 'nav',
                        ],
                        'items' => [
                            [
                                'label' => FA::icon('dashboard', ['tag' => 'i']) . Yii::t('app', 'Dashboard'),
                                'url' => ['/management/dashboard/index'],
                                'encode' => false,
                                'active' => get_class($this->context) == DashboardController::class,
                            ],
                            [
                                'label' => FA::icon('user', ['tag' => 'i']) . Yii::t('app', 'Users'),
                                'url' => ['/management/user/index'],
                                'encode' => false,
                                'visible' => Yii::$app->user->can(User::ROLE_ADMINISTRATOR),
                                'active' => get_class($this->context) == UserController::class,
                            ],
                            [
                                'label' => FA::icon('list', ['tag' => 'i']) . Yii::t('app', 'Categories'),
                                'url' => ['/management/category/index'],
                                'encode' => false,
                                'visible' => Yii::$app->user->can(User::ROLE_EDITOR),
                                'active' => get_class($this->context) == CategoryController::class,
                            ],
                        ],
                    ]) ?>
                </nav>
            </div>
        </div>
        <div class="col-xs-12 col-sm-8 col-md-9">
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
</div>

<?php $this->endContent(); ?>
