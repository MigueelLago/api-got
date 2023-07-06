<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Houses extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'houses';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'region',
        'founded_in',
        'current_lord'
    ];


    /**
     * Relationship
     */

    public function lords(){

        return $this->hasMany(Lords::class, 'house', 'id');
    }


    /**
     * Scopes
     */

    public function scopeFilterByName(Builder $builder, $name){

        return $builder->when(
            $name,
            function (Builder $builder, $name){
                return $builder->where('name', 'like', "%{$name}%");
            }
        );
    }

    public function scopeFilterById(Builder $builder, $id){

        return $builder->when(
            $id,
            function (Builder $builder, $id){
                return $builder->where('id', $id);
            }
        );
    }
}
