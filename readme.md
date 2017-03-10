# LoungeTips

LoungeTips is a community site for fans of the radio stations [CD102.5](https://cd1025.com) to discus the station, their favorite music and DJs, and most importantly share "lounge tips," the words shared on-air that listeners can enter into the web site in exchange for points.

The first version of this site was built nearly eight years ago in 24 hours. It was originall built on some shaky PHP and a punBB forum installation, and frankly I'm amazed it ran as well as it did for as long as it did. All good things must be refactored with modern technology, though, so we took _another_ 24 hours to rebuild the site using the [Laravel](https://laravel.com) framework and [Rick Mann's](https://github.com/Riari) [laravel-form](http://github.com/Riari/laravel-forum) package.

Some notes about this build that you might find interesting:

* There's a migration script in place that moves content from the old version 1 site into the new architecture. This involved moving several hundred users accounts, 3,000 forum posts, 12,000 shared tips, and 200,000 report instances
* Because a login is not required, much of the authentication that happens in this site is based on IP address. Laravel Policies are an ideal solution for access control on most sites, but we had to make do with in-controller IP address checks in order ot allow guest users to participate
