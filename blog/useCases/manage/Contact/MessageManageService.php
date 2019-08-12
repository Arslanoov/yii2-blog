<?php

namespace blog\useCases\manage\Contact;

use blog\repositories\Contact\MessageRepository;

class MessageManageService
{
    private $messages;

    public function __construct(MessageRepository $messages)
    {
        $this->messages = $messages;
    }

    public function remove($id): void
    {
        $message = $this->messages->get($id);
        $this->messages->delete($message);
    }
}