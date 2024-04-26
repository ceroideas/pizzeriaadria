<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\OrderProduct;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['client_id', 'status'];

    public $additional_attributes = [
        'products','total','products_details'
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function orderProducts() {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }

    public function getTotalAttribute() {

        $totalPrice = $this->orderProducts->reduce(function($carry, $orderProduct){
            return $carry + floatval($orderProduct->price);
        }, 0);

        return $totalPrice;
    }

    public function getProductsAttribute()
    {
        foreach ($this->orderProducts as $key => $value) {
            echo $value->quantity.'x '.$value->product->name.' | '.$value->price.'€ <br>';
        }
    }

    public function getProductsDetailsAttribute()
    {
        $html = "<table class='table table-bordered table-hover'>
            <thead>
                <tr>
                    <th>Qty</th>
                    <th>Producto</th>
                    <th>Ingredientes base</th>
                    <th>Ingredientes extra</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>";
                foreach ($this->orderProducts as $key => $value) {

                    $ingredients = "";
                    $extras = "";

                    foreach ($value->ingredients as $key => $__) {
                        $ingredients.='<li>'.$__->ingredient->name.' </li>';
                    }

                    foreach ($value->extraIngredients as $key => $__) {
                        $extras.='<li>'.$__->name.' <b>'.$__->extra_price.'€</b> </li>';
                    }

                    $html.="
                        <tr>
                            <td>".$value->quantity."x</td>
                            <td>".$value->product->name."</td>
                            <td>".$ingredients."</td>
                            <td>".$extras."</td>

                            <td>".$value->price."€</td>
                        </tr>
                    ";
                }
            $html.="</tbody>
        </table>";

        echo $html;
    }


}
