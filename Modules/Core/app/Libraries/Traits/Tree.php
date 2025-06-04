<?php

namespace Modules\Core\Libraries\Traits;

trait Tree
{
    public static function getLevel($parentid)
    {
        return 1;
    }

    public function childs()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }

    public function allparent()
    {
        return $this->belongsTo($this, 'parent_id')->with('allparent');
    }

    public function allChildren()
    {
        return $this->hasMany($this, 'parent_id')->with("allchildren");
    }

    public function mainParent()
    {
        $parents    = $this->allparent()->get()->toArray();
        $mainParent = collect(flatten($parents,'allparent',true))->where('parent_id',null)->first();

        if (count($mainParent)) {
            return $mainParent['id'];
        }

        return null;
    }
}
