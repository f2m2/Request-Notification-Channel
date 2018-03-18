<?php

namespace F2M2\RequestNotification;

class RequestNotificationMessage
{

    protected $data;
    protected $headers;
    protected $userAgent;

    /**
     * @param mixed $data
     *
     * @return static
    */
    public static function create($data = '')
    {
        return new static($data);
    }

    /**
     * @param mixed $data
    */
    public function __construct($data = '')
    {
        $this->data = $data;
    }

    /**
     * Set the RequestNotification data to be JSON encoded.
     *
     * @param mixed $data
     *
     * @return $this
    */
    public function data($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Add a RequestNotification request custom header.
     *
     * @param string $name
     * @param string $value
     *
     * @return $this
    */
    public function header($name, $value)
    {
        $this->headers[$name] = $value;
        return $this;
    }

    /**
     * Set the RequestNotification request UserAgent.
     *
     * @param string $userAgent
     *
     * @return $this
    */
    public function userAgent($userAgent)
    {
        $this->headers['User-Agent'] = $userAgent;
        return $this;
    }

    /**
     * @return array
    */
    public function toArray()
    {
        return [
            'headers' => $this->headers,
            'data' => $this->data,
        ];
    }
}
