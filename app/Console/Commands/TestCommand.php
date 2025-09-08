<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Address;
use App\Models\Country;
use App\Models\UserAddress;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartItem;
use App\Models\Promotion;        
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\Category;
use App\Models\PromotionCategory;
use App\Models\ProductCategory;
use App\Models\Order;
use App\Models\OrderItem;   
use App\Models\PaymentType;
use App\Models\PaymentMethod;
use App\Models\ShippingMethod;
use App\Models\OrderStatus;


class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    public function handle()
    {
        
        $orderStatus = OrderStatus::firstOrCreate([
            'status' => '1',
            
        ]);


        $this->info('promosion created successfully.');

    }
}
