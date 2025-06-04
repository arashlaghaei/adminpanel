<?php

namespace Modules\Core\Libraries\Traits;

trait Scopes
{
    public function scopeBasicSearch($query)
    {
        $request = request();
        $fillables = array_merge($this->getFillable(), ['id']);

        foreach ($request->all() as $key => $value) {
            if (str_contains($key, 'orderby') && (in_array($keyResult = str_replace('orderby_', '', $key),
                    $fillables))) {
                $query->orderBy($keyResult, $value);
            }
        }

        $query->where(function ($query) use ($request, $fillables) {

            foreach ($request->all() as $key => $value) {
                if (in_array($key, $fillables)) {
                    if (($key != 'page') || ($key == 'page' && !is_numeric($value))) {
                        if (is_array($value)) {
                            $query->whereIn($key, $value);
                        } else {
                            $query->where($key, $value);
                        }
                    }
                } elseif (str_contains($key, 'like') && (in_array($keyResult = str_replace('like_', '', $key),
                        $fillables))) {
                    $query->orWhere($keyResult, 'like', "%{$value}%");
                }
            }

        });

        return $query;
    }
}
