<?php


namespace alibaba\nacos\model;


class Beat extends Model
{
    protected $clientBeatInterval;

    /**
     * @return mixed
     */
    public function getClientBeatInterval()
    {
        return $this->clientBeatInterval;
    }

    /**
     * @param mixed $clientBeatInterval
     */
    public function setClientBeatInterval($clientBeatInterval)
    {
        $this->clientBeatInterval = $clientBeatInterval;
    } //int
}