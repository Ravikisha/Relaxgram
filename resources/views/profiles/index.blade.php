@extends('layouts.app')

@section('content')
<div class="flex flex-col sm:items-center py-10 pb-20  lg:items-center">
    <div class="lg:w-[80%]">
        <div class="flex gap-5 sm:justify-start sm:gap-20 pb-10 px-6 sm:px-10 w-full">
            <div>
                @if ($user->stories->count() > 0)
                    <a href="/stories/{{ $user->username }}">
                        <img src="{{ asset($user->profile->getProfileImage()) }}" class="border-linear rounded-full max-w-[100px] sm:max-w-[150px]">
                    </a>
                @else
                    <img src="{{ asset($user->profile->getProfileImage()) }}"
                        class="rounded-full max-w-[100px] sm:max-w-[150px]">
                @endif
            </div>

            <div class="flex flex-col justify-center sm:gap-3">
                <div class="flex flex-col sm:flex-row items-center">
                    <h1 class="text-base sm:text-lg font-semibold">{{ $user->username }}</h1>

                    @can('update', $user->profile)
                        <a class="cursor-pointer text-sm sm:ml-8 px-6 my-[0.4rem] py-[0.3rem] sm:py-[0.6rem] bg-gray-100 no-underline hover:font-semibold transition-all"
                            href="/profile/{{ $user->username }}/edit" role="button">
                            Edit Profile
                        </a>
                    @else
                        <follow-button user-id="{{ $user->username }}" follows="{{ $follows }}"></follow-button>
                    @endcan

                </div>

                <div class="sm:flex gap-8 hidden">
                    <div> <strong> {{ $postCount }} </strong> posts</div>
                    <div> <strong> {{ $followersCount }} </strong> followers</div>
                    <div> <strong> {{ $followingCount }} </strong> following</div>
                </div>

                <div class="sm:block">
                    <div class="hidden sm:inline-block font-semibold">{{ $user->name }}</div>
                    <span class="font-light">
                        &nbsp;&nbsp;{!! nl2br(e($user->profile->bio)) !!}
                    </span>
                </div>

                <div class="font-weight-bold">
                    <a href="{{ $user->profile->website }}" target="_blanc">
                        {{ $user->profile->website }}
                    </a>
                </div>

            </div>

        </div>

        <div class="flex justify-center py-2 border-t gap-8 sm:hidden">
            <div> <strong> {{ $postCount }} </strong> posts</div>
            <div> <strong> {{ $followersCount }} </strong> followers</div>
            <div> <strong> {{ $followingCount }} </strong> following</div>
        </div>

        <div class="pt-4 grid sm:grid-cols-2 md:grid-cols-3 justify-center gap-3 border-top">

            @forelse ($user->posts as $post)
                <div class="px-2">
                    <a class="relative min-h-[300px] w-[300px] h-[300px] sm:h-[300px] sm:w-[300px]" href="/p/{{ $post->id }}">
                        <img class="object-cover w-full h-full" src="{{ asset("storage/$post->image") }}">
                        <div
                            class="absolute group inset-0 transtion-all bg-black bg-opacity-0 hover:bg-opacity-30 flex justify-center items-center gap-3">
                            <span class="hidden group-hover:block like text-white flex items-center gap-2">
                                <i class="fa fa-heart fa-2x"></i>
                                <p>{{ count($post->like->where('State', true)) }}</p>
                            </span>

                            <span class="hidden group-hover:block comment text-white flex items-center gap-2">
                                <i class="far fa-comment fa-2x"></i>
                                <p>{{ count($post->comments) }}</p>
                            </span>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 d-flex justify-content-center text-muted">
                    <div class="card border-0 text-center bg-transparent">
                        <img src="{{ asset('img/noimage.png') }}" class="card-img-top" alt="...">
                        <div class="card-body ">
                            <h1>No Posts Yet</h1>
                        </div>
                    </div>
                </div>
            @endforelse

        </div>

    </div>

</div>

@endsection
