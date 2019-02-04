<?php

class Mail {

    private $to, $subject, $message, $headers, $template, $throughTemplate;

    public function __construct($to, $subject, $message, $headers = null)
    {
        $this->to[] = $to;
        $this->subject = $subject;
        $this->message = $message;

        if ($headers) { $this->headers = $headers; }

        $this->throughTemplate = false;
    }

    public function send()
    {
        foreach($this->to as $to)
        {
            if ($this->throughTemplate)
            {
                mail($to, $this->subject, $this->message, $this->headers);
            } else {
                mail($to, $this->subject, $this->message);
            }
            $this->throughTemplate = false;
        }
    }

    public function template()
    {
        $this->template =
        "
        <html>
            <head>
            <title>$this->subject</title>
            </head>
            <body>
                <h1><?= $this->subject ?></h1>
                <p><?= $this->message</p>
            </body>
        </html>
        ";

        $this->headers = "MIME-Version: 1.0" . "\r\n";
        $this->headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $this->throughTemplate = true;

        return $this;
    }

    public function addTo($newTo)
    {
        $this->to[] = $newTo;
        return $this;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    public function setTo($to)
    {
        unset($this->to);
        $this->to = [];
        $this->to[] = $to;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getMessage()
    {
        return $this->message;
    }


    public function getSubject()
    {
        return $this->subject;
    }
}