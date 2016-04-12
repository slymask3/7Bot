$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

function toggleMatch(id) {
    $('#match-more-'+id).toggle();
}

function getTime(unix) {
    min = Math.floor(unix / 60);
    sec = unix % 60;
    mins = min.toFixed(0);
    if(min < 10) {
        mins = '0'+min.toFixed(0);
    }
    secs = sec.toFixed(0);
    if(sec < 10) {
        secs = '0'+sec.toFixed(0);
    }
    return mins+':'+secs;
}

function getClass(i, sort) {
    return document.getElementById("game-number-"+i).getElementsByClassName(sort)[0];
}

function getClassColor(i, sort, avg) {
    if(parseInt(document.getElementById("game-number-"+i).getElementsByClassName(sort)[0].innerHTML) >= avg) {
        return " aboveavg";
    } else {
        return " belowavg";
    }
}

function getClassColorI(i, sort, avg) {
    if(parseInt(document.getElementById("game-number-"+i).getElementsByClassName(sort)[0].innerHTML) >= avg) {
        return " belowavg";
    } else {
        return " aboveavg";
    }
        }

function hideTopBar() {
    $('#topbar').hide();
}