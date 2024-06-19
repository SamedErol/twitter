<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Twitter markup</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/blocks/layout.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/blocks/brand.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/blocks/sidebar-menu.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/blocks/tweet.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/blocks/trend-for-you.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/blocks/who-to-follow.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    .tweet-input-container {
        display: flex;
        align-items: center;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        width: 100%;
        background-color: #f5f5f5;
    }

    .tweet-input {
        flex: 1;
        font-size: 16px;
        padding: 5px;
        border: none;
        outline: none;
        resize: none;
    }

    .tweet-input:focus {
        box-shadow: 0 0 0 2px #007bff;
    }

    .tweet-button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
    }
</style>

<body>
    <div class="layout">
        <div class="layout__left-sidebar">
            <div class="sidebar-menu">
                <img src="./svg/twitter.svg" class="twitter__logo" />
                <div class="sidebar-menu__item sidebar-menu__item--active">
                    <img src="./svg/home.svg" class="sidebar-menu__item-icon" />
                    Home
                </div>
                <div class="sidebar-menu__item">
                    <img src="./svg/explore.svg" class="sidebar-menu__item-icon" />
                    Explore
                </div>

                <div class="sidebar-menu__item">
                    <img src="./svg/notifications.svg" class="sidebar-menu__item-icon" />
                    Notifications
                </div>

                <div class="sidebar-menu__item">
                    <img src="./svg/messages.svg" class="sidebar-menu__item-icon" />
                    Messages
                </div>

                <div class="sidebar-menu__item">
                    <img src="./svg/profile.svg" class="sidebar-menu__item-icon" />
                    Profile
                </div>

                <div class="sidebar-menu__item">
                    <img src="./svg/more.svg" class="sidebar-menu__item-icon" />
                    More
                </div>

                <div class="sidebar-menu__item">
                    <img src="./svg/logout.svg" class="sidebar-menu__item-icon">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="reset-button">{{ __('Log Out') }}</button>
                    </form>
                </div>

                <div class="sidebar-menu__item">
                    <img src="./img/profile.jpg" class="tweet__author-logo">
                    {{ auth()->user()->name }}
                </div>

            </div>
        </div>
        <div class="layout__main">


            <!-- Tweet atma bölümü -->
            <div>
                <div>
                    <div class="col-md-12">
                        <!-- Tweet formu -->
                        <div class="card" style="border: none">
                            <div class="card-header" style="border: none">Tweet something</div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <div>
                                        <img class="tweet__author-logo" src="./img/profile.jpg" />
                                    </div>

                                    <div class="w-100">
                                        <form method="POST" action="{{ route('tweets.store') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <textarea id="autoResizeTextarea" style="resize: none;border:none; overflow-y:hidden" name="content"
                                                    class="tweet-textarea @error('content') is-invalid @enderror" rows="1" placeholder="What's happening?"
                                                    required></textarea>
                                                @error('content')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="container mt-5">

                                                <!-- Görünmez input elementi -->
                                                <div class="stuff-box-tweet">
                                                    <!-- SVG İkonlu Buton -->
                                                    <input type="file" name="images[]" multiple id="imageInput"
                                                        style="display: none"
                                                        class="form-control @error('images') is-invalid @enderror">
                                                    @error('images')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <button class="svg-image" type="button" id="uploadButton">
                                                        <!-- SVG İkonu -->
                                                        <svg viewBox="0 0 24 24" width="30" aria-hidden="true">
                                                            <path
                                                                d="M3 5.5C3 4.119 4.119 3 5.5 3h13C19.881 3 21 4.119 21 5.5v13c0 1.381-1.119 2.5-2.5 2.5h-13C4.119 21 3 19.881 3 18.5v-13zM5.5 5c-.276 0-.5.224-.5.5v9.086l3-3 3 3 5-5 3 3V5.5c0-.276-.224-.5-.5-.5h-13zM19 15.414l-3-3-5 5-3-3-3 3V18.5c0 .276.224.5.5.5h13c.276 0 .5-.224.5-.5v-3.086zM9.75 7C8.784 7 8 7.784 8 8.75s.784 1.75 1.75 1.75 1.75-.784 1.75-1.75S10.716 7 9.75 7z">
                                                            </path>
                                                        </svg>
                                                    </button>

                                                    <button type="submit" class="btn btn-primary mt-3">Tweet</button>
                                                </div>
                                            </div>


                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            document.getElementById('uploadButton').addEventListener('click', function() {
                                document.getElementById('imageInput').click();
                            });
                        </script>

                        <!-- Tweetlerin listelendiği kısım -->
                        <div class="mt-4">
                            @foreach ($tweets as $tweet)
                                <div class="tweet">
                                    <img class="tweet__author-logo" src="./img/profile.jpg" />
                                    <div class="tweet__main">
                                        <div class="tweet__header">
                                            <h4 class="tweet__author-name">{{ $tweet->user->name }}</h4>
                                            <div class="tweet__author-slug">
                                                @-{{ auth()->user()->name }}
                                            </div>
                                            <h6 class="tweet__publish-time">
                                                {{ $tweet->created_at->diffForHumans() }}
                                            </h6>
                                        </div>
                                        <p class="tweet__content">{{ $tweet->content }}</p>
                                        @foreach ($tweet->images as $img)
                                            <img class="tweet__image"
                                                src="{{ asset('uploads/images/tweet/' . $img->file_path) }}"
                                                alt="Tweet Resmi">
                                        @endforeach
                                    </div>

                                    <!-- Like Butonu ve Beğeni Sayacı -->
                                    <div class="stuff-box">
                                        <div class="like-boxs">
                                            <form action="{{ route('like', $tweet->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="like-button">
                                                    <svg viewBox="0 0 24 24" width="18.75" aria-hidden="true">
                                                        <g>
                                                            <path
                                                                d="M16.697 5.5c-1.222-.06-2.679.51-3.89 2.16l-.805 1.09-.806-1.09C9.984 6.01 8.526 5.44 7.304 5.5c-1.243.07-2.349.78-2.91 1.91-.552 1.12-.633 2.78.479 4.82 1.074 1.97 3.257 4.27 7.129 6.61 3.87-2.34 6.052-4.64 7.126-6.61 1.111-2.04 1.03-3.7.477-4.82-.561-1.13-1.666-1.84-2.908-1.91zm4.187 7.69c-1.351 2.48-4.001 5.12-8.379 7.67l-.503.3-.504-.3c-4.379-2.55-7.029-5.19-8.382-7.67-1.36-2.5-1.41-4.86-.514-6.67.887-1.79 2.647-2.91 4.601-3.01 1.651-.09 3.368.56 4.798 2.01 1.429-1.45 3.146-2.1 4.796-2.01 1.954.1 3.714 1.22 4.601 3.01.896 1.81.846 4.17-.514 6.67z">
                                                            </path>
                                                        </g>
                                                    </svg>
                                                </button>
                                            </form>
                                            <span>{{ count($tweet->likes) }}</span>
                                        </div>

                                        <!-- retweet -->
                                        <div class="comment-box">
                                            <div>
                                                <form method="POST" action="{{ route('retweets.store') }}">
                                                    @csrf
                                                    <input type="hidden" name="tweet_id"
                                                        value="{{ $tweet->id }}">
                                                    <button>

                                                    </button>
                                                    <svg viewBox="0 0 24 24" width="18.75" aria-hidden="true">
                                                        <g>
                                                            <path
                                                                d="M4.5 3.88l4.432 4.14-1.364 1.46L5.5 7.55V16c0 1.1.896 2 2 2H13v2H7.5c-2.209 0-4-1.79-4-4V7.55L1.432 9.48.068 8.02 4.5 3.88zM16.5 6H11V4h5.5c2.209 0 4 1.79 4 4v8.45l2.068-1.93 1.364 1.46-4.432 4.14-4.432-4.14 1.364-1.46 2.068 1.93V8c0-1.1-.896-2-2-2z">
                                                            </path>
                                                        </g>
                                                    </svg>
                                                    <button type="submit">Retweet</button>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Comment(yorum kısmı) -->
                                        <div class="comment-box">
                                            <div class="tweet-icon-box">
                                                <button class="tweet-icon-button" data-bs-toggle="collapse"
                                                    href="#collapseExample-{{ $tweet->id }}" aria-expanded="false"
                                                    aria-controls="collapseExample">
                                                    <svg viewBox="0 0 24 24" width="18.75" aria-hidden="true">
                                                        <g>
                                                            <path
                                                                d="M1.751 10c0-4.42 3.584-8 8.005-8h4.366c4.49 0 8.129 3.64 8.129 8.13 0 2.96-1.607 5.68-4.196 7.11l-8.054 4.46v-3.69h-.067c-4.49.1-8.183-3.51-8.183-8.01zm8.005-6c-3.317 0-6.005 2.69-6.005 6 0 3.37 2.77 6.08 6.138 6.01l.351-.01h1.761v2.3l5.087-2.81c1.951-1.08 3.163-3.13 3.163-5.36 0-3.39-2.744-6.13-6.129-6.13H9.756z">
                                                            </path>
                                                        </g>
                                                    </svg>
                                                </button>

                                                <span>{{ count($tweet->comments) }}</span>
                                            </div>
                                        </div>

                                        <div class="collapse" id="collapseExample-{{ $tweet->id }}">
                                            <form action="{{ route('comments.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="tweet_id" value="{{ $tweet->id }}">
                                                <textarea id="autoResizeTextarea-{{ $tweet->id }}" style="resize: none;border:none; overflow-y:hidden"
                                                    name="content" class="tweet-textarea" rows="1" placeholder="What's comment?" required></textarea>
                                                <button type="submit" class="btn btn-outline-primary">Yorum
                                                    Yap</button>
                                            </form>

                                            @foreach ($tweet->comments as $comment)
                                                <div class="user-comment">
                                                    <div>
                                                        <img class="tweet__author-logo" src="./img/profile.jpg" />
                                                    </div>
                                                    <p>{{ $comment->user->name }}: {{ $comment->content }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Beğenme(Like) kısmı -->
            {{-- @foreach ($tweets as $tweet)
                <div>
                    <p>{{ $tweet->content }}</p>
                    <form action="{{ route('likes.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tweet_id" value="{{ $tweet->id }}">
                        <button type="submit">Beğen</button>
                    </form>
                    <p>{{ $tweet->likes->count() }} Beğeni</p>
                </div>
            @endforeach --}}

            <!-- Retweet kısmı -->
            {{-- @foreach ($tweets as $tweet)
                <div>
                    <p>{{ $tweet->content }}</p>
                    <form action="{{ route('retweets.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tweet_id" value="{{ $tweet->id }}">
                        <button type="submit">Retweet</button>
                    </form>
                    <p>{{ $tweet->retweets->count() }} Retweet</p>
                </div>
            @endforeach --}}

            <div class="tweet">
                <img class="tweet__author-logo" src="./img/profile-image-1.jpg" />
                <div class="tweet__main">
                    <div class="tweet__header">
                        <div class="tweet__author-name">
                            Becki (& Chris)
                        </div>
                        <div class="tweet__author-slug">
                            @beckiandchris
                        </div>
                        <div class="tweet__publish-time">
                            38m
                        </div>
                    </div>
                    <div class="tweet__content">
                        Thank you
                    </div>
                </div>
            </div>
            <div class="tweet">
                <img class="tweet__author-logo" src="./img/profile-image-1.jpg" />
                <div class="tweet__main">
                    <div class="tweet__header">
                        <div class="tweet__author-name">
                            Elixir Digest
                        </div>
                        <div class="tweet__author-slug">
                            @elixirdigest
                        </div>
                        <div class="tweet__publish-time">
                            10d
                        </div>
                    </div>
                    <div class="tweet__content">
                        Yet Another Guide To Build a JSON API with Phoenix 1.5 shared in
                        the latest Elixir Digest
                        <a href="https://elixirdigest.net/digests/276">https://elixirdigest.net/digests/276</a>
                        @_tamas_soos #myelixirstatus #elixirlang #phoenixframework
                    </div>
                </div>
            </div>

            <div class="tweet">
                <img class="tweet__author-logo" src="./img/profile-image-1.jpg" />
                <div class="tweet__main">
                    <div class="tweet__header">
                        <div class="tweet__author-name">
                            Chris Martin
                        </div>
                        <div class="tweet__author-slug">
                            @chris_martin
                        </div>
                        <div class="tweet__publish-time">
                            15h
                        </div>
                    </div>
                    <div class="tweet__content">
                        One of my favorite things about the "ergonomics" of haskell is
                        being able to leave underscores in code that isn't finished yet,
                        and the type checker still works and provides useful information
                        about the incomplete code. ("holes" --
                        <a href="https://typeclasses.com/typed-holes">https://typeclasses.com/typed-holes</a>)
                        <img class="tweet__image" src="./img/post-image-1.jpg" />
                    </div>
                </div>
            </div>

            <div class="tweet">
                <img class="tweet__author-logo" src="./img/profile-image-1.jpg" />
                <div class="tweet__main">
                    <div class="tweet__header">
                        <div class="tweet__author-name">
                            Becki (& Chris)
                        </div>
                        <div class="tweet__author-slug">
                            @beckiandchris
                        </div>
                        <div class="tweet__publish-time">
                            38m
                        </div>
                    </div>
                    <div class="tweet__content">
                        Thank you
                    </div>
                </div>
            </div>

            <div class="tweet">
                <img class="tweet__author-logo" src="./img/profile-image-1.jpg" />
                <div class="tweet__main">
                    <div class="tweet__header">
                        <div class="tweet__author-name">
                            Becki (& Chris)
                        </div>
                        <div class="tweet__author-slug">
                            @beckiandchris
                        </div>
                        <div class="tweet__publish-time">
                            38m
                        </div>
                    </div>
                    <div class="tweet__content">
                        Thank you
                    </div>
                </div>
            </div>

            <div class="tweet">
                <img class="tweet__author-logo" src="./img/profile-image-1.jpg" />
                <div class="tweet__main">
                    <div class="tweet__header">
                        <div class="tweet__author-name">
                            Becki (& Chris)
                        </div>
                        <div class="tweet__author-slug">
                            @beckiandchris
                        </div>
                        <div class="tweet__publish-time">
                            38m
                        </div>
                    </div>
                    <div class="tweet__content">
                        Thank you
                    </div>
                </div>
            </div>
        </div>
        <div class="layout__right-sidebar-container">
            <div class="layout__right-sidebar">
                <div class="trends-for-you">
                    <div class="trends-for-you__block">
                        <div class="trends-for-you__heading">
                            Trends for you
                        </div>
                    </div>
                    <div class="trends-for-you__block">
                        <div class="trends-for-you__meta-information">
                            Trending in Germany
                        </div>
                        <div class="trends-for-you__trend-name">
                            #iPhone12
                        </div>
                        <div class="trends-for-you__meta-information">
                            155k Tweets
                        </div>
                    </div>
                    <div class="trends-for-you__block">
                        <div class="trends-for-you__meta-information">
                            Trending in Germany
                        </div>
                        <div class="trends-for-you__trend-name">
                            #AmazonPrimeDay
                        </div>
                    </div>
                    <div class="trends-for-you__block">
                        <div class="trends-for-you__meta-information">
                            Trending - Trending
                        </div>
                        <div class="trends-for-you__trend-name">
                            #autos
                        </div>
                        <div class="trends-for-you__meta-information">
                            2,800 Tweets
                        </div>
                    </div>
                </div>
                <div class="who-to-follow">
                    <div class="who-to-follow__block">
                        <div class="who-to-follow__heading">
                            Who to follow
                        </div>
                    </div>
                    <div class="who-to-follow__block">
                        <img class="who-to-follow__author-logo" src="./img/profile-image-1.jpg" />
                        <div class="who-to-follow__content">
                            <div>
                                <div class="who-to-follow__author-name">
                                    Becki (& Chris)
                                </div>
                                <div class="who-to-follow__author-slug">
                                    @beckiandchris
                                </div>
                            </div>
                            <div class="who-to-follow__button">
                                Follow
                            </div>
                        </div>
                    </div>
                    <div class="who-to-follow__block">
                        <img class="who-to-follow__author-logo" src="./img/profile-image-2.png" />
                        <div class="who-to-follow__content">
                            <div>
                                <div class="who-to-follow__author-name">
                                    Elixir Digest
                                </div>
                                <div class="who-to-follow__author-slug">
                                    @elixirdigest
                                </div>
                            </div>
                            <div class="who-to-follow__button">
                                Follow
                            </div>
                        </div>
                    </div>

                    <div class="who-to-follow__block">
                        <img class="who-to-follow__author-logo" src="./img/profile-image-3.jpg" />
                        <div class="who-to-follow__content">
                            <div>
                                <div class="who-to-follow__author-name">
                                    Chris Martin
                                </div>
                                <div class="who-to-follow__author-slug">
                                    @chris_martin
                                </div>
                            </div>
                            <div class="who-to-follow__button">
                                Follow
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.getElementById('autoResizeTextarea');

            textarea.addEventListener('input', function() {
                this.style.height = 'auto'; // Yüksekliği otomatik olarak ayarlamak için sıfırla
                this.style.height = (this.scrollHeight) + 'px'; // İçeriğin yüksekliğine göre ayarla
            });
        });
    </script>
