
@foreach ($mediaFiles as $mediaFile)
    <div class="avatar avatar-xl selected-file">
        <img class="rounded-circle border" src="{{ urlVersion($mediaFile->media_file) }}" alt="">
        <span class="tt-remove" onclick="removeSelectedFile(this, {{ $mediaFile->id }})"><i
                data-feather="trash"></i></span>
    </div>
@endforeach

