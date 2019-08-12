<?php

namespace backend\widgets\grid;

use Yii;
use blog\access\Rbac;
use yii\grid\DataColumn;
use yii\helpers\Html;
use yii\rbac\Item;
use yii\rbac\Role;

class RoleColumn extends DataColumn
{
    protected function renderDataCellContent($model, $key, $index): string
    {
        $roles = Yii::$app->authManager->getRolesByUser($model->id);
        return $roles === [] ? $this->grid->emptyCell : implode(', ', array_map(function (Item $role) {
            return $this->getRoleLabel($role);
        }, $roles));
    }

    private function getRoleLabel(Item $role): string
    {
        switch ($role->name) {
            case Rbac::ROLE_USER:
                $class = 'primary';
                break;

            case Rbac::ROLE_MANAGER:
                $class = 'success';
                break;

            case Rbac::ROLE_MODERATOR:
                $class = 'success';
                break;

            case Rbac::ROLE_CONTENT_MANAGER:
                $class = 'warning';
                break;

            case Rbac::ROLE_ADMIN:
                $class = 'danger';
                break;
        }
        return Html::tag('span', Html::encode($role->description), ['class' => 'label label-' . $class]);
    }
}