# Laravel Notification Channel
### Used to send an application/x-www-form-urlencoded POST requests.

## Installation

You can install the package via composer:

``` bash
composer require f2m2/request-notifcation-channel
```

## Usage


``` php
use F2M2\RequestNotification\RequestNotificationChannel;
use F2M2\RequestNotification\RequestNotificationMessage;
use Illuminate\Notifications\Notification;

class MyNotification extends Notification
{
    public function via($notifiable)
    {
        return [RequestNotificationChannel::class];
    }

    public function toRequestNotification($notifiable)
    {
        return RequestNotificationChannel::create()
            ->data([
               'data' => [
                   'property' => 'value'
               ]
            ])
            ->userAgent("Custom-User-Agent")
            ->header('X-Custom', 'Custom-Header');
    }
}
```

Add the `routeNotificationForRequestNotification` method to your Notifiable Model, which should return the URL where the notification will call the request.

```php
public function routeNotificationForWebhook()
{
    return 'http://httpbin.org/post';
}
```
