<?php

class NoteTableSeeder extends Seeder {

    public function run()
    {
        DB::table('notes')->delete();


        $notes = array(
            array(
                'user_id'      => '2',
                'author_id'      => '1',
                'notes'   => 'Test Text 1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'user_id'      => '1',
                'author_id'      => '1',
                'notes'   => 'Test Text 2',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            )
        );

        DB::table('notes')->insert( $notes );
    }

}
