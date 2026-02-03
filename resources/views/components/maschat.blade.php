@props(['maschat'])

<div class="card bg-base-100 shadow">
    <div class="card-body">
        <div class="flex space-x-3">
            @if($maschat->user)
                <div class="avatar">
                    <div class="size-10 rounded-full">
                        <img src="https://avatars.laravel.cloud/{{ urlencode($maschat->user->email) }}"
                             alt="{{ $maschat->user->name }}'s avatar"
                             class="rounded-full" />
                    </div>
                </div>
            @else
                <div class="avatar placeholder">
                    <div class="size-10 rounded-full">
                        <img src="https://avatars.laravel.cloud/f61123d5-0b27-434c-a4ae-c653c7fc9ed6?vibe=stealth"
                        alt="Anonymous User"
                        class="rounded-full" />
                    </div>
                </div>
            @endif

            <div class="min-w-0 flex-1">
                <div class="flex justify-between w-full">
                    <div class="flex items-center gap-1">
                        <span class="text-sm font-semibold">{{ $maschat->user ? $maschat->user->name : 'Anonymous' }}</span>
                        <span class="text-base-content/60">·</span>
                        <span class="text-sm text-base-content/60">{{ $maschat->created_at->diffForHumans() }}</span>
                        @if ($maschat->updated_at->gt($maschat->created_at->addSeconds(5)))
                            <span class="text-base-content/60">-</span>
                            <span class="text-sm italic text-red-500">edited</span>
                        @endif
                    </div>
 
                    @can('update', $maschat)
                      <div class="flex gap-1">
                          <a href="/maschats/{{ $maschat->id }}/edit" class="btn btn-ghost btn-xs">
                              Edit
                          </a>
                          <form method="POST" action="/maschats/{{ $maschat->id }}">
                              @csrf
                              @method('DELETE')
                              <button type="submit"
                                  onclick="return confirm('Are you sure you want to delete this maschat?')"
                                  class="btn btn-xs text-error">
                                  Delete
                              </button>
                          </form>
                      </div>
                    @endcan
                </div>
                <p class="mt-1">{{ $maschat->message }}</p>
            </div>
        </div>
    </div>
</div>