<?php

class CarouselsTableSeeder extends DatabaseSeeder {

    public function run()
    {
        DB::table('carousels')->delete();

        Carousels::create(array(
            'title'          => 'Slide1',
            'description'    => 'Slide 1 description',
            'img_src'        => '',
            'link'           => '',
            'status'         => 0
        ));
    }
}