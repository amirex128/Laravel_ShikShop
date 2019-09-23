<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if ( !\App\User::find('3g6s316j') )
        {
            \App\User::create([
                'id' => '3g6s316j',
                'first_name' => 'امیر',
                'last_name' => 'خدنگی',
                'phone' => '09105009868',
                'email' => 'AmirKhadangi920@Gmail.com',
                'password' => Hash::make('123456'),
                'type' => 1
            ]);
            echo "\e[91mAmir Khadangi user \e[39mwas \e[32mcreated \n";
        }

        if ( \App\Models\Option::all()->isEmpty() )
        {
            \App\Models\Option::createMany([
                [
                    'name' => 'slider',
                    'value' => "[{\"title\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0634\\u0645\\u0627\\u0631\\u0647 \\u06f1\",\"description\":\"\\u062a\\u0648\\u0636\\u06cc\\u062d \\u062a\\u0635\\u0627\\u062f\\u0641\\u06cc \\u0627\\u0633\\u0644\\u0627\\u06cc\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 \\u06f1\",\"link\":\"http:\\/\\/hicostore\\/link1\",\"button\":\"\\u062e\\u0631\\u06cc\\u062f \\u06a9\\u0646\\u06cc\\u062f\",\"photo\":\"f9f28eaa.jpg\"},{\"title\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0634\\u0645\\u0627\\u0631\\u0647 2 \\u0627\\u0635\\u0644\\u0627\\u062d \\u0634\\u062f\\u0647\",\"description\":\"\\u062a\\u0648\\u0636\\u06cc\\u062d \\u062a\\u0635\\u0627\\u062f\\u0641\\u06cc \\u0627\\u0633\\u0644\\u0627\\u06cc\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 2\",\"link\":\"http:\\/\\/hicostore\\/link2\",\"button\":\"\\u062f\\u06a9\\u0645\\u0647 2\",\"photo\":\"e8dd6566.jpg\"},{\"title\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0634\\u0645\\u0627\\u0631\\u0647 3\",\"description\":\"\\u062a\\u0648\\u0636\\u06cc\\u062d \\u062a\\u0635\\u0627\\u062f\\u0641\\u06cc \\u0627\\u0633\\u0644\\u0627\\u06cc\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 3\",\"link\":\"http:\\/\\/hicostore\\/link3\",\"button\":\"\\u062f\\u06a9\\u0645\\u0647 3\",\"photo\":\"312a4973.jpg\"}]",
                ], [
                    'name' => 'posters',
                    'value' => "[{\"title\":\"\u067e\u0648\u0633\u062a\u0631 1\",\"description\":\"\u062a\u0648\u0636\u06cc\u062d \u067e\u0648\u0633\u062a\u0631 \u0634\u0645\u0627\u0631\u0647 1\",\"link\":\"http:\/\/hicostore\/link1\",\"button\":\"\u062f\u06a9\u0645\u0647 \u0634\u0645\u0627\u0631\u0647 1\",\"photo\":\"3c52cb59.jpeg\"},{\"title\":\"\u067e\u0648\u0633\u062a\u0631 2\",\"description\":\"\u062a\u0648\u0636\u06cc\u062d \u067e\u0648\u0633\u062a\u0631 \u0634\u0645\u0627\u0631\u0647 2\",\"link\":\"http:\/\/hicostore\/link2\",\"button\":\"\u062f\u06a9\u0645\u0647 \u0634\u0645\u0627\u0631\u0647 2\",\"photo\":\"11d55624.jpg\"},{\"title\":\"\u067e\u0648\u0633\u062a\u0631 3\",\"description\":\"\u062a\u0648\u0636\u06cc\u062d \u067e\u0648\u0633\u062a\u0631 \u0634\u0645\u0627\u0631\u0647 3\",\"link\":\"http:\/\/hicostore\/link3\",\"button\":\"\u062f\u06a9\u0645\u0647 \u0634\u0645\u0627\u0631\u0647 3\",\"photo\":\"27968418.jpg\"},{\"title\":\"\u067e\u0648\u0633\u062a\u0631 1\",\"description\":\"\u062a\u0648\u0636\u06cc\u062d \u067e\u0648\u0633\u062a\u0631 \u0634\u0645\u0627\u0631\u0647 1\",\"link\":\"http:\/\/hicostore\/link1\",\"button\":\"\u062f\u06a9\u0645\u0647 \u0634\u0645\u0627\u0631\u0647 1\",\"photo\":\"3c52cb59.jpeg\"},{\"title\":\"\u067e\u0648\u0633\u062a\u0631 2\",\"description\":\"\u062a\u0648\u0636\u06cc\u062d \u067e\u0648\u0633\u062a\u0631 \u0634\u0645\u0627\u0631\u0647 2\",\"link\":\"http:\/\/hicostore\/link2\",\"button\":\"\u062f\u06a9\u0645\u0647 \u0634\u0645\u0627\u0631\u0647 2\",\"photo\":\"11d55624.jpg\"},{\"title\":\"\u067e\u0648\u0633\u062a\u0631 3\",\"description\":\"\u062a\u0648\u0636\u06cc\u062d \u067e\u0648\u0633\u062a\u0631 \u0634\u0645\u0627\u0631\u0647 3\",\"link\":\"http:\/\/hicostore\/link3\",\"button\":\"\u062f\u06a9\u0645\u0647 \u0634\u0645\u0627\u0631\u0647 3\",\"photo\":\"27968418.jpg\"}]",
                ], [
                    'name' => 'site_name',
                    'value' => 'HiCO Store',
                ], [
                    'name' => 'site_description',
                    'value' => 'این یک توضیح خیلی کوتاه و تصادفی درباره فروشگاه و کسب و کار کوچک هایکو استور میباشد که توسط مدیر قابل تعویض است',
                ], [
                    'name' => 'site_logo',
                    'value' => 'b0fae1e6.png',
                ], [
                    'name' => 'watermark',
                    'value' => 'b0fae1e6.png',
                ], [
                    'name' => 'shop_phone',
                    'value' => '09123456789',
                ], [
                    'name' => 'shop_address',
                    'value' => 'خراسان رضوی ، مشهد ، بین دستغیب 15 و 17 ، پلاک 231 ، واحد 1',
                ], [
                    'name' => 'social_link',
                    'value' => "{\"instagram\":\"https:\\/\\/instagram.com\\/\",\"telegram\":\"https:\\/\\/telegram.com\\/\",\"facebook\":\"https:\\/\\/facebook.com\\/\",\"twitter\":\"https:\\/\\/twitter.com\"}",
                ], [
                    'name' => 'dollar_cost',
                    'value' => '14500',
                ], [
                    'name' => 'shipping_cost',
                    'value' => "{\"model1\":{\"name\":\"\\u0645\\u062a\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 \\u06cc\\u06a9\",\"cost\":\"5000\"},\"model2\":{\"name\":\"\\u0645\\u062a\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 \\u062f\\u0648\",\"cost\":\"14000\"},\"model3\":{\"name\":\"\\u0645\\u062a\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 \\u0633\\u0647\",\"cost\":\"8000\"},\"model4\":{\"name\":\"\\u0645\\u062a\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 \\u0686\\u0647\\u0627\\u0631\",\"cost\":\"5000\"}}",
                ]
            ]);
            echo "\e[91mOptions \e[39mwas \e[32mcreated \n";
        }
        
        factory(\App\User::class, rand(1, 10) )->create()->each( function ($user) {
            
            factory(\App\Models\Order::class, 20)->create(['buyer' => $user->id]);
            factory(\App\Models\Ticket::class, rand(1, 5) )->create([ 'user_id' => $user->id ]);
        });
        echo "\e[91mUsers \e[39mwas \e[32mcreated \n";
        echo "\e[91mUser's tickets \e[39mwas \e[32mcreated \n";
        echo "\e[91mUser's orders \e[39mwas \e[32mcreated \n";

        factory(\App\Models\Article::class, rand(0, 10))->create();
        echo "\e[91mArticles \e[39mwas \e[32mcreated \n";
        $colors = factory(\App\Models\Color::class, 20)->create();
        echo "\e[91mColors \e[39mwas \e[32mcreated \n";
        $brands = factory(\App\Models\Brand::class, 10)->create();
        echo "\e[91mBrands \e[39mwas \e[32mcreated \n";
        $designs = factory(\App\Models\Design::class, 10)->create();
        echo "\e[91mDesigns \e[39mwas \e[32mcreated \n";
        $sizes = factory(\App\Models\Size::class, 10)->create();
        echo "\e[91mSizes \e[39mwas \e[32mcreated \n";
        $sizes->each( function ($size) {
            factory(\App\Models\Size::class, rand(1, 10) )->create([ 'group' => $size->id ]);
        });
        echo "\e[91mSize for a size groups \e[39mwas \e[32mcreated \n";

        factory(\App\Models\Category::class, rand(1, 10) )->create()->each( function ($category) use ( $colors, $brands, $designs, $sizes ) {
            
            echo "\e[91mCategories \e[39mwas \e[32mcreated \n";

            factory(\App\Models\Category::class, rand(1, 5) )->create([
                'parent' => $category->id
            ])->each( function ($category) use ( $colors, $brands, $designs, $sizes ) {
                
                echo "\e[91mCategories for parent categories \e[39mwas \e[32mcreated \n";

                $category->products()->save(factory(\App\Models\Product::class)->make([
                    'brand_id'  => $brands[ rand(0, count($brands) - 1 )]->id,
                    'color_id'  => $colors[ rand(0, count($colors) - 1 )]->id,
                    'size_id'   => $designs[ rand(0, count($designs) - 1 )]->id,
                    'design_id' => $sizes[ rand(0, count($sizes) - 1 )]->id
                ]))->each( function ( $product ) {
                    
                    echo "\e[91mProducts \e[39mwas \e[32mcreated \n";

                    factory(\App\Models\Specification::class, rand(1, 20) )->create([
                        'product_id' => $product->id
                    ]);
                    echo "\e[91mProducts Specifications \e[39mwas \e[32mcreated \n";
                });
            });
        });

        factory(\App\Models\QuestionAndAnswer::class, 20)->create();
        echo "\e[91mQ&A \e[39mwas \e[32mcreated \n";
    }
}
