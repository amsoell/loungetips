<?php

namespace App\Policies\Forum;

class ForumPolicy extends \Riari\Forum\Policies\ForumPolicy {
	public function isAdmin($user) {
		return $user->id==1;
	}

	public function createCategories($user) {
		return $this->isAdmin($user);
	}

	public function manageCategories($user) {
		return $this->isAdmin($user);
	}

	public function moveCategories($user) {
		return $this->isAdmin($user);
	}

	public function renameCategories($user) {
		return $this->isAdmin($user);
	}

	public function markNewThreadsAsRead($user) {
		return $this->isAdmin($user);
	}

	public function viewTrashedThreads($user) {
		return $this->isAdmin($user);
	}

	public function viewTrashedPosts($user) {
		return $this->isAdmin($user);
	}
}
