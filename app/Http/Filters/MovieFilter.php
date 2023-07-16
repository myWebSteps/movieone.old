<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class MovieFilter extends AbstractFilter
{
    const CATEGORY = 'category';
    const SUBCATEGORY = 'subcategory';
    const TYPE = 'type';
    const SEARCH = 'key';



    protected function getCallbacks(): array
    {
        return [
            self::CATEGORY => [$this, 'category'],
            self::SUBCATEGORY => [$this, 'subcategory'],
            self::TYPE => [$this, 'type'],
            self::SEARCH => [$this, 'search']

        ];
    }

    protected function category(Builder $builder, $value)
    {
        $builder->where('category_id', (int)$value);
    }

    protected function type(Builder $builder, $value)
    {
        $builder->where('type', (int)$value);
    }

    protected function search(Builder $builder, $value)
    {
        $builder->where('description', 'like', "%$value%");
    }

    protected function subcategory(Builder $builder, $value)
    {
        $builder->whereHas('subcategories', function ($b) use($value){
            $b->where('subcategory_id', (int)$value);
        });
    }
}
