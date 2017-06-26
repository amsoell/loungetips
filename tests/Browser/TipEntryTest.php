<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TipEntryTest extends DuskTestCase
{

	use DatabaseMigrations;

	public function testFrontPage() {
		$this->browse(function (Browser $browser) {
			$browser->visit('/')
					->assertSee('Got a tip? Share it!');
		});
	}

	public function testAnonymousTipEntry() {
		$this->browse(function (Browser $browser) {
			$browser->visit('/')
				->select('description', '10am')
				->type('tip', 'test')
				->press('Share')
				->assertSee('Thank you for sharing!');
		});
	}
}
