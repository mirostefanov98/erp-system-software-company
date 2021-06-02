<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Task extends Model
{
    use HasFactory;
    use Sortable;


    protected $fillable = [
        'name',
        'priority',
        'status',
        'description',
        'state',
        'project_id',
    ];

    public $sortable = ['priority', 'status', 'state'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
