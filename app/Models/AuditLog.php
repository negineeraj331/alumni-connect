<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'user_id', 'action', 'auditable_type', 'auditable_id', 
        'old_values', 'new_values', 'ip_address', 'user_agent', 'created_at'
    ];
    
    protected $casts = [
        'old_values' => 'array', 
        'new_values' => 'array', 
        'created_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function auditable()
    {
        return $this->morphTo();
    }

    public static function record(string $action, ?Model $model = null, array $old = [], array $new = []): self
    {
        return self::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'auditable_type' => $model ? get_class($model) : null,
            'auditable_id' => $model?->id,
            'old_values' => $old ?: null,
            'new_values' => $new ?: null,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'created_at' => now(),
        ]);
    }
}
