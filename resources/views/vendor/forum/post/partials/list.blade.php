<tr id="post-{{ $post->sequence }}" class="{{ $post->trashed() ? 'deleted' : '' }}" class="post-body">
    <td class="author-info">
        <a href="{{ route('user.profile', $post->author) }}">
            <strong>{!! $post->authorName !!}</strong><br />
            <img src="//www.gravatar.com/avatar/{{ md5($post->author->email) }}?d=retro" />
        </a><br />
        <em>{{ $post->author->rank }}</em><br />
        Tips shared: {{ $post->author->tips->count() }}
    </td>
    <td class="content">
        @if (!is_null($post->parent))
            <p>
                <strong>
                    <a href="{{ route('user.profile', $post->parent->author) }}">{{ trans('forum::general.response_to', ['item' => $post->parent->authorName]) }}</a>
                    (<a href="{{ Forum::route('post.show', $post->parent) }}">{{ trans('forum::posts.view') }}</a>):
                </strong>
            </p>
            <blockquote>
                {!! str_limit((new \Golonka\BBCode\BBCodeParser)->parse(Forum::render($post->parent->content))) !!}
            </blockquote>
        @endif

        @if ($post->trashed())
            <span class="label label-danger">{{ trans('forum::general.deleted') }}</span>
        @else
            {!! (new \Golonka\BBCode\BBCodeParser)->parse(Forum::render($post->content)) !!}
        @endif
        <br /><br />
        <div class="row">
            <div class="col-xs-12">
                <span class="pull-right">
                    <a href="{{ Forum::route('thread.show', $post) }}">#{{ $post->sequence }}</a> -
                    @if (!$post->trashed())
                        @can ('edit', $post)
                            <a href="{{ Forum::route('post.edit', $post) }}">{{ trans('forum::general.edit') }}</a> -
                        @endcan
                    @endif
                    {{ trans('forum::general.posted') }} {{ $post->posted }} -
                    @if ($post->hasBeenUpdated())
                        {{ trans('forum::general.last_updated') }} {{ $post->updated }} -
                    @endif

                    @if (!$post->trashed())
                        @can ('reply', $post->thread)
                            <a href="{{ Forum::route('post.create', $post) }}">{{ trans('forum::general.reply') }}</a> -
                        @endcan
                    @endif
                    @if (Request::fullUrl() != Forum::route('post.show', $post))
                        <a href="{{ Forum::route('post.show', $post) }}">{{ trans('forum::posts.view') }}</a>
                    @endif
                    @if (isset($thread))
                        @can ('deletePosts', $thread)
                            @if (!$post->isFirst)
                                <input type="checkbox" name="items[]" value="{{ $post->id }}">
                            @endif
                        @endcan
                    @endif
                </span>
            </div>
        </div>
    </td>
</tr>
