<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Project extends Model
{
    use HasFactory;
    use Sortable;


    protected $fillable = [
        'name',
        'state',
        'deadline_date',
        'status',
    ];

    public $sortable = ['state', 'deadline_date', 'status'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
