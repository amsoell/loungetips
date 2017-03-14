<?php

namespace App\Policies\Forum;

use Riari\Forum\Models\Thread;

class ThreadPolicy extends \Riari\Forum\Policies\ThreadPolicy {

	public function isAdmin($user) {
		return ends_with($user->email, '@loungetips.com');
	}

	public function deletePosts($user, Thread $thread) {
		return $this->isAdmin($user);
	}

	public function rename($user, Thread $thread) {
		return $user->getKey() === $thread->author_id;
	}

	public function reply($user, Thread $thread) {
		return !($thread->locked || $user->tips->count()<1);
	}

	public function delete($user, Thread $thread) {
		return Gate::allows('deleteThreads', $thread->category) || $user->getKey() === $thread->author_id;
	}
}
