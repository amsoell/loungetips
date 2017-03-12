<tr>
    <td {{ $category->threadsEnabled ? '' : 'colspan=5' }}>
        <p class="{{ isset($titleClass) ? $titleClass : '' }}"><a href="{{ Forum::route('category.show', $category) }}">{{ $category->title }}</a></p>
        <span class="text-muted">{{ $category->description }}</span>
    </td>
    @if ($category->threadsEnabled)
        <td>{{ $category->thread_count }}</td>
        <td>{{ $category->post_count }}</td>
        <td>
            @if ($category->latestActiveThread)
                <a href="{{ Forum::route('thread.show', $category->latestActiveThread->lastPost) }}">
                    {{ $category->latestActiveThread->title }}
                </a><br />
                {{ $category->latestActiveThread->lastPost->created_at->diffForHumans() }}<br />
                <a href="{{ route('user.profile', $category->latestActiveThread->lastPost->author) }}">{{ $category->latestActiveThread->lastPost->authorName }}</a>
            @endif
        </td>
    @endif
</tr>
