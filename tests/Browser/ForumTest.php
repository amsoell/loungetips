<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class _ForumTest extends DuskTestCase
{

	use DatabaseMigrations;

	public function testAnonymousRead() {
		$this->populateForum();
		$this->browse(function (Browser $browser) {
			$browser->visit('/talk')
					->assertVisible('table .category ~ tr .lead a');
			$forum_category = $browser->text('table .category ~ tr .lead a');

			$browser->clickLink($forum_category)
					->assertVisible('table p.lead a');
			$forum_thread = $browser->text('table p.lead a');

			$browser->clickLink($forum_thread)
					->assertSee("Want to join in the conversation? Give us a good tip and then we'll talk.");
		});
	}

	public function populateForum() {
		$user = factory(\App\User::class)->create();
		$category = factory(\Riari\Forum\Models\Category::class)->create();

		for ($j=0; $j<3; $j++) {
			$thread = factory(\Riari\Forum\Models\Thread::class)->make();
			$thread->author()->associate($user);
			$thread->category()->associate($category);
			$thread->save();

			for ($i=0; $i < 5; $i++) {
				$post = factory(\Riari\Forum\Models\Post::class)->make();
				$post->unsetEventDispatcher(); // To prevent the sequence from being set

				$post->author()->associate($user);
				$post->thread()->associate($thread);
				$post->sequence = 1;
				$post->save();
			}
		}
	}

}
