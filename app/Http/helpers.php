<?php

use App\Models\Order;
use App\Models\Upload;
use App\Models\Customer;
use App\Models\Admin\Brnad;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Models\Admin\Attribute;
use App\Models\Admin\SubCategory;
use App\Models\Admin\SubSubCategory;
use App\Models\Admin\WebsiteSetting;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\FeatureActivation;


if (!function_exists('api_asset')) {
    function api_asset($id)
    {
        if (($asset = \App\Models\Upload::find($id)) != null) {
            return $asset->file_name;
        }
        return "no-image.png";
    }
}

if (!function_exists('uploaded_asset')) {
    function uploaded_asset($id)
    {
        if (($asset = \App\Models\Upload::find($id)) != null) {
            return my_asset($asset->file_name);
        }
        return null;
    }
}

if (! function_exists('my_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    function my_asset($path, $secure = null)
    {
        if(env('FILESYSTEM_DRIVER') == 's3'){
            return Storage::disk('s3')->url($path);
        }
        else {
            return app('url')->asset('public/'.$path, $secure);
        }
    }
}

if (! function_exists('static_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    function static_asset($path, $secure = null)
    {
        return app('url')->asset('public/'.$path, $secure);
    }
}

if (!function_exists('getBaseURL')) {
    function getBaseURL()
    {
        $root =(isset($_SERVER['HTTPS']) ? "https://" : "http://").$_SERVER['HTTP_HOST'];
        $root .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

        return $root;
    }
}

if (!function_exists('getFileBaseURL')) {
    function getFileBaseURL()
    {
        if(env('FILESYSTEM_DRIVER') == 's3'){
            return env('AWS_URL').'/';
        }
        else {
            return getBaseURL().'public/';
        }
    }
}

function hex2rgba($color, $opacity = false) {

    $default = 'rgb(230,46,4)';

    //Return default if no color provided
    if(empty($color))
          return $default;

    //Sanitize $color if "#" is provided
    if ($color[0] == '#' ) {
        $color = substr( $color, 1 );
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    //Convert hexadec to rgb
    $rgb = array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if($opacity){
        if(abs($opacity) > 1)
            $opacity = 1.0;
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
    } else {
        $output = 'rgb('.implode(",",$rgb).')';
    }

    //Return rgb(a) color string
    return $output;
}

function compress($src, $dist, $dis_width =500) {
    $img = '';
    $extension = strtolower(strrchr($src, '.'));
    switch($extension)
    {
        case '.jpg':
        case '.jpeg':
            $img = imagecreatefromjpeg($src);
            break;
        case '.gif':
            $img = imagecreatefromgif($src);
            break;
        case '.png':
            $img = imagecreatefrompng($src);
            break;
    }
    $width = imagesx($img);
    $height = imagesy($img);
    $dis_height = $dis_width * ($height / $width);
    $new_image = imagecreatetruecolor($dis_width, $dis_height);
    imagecopyresampled($new_image, $img, 0, 0, 0, 0, $dis_width, $dis_height, $width, $height);
    $imageQuality = 90;
    switch($extension)
    {
        case '.jpg':
        case '.jpeg':
            if (imagetypes() & IMG_JPG) {
                imagejpeg($new_image, $dist, $imageQuality);
            }
            break;
        case '.gif':
            if (imagetypes() & IMG_GIF) {
                imagegif($new_image, $dist);
            }
            break;
        case '.png':
            $scaleQuality = round(($imageQuality/100) * 9);
            $invertScaleQuality = 9 - $scaleQuality;
            if (imagetypes() & IMG_PNG) {
                imagepng($new_image, $dist, $invertScaleQuality);
            }
            break;
    }
    imagedestroy($new_image);
    return filesize($src);
}

if (! function_exists('generateRandomString')) {
    function generateRandomString($n) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }
}

if (! function_exists('getPriceRange')) {
    function getPriceRange($product_group_id) {

        $products=Product::where('product_group_id',$product_group_id);

        $retailer_min_price=$products->min('retailer_selling_price');
        $retailer_max_price=$products->max('retailer_selling_price');
        $distributor_min_price=$products->min('distributor_selling_price');
        $distributor_max_price=$products->max('distributor_selling_price');
        $wholeseller_min_price=$products->min('wholeseller_selling_price');
        $wholeseller_max_price=$products->max('wholeseller_selling_price');
        $retailer_min_point=$products->min('retailer_point');
        $retailer_max_point=$products->max('retailer_point');
        $distributor_min_point=$products->min('distributor_point');
        $distributor_max_point=$products->max('distributor_point');
        $wholeseller_min_point=$products->min('wholeseller_point');
        $wholeseller_max_point=$products->max('wholeseller_point');

        return [
            'retailer_min_price'=>$retailer_min_price,
            'retailer_max_price'=>$retailer_max_price,
            'distributor_min_price'=>$distributor_min_price,
            'distributor_max_price'=>$distributor_max_price,
            'wholeseller_min_price'=>$wholeseller_min_price,
            'wholeseller_max_price'=>$wholeseller_max_price,
            'retailer_min_point'=>$retailer_min_point,
            'retailer_max_point'=>$retailer_max_point,
            'distributor_min_point'=>$distributor_min_point,
            'distributor_max_point'=>$distributor_max_point,
            'wholeseller_min_point'=>$wholeseller_min_point,
            'wholeseller_max_point'=>$wholeseller_max_point,
        ];

    }
}

if(!function_exists('getProductPrice')){
    function getProductPrice($product_id,$type)
    {
        $product=Product::where('id',$product_id)->first();

        $thumbnail_image=asset('public/'.api_asset($product->thumbnail_image));

        foreach(explode(',',$product->gallery_image) as $gallery_image)
        {
            $gallery_images[]=asset('public/'.api_asset($gallery_image));
        }

        foreach($product->category_id as $category)
        {
            $category_name[]=Category::where('id',$category)->first()->name;
        }

        foreach($product->subcategory_id as $subcategory)
        {
            $subcategory_name[]=SubCategory::where('id',$subcategory)->first()->name;
        }

        if($product->subsubcategory_id)
        {
            foreach($product->subsubcategory_id as $subsubcategory)
            {
                $subsubcategory_name[]=SubSubCategory::where('id',$subsubcategory)->first()->name;
            }
        }
        else
        {
            $subsubcategory_name=[];
        }

        $brand=Brnad::where('id',$product->brand_id)->first()->name;

        if($product->attribute)
        {
            foreach($product->attribute as $attribute)
            {
                $attribute_name[]=Attribute::where('id',$attribute)->first()->name;
            }
        }
        else
        {
            $attribute_name=[];
        }

        $user_type=$type;
        if($user_type == 'retailer')
        {
            $selling_price=$product->retailer_selling_price;
            $discount_type=$product->retailer_discount_type;
            $discount=$product->retailer_discount;
            $min_qty=$product->retailer_min_qty;
            $max_qty=$product->retailer_max_qty;

            if($discount_type == 'amount')
            {
                $product_price=$selling_price-$discount;
            }
            if($discount_type == 'percent')
            {
                $discount_amount=$selling_price*$discount/100;
                $product_price=$selling_price-$discount_amount;
            }
        }
        if($user_type == 'distributor')
        {
            $selling_price=$product->distributor_selling_price;
            $discount_type=$product->distributor_discount_type;
            $discount=$product->distributor_discount;
            $min_qty=$product->distributor_min_qty;
            $max_qty='';

            if($discount_type == 'amount')
            {
                $product_price=$selling_price-$discount;
            }
            if($discount_type == 'percent')
            {
                $discount_amount=$selling_price*$discount/100;
                $product_price=$selling_price-$discount_amount;
            }
        }
        if($user_type == 'wholeseller')
        {
            $selling_price=$product->wholeseller_selling_price;
            $discount_type=$product->wholeseller_discount_type;
            $discount=$product->wholeseller_discount;
            $min_qty=$product->wholeseller_min_qty;
            $max_qty='';

            if($discount_type == 'amount')
            {
                $product_price=$selling_price-$discount;
            }
            if($discount_type == 'percent')
            {
                $discount_amount=$selling_price*$discount/100;
                $product_price=$selling_price-$discount_amount;
            }
        }

        return [
            'category_name'=>$category_name,
            'subcategory_name'=>$subcategory_name,
            'subsubcategory_name'=>$subsubcategory_name,
            'brand'=>$brand,
            'attribute_name'=>$attribute_name,
            'thumbnail_image'=>$thumbnail_image,
            'gallery_images'=>$gallery_images,
            'selling_price'=>$selling_price,
            'discount_type'=>$discount_type,
            'discount'=>$discount,
            'product_price'=>$product_price,
            'min_qty'=>$min_qty,
            'max_qty'=>$max_qty
        ];
    }
}

if(!function_exists('getProductDiscountedPrice')){
    function getProductDiscountedPrice($product_id,$type)
    {
        $product=Product::where('id',$product_id)->first();

        $user_type=$type;
        if($user_type == 'retailer')
        {
            $selling_price=$product->retailer_selling_price;
            $discount_type=$product->retailer_discount_type;
            $discount=$product->retailer_discount;
            $min_qty=$product->retailer_min_qty;
            $max_qty=$product->retailer_max_qty;

            if($discount_type == 'amount')
            {
                $product_price=$selling_price-$discount;
            }
            if($discount_type == 'percent')
            {
                $discount_amount=$selling_price*$discount/100;
                $product_price=$selling_price-$discount_amount;
            }
        }
        if($user_type == 'distributor')
        {
            $selling_price=$product->distributor_selling_price;
            $discount_type=$product->distributor_discount_type;
            $discount=$product->distributor_discount;
            $min_qty=$product->distributor_min_qty;
            $max_qty='';

            if($discount_type == 'amount')
            {
                $product_price=$selling_price-$discount;
            }
            if($discount_type == 'percent')
            {
                $discount_amount=$selling_price*$discount/100;
                $product_price=$selling_price-$discount_amount;
            }
        }
        if($user_type == 'wholeseller')
        {
            $selling_price=$product->wholeseller_selling_price;
            $discount_type=$product->wholeseller_discount_type;
            $discount=$product->wholeseller_discount;
            $min_qty=$product->wholeseller_min_qty;
            $max_qty='';

            if($discount_type == 'amount')
            {
                $product_price=$selling_price-$discount;
            }
            if($discount_type == 'percent')
            {
                $discount_amount=$selling_price*$discount/100;
                $product_price=$selling_price-$discount_amount;
            }
        }

        return [
            'selling_price'=>$selling_price,
            'discount_type'=>$discount_type,
            'discount'=>$discount,
            'product_price'=>$product_price,
            'min_qty'=>$min_qty,
            'max_qty'=>$max_qty
        ];
    }
}

if (!function_exists('websiteSettingValue')) {
    function websiteSettingValue($type) {
        return WebsiteSetting::where('type', $type)->first() ? WebsiteSetting::where('type', $type)->first()->image : "";
    }
}

if (!function_exists('featureActivation')) {
    function featureActivation($feature) {
        return FeatureActivation::where('feature_name', $feature)->first() ? FeatureActivation::where('feature_name', $feature)->first()->is_active : "";
    }
}

if (! function_exists('homePrice')) {
    function homePrice($id)
    {
        $product=Product::where('id',$id)->first();
        if(auth()->guard('customer')->check()){
            $user_type=Auth::guard('customer')->user()->type;

            if($user_type=='retailer'){
               return retailerPrice($product);
            }
            if($user_type=='distributor'){
               return distributorPrice($product);
            }
            if($user_type=='wholeseller'){
               return wholesalerPrice($product);
            }
        }else{

            if(featureActivation('retailer') == '1'){
                return retailerPrice($product);
            }
            if(featureActivation('distributor') == '1' && featureActivation('wholeseller') == '1'){
                return [
                    'selling_price'=>'',
                    's_p'=>'',
                    'discount_type'=>'',
                    'discount'=>'',
                    'product_price'=>'',
                    'p_p'=>'',
                    'min_qty'=>'',
                    'max_qty'=>''
                ];
            }
            if(featureActivation('distributor') == '1'){
                return distributorPrice($product);
            }
            if(featureActivation('wholeseller') == '1'){

                return wholesalerPrice($product);
            }

             return [
                    'selling_price'=>'',
                    's_p'=>'',
                    'discount_type'=>'',
                    'discount'=>'',
                    'product_price'=>'',
                    'p_p'=>'',
                    'min_qty'=>'',
                    'max_qty'=>''
                ];


        }
    }
}

if (! function_exists('retailerPrice')) {
    function retailerPrice($product)
    {
        $selling_price=$product->retailer_selling_price;
        $discount_type=$product->retailer_discount_type;
        $discount=$product->retailer_discount;
        $min_qty=$product->retailer_min_qty;
        $max_qty=$product->retailer_max_qty;

        if($discount_type == 'amount'){
            $product_price=$selling_price-$discount;
        }
        if($discount_type == 'percent'){
            $discount_amount=$selling_price*$discount/100;
            $product_price=$selling_price-$discount_amount;
        }
        return [
            'selling_price'=>'₹'.$selling_price,
            's_p'=>$selling_price,
            'discount_type'=>$discount_type,
            'discount'=>$discount,
            'product_price'=>'₹'.$product_price,
            'p_p'=>$product_price,
            'min_qty'=>$min_qty,
            'max_qty'=>$max_qty
        ];
    }
}

if (! function_exists('distributorPrice')) {
    function distributorPrice($product){
        $selling_price=$product->distributor_selling_price;
        $discount_type=$product->distributor_discount_type;
        $discount=$product->distributor_discount;
        $min_qty=$product->distributor_min_qty;
        $max_qty='';

        if($discount_type == 'amount'){
            $product_price=$selling_price-$discount;
        }
        if($discount_type == 'percent'){
            $discount_amount=$selling_price*$discount/100;
            $product_price=$selling_price-$discount_amount;
        }
        return [
            'selling_price'=>'₹'.$selling_price,
            's_p'=>$selling_price,
            'discount_type'=>$discount_type,
            'discount'=>$discount,
            'product_price'=>'₹'.$product_price,
            'p_p'=>$product_price,
            'min_qty'=>$min_qty,
            'max_qty'=>$max_qty
        ];
    }
}

if (! function_exists('wholesalerPrice')) {
    function wholesalerPrice($product){
        $selling_price=$product->wholeseller_selling_price;
        $discount_type=$product->wholeseller_discount_type;
        $discount=$product->wholeseller_discount;
        $min_qty=$product->wholeseller_min_qty;
        $max_qty='';

        if($discount_type == 'amount'){
            $product_price=$selling_price-$discount;
        }
        if($discount_type == 'percent'){
            $discount_amount=$selling_price*$discount/100;
            $product_price=$selling_price-$discount_amount;
        }
        return [
            'selling_price'=>'₹'.$selling_price,
            's_p'=>$selling_price,
            'discount_type'=>$discount_type,
            'discount'=>$discount,
            'product_price'=>'₹'.$product_price,
            'p_p'=>$product_price,
            'min_qty'=>$min_qty,
            'max_qty'=>$max_qty
        ];
    }
}


if (! function_exists('commissions')) {
    function commissions()
    {
        return [
          200,100,50,50,25,25,25,25,25,25,25
        ];
    }
}

if (! function_exists('repurchase_commissions')) {
    function repurchase_commissions()
    {
        return [
          2.5,1.5,1,0.75,0.5
        ];
    }
}

if (! function_exists('reward_users')) {
    function reward_users()
    {
        return [
          50,100,200,500,1000,2000,5000,10000,20000,50000,100000,300000,500000,1000000,2000000,5000000
        ];
    }
}

if (! function_exists('reward_user_one_site')) {
    function reward_user_one_site()
    {
        return [
         30,60,120,300,600,1200,3000,6000,12000,30000,60000,180000,300000,600000,1200000,3000000
        ];
    }
}

if (! function_exists('reward_user_other_site')) {
    function reward_user_other_site()
    {
        return [
         20,40,80,200,400,800,2000,4000,8000,20000,40000,120000,200000,400000,800000,2000000
        ];
    }
}

if (! function_exists('getIndianCurrency')) {
    function getIndianCurrency(float $number)
    {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(0 => '', 1 => 'one', 2 => 'two',
            3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
            7 => 'seven', 8 => 'eight', 9 => 'nine',
            10 => 'ten', 11 => 'eleven', 12 => 'twelve',
            13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
            16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
            19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
            40 => 'forty', 50 => 'fifty', 60 => 'sixty',
            70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
        $digits = array('', 'hundred','thousand','lakh', 'crore');
        while( $i < $digits_length ) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
    }
}

if (!function_exists('calculateTotalTeamCount')) {
    function calculateTotalTeamCount($user)
    {
        $teamCount = 0;

        foreach (Customer::where('refered_by', $user->referral_code)->get() as $child) {

                $teamCount++; // Count the direct children

            $teamCount += calculateTotalTeamCount($child); // Recursively count their teams
        }

        return $teamCount;
    }
}

if (!function_exists('calculateTotalTeamPvCount')) {
    function calculateTotalTeamPvCount($user)
    {
        $teamPv= 0;

        foreach (Customer::where('refered_by', $user->referral_code)->get() as $child) {
          $total_pv=0;
          $order_data=Order::where('user_id', $child->id)->where('payment_status','success')->get();
            foreach($order_data as $datas){
             foreach($datas->order_details as $order_detail){
              $total_pv= $total_pv + ($order_detail->pv *  $order_detail->quantity);
              }
             }
            $teamPv+=$total_pv; // Count the direct children
            $teamPv += calculateTotalTeamCount($child); // Recursively count their teams
        }

        return $teamPv;
    }
}

?>
