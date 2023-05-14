(function($) {

    window.app = {

        spritely: {

            init: function() {

                $('#car')
                    .sprite({fps: 80, no_of_frames: 4}) //fps: frame/s, fps cang nho thi chuyen dong cang giat; no_of_frames: so luong khung hinh trong buc anh
                    .isDraggable({ // Nếu drag hoạt động, phải thêm Jquery Ui vào
                        start: function() { // Khi click chuột vào đối tượng và kéo
                            // Các sự kiện sẽ diễn ra
                           $('#car').fadeTo('fast', 0.7);
                        },
                        stop: function() { // Khi bỏ buôn chuột ra
                            // Các sự kiện sẽ diễn ra
                            $('#car').fadeTo('fast', 1);
                            $('#car').find("p").html("Hãy kéo em đi thật xa...");
                        },
                        drag: function() { // Trong quá trình kéo
                            // các sự kiện sẽ diễn ra.
                            $('#car').find("p").html("Kéo nữa đi anh...");
                        }
                    })
                    .activeOnClick()
                    .active();
                $('#car1')
                    .sprite({fps:  80, no_of_frames: 3})
                    .isDraggable()
                    .activeOnClick()
                    .active();
                $('#wolken').pan({fps: 30, speed: 0.7, dir: 'left', depth: 10}); // speed: toc do di chuyen cua vat the
                $('#mond').pan({fps: 30, speed: 0.7, dir: 'left', depth: 10});
                $('#hill2').pan({fps: 30, speed: 2, dir: 'left', depth: 30});
                $('#berge').pan({fps: 30, speed: 2, dir: 'left', depth: 30});
                $('#strasse').pan({fps: 30, speed: 1, dir: 'left', depth: 70});
                $('#balloons').pan({fps: 30, speed: 4, dir: 'up', depth: 70});
                $('#balloons2').pan({fps: 50, speed: 3, dir: 'up', depth: 70});
                $('#strasse, #berge, #wolken, #mond').spRelSpeed(8);

                $('html').flyToTap();
                {
                    var stage_left = (($('.container').width()) / 7);
                    //alert($('.container').width());
                    var stage_top = 10;
                    $('#car').spRandom({ //chuyen dong tu do voi thong so nhu duoi
                        top: stage_top + 280, //cao toi da
                        left: stage_left, //trai
                        //left: 100,
                        //right: 400, //phai
                        right: (($('.container').width()) - 200),
                        bottom: 280, //duoi
                        speed: 3500, //toc do di chuyen giua cac diem
                        pause: 5000}); //thoi gian ngung giua cac diem
                    $('#car1').spRandom({top: 260, left: 50, right: 500, bottom: 260, speed: 4000, pause: 3000});
}

                    $('#sp-container, .buehne').css({
                       'min-width': '100%'
                    });
                    $('#slider')
                        .show()
                        .slider({
                            value: 8,
                            min: -60,
                            max: 60,
                            slide: function() {
                                window.app.spritely.sliderChange($(this).slider('value'));
                            },
                            change: function() {
                                window.app.spritely.sliderChange($(this).slider('value'));
                            }
                        });
            },

            sliderChange: function(val) {
                  if ($('#dragMe').css('display') == 'block') {
{
                          $('#dragMe').hide();
                      }
                  }
                  var sliderSpeed = val;
                if (sliderSpeed < 0) {
                    var sliderSpeed = String(sliderSpeed).split('-')[1];
                    $('#car, #car1').spState(2);
                    $('#strasse, #berge, #wolken').spChangeDir('right');
                } else {
                    $('#car, #car1').spState(1);
                    $('#strasse, #berge, #wolken').spChangeDir('left');
                }
                $('#strasse, #berge, #wolken').spRelSpeed(sliderSpeed);

                var birdSpeed = sliderSpeed;
                if (sliderSpeed < 60) {
                    var birdSpeed = 60;
                } else if (sliderSpeed > 120) {
                    var birdSpeed = sliderSpeed / 2;
                }
                $('#car').fps(birdSpeed - 4);

            }

        },

    };

    $(document).ready(function() {
        window.app.spritely.init();
    });

})(jQuery);


