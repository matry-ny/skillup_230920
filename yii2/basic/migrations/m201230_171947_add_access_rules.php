<?php

use yii\db\Migration;

/**
 * Class m201230_171947_add_access_rules
 */
class m201230_171947_add_access_rules extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $authManager = Yii::$app->authManager;

        $guest = $authManager->createRole('guest');
        $manager = $authManager->createRole('manager');
        $admin = $authManager->createRole('admin');

        $login = $authManager->createPermission('login');
        $logout = $authManager->createPermission('logout');
        $view = $authManager->createPermission('view');
        $create = $authManager->createPermission('create');
        $update = $authManager->createPermission('update');
        $delete = $authManager->createPermission('delete');

        $authManager->add($login);
        $authManager->add($logout);
        $authManager->add($view);
        $authManager->add($create);
        $authManager->add($update);
        $authManager->add($delete);

        $authManager->add($guest);
        $authManager->add($manager);
        $authManager->add($admin);

        $authManager->addChild($guest, $login);
        $authManager->addChild($guest, $view);
        $authManager->addChild($guest, $logout);

        $authManager->addChild($manager, $guest);
        $authManager->addChild($manager, $create);
        $authManager->addChild($manager, $update);

        $authManager->addChild($admin, $manager);
        $authManager->addChild($admin, $delete);

//        $role = Yii::$app->authManager->createRole('guest');
//        Yii::$app->authManager->assign($role, 2);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $authManager = Yii::$app->authManager;

        $login = $authManager->createPermission('login');
        $logout = $authManager->createPermission('logout');
        $view = $authManager->createPermission('view');
        $update = $authManager->createPermission('update');
        $delete = $authManager->createPermission('delete');

        $authManager->remove($login);
        $authManager->remove($logout);
        $authManager->remove($view);
        $authManager->remove($update);
        $authManager->remove($delete);

        $guest = $authManager->createRole('guest');
        $manager = $authManager->createRole('manager');
        $admin = $authManager->createRole('admin');

        $authManager->remove($guest);
        $authManager->remove($manager);
        $authManager->remove($admin);
    }
}
