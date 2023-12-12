
<div style="position: absolute; top: 45%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
    <!-- Search Input Section -->
    {{-- <div style="margin-bottom: 20px;">
        <input wire:model.live="search" type="text" name=search placeholder="search.." wire:keydown.escape=""
            style="padding: 5px; width: 200px;">
    </div> --}}
    <div>
        <form wire:submit="search">
            <input type="search" name="search" wire:model.live="search">
     
            {{-- <button type="submit">Search </button> --}}
        </form>
    </div>

    <!-- Search Results Section -->
    @if (!empty($search))
        @if (!empty($cvs))
            <ul style="list-style-type: none; padding: 0;">
                @foreach ($cvs as $cv)
                    <li style="border: 1px solid #ccc; margin-bottom: 10px; padding: 10px;">
                        <strong>Name:{{ $cv->name }}</strong><br>
                        <strong>Technology:{{ $cv->technology }}</strong><br>
                        {{-- <strong>Status:{{ $cv->name }}</strong><br> --}}
                        <strong>Email:{{ $cv->email }}</strong>

                        <div>
                            <button onclick="window.location.href='cv_status/edit/{{ $cv->id }}'">
                                Edit
                            </button>
                            <button onclick="window.location.href='cv_status/delete/{{ $cv->id }}'">
                                Delete
                            </button>
                            <button
                                onclick="window.location.href='{{ route('user_cv.showusers', ['id' => $cv->id]) }}'">
                                view
                            </button>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="m-5">NO RESULTS.. </p>

        @endif

    @endif
</div>



