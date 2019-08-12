<?php

namespace blog\repositories\Contact;

use blog\entities\Contact\Message;
use DomainException;

class MessageRepository
{
    public function get($id): ?Message
    {
        return Message::findOne($id);
    }

    public function save(Message $message): void
    {
        if (!$message->save()) {
            throw new DomainException('Не удалось отправить сообщение');
        }
    }

    public function delete(Message $message): void
    {
        if (!$message->delete()) {
            throw new DomainException('Не удалось удалить сообщение');
        }
    }
}