<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    use HasFactory;

    private static $category;

    public static function saveCategory($request){
        $request->validate([
            'category_name' => 'required|string|min:3|max:20',
        ]);
       self::$category = new Category();
       self::$category->category_name = $request->category_name;
       self::$category->save();
    }

}
