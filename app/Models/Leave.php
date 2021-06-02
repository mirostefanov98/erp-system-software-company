<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Leave extends Model
{
    use HasFactory;
    use Sortable;


    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'description',
        'state',
    ];

    public $sortable = ['user_id', 'state'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
