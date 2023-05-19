    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">

                @foreach ($posts as $post)
                    <!-- Post preview-->
                    <div class="post-preview">
                        <a href="/post/{{ $post->slug }}">
                            <h2 class="post-title">{{ $post->title }}</h2>
                            <h3 class="post-subtitle">{{ $post->description }}</h3>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <strong>{{ \App\Models\User::find($post->user_id)->name }}</strong>
                            on {{ date('m d, y', strtotime($post->published_at)) }}
                        </p>

                        @if (Auth::check())
                            <div class="del-buttons">
                                @if ($post->user_id == auth()->user()->id || auth()->user()->is_admin)
                                    <form action="{{ route('del_post.perform', $post->id) }}" class="del-post"
                                        method="POST">
                                        @csrf

                                        <button>DELETE</button>
                                    </form>
                                @endif

                                @if (auth()->user()->is_admin && $post->user_id != auth()->user()->id)
                                    <form action="{{ route('del_post_user.perform', $post->id) }}" class="del-user"
                                        method="POST">
                                        @csrf

                                        <button>DELETE USER</button>
                                    </form>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- Divider-->
                    <hr class="my-4" />
                @endforeach

                @if ($pagination_enabled)
                    <div class="pagination">
                        @if (request()->get('page') > 1)
                            <a href="?page={{ request()->get('page') - 1 }}">Previous page</a>
                        @endif
                        <a href="?page={{ (request()->get('page') ?? 1) + 1 }}">Next page</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
