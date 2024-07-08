@extends('layout')

@section('title', 'story')  

@auth
{{ csrf_field() }}


        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
            <link rel="stylesheet" href="assets/css/story-style.css">
        </head>

        <body>
        <section id="tranding">
            <div class="container">
            

                <div class="swiper-button-prev slider-arrow">
                    <ion-icon name="arrow-back-outline"></ion-icon>
                </div>

                <div style="max-width: 100%" class="swiper tranding-slider">
                    <div class="swiper-wrapper">

                        @foreach ($all_story as $story)

                            <div class="swiper-slide tranding-slide">
                                <div class="tranding-slide-img">
                                <img src="{{$story['story_picture']}}" alt="Tranding">
                                </div>
                                <div class="tranding-slide-content">

                                    <div style="padding: 15px" class="d-flex align-items-center position-relative">
                                        <!-- Avatar -->
                                        <div class="avatar me-3">
                                          <img class="avatar-img rounded-circle" src="{{$story['user_profile_pic']}}" alt="avatar">
                                        </div>
                                        <div>
                                          <a class="h6 stretched-link" href="/user/{{$story['user_name']}}">{{$story['user_name']}}</a>
                                          <p class="small m-0">{{$story['first_name']}} {{$story['last_name']}}</p>
                                        </div>
                                    </div>

                                <div class="tranding-slide-content-bottom">
                                    <h2 class="food-name"> {{$story['title']}} </h2>
                                    <h5 class="food-rating">
                                        <span> {{$story['description']}} </span>
                                    </h5>
                                </div>
                                </div>
                            </div>

                        @endforeach

                    </div>
                </div>

                <div class="swiper-button-next slider-arrow">
                    <ion-icon name="arrow-forward-outline"></ion-icon>
                </div>

            </div>
        </section>

        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
        <script src="assets/js/story-script.js"></script>
        </body>   

</main>



@endauth
