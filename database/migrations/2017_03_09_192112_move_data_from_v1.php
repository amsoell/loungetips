<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Report;
use App\Tip;
use App\User;
use Riari\Forum\Models\Category;
use Riari\Forum\Models\Thread;
use Riari\Forum\Models\Post;

class MoveDataFromV1 extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		if (env('DB_MIGRATE', false)) {
			$dbh = new mysqli(env('DB_MIGRATE'), 'db170824', 'sh0esusing', 'db170824_loungetips');

			/**
			 * Import Users
			 */
			$sqlx = "SELECT id, username, password, salt, email, registered, num_posts FROM talk_users";
			$res = $dbh->query($sqlx);

			$user_post_count = [];
			while ($row = $res->fetch_assoc()) {
				$user            = new User();
				$user->id        = $row['id'];
				$user->name      = $row['username'];
				$user->password  = $row['password'];
				$user->opassword = $row['password'];
				$user->osalt     = $row['salt'];
				$user->email     = $row['email'];
				$user->setCreatedAt($row['registered']);
				$user->setUpdatedAt($row['registered']);
				$user->save();

				$user_post_count[$row['id']] = $row['num_posts'];
			}

			/**
			 * Importing Tips
			 */
			$sqlx = "SELECT id, tip, description, entered, useragent, remoteaddr, user FROM tips";
			$res = $dbh->query($sqlx);

			while ($row = $res->fetch_assoc()) {
				$tip              = new Tip();
				$tip->id          = $row['id'];
				$tip->tip         = $row['tip'];
				$tip->description = $row['description'];
				$tip->remoteaddr  = $row['remoteaddr'];
				$tip->useragent   = $row['useragent'];
				$tip->user_id     = $row['user'];
				$tip->setCreatedAt($row['entered']);
				$tip->setUpdatedAt($row['entered']);

				$tip->save();
			}

			/**
			 * Importing Forum Forums (?? I know)
			 */
			$sqlx = "SELECT id, forum_name, disp_position, cat_id FROM talk_forums";
			$res = $dbh->query($sqlx);

			while ($row = $res->fetch_assoc()) {
				$category                 = new Category();
				$category->id             = $row['id'];
				$category->title          = $row['forum_name'];
				$category->weight         = $row['disp_position'];
				$category->enable_threads = 1;

				$category->save();
			}

			/**
			 * Importing Forum Topics
			 */
			$sqlx = "SELECT id, subject, posted, last_post, forum_id, poster, num_replies FROM talk_topics";
			$res = $dbh->query($sqlx);

			while ($row = $res->fetch_assoc()) {
				$thread              = new Thread();
				$thread->id          = $row['id'];
				$thread->category_id = $row['forum_id'];
				$thread->author_id   = User::where('name', $row['poster'])->first()->id;
				$thread->title       = $row['subject'];
				$thread->reply_count = $row['num_replies'];
				$thread->setCreatedAt($row['posted']);
				$thread->setUpdatedAt($row['last_post']);

				$thread->save();
			}

			/**
			 * Importing Forum Posts
			 */
			$sqlx = "SELECT id, poster_id, message, posted, topic_id FROM talk_posts";
			$res = $dbh->query($sqlx);

			while ($row = $res->fetch_assoc()) {
				$post            = new Post();
				$post->id        = $row['id'];
				$post->thread_id = $row['topic_id'];
				$post->author_id = $row['poster_id'];
				$post->content   = mb_convert_encoding($row['message'], 'UTF-8');
				$post->setCreatedAt($row['posted']);
				$post->setUpdatedAt($row['posted']);

				$post->save();
			}

			/**
			 * Importing Tip Reports
			 */
			$sqlx = "SELECT id, remoteaddr, reported, report FROM report";
			$res = $dbh->query($sqlx);

			while ($row = $res->fetch_assoc()) {
				if (Tip::find($row['id'])) {
					$report             = new Report();
					$report->tip_id     = $row['id'];
					$report->report     = $row['report'];
					$report->remoteaddr = $row['remoteaddr'];
					$report->setCreatedAt($row['reported']);
					$report->setUpdatedAt($row['reported']);

					$report->save();
				}
			}
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}
}
