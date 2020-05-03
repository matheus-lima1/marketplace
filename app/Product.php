<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


// Por convensão, o Laravel vincula o model Product a tabela products
class Product extends Model
{
    use HasSlug;

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    
    protected $fillable = ['name', 'description','body','price','slug'];

    // os produtos PERTENCEM a uma loja
    public function store(){

        return $this->belongsTo(Store::class); 

    }


    public function categories(){

        return $this->belongsToMany(Category::class); // tabela por ordem alfabética, ou seja, category_product
        

    }

    public function photos(){
       return $this->hasMany(ProductPhoto::class);
    }

}
