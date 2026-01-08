<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_status_logs extends Model
{
    /** @use HasFactory<\Database\Factories\OrderStatusLogsFactory> */
    use HasFactory;

       protected $fillable = [
        'order_id',
        'status',
        'changed_by',
        'changed_at',
    ];

    public $timestamps = true;

    public function updateStatus(string $status): void
{
    $this->update([
        'order_status' => $status
    ]);

    OrderStatusLog::create([
        'order_id' => $this->id,
        'status' => $status,
        'changed_by' => auth()->id(),
        'changed_at' => now(),
    ]);
}
}
