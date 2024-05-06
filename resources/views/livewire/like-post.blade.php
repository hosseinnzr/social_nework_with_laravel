<div wire:poll.visible style="text-align: center">
    @if (in_array(Auth::id(), explode(",", $post['like'])))

        <button style="color:red" wire:click="like({{$post}})"><i class="bi bi-heart-fill pe-1"></i>liked ( {{ $post['like_number'] }} )</button>
    @else
        <button  wire:click="like({{$post}})"><i class="bi bi-heart-fill pe-1"></i>like ( {{ $post['like_number'] }} )</button>
    @endif
</div>