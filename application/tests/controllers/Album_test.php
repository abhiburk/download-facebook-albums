<?php
/**
 * Part of ci-phpunit-test
 */

class Album_test extends TestCase
{
	public function test_set_session()
	{
		$output = $this->request('GET', 'callback/set_session');
		$this->assertContains('Data is not set.', $output);
	}

	public function test_get_session()
	{
		$output = $this->request('GET', 'callback/get_session');
		$this->assertContains('Session not available', $output);
	}
	
	public function test_delete_session(){
		$output = $this->request('GET', 'home/logout');
		$this->assertContains('Sessions Destroyed', $output);
	}

	public function test_download_album_list(){
		$output = $this->request('GET', 'unittest/album_list');
		$this->assertContains('Session not available for album', $output);
	}

	public function selected_album(){
		$output = $this->request('GET', 'unittest/album_list');
		$this->assertContains('False', $output);
	}

	public function test_method_404()
	{
		$this->request('GET', 'callback/method_not_exist');
		$this->assertResponseCode(404);
	}

	
	public function test_APPPATH()
	{
		$actual = realpath(APPPATH);
		$expected = realpath(__DIR__ . '/../..');
		$this->assertEquals(
			$expected,
			$actual,
			'Your APPPATH seems to be wrong. Check your $application_folder in tests/Bootstrap.php'
		);
	}
}
