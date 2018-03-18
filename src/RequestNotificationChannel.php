<?php

namespace F2M2\RequestNotification;

use Illuminate\Notifications\Notification;
use F2M2\RequestNotification\Exceptions\SendNotificationFaild;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;

class RequestNotificationChannel
{
    /** @var Client */
    protected $client;

    /**
     * @param Client $client
    */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \F2M2\RequestNotificationChannel\Exceptions\CouldNotSendNotification
    */
    public function send($notifiable, Notification $notification)
    {
        if (! $url = $notifiable->routeNotificationFor('RequestNotification')) {
            return;
        }

        $requestData = $notification->toRequestNotification($notifiable)->toArray();

        $response = $this->client->post($url, [
            'form_params' => Arr::get($requestData, 'data'),
            'verify' => false,
            'headers' => Arr::get($requestData, 'headers'),
        ]);

        if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
            throw SendNotificationFaild::serviceRespondedWithAnError($response);
        }
    }
}
