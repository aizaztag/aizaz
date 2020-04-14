<?php

use App\Form;
use Illuminate\Database\Seeder;

class FormsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $form = new Form;
        $form->item_name = "item_name";
        $form->sku_no = "sku_no";
        $form->price = 'price';
        $form->save();
    }
}
