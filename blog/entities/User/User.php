<?php

namespace blog\entities\User;

use blog\entities\AggregateRoot;
use blog\entities\Blog\Post\Comment;
use blog\entities\Blog\Post\Post;
use blog\entities\EventTrait;
use blog\entities\User\events\UserSignUpConfirmed;
use blog\entities\User\events\UserSignUpRequested;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use DomainException;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

class User extends ActiveRecord implements AggregateRoot
{
    use EventTrait;

    const STATUS_WAIT = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_BANNED = 2;

    public static function tableName(): string
    {
        return '{{%users}}';
    }

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'photo',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/users/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/users/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/users/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/users/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'thumb' => ['width' => 300, 'height' => 300],
                    'single_post' => ['width' => 169, 'height' => 177],
                    'single_comment' => ['width' => 115, 'height' => 112],
                    'view' => ['width' => 100, 'height' => 100],
                ],
            ],
        ];
    }

    public function rules(): array
    {
        return [
            ['status', 'default', 'value' => self::STATUS_WAIT],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_WAIT, self::STATUS_BANNED]],
        ];
    }

    public static function create(string $username, string $email, string $password, string $aboutMe = null): self
    {
        $user = new User();
        $user->created_at = time();
        $user->updated_at = time();
        $user->username = $username;
        $user->email = $email;
        $user->about_me = $aboutMe;
        $user->status = self::STATUS_ACTIVE;
        $user->setPassword($password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user;
    }

    public static function requestSignup(string $username, string $email, string $password, string $aboutMe = null): self
    {
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->about_me = $aboutMe;
        $user->setPassword($password);
        $user->created_at = time();
        $user->updated_at = time();
        $user->status = self::STATUS_WAIT;
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->recordEvent(new UserSignUpRequested($user));
        return $user;
    }

    public function edit(string $username, string $aboutMe = null): void
    {
        $this->updated_at = time();
        $this->username = $username;
        $this->about_me = $aboutMe;
    }

    public static function signupByNetwork($network, $identity): self
    {
        $user = new User();
        $user->created_at = time();
        $user->status = self::STATUS_ACTIVE;
        $user->generateAuthKey();
        $user->networks = [Network::create($network, $identity)];
        return $user;
    }

    public function attachNetwork($network, $identity): void
    {
        $networks = $this->networks;
        foreach ($networks as $current) {
            if ($current->isFor($network, $identity)) {
                throw new DomainException('Соц-сеть уже привязана');
            }
        }
        $networks[] = Network::create($network, $identity);
        $this->networks = $networks;
    }

    public function confirmSignup(): void
    {
        if ($this->isActive()) {
            throw new DomainException('Пользователь уже активирован');
        }
        $this->status = self::STATUS_ACTIVE;
        $this->verification_token = null;
        $this->recordEvent(new UserSignUpConfirmed($this));
    }

    public function ban(): void
    {
        if ($this->isBanned()) {
            throw new DomainException('Пользователь уже забанен');
        }

        $this->status = self::STATUS_BANNED;
    }

    public function unban(): void
    {
        if (!$this->isBanned()) {
            throw new DomainException('Пользователь уже не в бане');
        }
        $this->status = self::STATUS_ACTIVE;
    }

    public function activate(): void
    {
        if ($this->isActive()) {
            throw new DomainException('Пользователь уже активирован');
        }
        if ($this->isBanned()) {
            throw new DomainException('Пользователь забанен');
        }
        $this->status = self::STATUS_ACTIVE;
        $this->verification_token = null;
    }

    public function draft(): void
    {
        if ($this->isWait()) {
            throw new DomainException('Пользователь уже не активирован');
        }
        if ($this->isBanned()) {
            throw new DomainException('Пользователь забанен');
        }
        $this->status = self::STATUS_WAIT;
    }

    public function requestPasswordReset(): void
    {
        if (!empty($this->password_reset_token) && self::isPasswordResetTokenValid($this->password_reset_token)) {
            throw new DomainException('Запрос на восстановление пароля уже был отдан.');
        }
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public static function findByPasswordResetToken($token): ?User
    {
        return self::findOne([
            'password_reset_token' => $token,
            'status' => User::STATUS_ACTIVE,
        ]);
    }

    public static function isPasswordResetTokenValid($token)
    {
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public function resetPassword($password): void
    {
        $this->setPassword($password);
    }

    public function isActive(): bool
    {
        return $this->status == self::STATUS_ACTIVE;
    }

    public function isWait(): bool
    {
        return $this->status == self::STATUS_WAIT;
    }

    public function isBanned(): bool
    {
        return $this->status == self::STATUS_BANNED;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getPosts(): ActiveQuery
    {
        return $this->hasMany(Post::class, ['author_id' => 'id']);
    }

    public function getNetworks(): ActiveQuery
    {
        return $this->hasMany(Network::class, ['user_id' => 'id']);
    }

    public function getComments(): ActiveQuery
    {
        return $this->hasMany(Comment::class, ['user_id' => 'id']);
    }

    public function editProfile(string $username, string $email, string $aboutMe): void
    {
        $this->username = $username;
        $this->email = $email;
        $this->about_me = $aboutMe;
        $this->updated_at = time();
    }

    public function setPhoto(UploadedFile $photo): void
    {
        $this->photo = $photo;
    }

    public function deletePhoto(): void
    {
        unset($this->photo);
    }
}
