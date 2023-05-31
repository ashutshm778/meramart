<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'dashboard',

            'category-index',
            'category-create',
            'category-edit',
            'category-delete',

            'campaign-index',
            'campaign-create',
            'campaign-edit',
            'campaign-delete',

            'product-index',
            'product-create',
            'product-edit',
            'product-delete',

            'monthly-campaign-index',
            'monthly-campaign-create',
            'monthly-campaign-edit',
            'monthly-campaign-delete',

            'order-index',
            'order-detail',
            'order-edit',

            'monthly-donation-index',

            'blog-index',
            'blog-create',
            'blog-edit',
            'blog-delete',

            'testimonial-index',
            'testimonial-create',
            'testimonial-edit',
            'testimonial-delete',

            'campaign-request-index',
            'campaign-request-edit',

            'enquiry-index',

            'banner-index',
            'banner-create',
            'banner-delete',

            'faq-index',
            'faq-create',
            'faq-edit',
            'faq-delete',

            'gallery-index',
            'gallery-create',
            'gallery-delete',

            'user-index',
            'user-create',
            'user-show',
            'user-edit',
            'user-delete',

            'role-index',
            'role-create',
            'role-show',
            'role-edit',
            'role-delete'
        ];

        $parent_id = [
            1,

            2,
            2,
            2,
            2,

            3,
            3,
            3,
            3,

            4,
            4,
            4,
            4,

            5,
            5,
            5,
            5,

            6,
            6,
            6,

            7,

            8,
            8,
            8,
            8,

            9,
            9,
            9,
            9,

            10,
            10,

            11,

            12,
            12,
            12,

            13,
            13,
            13,
            13,

            14,
            14,
            14,

            15,
            15,
            15,
            15,
            15,

            16,
            16,
            16,
            16,
            16
        ];

        $parent_name = [
            'Dashboard',

            'Category',
            'Category',
            'Category',
            'Category',

            'Campaign',
            'Campaign',
            'Campaign',
            'Campaign',

            'Product',
            'Product',
            'Product',
            'Product',

            'Monthly Campaign',
            'Monthly Campaign',
            'Monthly Campaign',
            'Monthly Campaign',

            'Order',
            'Order',
            'Order',

            'Monthly Donation',

            'Blog',
            'Blog',
            'Blog',
            'Blog',

            'Testimonial',
            'Testimonial',
            'Testimonial',
            'Testimonial',

            'Campaign Request',
            'Campaign Request',

            'Enquiry',

            'Banner',
            'Banner',
            'Banner',

            'Faq',
            'Faq',
            'Faq',
            'Faq',

            'Gallery',
            'Gallery',
            'Gallery',

            'User',
            'User',
            'User',
            'User',
            'User',

            'Role',
            'Role',
            'Role',
            'Role',
            'Role',
        ];

        foreach ($permissions as $key=>$permission) {
            $per=Permission::where('name',$permission)->first();
            if($per)
            {
                $permission_data = Permission::find($per->id);
            }
            else
            {
                $permission_data = new Permission;
            }
            $permission_data->name = $permission;
            $permission_data->parent_id = $parent_id[$key];
            $permission_data->parent_name = $parent_name[$key];
            $permission_data->guard_name = 'web';
            $permission_data->save();
        }
    }
}
