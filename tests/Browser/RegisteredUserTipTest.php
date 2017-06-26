<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisteredUserTipTest extends DuskTestCase
{

	use DatabaseMigrations;
	use DatabaseTransactions;

	public function testFrontPage() {
		$this->browse(function (Browser $browser) {
			$browser->visit('/')
					->assertSee('Got a tip? Share it!');
		});
	}

	public function testUserTipEntry() {
		// Register new user account
		$this->browse(function (Browser $browser) {
			$browser->visit('/register')
				->assertVisible('form')
				->type('name', 'testUser')
				->type('email', 'test@test.com')
				->type('password', 'supersecret')
				->type('password_confirmation', 'supersecret')
				->press('Register')
				->assertSee('testUser');
		});

		// Submit a tip as user
		$this->browse(function (Browser $browser) {
			$browser->visit('/')
				->select('description', '10am')
				->type('tip', 'test')
				->press('Share')
				->assertSee('Your 10am tip is test')
				->assertSee('Shared by testUser');
		});

		// Submit a user vote successfully
		$this->browse(function (Browser $browser, Browser $guestBrowser) {
			$browser->visit('/')
				->assertVisible('.fa-thumbs-up')
				->press('.fa-thumbs-up')
				->assertSee('Thank you for reporting!');

			// User can't vote twice
			$guestBrowser->visit('/')
				->assertMissing('.fa-thumbs-up');
		});
	}
}
