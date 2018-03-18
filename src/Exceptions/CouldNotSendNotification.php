<?php

namespace F2m2\RequestNotification\Exceptions;

class SendNotificationFaild extends \Exception
{
    public static function serviceRespondedWithAnError($response)
    {
        return new static('RequestNotification responded with an error: `'.$response->getBody()->getContents().'`');
    }
}
