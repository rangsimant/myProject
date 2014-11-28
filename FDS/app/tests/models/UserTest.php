<?php

use Mockery as m;

class UserTest extends TestCase {

    public function testGetUserByUsername()
    {
        $user = new User();
        $user = $user->getUserByUsername( 'admin' );
        $this->assertEquals( 'admin' , $user->username);
    }

    public function testGetUserByWrongUsername()
    {
    	$user = new User();
        $user = $user->getUserByUsername( 'wrong' );
        $this->assertNull( $user );
    }

    public function testSaveRoles()
    {
    	$user = new User();
    	$user = $user->saveRoles('testRole1','testRole2');
    	var_dump($user);
    }
}