</body>

</html>


{{-- <!-- retweet -->
                                        <div class="comment-box">
                                            <div class="tweet-icon-box">
                                                <form method="POST" action="{{ route('retweets.store') }}">
                                                    @csrf
                                                    <input type="hidden" name="tweet_id"
                                                        value="{{ $tweet->id }}">
                                                    <button>

                                                        <svg viewBox="0 0 24 24" width="18.75" aria-hidden="true">
                                                            <g>
                                                                <path
                                                                    d="M4.5 3.88l4.432 4.14-1.364 1.46L5.5 7.55V16c0 1.1.896 2 2 2H13v2H7.5c-2.209 0-4-1.79-4-4V7.55L1.432 9.48.068 8.02 4.5 3.88zM16.5 6H11V4h5.5c2.209 0 4 1.79 4 4v8.45l2.068-1.93 1.364 1.46-4.432 4.14-4.432-4.14 1.364-1.46 2.068 1.93V8c0-1.1-.896-2-2-2z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                    </button>
                                                    <button type="submit">Retweet</button>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Retweetleri Görüntüleme -->
                                        @foreach ($tweet->retweets as $retweet)
                                            <div class="retweet">
                                                <div class="retweet-user">{{ $retweet->user->name }}</div>
                                                <div class="retweet-comment">{{ $retweet->comment }}</div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Retweet Modal -->
                                    <div class="modal fade" id="retweetModal{{ $tweet->id }}" tabindex="-1"
                                        aria-labelledby="retweetModalLabel{{ $tweet->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="retweetModalLabel{{ $tweet->id }}">Retweet</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('retweets.store') }}">
                                                        @csrf
                                                        <input type="hidden" name="tweet_id"
                                                            value="{{ $tweet->id }}">
                                                        <div class="form-group">
                                                            <textarea name="comment" class="form-control" placeholder="Add a comment (optional)"></textarea>
                                                        </div>
                                                        <button type="submit"
                                                            class="btn btn-primary">Retweet</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
