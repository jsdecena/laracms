<?php

class CarouselsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('carousels')->truncate();
        
		\DB::table('carousels')->insert(array (
			0 => 
			array (
				'id_carousel' => '1',
				'title' => 'Slide1',
				'description' => 'Slide 1 description',
				'img_src' => '',
				'link' => '',
				'status' => '0',
				'created_at' => '2014-08-07 02:31:22',
				'updated_at' => '2014-08-07 02:31:22',
			),
		));
	}

}
