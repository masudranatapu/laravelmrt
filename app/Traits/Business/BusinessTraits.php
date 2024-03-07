<?php

namespace App\Traits\Business;



trait BusinessTraits
{
    public function businessOptions()
    {
        $data = [
            "enable_copyright" => "Enable Copyright Text",
            "enable_send_mail" => "Enable Send Mail",
            "enable_sku_unique" => "Sku Unique",
            "enable_product_name_unique" => "Product Name Unique",
            "enable_expire_date" => "Enable Expire Date",
            "enable_supplier_wise_products" => "Supplier Wise Products",
            "enable_online_order" => "Enable Online Order",
            "enable_user_commission" => "Enable User Commission",
            "enable_customer_commission" => "Customer Commission",
            "enable_auto_print" => "Auto Print",
        ];

        return (object) $data;
    }
}
