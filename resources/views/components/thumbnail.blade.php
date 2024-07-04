@php
if($type === 'images'){
  $path = 'storage/images/';
}
if($type === 'textbooks'){
  $path = 'storage/textbooks/';
}

@endphp

<div class="c-thumbnail" id="userImgPreview">
  @if(empty($filename))
    @if ($type === 'images')
        <img class="c-thumbnail-avatar" id="thumbnail" src="{{ asset('images/avatar-default.svg')}}">
    @else
        <img class="c-thumbnail-no_image" id="thumbnail" src="{{ asset('images/no_image.jpg')}}">
    @endif
  @else
    <img id="thumbnail" src="{{ asset($path . $filename)}}">
  @endif
</div>
