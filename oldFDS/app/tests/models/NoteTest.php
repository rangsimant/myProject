<?php

use Mockery as m;
use Woodling\Woodling;

class NoteTest extends TestCase {


	public function testGetNoteByUserID()
	{
		$user_id = 1;
		$note = Note::getNote($user_id);
		$this->assertEquals( count($note), 1);
	}

	public function testGetNoteByEmptyUserID()
	{
		$user_id = "";
		$note = Note::getNote($user_id);
		$this->assertNotEquals( count($note), 1);
	}

}