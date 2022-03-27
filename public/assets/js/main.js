(function ($) {
    let reEmail = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
    let rePassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    let reName = /^([A-Z][a-z]{2,15}\s?){2,4}$/;
    let rePhone = /^06\d{7,8}$/;
    var err = 0;
    var route = location.href
    //js for registration view
    if (route.indexOf("registracija") != -1) {
        btnRegister.addEventListener("click", function (e) {
            e.preventDefault();
            const name = document.querySelector("#name");
            const email = document.querySelector("#email");
            const phone = document.querySelector("#phone");
            const ddl = document.querySelector("#ddl");
            const password = document.querySelector("#password");
            const passwordConf = document.querySelector("#rePassword");
            err = 0;
            validRegex(name, reName);
            validRegex(email, reEmail);
            validRegex(phone, rePhone);
            validInput(ddl, "0");
            validRegex(password, rePassword);
            if (password.value !== passwordConf.value || passwordConf.value == "") {
                err++;
                passwordConf.classList.add("err");
                passwordConf.classList.remove("succ");
                passwordConf.nextElementSibling.classList.remove("hide");
            } else {
                passwordConf.classList.remove("err");
                passwordConf.classList.add("succ");
                passwordConf.nextElementSibling.classList.add('hide');
            }

            if (!err) {
                let data = {
                    nameUI: name.value,
                    emailUI: email.value,
                    phoneUI: phone.value,
                    roleUI: ddl.value,
                    passwordUI: password.value,
                    passwordConfUI: passwordConf.value
                }
                ajaxCall("registracija", "post", data)
                    .then(data => {
                        //successfully register or fail for email or phone unique column
                        document.getElementById("errors").innerHTML = `<p class="${data.class} my-3">${data.msg}</p>`;
                        setTimeout(() => {
                            document.getElementById("errors").innerHTML = '';
                        }, 3000)
                        if (data.class == "alert alert-success") {
                            location.href = "profil"
                        }
                        //output server validation errors
                        if (data.errors) {
                            let dataArr = Object.values(data.errors);
                            let output = '';
                            if (dataArr.length) {
                                for (err of dataArr) {
                                    output += `<p class="alert alert-danger my-3">${err}</p>`
                                }
                                document.getElementById("errors").innerHTML = output;
                                setTimeout(() => {
                                    document.getElementById("errors").innerHTML = '';
                                }, 4000)
                            }
                        }
                    })
                    .catch(err => console.log(err));
            }
        });
    }

    //validate regex
    function validRegex(obj, regex) {
        if (!regex.test(obj.value)) {
            obj.classList.add("err");
            obj.classList.remove("succ");
            obj.nextElementSibling.classList.remove("hide");
            err++;
        } else {
            obj.classList.remove("err");
            obj.classList.add("succ");
            obj.nextElementSibling.classList.add("hide");
        }
    }

    // validate inputs
    function validInput(input, compere) {
        if (input.value == compere) {
            input.classList.add("err");
            input.classList.remove("succ");
            input.nextElementSibling.classList.remove("hide");
            err++;
        } else {
            input.classList.remove("err");
            input.classList.add("succ");
            input.nextElementSibling.classList.add("hide");
        }
    }
    function clearInput(obj) {
        obj.classList.remove("succ");
    }
    //ajax call
    async function ajaxCall(url, method, data) {
        const response = await fetch(url, {
            method: method,
            headers: {
                "Accept": "application/json",
                "Content-type": "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify(data)
        });
        const resData = await response.json();
        return resData;
    }

    //ajax get call
    async function ajaxGetCall(url) {
        const response = await fetch(url);

        const resData = await response.json();
        return resData;
    }

    //get pagination links
    const paginationLinks = document.querySelectorAll(".pagination-link");
    //put event on every link
    paginationLinks.forEach(link => {
        link.addEventListener("click", paginate)
    });

    //pagination
    function paginate(e) {
        if (e.target.classList.contains("pagination-link")) {
            //get data attr from pagination links
            var data = e.target.dataset.id
        }
        //get querystring if exists
        let searchParams;
        if (location.search.length > 0) {
            searchParams = location.search + "&";
        } else {
            searchParams = "?"
        }

        ajaxGetCall(`vikendice${searchParams}page=${data}`)
            .then(data => {
                printVenues(data)
                window.scrollTo({
                    top: 600,
                    right: 0,
                    behavior: "smooth"
                });
            })
            .catch(err => console.log(err));
        e.preventDefault();
    }

    //print venues
    function printVenues(data) {
        let output = '';
        data.items.forEach(venue => {
            output += `<div class="col-md-4 d-flex ">
                        <div class="blog-entry align-self-stretch">
                         <a href="vikendice/${venue.id}" class="block-20 rounded" style="background-image:url(storage/venues/${venue.path})">
                            </a>
                            <div class="text p-4 text-center">
                                <h3 class="heading"><a href="vikendice/${venue.id}">${venue.name}</a></h3>
                                <div class="meta mb-2">
                                    <div>Povrsina: ${venue.square_footage}m<sup>2</sup></div>
                                    <div>Broj soba: <i class="fa-solid fa-bed"></i> ${venue.num_rooms}</div>
                                    <div>Broj kupatila: <i class="fa-solid fa-shower"></i> ${venue.num_wc}</div>
                                    <div>Broj gostiju: <i class="fa-solid fa-person"></i> ${venue.max_guests}</div>
                                </div>
                                <a href=""> <p class="text-info font-weight-bold">Cena po nocenju: ${venue.price} &euro;</p></a>
                            </div>
                        </div>
                    </div>`;
        });
        document.getElementById("venues").innerHTML = output;
    }

    if (route.indexOf("oglasi") != -1) {
        // let delBtns = document.querySelectorAll(".delete-item");
        // delBtns.forEach(item => {
        //     item.addEventListener("click", deleteVenue)
        // });
        document.addEventListener("click",deleteVenue)
        function deleteVenue(e) {
            if(e.target.classList.contains("delete-item")){
                let id = e.target.parentElement.dataset.id
                let url = location.href.replace(/oglasi\/\d{1,3}/, `vikendice/${id}`);

                ajaxCall(url, "DELETE", "")
                    .then(data => {
                        if (data) {
                            result.innerHTML = `<p class="${data.class}">${data.msg}</p>`
                        }
                        setTimeout(() => {
                            result.innerHTML = '';
                        }, 2000);
                        if (data.venues) {
                            printTableVenues(data.venues,data.venuesCount);
                        }
                    })
                    .catch(err => console.log(err))
            }
        }
        function printTableVenues(data,links) {
            let output = '';
            let rb = 1;
            printLinks(links);
            data.forEach(item => {
                let url = location.href.replace(/oglasi\/\d{1,3}/, `vikendice/${item.id}/edit`);
                output += `<tr>
                             <th scope="row">${rb++}</th>
                             <td>${item.name}</td>
                             <td>${item.created_at == null ? "" : new Date(item.created_at)}</td>
                             <td data-id="${item.id}"><a href='${url}' class="btn btn-info">Izmeni</a></td>
                             <td data-id="${item.id}"><div class="btn btn-danger delete-item">Obrisi</div></td>
                        </tr>`;
            });
            tbody.innerHTML = output;
        }

        function printLinks(links) {
            let limit = 5;
            let pages = Math.ceil(links / limit);
            let output = `<section class="mb-5">
            <div class="container">
                <div class="row">
                <div class="col-md-12 ">
                <nav aria-label="Page navigation example mb-5">
                <ul class="pagination">
                <li class="page-item disabled">
            </li>`;
            for (var i = 0; i < pages; i++) {
                output += `<li class="page-item"><a class="page-link pagination-link-whenDeleted" href="#" data-id="${i}">${i + 1}</a>
                </li>`;
            }
            output += `</li></ul>
            </nav>
            </div>
            </div>
            </div>
            </section>`
            ;
            document.getElementById("paginationLinks").innerHTML = output;
        }
        document.addEventListener("click",paginateOnTable)
        function paginateOnTable(e){
            if(e.target.classList.contains("page-link")){
                let id = e.target.dataset.id;
                let url = location.href.replace(/oglasi\/\d{1,3}\?page=\d/, `vikendiceTabela?page=${id}`);
                ajaxGetCall(url)
                    .then(data => {
                        printTableVenues(data.venues,data.venuesCount);
                    })
                    .catch(err => console.log(err));
            }
        }
    }
    if (route.indexOf("admin") != -1) {
        addUser.addEventListener("click",(e)=>{
            e.preventDefault();
            addUserForm.classList.toggle("d-none");
        })
    }

    //    -----------------------------------------------------------------------------------------------------

    "use strict";


    $(window).stellar({
        responsive: true,
        parallaxBackgrounds: true,
        parallaxElements: true,
        horizontalScrolling: false,
        hideDistantElements: false,
        scrollProperty: 'scroll'
    });


    var fullHeight = function () {

        $('.js-fullheight').css('height', $(window).height());
        $(window).resize(function () {
            $('.js-fullheight').css('height', $(window).height());
        });

    };
    fullHeight();

    // loader
    var loader = function () {
        setTimeout(function () {
            if ($('#ftco-loader').length > 0) {
                $('#ftco-loader').removeClass('show');
            }
        }, 1);
    };
    loader();

    var carousel = function () {
        $('.carousel-testimony').owlCarousel({
            center: true,
            loop: true,
            items: 1,
            margin: 30,
            stagePadding: 0,
            nav: false,
            navText: ['<span class="ion-ios-arrow-back">', '<span class="ion-ios-arrow-forward">'],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });

    };
    carousel();

    $('nav .dropdown').hover(function () {
        var $this = $(this);
        // 	 timer;
        // clearTimeout(timer);
        $this.addClass('show');
        $this.find('> a').attr('aria-expanded', true);
        // $this.find('.dropdown-menu').addClass('animated-fast fadeInUp show');
        $this.find('.dropdown-menu').addClass('show');
    }, function () {
        var $this = $(this);
        // timer;
        // timer = setTimeout(function(){
        $this.removeClass('show');
        $this.find('> a').attr('aria-expanded', false);
        // $this.find('.dropdown-menu').removeClass('animated-fast fadeInUp show');
        $this.find('.dropdown-menu').removeClass('show');
        // }, 100);
    });


    $('#dropdown04').on('show.bs.dropdown', function () {
        console.log('show');
    });

    // magnific popup
    $('.image-popup').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        closeBtnInside: false,
        fixedContentPos: true,
        mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
        },
        image: {
            verticalFit: true
        },
        zoom: {
            enabled: true,
            duration: 300 // don't foget to change the duration also in CSS
        }
    });

    $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,

        fixedContentPos: false
    });

    var contentWayPoint = function () {
        var i = 0;
        $('.ftco-animate').waypoint(function (direction) {

            if (direction === 'down' && !$(this.element).hasClass('ftco-animated')) {

                i++;

                $(this.element).addClass('item-animate');
                setTimeout(function () {

                    $('body .ftco-animate.item-animate').each(function (k) {
                        var el = $(this);
                        setTimeout(function () {
                            var effect = el.data('animate-effect');
                            if (effect === 'fadeIn') {
                                el.addClass('fadeIn ftco-animated');
                            } else if (effect === 'fadeInLeft') {
                                el.addClass('fadeInLeft ftco-animated');
                            } else if (effect === 'fadeInRight') {
                                el.addClass('fadeInRight ftco-animated');
                            } else {
                                el.addClass('fadeInUp ftco-animated');
                            }
                            el.removeClass('item-animate');
                        }, k * 50, 'easeInOutExpo');
                    });

                }, 100);

            }

        }, {offset: '95%'});
    };
    contentWayPoint();

    $('.appointment_date-check-in').datepicker({
        'format': 'm/d/yyyy',
        'autoclose': true
    });
    $('.appointment_date-check-out').datepicker({
        'format': 'm/d/yyyy',
        'autoclose': true
    });

    $('.appointment_time').timepicker();


})(jQuery);

