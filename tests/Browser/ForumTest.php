<?php

namespace Tests\Browser;

use App\User;
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
		// Create 5 users
		factory(User::class, 5)->create();

		// Create 5 categories...
		// ...with 3 threads each...
		// ...with 4 messages each.
		factory(\Riari\Forum\Models\Category::class, 5)->create()->each(function ($category) {
			factory(\Riari\Forum\Models\Thread::class, 3)->create([
				'category_id' => $category->id,
				'author_id'   => User::inRandomOrder()->first()->id,
			])->each(function ($thread) {
				$post = factory(\Riari\Forum\Models\Post::class, 4)->create([
					'author_id' => User::inRandomOrder()->first()->id,
					'thread_id' => $thread->id,
					'sequence' => 1,
				]);
			});
		});
	}

}
