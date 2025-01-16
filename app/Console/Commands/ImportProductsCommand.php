<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Category;
// use App\Models\Image;
// use App\Models\ProductMeta;

class ImportProductsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed:wc-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Parse JSON data (replace with actual fetching logic if not static)
        // $jsonData = file_get_contents('path_to_your_json_file.json');
        // $productsData = json_decode($jsonData, true);


        // Initialize variables
        $page = 1;
        $per_page = 50;
        $results = [];

        // Loop to fetch data until empty array is encountered
        while (true) {
            // Create cURL resource
            $ch = curl_init();

            $baseUrl = config('app.base_url');
            $consumerKey = config('app.consumer_key');
            $consumerSecret = config('app.consumer_secret');

            if(!$baseUrl || !$consumerKey || !$consumerSecret) {
                logger('WooCommerece details are not set in Settings');
                exit();
            }

            // Set cURL options
            $url = $baseUrl."/wp-json/wc/v3/products?consumer_key=".$consumerKey."&consumer_secret=".$consumerSecret."&per_page={$per_page}&page={$page}";
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Execute cURL session
            $response = curl_exec($ch);

            // Check for cURL errors
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
                break;
            }
            // Close cURL session
            curl_close($ch);

            // Decode JSON response
            $data = json_decode($response, true);

            // Check if array is empty ([]), if so, break the loop
            if (empty($data)) {
                break;
            }

            // Merge fetched data into results array
            $results = array_merge($results, $data);

            // Increment page for next iteration
            $page++;
        }



        $this->info('Combine done ');


        foreach ($results as $productData) {
            try {
                // Create product
                $price = $productData['price'] !== null ? $productData['price'] : 'null';
                $regular_price = $productData['regular_price'] !== null ? $productData['regular_price'] : 'null';

                $product = Product::updateOrCreate(
                    [
                        'sku' => $productData['sku'],
                        'wc_id' => $productData['id']
                    ],
                    [
                        'name' => $productData['name'],
                        'slug' => $productData['slug'],
                        'description' => $productData['description'],
                        'short_description' => $productData['short_description'],
                        'price' => $price,
                        'regular_price' => $regular_price,
                        'on_sale' => $productData['on_sale'],
                        'purchasable' => $productData['purchasable'],
                        'total_sales' => $productData['total_sales'],
                        'virtual' => $productData['virtual'],
                        'downloadable' => $productData['downloadable'],
                        'manage_stock' => $productData['manage_stock'],
                        'img_url' => $productData['images'][0]['src'] ?? null,
                        'stock_quantity' => $productData['stock_quantity'],
                        'stock_status' => $productData['stock_status'],
                        'backorders_allowed' => $productData['backorders_allowed'],
                        'sold_individually' => $productData['sold_individually'],
                    ]
                );

                // $this->info('Products Done ');
                // Attach categories
                foreach ($productData['categories'] as $categoryData) {
                    $category = Category::firstOrCreate([
                        'wc_id' => $categoryData['id'],
                        'name' => $categoryData['name'],
                        'slug' => $categoryData['slug'],
                    ]);

                    // $this->info('Cat Done');
                    try {
                        $product->categories()->attach($category->id);
                    } catch (\Illuminate\Database\QueryException $e) {
                        continue;
                    }
                    // $this->info('Link Cat Done');
                }
            } catch (\Illuminate\Database\QueryException $e) {

                // $this->info($productData['id'] . 'Error-----');
                // logger($productData['id'] . 'Error----- <br>');
                continue;
            }

        }

        $this->info('Products imported successfully.');
    }
}
