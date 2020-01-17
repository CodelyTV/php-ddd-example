<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Courses\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

final class CourseEloquentModel extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['name', 'duration'];
}
