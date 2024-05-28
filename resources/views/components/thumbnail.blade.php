@php
if($type === 'images'){
  $path = 'storage/images/';
}
if($type === 'products'){
  $path = 'storage/products/';
}

@endphp

<div class="userImgPreview" id="userImgPreview">
  @if(empty($filename))
    <img id="thumbnail" src="{{ asset('images/avatar-default.svg')}}">
  @else
    <img id="thumbnail" src="{{ asset($path . $filename)}}">
  @endif
</div>
