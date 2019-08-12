<?php

namespace blog\useCases\cabinet;

use blog\forms\User\ProfileEditDataForm;
use blog\forms\User\ProfileEditPhotoForm;
use blog\repositories\UserRepository;

class ProfileService
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function edit($id, ProfileEditDataForm $form): void
    {
        $user = $this->users->get($id);

        $user->editProfile(
            $form->username,
            $form->email,
            $form->aboutMe
        );

        $this->users->save($user);
    }

    public function editPhoto($id, ProfileEditPhotoForm $form): void
    {
        $user = $this->users->get($id);

        if ($form->photo) {
            $user->setPhoto($form->photo);
        }

        $this->users->save($user);
    }

    public function nullPhoto($id): void
    {
        $user = $this->users->get($id);
        $user->deletePhoto();
        $this->users->save($user);
    }
}