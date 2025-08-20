<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyTicket extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    public function replyImages()
    {
        return $this->hasMany(TicketFile::class, 'replied_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'replied_by', 'id')->withDefault();
    }
}
