var DECLARE = "别看了，乱七八糟的 浪费时间。"
eval("'"+DECLARE + "'")
var canvas = document.getElementById('drawer');
var ctx = canvas.getContext('2d');
var ratio = 2
drewPoints = []
if(!ga){
    function ga(a, b, c, d, e){
        return;
    }
}
function record(x, y){
    x = Number.parseInt(x / ratio) * ratio
    y = Number.parseInt(y / ratio) * ratio
    for (let i = 0; i < drewPoints.length; i++) {
        const element = drewPoints[i];
        if(element[0] == x && element[1] == y){
            drewPoints.splice(i,1)
            return
        }
    }
    drewPoints.push([x, y])
    $('[data-label=countLeft').text(countLeft - drewPoints.length)
}
function draw(x, y){
    x = Number.parseInt(x / ratio) * ratio
    y = Number.parseInt(y / ratio) * ratio
    var imgd = ctx.getImageData(x, y, 1, 1).data
    var p = imgd[1] == 0
    ctx.fillStyle = p ? '#fff': '#000'
    ctx.fillRect(x,y,ratio,ratio);
}
if (document.body.ontouchstart !== undefined) {
    // Mobile
    canvas.ontouchstart = function (e) {
        if(!window.login){
            alert('请先登录~')
            ga('send', 'event', '100Bits!', 'interact', 'notLoggedIn');
            return
        }

        var x = e.touches[0].pageX - canvas.offsetLeft
        var y = e.touches[0].pageY - canvas.offsetTop
        if(countLeft - drewPoints.length > 0){
            draw(x,y)
            record(x,y)
            ga('send', 'event', '100Bits!', 'drawTouch', 'x:' + x + ',y: ' + y);
        }
    }
} else {
    canvas.onmousedown = function(e) {
        if(!window.login){
            alert('请先登录~')
            ga('send', 'event', '100Bits!', 'interact', 'notLoggedIn');
            return
        }
        var x = e.pageX  - canvas.offsetLeft
        var y = e.pageY - canvas.offsetTop
        if(countLeft - drewPoints.length > 0){
            draw(x,y)
            record(x,y)
            ga('send', 'event', '100Bits!', 'drawMouse', 'x:' + x + ',y: ' + y);
        }
    }
}


$(document).ready(function() {
    window.countLeft = 100
    var ACTIVED_CSS = 'uk-button-danger'
    var DEFAULT_SPEED = 50
    var progressbar = $('#progressbar')
    var playProgress = undefined
    var last = []
    var isReserve = false
    var playBtn = $('.btn-play')
    var nextBtn = $('.btn-next')
    var prevBtn = $('.btn-prev')
    var towardBtn = $('.btn-toward')
    var backwardBtn = $('.btn-backward')
    var resetBtn = $('.btn-reset')
    var uploadBtn = $('.btn-upload')
    var performDrew = () => {
        enableBtn(playBtn)
        if(isReserve){
            progressbar.val(progressbar.val() - 1)
            point = last[progressbar.val()]
            if(point != undefined){
                draw(point[0], point[1])
                $('[data-label=user]').text(point[2])
            }
        } else {
            point = last[progressbar.val()]
            if(point != undefined){
                draw(point[0], point[1])
                $('[data-label=user]').text(point[2])
            }
            progressbar.val(progressbar.val() + 1)
        }
        if(progressbar.val() == last.length && !isReserve){
            clearInterval(playProgress)
            inactiveBtn(playBtn)
            disableBtn(playBtn)
            disableBtn(nextBtn)
            disableBtn(towardBtn)
            enableBtn(prevBtn)
            enableBtn(backwardBtn)
        } else if(progressbar.val() == 0 && isReserve){
            clearInterval(playProgress)
            inactiveBtn(playBtn)
            disableBtn(playBtn)
            disableBtn(prevBtn)
            disableBtn(backwardBtn)
            enableBtn(nextBtn)
            enableBtn(towardBtn)
        }
    }
    var isBtnActived = (btn) => {
        return btn.hasClass(ACTIVED_CSS)
    }
    var inactiveBtn = (btn) => {
        return btn.removeClass(ACTIVED_CSS)
    }
    var activeBtn = (btn) => {
        return btn.addClass(ACTIVED_CSS)
    }
    var disableBtn = (btn) => {
        return btn.attr('disabled', true)
    }
    var enableBtn = (btn) => {
        return btn.attr('disabled', false)
    }
    $.get('api/pic')
     .then(res =>{
        res.forEach(e => {
            last.push([e.x, e.y, e.user])
        });
        progressbar.attr('max', last.length)
        return $.get('count')
    }).then(res => {
        countLeft = 100 - Number.parseInt(res)
        $('[data-label=countLeft').text(countLeft - drewPoints.length)
    })

    $.get('api/plate')
      .then(res => {
        var plate = new Image()
        plate.src = res.url
        ctx.drawImage(plate, 0, 0)
    })

    nextBtn.click(performDrew)
    prevBtn.click(() => {
        isReserve = true
        performDrew()
        isReserve = false
    })
    towardBtn.click(() => {
        if(isBtnActived(towardBtn)){
            clearInterval(playProgress)
            playProgress = setInterval(performDrew, 2);
        } else {
            isReserve = false
            inactiveBtn(backwardBtn)
            activeBtn(towardBtn)
            clearInterval(playProgress)
            playProgress = setInterval(performDrew, DEFAULT_SPEED);
        }
    })
    backwardBtn.click(() => {
        if(isBtnActived(backwardBtn)){
            clearInterval(playProgress)
            playProgress = setInterval(performDrew, 2);
        } else {
            isReserve = true
            inactiveBtn(towardBtn)
            activeBtn(backwardBtn)
            if(progressbar.val() > 0 && isReserve){
                activeBtn(playBtn)
                enableBtn(playBtn)
                enableBtn(prevBtn)
                enableBtn(backwardBtn)
                if(progressbar.val() < last.length)
                    enableBtn(nextBtn)
                return
            }
            clearInterval(playProgress)
            playProgress = setInterval(performDrew, DEFAULT_SPEED);
        }
    })
    playBtn.click(function(){
        if(isBtnActived(playBtn)){
            clearInterval(playProgress)
            inactiveBtn(playBtn)
        } else {
            activeBtn(playBtn)
            playProgress = setInterval(performDrew, DEFAULT_SPEED);
        }
    })
    resetBtn.click(function(){
        var a = drewPoints
        a.forEach(e => {
            draw(e[0], e[1])
            record(e[0], e[1])
        });
    })
    uploadBtn.click(function(){
        UIkit.notification('正在上传...');
        $.post('upload', {
            points: drewPoints,
            _token:$("input[name='_token']").val()
        })
         .then(res => {
            UIkit.notification('上传成功!');
         })
         .catch(err => {
            UIkit.notification('上传失败! 太多bug了..');
         })
    })
    playBtn.click()
});
