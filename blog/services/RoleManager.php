<?php

namespace blog\services;

use yii\rbac\ManagerInterface;
use DomainException;

class RoleManager
{
    private $manager;

    public function __construct(ManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function assign($userId, $name): void
    {
        if (!$role = $this->manager->getRole($name)) {
            throw new DomainException('Роль "' . $name . '" не существует');
        }
        $this->manager->revokeAll($userId);
        $this->manager->assign($role, $userId);
    }
}