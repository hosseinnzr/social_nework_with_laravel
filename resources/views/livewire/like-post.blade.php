
<div style="text-align: center">
    <button wire:click="like({{$post}})"><i class="bi bi-heart pe-1"></i>like</button>
     ( {{ $post['like_number'] }} )
</div>