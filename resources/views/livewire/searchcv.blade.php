<div style="position: absolute; top: 45%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
    <div>
        <form wire:submit="search">
            <input type="search" name="search" wire:model.live="search">
        </form>
    </div>

    <!-- Search Results Section -->
        @if (!empty($cvs))
            <ul style="list-style-type: none; padding: 0;">
                @foreach ($cvs as $cv)
                    <li style="border: 1px solid #ccc; margin-bottom: 10px; padding: 10px;">
                        <strong>Name:{{ $cv->name }}</strong><br>
                        <strong>Technology:{{ $cv->technology }}</strong><br>
                        <strong>Status:{{ $cv->cvStatus->status }}</strong><br>
                        <strong>Email:{{ $cv->email }}</strong>

                        <div>
                            <button onclick="window.location.href='cv_status/edit/{{ $cv->id }}'">
                              Change CV-status ||
                            </button>
                            <button onclick="window.location.href='cv_status/delete/{{ $cv->id }}'">
                                Delete ||
                            </button>
                            <button onclick="window.location.href='{{ route('user_cv.showusers', ['id' => $cv->id]) }}'">
                                view
                            </button>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p >NO RESULTS.. </p>
        @endif

</div>
