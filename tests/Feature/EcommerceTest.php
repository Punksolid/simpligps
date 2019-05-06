<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function GuzzleHttp\json_decode;

class EcommerceTest extends TestCase
{
    public function test_ecommerce_puede_registrar_una_cuenta()
    {
        
        $payload = json_decode('{
            id: 6427,
            parent_id: 6426,
            status: "active",
            order_key: "wc_order_5cce6bc19a69b",
            number: "6427",
            currency: "USD",
            version: "3.6.2",
            prices_include_tax: false,
            date_created: "2019-05-05T04:51:13",
            date_modified: "2019-05-05T04:51:14",
            customer_id: 1,
            discount_total: "0.00",
            discount_tax: "0.00",
            shipping_total: "0.00",
            shipping_tax: "0.00",
            cart_tax: "0.00",
            total: "0.00",
            total_tax: "0.00",
            billing: {
            first_name: "Jeber",
            last_name: "Martinez",
            company: null,
            address_1: "Calle Falsa 4456",
            address_2: null,
            city: "Guadalajara",
            state: "JA",
            postcode: "80000",
            country: "MX",
            email: "menteinteractiva2@gmail.com",
            phone: "6671232323"
            },
            shipping: {
            first_name: null,
            last_name: null,
            company: null,
            address_1: null,
            address_2: null,
            city: null,
            state: null,
            postcode: null,
            country: null
            },
            payment_method: null,
            payment_method_title: null,
            transaction_id: null,
            customer_ip_address: "189.186.92.100",
            customer_user_agent: "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36",
            created_via: "checkout",
            customer_note: null,
            date_completed: null,
            date_paid: "2019-05-05T04:51:14",
            cart_hash: null,
            line_items: [
            {
            id: 6,
            name: "TRM 30 days Free Trial",
            sku: null,
            product_id: 6406,
            variation_id: 0,
            quantity: 1,
            tax_class: null,
            price: "0.00",
            subtotal: "0.00",
            subtotal_tax: "0.00",
            total: "0.00",
            total_tax: "0.00",
            taxes: [
            ],
            meta: [
            ]
            }
            ],
            tax_lines: [
            ],
            shipping_lines: [
            ],
            fee_lines: [
            ],
            coupon_lines: [
            ],
            refunds: [
            ],
            billing_period: "month",
            billing_interval: "1",
            resubscribed_from: null,
            resubscribed_subscription: null,
            start_date: "2019-05-05T04:51:12",
            trial_end_date: "2019-06-04T04:51:12",
            next_payment_date: "2019-06-04T04:51:12",
            end_date: "2019-07-04T04:51:12",
            date_completed_gmt: null,
            date_paid_gmt: "2019-05-05T04:51:14"
            }', );
            dd('a');
        dd($payload);
        dd("a");
        $call =  $this->postJson("api/v1/ecommerce/1234567890/", $payload);
    }
}
