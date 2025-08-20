<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketFile extends Model
{
    use HasFactory;

    protected $table = "ticket_files";
    protected $fillable = [
        "file_path",
        "ticket_id",
        "replied_id",
        "is_active",
        "created_by_id",
        "updated_by_id",
        "deleted_at"
    ];
}
