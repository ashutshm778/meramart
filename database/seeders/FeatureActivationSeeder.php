<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\FeatureActivation;

class FeatureActivationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $feature_names = ['retailer','distributor','wholeseller','mlm','purchase_vendor','sales_team','staff_management','app_setting','offer','coupon'];
        foreach($feature_names as $feature_name){
            FeatureActivation::updateOrCreate([
                'feature_name'=>$feature_name
            ],[
                'is_active'=>'0'
            ]);
        }
    }
}
