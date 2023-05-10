<?php

namespace Message;

class Message
{
    public static function setMessage($message, $type)
    {
        $_SESSION['message'][] = (object)[
            'message' => $message,
            'type' => $type
        ];
        return;
    }
}
