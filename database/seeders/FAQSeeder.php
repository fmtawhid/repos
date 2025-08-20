<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('f_a_q_s')->delete();
        $f_a_q_s = array(
            array('id' => '1','question' => 'Where can I learn more about copywriting or entrepreneurship?','answer' => 'Restros - is an innovative SaaS platform that harnesses the power of OpenAI Artificial Intelligence technology to provide your users with a range of exceptional features. Restros, users can effortlessly generate unique and plagiarism-free content and images, taking advantage of multiple languages for enhanced versatility. It\'s all in one SaaS platform to generate AI content, image and code.','is_active' => '1','user_id' => '1','created_by_id' => '1','updated_by_id' => NULL,'created_at' => '2024-07-08 06:07:45','updated_at' => '2024-07-08 06:07:45','deleted_at' => NULL),
            array('id' => '2','question' => 'Can I get a demo of the product?','answer' => 'Of course! We are currently running 1 live demo a week. You can sign up and register for our next one here.','is_active' => '1','user_id' => '1','created_by_id' => '1','updated_by_id' => NULL,'created_at' => '2024-07-08 06:08:04','updated_at' => '2024-07-08 06:08:04','deleted_at' => NULL),
            array('id' => '3','question' => 'What languages does it support?','answer' => 'With the Pro plan, you can create content in the following 250+ languages:','is_active' => '1','user_id' => '1','created_by_id' => '1','updated_by_id' => NULL,'created_at' => '2024-07-08 06:08:21','updated_at' => '2024-07-08 06:08:21','deleted_at' => NULL),
            array('id' => '4','question' => 'How much does it cost?','answer' => 'Our copywriting tools have a free plan! That\'s right, you can create content with our free tools. However, if you want more content, you\'ll have to subscribe to our Pro plan!','is_active' => '1','user_id' => '1','created_by_id' => '1','updated_by_id' => NULL,'created_at' => '2024-07-08 06:08:38','updated_at' => '2024-07-08 06:08:38','deleted_at' => NULL),
            array('id' => '5','question' => 'What can I create with Restros?','answer' => 'We have copywriting tools for everything you need to start and run your business! You can write blog posts, product descriptions, and even Instagram captions with Restros. We\'re always updating our tools, so let us know what else you\'d like to see!','is_active' => '1','user_id' => '1','created_by_id' => '1','updated_by_id' => NULL,'created_at' => '2024-07-08 06:08:56','updated_at' => '2024-07-08 06:08:56','deleted_at' => NULL)
          );

          DB::table('f_a_q_s')->insert($f_a_q_s);
    }
}
