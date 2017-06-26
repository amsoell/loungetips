<?php

namespace Tests\Browser;

use App\User;
use Faker\Factory as Faker;
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

	public function testUserNoTipsPost() {
		$this->populateForum();
		$this->browse(function (Browser $browser) {
			$faker = Faker::create();

			$browser->loginAs(User::inRandomOrder()->first())
				->visit('/talk');
			$forum_category = $browser->text('table .category ~ tr .lead a');
			$forum_category_url = $browser->attribute('table .category ~ tr .lead a', 'href');

			$browser->clickLink($forum_category)
				->assertDontSee('New thread');

			$browser->visit($forum_category_url.'/thread/create')
				->type('title', $faker->words(4, true))
				->type('content', $faker->sentences(3))
				->press('Create')
				->assertSee('HttpException');
		});
	}

	public function testUserOneTipPost() {
		$this->populateForum();

		$user = User::inRandomOrder()->first();
		factory(\App\Tip::class)->create([
			'user_id' => $user->id
		]);

		$this->browse(function (Browser $browser) use ($user) {
			$faker = Faker::create();

			$browser->loginAs($user)
				->visit('/talk');
			$forum_category = $browser->text('table .category ~ tr .lead a');
			$forum_category_url = $browser->attribute('table .category ~ tr .lead a', 'href');

			$subject = $faker->words(4, true);

			$browser->clickLink($forum_category)
				->assertSee('New thread')
				->clickLink('New thread')
				->type('title', $subject)
				->type('content', $faker->sentences(3))
				->press('Create')
				->assertSee($subject);
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
