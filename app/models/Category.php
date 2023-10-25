<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ["name", "slug"];

    public function getPaginate($limit)
    {
        $table = $this->getTable();
        $categories = [];
        $cats = Capsule::select("SELECT * FROM $table ORDER BY id DESC" . $limit);
        foreach ($cats as $cat) {
            $date = new Carbon($cat->created_at);
            array_push($categories, [
                "id" => $cat->id,
                "name" => $cat->name,
                "slug" => $cat->slug,
                "created" => $date->toFormattedDateString()
            ]);
        }
        return $categories;
    }
}
