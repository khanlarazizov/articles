<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Protocol extends Model
{
    use HasFactory,Sluggable;
    protected $guarded=['id','created_at','updated_at'];
    public $timestamps = false;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function contract():BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }

    public function scopeName($query,$name){
        if (!is_null($name)){
            return $query->where("name","LIKE","%" . $name . "%");
        }
    }
    public function scopeContract($query,$contract_id){
        if (!is_null($contract_id)){
            return $query->where("contract_id","LIKE","%" . $contract_id . "%");
        }
    }
    public function scopeDate($query,$date){
        if (!is_null($date)){
            return $query->where("date",$date);
        }
    }
    public function scopePrice($query,$price){
        if (!is_null($price)){
            return $query->where("price",$price);
        }
    }
}
