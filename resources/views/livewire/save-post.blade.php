<div wire:poll.visible>
    @if (strpos(Auth::user()->save_post, $postId))
        <button wire:click="savepost({{$postId}})">
            <i class="bi bi-bookmark-fill fa-xl pe-2"></i>
        </button>
    @else
        <button wire:click="savepost({{$postId}})">
            <i class="bi bi-bookmark fa-xl pe-2"></i>
        </button>
    @endif
</div>
