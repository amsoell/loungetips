<?php

namespace App\Policies\Forum;

use Riari\Forum\Models\Category;

class CategoryPolicy extends \Riari\Forum\Policies\CategoryPolicy {
    public function isAdmin($user) {
        return ends_with($user->email, '@loungetips.com');
    }

    public function createThreads($user, Category $category) {
        return ($user->tips->count() > 0);
    }

    public function manageThreads($user, Category $category) {
        return $this->isAdmin($user);
    }

    public function deleteThreads($user, Category $category) {
        return $this->isAdmin($user);
    }

    public function enableThreads($user, Category $category) {
        return $this->isAdmin($user);
    }

    public function moveThreadsFrom($user, Category $category) {
        return $this->isAdmin($user);
    }

    public function moveThreadsTo($user, Category $category) {
        return $this->isAdmin($user);
    }

    public function lockThreads($user, Category $category) {
        return $this->isAdmin($user);
    }

    public function pinThreads($user, Category $category) {
        return $this->isAdmin($user);
    }

    public function view($user, Category $category) {
        return true;
    }

    public function delete($user, Category $category) {
        return $this->isAdmin($user);
    }
}
