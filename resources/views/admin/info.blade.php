<style>
    .user-panel img {
        height: 40px;
        width: 50px;
    }
</style>
@php
    $name = auth()->user()->name;
    $avatar = auth()->user()->avatar;
@endphp
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
    <img src="{{ $avatar }}" class="img-circle brand-image elevation-2" alt="User Image">
    </div>
    <div class="info">
    <a class="d-block">{{ $name }}</a>
    </div>
</div>
