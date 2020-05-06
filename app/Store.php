<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
// Classe DB para realizar Querys 

class Store extends Model
{

    use HasSlug;

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    
    protected $fillable = ['name', 'description','phone','slug', 'logo'];

    // loja PERTENCE a um usuario
    public function user(){

        return $this->belongsTo(User::class); // this(store) PERTENCE a um usuario(user)

    } 

    // loja TEM MUITOS produtos
    public function products(){

        return $this->hasMany(Product::class);

    }

    public function orders(){
        return $this->belongsToMany(UserOrder::class,'order_store',null,'order_id');
    }

    

}

//  model = Store
//  tabela = stores
