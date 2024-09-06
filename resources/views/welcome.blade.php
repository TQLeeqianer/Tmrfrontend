<!-- resources/views/dashboard.blade.php -->

@include('header');



            <!-- home section starts  -->
     <section class="home" id="home">
              <div class="content">
                <h3>

                  <span> LEE EVENT </span>
                </h3>
                <a href="#" class="btn">Get more Information</a>
              </div>

              <div class="swiper-container home-slider">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <img src="{{asset('img/home1.jpg')}}" alt="" />

                  </div>
                  <div class="swiper-slide">
                    <img src="img/home2.jpg" alt="" />
                  </div>
                  <div class="swiper-slide">
                    <img src="img/home3.jpg" alt="" />
                  </div>
                  <div class="swiper-slide">
                    <img src="img/home4.jpg" alt="" />
                  </div>
                  <div class="swiper-slide">
                    <img src="img/home5.jpg" alt="" />
                  </div>
                  <div class="swiper-slide">
                    <img src="img/home6.jpg" alt="" />
                  </div>
                </div>
              </div>
            </section>

{{--            <section class="home" id="home">--}}
{{--              <div class="content">--}}
{{--                <h3>--}}
{{--                  where your ideas take off--}}
{{--                  <span> kanasu events </span>--}}
{{--                </h3>--}}
{{--                <a href="#" class="btn">get quote</a>--}}
{{--              </div>--}}

{{--              <div class="swiper-container home-slider">--}}
{{--                <div class="swiper-wrapper">--}}
{{--                  <div class="swiper-slide">--}}
{{--                    <img src="images/home1.jpg" alt="" />--}}
{{--                  </div>--}}
{{--                  <div class="swiper-slide">--}}
{{--                    <img src="images/home2.jpg" alt="" />--}}
{{--                  </div>--}}
{{--                  <div class="swiper-slide">--}}
{{--                    <img src="images/home3.jpg" alt="" />--}}
{{--                  </div>--}}
{{--                  <div class="swiper-slide">--}}
{{--                    <img src="images/home4.jpg" alt="" />--}}
{{--                  </div>--}}
{{--                  <div class="swiper-slide">--}}
{{--                    <img src="images/home5.jpg" alt="" />--}}
{{--                  </div>--}}
{{--                  <div class="swiper-slide">--}}
{{--                    <img src="images/home6.jpg" alt="" />--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </section>--}}

            <!-- service section starts  -->
            <style>
              /* Service Section Styles */
#service {
    background-color: #f4f4f4;
    padding: 60px 20px;
    text-align: center;
}

#service .heading {
    font-size: 36px;
    color: #333;
    margin-bottom: 40px;
}

#service .heading span {
    color: #e74c3c;
}

#service .box-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

#service .box {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    max-width: 300px;
    width: 100%;
}

#service .box h3 {
    font-size: 24px;
    color: #333;
    margin-bottom: 10px;
}

#service .box p {
    color: #777;
    font-size: 16px;
}

