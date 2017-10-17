<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PrivateMessage extends Model
{
    protected $fillable = [
        'sender_id', 'receiver_id', 'subject', 'message', 'read'
    ];

    protected $appends = ['sender', 'receiver'];

    // Scopes
    public function scopeReceiver($query, $receiver_id)
    {
        return $query->where('receiver_id', $receiver_id);
    }

    public function scopeSender($query, $sender_id)
    {
        return $query->where('sender_id', $sender_id);
    }

    protected function getCreatedAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    // Methods
    protected function getSenderAttribute()
    {
        return User::find($this->sender_id);
    }

    protected function getReceiverAttribute()
    {
        return User::find($this->receiver_id);
    }

    public function unRead($receiver_id)
    {
        return $this
            ->where('read', 0)
            ->receiver($receiver_id)
            ->latest();
    }

    public function getReceiverMessages($receiver_id)
    {
        return $this
            ->receiver($receiver_id)
            ->latest();
    }

    public function getSenderMessages($sender_id)
    {
        return $this
            ->sender($sender_id)
            ->latest();
    }

    public function find($id)
    {
        $msg = $this->findOrFail($id);

        if ($msg->read == 0) {
            $msg->read = 1;
            $msg->save();
        }

        return $msg;
    }

    public function save($data)
    {
        return $this
            ->create($data);
    }
}
