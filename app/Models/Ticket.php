<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\Status\IsActiveTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\BootTrait\CreatedUpdatedByRelationshipTrait;

class Ticket extends Model
{
    use HasFactory;
    use IsActiveTrait;
    use CreatedByUpdatedByIdTrait;
    use CreatedUpdatedByRelationshipTrait;
    use SoftDeletes;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'is_active',
        'category_id',
        'priority_id',
        'user_id',
        'created_by_id',
        'updated_by_id'
    ];
    public function images()
    {
        return $this->hasMany(TicketFile::class, 'ticket_id', 'id')->whereNull('replied_id');
    }
    public function assigStaffs()
    {
        return $this->hasMany(AssignTicket::class, 'ticket_id', 'id');
    }
    public function replies()
    {
        return $this->hasMany(ReplyTicket::class, 'ticket_id', 'id')->orderBy('id', 'DESC');
    }
    public function category()
    {
        return $this->belongsTo(SupportCategory::class, 'category_id', 'id')->withDefault([
            'name'=>'n/a'
        ]);
    }
    public function priority()
    {
        return $this->belongsTo(SupportPriority::class, 'priority_id', 'id')->withDefault([
            'name'=>'n/a'
        ]);
    }
    public function getAttributeShortDescription($key)
    {
        return Str::limit($this->description, 20 );
    }
    public function scopeFilters($query)
    {
        $request = request();

        // Is Active
        if ($request->has("is_active")) {
            $query->isActive($request->is_active);
        }

        // Search
        if ($request->has("search")) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        return $query;
    }

    public function scopeSlug($query, $slug)
    {
        $query->where("slug", $slug);
    }

    // New code for fix saas
    public function scopeCreatedBy($query, $userId)
    {
        return $query->where("created_by_id", $userId);
    }

    public function scopeForVendor($query, $vendorId = null)
    {
        if (auth()->check()) {
            return $query->createdBy(auth()->id());
        }
        
        if ($vendorId) {
            return $query->createdBy($vendorId);
        }
        
        return $query;
    }
}
