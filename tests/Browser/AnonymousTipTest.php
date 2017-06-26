<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AnonymousTipTest extends DuskTestCase
{

	use DatabaseMigrations;
	use DatabaseTransactions;

	public function testFrontPage() {
		$this->browse(function (Browser $browser) {
			$browser->visit('/')
					->assertSee('Got a tip? Share it!');
		});
	}

	public function testAnonymousTipEntry() {
		// Submit a tip successfully
		$this->browse(function (Browser $browser) {
			$browser->visit('/')
				->select('description', '10am')
				->type('tip', 'test')
				->press('Share')
				->assertSee('Your 10am tip is test');
		});

		// Submit a vote successfully
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
