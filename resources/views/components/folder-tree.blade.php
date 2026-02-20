{{-- resources/views/components/folder-tree.blade.php --}}
<ul>
    @foreach ($folders as $folder)
        <li>
            <strong>{{ $folder->name }}</strong>

            {{-- List files in this folder --}}
            @if($folder->files->count())
                <ul>
                    @foreach ($folder->files as $file)
                        <li>{{ $file->name }}</li>
                    @endforeach
                </ul>
            @endif

            {{-- Recurse into children folders --}}
            @if($folder->children->count())
                <x-folder-tree :folders="$folder->children" />
            @endif
        </li>
    @endforeach
</ul>