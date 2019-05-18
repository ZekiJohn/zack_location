<?php

namespace App\Transformers;

// use function GuzzleHttp\json_encode;

class UserTransformer {
    protected $user;
    protected $embeds;

    public function __construct($user, $embeds = [])
    {
        $this->user = $user;
        $this->embeds = $embeds;
    }

    public function toArray()
    {
        return [
            'Name' => sprintf("%s %s", $this->user->first_name, $this->user->last_name),
            'Email' => $this->user->email,
            'Activated' => $this->user->activated ? 'True' : 'False',
        ];
    }
    public function toJson()
    {
        return json_encode($this->toArray());
    }
    public function __toString()
    {
        return $this->toJson();
    }
}
