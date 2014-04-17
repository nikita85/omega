<?php

/**
 * Expand role for class
 *
 * @author Vladislav Kovtunov <kovtunovvladislav@gmail.com>
 */
class WebUser extends CWebUser
{
    /**
     * Set current user instance
     * @var object User instance
     */
    private $model = null;
    
    /**
     * Get current user role
     * @return string user role
     */
    public function getRole()
    {
        $user = $this->getModel();

        if (!empty($user)) {
            return $user->role;
        }
    }
    
    /**
     * Extract current user instance from database
     * @return object User instance
     */
    public function getModel()
    {
        if (!$this->isGuest && empty($this->model)) {
            $this->model = User::model()->findByPk($this->id);
        }

        return $this->model;
    }

    /**
     * Check user access to request page
     */
    public function isAccess()
    {
        return $this->checkAccess(Yii::app()->controller->route);
    }

    /**
     * @return bool
     */
    public function isSuperAdmin()
    {
        return (UserRoleEnum::SUPER_ADMIN == $this->role);
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return (UserRoleEnum::ADMIN == $this->role);
    }

    /**
     * @return bool
     */
    public function isAnyAdmin()
    {
        return in_array($this->role, [UserRoleEnum::SUPER_ADMIN, UserRoleEnum::ADMIN, UserRoleEnum::USER_MANAGER, UserRoleEnum::PAYMENT_MANAGER]);
    }

    /**
     * @return bool
     */
    public function isTeacher()
    {
        return (UserRoleEnum::TEACHER == $this->role);
    }

    /**
     * @return bool
     */
    public function isStudent()
    {
        return (UserRoleEnum::STUDENT == $this->role);
    }

    /**
     * @return bool
     */
    public function isParent()
    {
        return (UserRoleEnum::PARENT == $this->role);
    }

    /**
     * @return bool
     */
    public function isGuest()
    {
        return $this->getIsGuest();
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->getModel()->first_name;
    }

    public function getFullName()
    {
        return $this->getModel()->getFullName();
    }

    public function getUser()
    {
        return $this->getModel();
    }


}