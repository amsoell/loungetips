<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Tip;
use App\User;

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
			$sqlx = "SELECT id, username, password, email, registered, num_posts FROM talk_users";
			$res = $dbh->query($sqlx);

			$user_post_count = [];
			while ($row = $res->fetch_assoc()) {
				$user             = new User();
				$user->id         = $row['id'];
				$user->name       = $row['username'];
				$user->password   = $row['password'];
				$user->email      = $row['email'];
				$user->setCreatedAt($row['registered']);
				$user->setUpdatedAt($row['registered']);
				$user->save();

				$user_post_count[$row['id']] = $row['num_posts'];
			}

			$sqlx = "SELECT id, tip, description, entered, useragent, remoteaddr FROM tips";
			$res = $dbh->query($sqlx);

			while ($row = $res->fetch_assoc()) {
				$tip              = new Tip();
				$tip->id          = $row['id'];
				$tip->tip         = $row['tip'];
				$tip->description = $row['description'];
				$tip->remoteaddr  = $row['remoteaddr'];
				$tip->useragent   = $row['useragent'];
				$tip->setCreatedAt($row['entered']);
				$tip->setUpdatedAt($row['entered']);

				$tip->save();
			}

			foreach ($user_post_count as $key => $posts) {
				$tips = Tip::doesntHave('user')->orderBy('id')->limit($posts)->update([ 'user_id' => $key ]);
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
