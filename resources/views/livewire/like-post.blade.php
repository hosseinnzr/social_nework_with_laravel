<div wire:poll.visible style="text-align: center">
    @if (in_array(Auth::id(), explode(",", $post['like'])))
        <button style="color:red; font-size: 15px" wire:click="like({{$post}})"><i class="bi bi-heart-fill fa-lg pe-1"></i> {{ $post['like_number'] }} </button>
    @else
        <button  wire:click="like({{$post}})"><i class="bi bi-heart fa-lg pe-1"></i> {{ $post['like_number'] }} </button>
    @endif
</div>