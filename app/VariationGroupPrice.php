<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VariationGroupPrice extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Accessor that Calculates the price of price group of a product based on price_type of it.
     */
    public function getCalculatedPriceAttribute()
    {
        if(isset($this->price_type) && $this->price_type == 'percentage'){
            //calculate the price
            $variation = Variation::find($this->variation_id);
            $utils = new \App\Utils\Util();
            $price = $utils->calc_percentage($variation->sell_price_inc_tax, $this->price_inc_tax);
        } else {
            $price = $this->price_inc_tax;
        }

        return $price;
    }
}