#service .box:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    #service .box-container {
        flex-direction: column;
    }
}

            </style>
            <section class="service" id="service">
              <h1 class="heading">our <span>Event</span></h1>

              <div class="box-container">
                  @foreach($events as $event)
                      <a href="{{route('event', ['id' => $event->id])}}" class="box col-md-4" style="text-decoration: none">
                          {{-- <i class="fas fa-envelope"></i> --}}
                          <i class=""></i>
                          <h3>{{$event->name}}</h3>
                          <p>
                            {{$event->detail}}
                          </p>
                      </a>
                  @endforeach

            </section>

            <!-- about section starts  -->
            <section class="about" id="about">
              <h1 class="heading"><span>about</span> us</h1>

              <div class="row">
                <div class="image">
                  <img src="img/about.jpg" alt="" />
                </div>

                <div class="content">
                  <h3>your occasion deserves our careful planning</h3>
                  <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam
                    labore fugiat ut esse perferendis perspiciatis provident dolores
                    fuga in facilis culpa possimus, quia praesentium itaque, sapiente
                    quasi harum rem asperiores.
                  </p>
                  <p>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugiat
                    vero expedita incidunt provident quibusdam aut odit, numquam
                    nesciunt similique nisi.
                  </p>
                  <a href="#" class="btn">reach us</a>
                </div>
              </div>
            </section>

            <!-- gallery section starts  -->
            <section class="gallery" id="gallery">
              <h1 class="heading">our <span>gallery</span></h1>

              <div class="box-container">
                <div class="box">
                  <img src="img/gallery1.jpg" alt="" />
                  <h3 class="title">best events</h3>
                  <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-share"></a>
                    <a href="#" class="fas fa-eye"></a>
                  </div>
                </div>

                <div class="box">
                  <img src="img/gallery2.jpg" alt="" />
                  <h3 class="title">best events</h3>
                  <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-share"></a>
                    <a href="#" class="fas fa-eye"></a>
                  </div>
                </div>

                <div class="box">
                  <img src="img/gallery3.jpg" alt="" />
                  <h3 class="title">best events</h3>
                  <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-share"></a>
                    <a href="#" class="fas fa-eye"></a>
                  </div>
                </div>

                <div class="box">
                  <img src="img/gallery4.jpg" alt="" />
                  <h3 class="title">best events</h3>
                  <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-share"></a>
                    <a href="#" class="fas fa-eye"></a>
                  </div>
                </div>

                <div class="box">
                  <img src="img/gallery5.jpg" alt="" />
                  <h3 class="title">best events</h3>
                  <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-share"></a>
                    <a href="#" class="fas fa-eye"></a>
                  </div>
                </div>

                <div class="box">
                  <img src="img/gallery6.jpg" alt="" />
                  <h3 class="title">best events</h3>
                  <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-share"></a>
                    <a href="#" class="fas fa-eye"></a>
                  </div>
                </div>

                <div class="box">
                  <img src="img/gallery7.jpg" alt="" />
                  <h3 class="title">best events</h3>
                  <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-share"></a>
                    <a href="#" class="fas fa-eye"></a>
                  </div>
                </div>

                <div class="box">
                  <img src="img/gallery8.jpg" alt="" />
                  <h3 class="title">best events</h3>
                  <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-share"></a>
                    <a href="#" class="fas fa-eye"></a>
                  </div>
                </div>

                <div class="box">
                  <img src="img/gallery9.jpg" alt="" />
                  <h3 class="title">best events</h3>
                  <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-share"></a>
                    <a href="#" class="fas fa-eye"></a>
                  </div>
                </div>
              </div>
            </section>

            <!-- price section starts  -->
            {{-- <section class="price" id="price">
              <h1 class="heading">our <span>pricing</span></h1> --}}

              {{-- <div class="box-container">
                <div class="box">
                  <h3 class="title">basic</h3>
                  <h3 class="amount">$879.00</h3>
                  <ul>
                    <li><i class="fas fa-check"></i>full services</li>
                    <li><i class="fas fa-check"></i> decorations</li>
                    <li><i class="fas fa-check"></i> music and photos</li>
                    <li><i class="fas fa-check"></i> food and drinks</li>
                    <li><i class="fas fa-check"></i> invitation card</li>
                  </ul>
                  <a href="#" class="btn">check out</a>
                </div>

                <div class="box">
                  <h3 class="title">prime</h3>
                  <h3 class="amount">$799.00</h3>
                  <ul>
                    <li><i class="fas fa-check"></i>full services</li>
                    <li><i class="fas fa-check"></i> decorations</li>
                    <li><i class="fas fa-check"></i> music and photos</li>
                    <li><i class="fas fa-check"></i> food and drinks</li>
                    <li><i class="fas fa-check"></i> invitation card</li>
                  </ul>
                  <a href="#" class="btn">check out</a>
                </div>

                <div class="box">
                  <h3 class="title">luxury</h3>
                  <h3 class="amount">$379.00</h3>
                  <ul>
                    <li><i class="fas fa-check"></i>full services</li>
                    <li><i class="fas fa-check"></i> decorations</li>
                    <li><i class="fas fa-check"></i> music and photos</li>
                    <li><i class="fas fa-check"></i> food and drinks</li>
                    <li><i class="fas fa-check"></i> invitation card</li>
                  </ul>
                  <a href="#" class="btn">check out</a>
                </div>

                <div class="box">
                  <h3 class="title">ultra</h3>
                  <h3 class="amount">$920.00</h3>
                  <ul>
                    <li><i class="fas fa-check"></i>full services</li>
                    <li><i class="fas fa-check"></i> decorations</li>
                    <li><i class="fas fa-check"></i> music and photos</li>
                    <li><i class="fas fa-check"></i> food and drinks</li>
                    <li><i class="fas fa-check"></i> invitation card</li>
                  </ul>
                  <a href="#" class="btn">check out</a>
                </div>
              </div>
            </section> --}}

            <!-- review section starts  -->
            <section class="reivew" id="review">
              <h1 class="heading">client's <span>review</span></h1>

              <div class="review-slider swiper-container">
                <div class="swiper-wrapper">
                  <div class="swiper-slide box">
                    <i class="fas fa-quote-right"></i>
                    <div class="user">
                      <img src="img/img1.jpg" alt="" />
                      <div class="user-info">
                        <h3>nayana</h3>
                        <span>happy customer</span>
                      </div>
                    </div>
                    <p>
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis
                      dolor dicta cum. Eos beatae eligendi, magni numquam nemo sed ut
                      corrupti, ipsam iure nisi unde et assumenda perspiciatis
                      voluptatibus nihil.
                    </p>
                  </div>

                  <div class="swiper-slide box">
                    <i class="fas fa-quote-right"></i>
                    <div class="user">
                      <img src="img/img2.jpg" alt="" />
                      <div class="user-info">
                        <h3>lisa</h3>
                        <span>happy customer</span>
                      </div>
                    </div>
                    <p>
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis
                      dolor dicta cum. Eos beatae eligendi, magni numquam nemo sed ut
                      corrupti, ipsam iure nisi unde et assumenda perspiciatis
                      voluptatibus nihil.
                    </p>
                  </div>

                  <div class="swiper-slide box">
                    <i class="fas fa-quote-right"></i>
                    <div class="user">
                      <img src="img/img3.jpg" alt="" />
                      <div class="user-info">
                        <h3>mary</h3>
                        <span>happy customer</span>
                      </div>
                    </div>
                    <p>
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis
                      dolor dicta cum. Eos beatae eligendi, magni numquam nemo sed ut
                      corrupti, ipsam iure nisi unde et assumenda perspiciatis
                      voluptatibus nihil.
                    </p>
                  </div>

                  <div class="swiper-slide box">
                    <i class="fas fa-quote-right"></i>
                    <div class="user">
                      <img src="img/img4.jpg" alt="" />
                      <div class="user-info">
                        <h3>rose</h3>
                        <span>happy customer</span>
                      </div>
                    </div>
                    <p>
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis
                      dolor dicta cum. Eos beatae eligendi, magni numquam nemo sed ut
                      corrupti, ipsam iure nisi unde et assumenda perspiciatis
                      voluptatibus nihil.
                    </p>
                  </div>
                </div>
              </div>
            </section>

            <!-- contact section starts  -->
            <section class="contact" id="contact">
              <h1 class="heading"><span>contact</span> us</h1>

              <form action="">
                <div class="inputBox">
                  <input type="text" placeholder="name" />
                  <input type="email" placeholder="email" />
                </div>
                <div class="inputBox">
                  <input type="tel" placeholder="number" />
                  <input type="text" placeholder="subject" />
                </div>
                <textarea
                  name=""
                  placeholder="message"
                  id=""
                  cols="30"
                  rows="10"
                ></textarea>
                <input type="submit" value="send message" class="btn" />
              </form>
            </section>

           @include('footer');
