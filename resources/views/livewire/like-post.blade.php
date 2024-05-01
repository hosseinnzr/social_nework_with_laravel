
<div style="text-align: center">
    <button wire:click="like({{$post}})">+</button>
    <h1>{{ $post['like_number'] }}</h1>
</div>