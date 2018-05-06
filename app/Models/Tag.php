<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public static function bulkFindOrCreate(array $names)
    {
        $tags = collect();
        $exists = static::whereIn('name', $names)->get();

        foreach ($names as $name) {
            $tag = $exists->where('name', $name)->first();
            if (!$tag) {
                $tag = static::create([
                    'name' => $name,
                ]);
            }
            $tags->push($tag);
        }

        return $tags;
    }
}
