var options = {
    valueNames: [ 'sort-lane',
                  'sort-champion',
                  'sort-enemy',
                  'sort-kp',
                  'sort-dp',
                  'sort-kills',
                  'sort-deaths',
                  'sort-assists',
                  'sort-damage',
                  'sort-gold',
                  'sort-cs',
                  'sort-length',
                  'sort-damagem',
                  'sort-goldm',
                  'sort-csm',
                  'sort-date',
                  'sort-kda',
                  'sort-7bs',
                  'sort-cc' ],
    page: document.getElementById("pages").value,
    plugins: [
      ListPagination({})
    ]
  };

var userList = new List('users', options);
console.log(userList);
//        document.getElementById("p1").innerHTML = userList.items[0]['_values']['sort-damage'];

function fullAvg() {
    kpa = 0;
    dpa = 0;
    ka = 0;
    da = 0;
    aa = 0;
    dmga = 0;
    golda = 0;
    csa = 0;
    lengtha = 0;
    dmgma = 0;
    goldma = 0;
    csma = 0;
    score = 0;
    cc = 0;
    for(i=0; i<userList.items.length; i++) {
        kpa += parseFloat(userList.items[i]['_values']['sort-kp']);
        dpa += parseFloat(userList.items[i]['_values']['sort-dp']);
        ka += parseInt(userList.items[i]['_values']['sort-kills']);
        da += parseInt(userList.items[i]['_values']['sort-deaths']);
        aa += parseInt(userList.items[i]['_values']['sort-assists']);
        dmga += parseInt(userList.items[i]['_values']['sort-damage']);
        golda += parseInt(userList.items[i]['_values']['sort-gold']);
        csa += parseInt(userList.items[i]['_values']['sort-cs']);
        lengtha += parseInt(userList.items[i]['_values']['sort-length']);
        dmgma += parseFloat(userList.items[i]['_values']['sort-damagem']);
        goldma += parseFloat(userList.items[i]['_values']['sort-goldm']);
        csma += parseFloat(userList.items[i]['_values']['sort-csm']);
        score += parseFloat(userList.items[i]['_values']['sort-7bs']);
        cc += parseFloat(userList.items[i]['_values']['sort-cc']);
    }
    kpa /= userList.items.length;
    dpa /= userList.items.length;
    ka /= userList.items.length;
    da /= userList.items.length;
    aa /= userList.items.length;
    dmga /= userList.items.length;
    golda /= userList.items.length;
    csa /= userList.items.length;
    lengtha /= userList.items.length;
    dmgma /= userList.items.length;
    goldma /= userList.items.length;
    csma /= userList.items.length;
    score /= userList.items.length;
    cc /= userList.items.length;

    lengthat = getTime(lengtha);

    document.getElementById("avg-kp").innerHTML = kpa.toFixed(2);
    document.getElementById("avg-dp").innerHTML = dpa.toFixed(2);
    document.getElementById("avg-kills").innerHTML = ka.toFixed(1);
    document.getElementById("avg-deaths").innerHTML = da.toFixed(1);
    document.getElementById("avg-assists").innerHTML = aa.toFixed(1);
    document.getElementById("avg-damage").innerHTML = dmga.toFixed(2);
    document.getElementById("avg-gold").innerHTML = golda.toFixed(2);
    document.getElementById("avg-cs").innerHTML = csa.toFixed(2);
    document.getElementById("avg-length").innerHTML = lengthat;
    document.getElementById("avg-damagem").innerHTML = dmgma.toFixed(2);
    document.getElementById("avg-goldm").innerHTML = goldma.toFixed(2);
    document.getElementById("avg-csm").innerHTML = csma.toFixed(2);
    document.getElementById("avg-7bs").innerHTML = score.toFixed(2);
    document.getElementById("avg-cc").innerHTML = cc.toFixed(2);

    document.getElementById("avg-kda").innerHTML = ((ka+aa)/da).toFixed(2);

    document.getElementById("total-games").innerHTML = userList.items.length;
}

userList.on("updated", function(){
    kpaf = 0;
    dpaf = 0;
    kaf = 0;
    daf = 0;
    aaf = 0;
    dmgaf = 0;
    goldaf = 0;
    csaf = 0;
    lengthaf = 0;
    dmgmaf = 0;
    goldmaf = 0;
    csmaf = 0;
    scoref = 0;
    ccf = 0;
    for(i=0; i<userList.matchingItems.length; i++) {
        kpaf += parseFloat(userList.matchingItems[i]['_values']['sort-kp']);
        dpaf += parseFloat(userList.matchingItems[i]['_values']['sort-dp']);
        kaf += parseInt(userList.matchingItems[i]['_values']['sort-kills']);
        daf += parseInt(userList.matchingItems[i]['_values']['sort-deaths']);
        aaf += parseInt(userList.matchingItems[i]['_values']['sort-assists']);
        dmgaf += parseInt(userList.matchingItems[i]['_values']['sort-damage']);
        goldaf += parseInt(userList.matchingItems[i]['_values']['sort-gold']);
        csaf += parseInt(userList.matchingItems[i]['_values']['sort-cs']);
        lengthaf += parseInt(userList.matchingItems[i]['_values']['sort-length']);
        dmgmaf += parseFloat(userList.matchingItems[i]['_values']['sort-damagem']);
        goldmaf += parseFloat(userList.matchingItems[i]['_values']['sort-goldm']);
        csmaf += parseFloat(userList.matchingItems[i]['_values']['sort-csm']);
        scoref += parseFloat(userList.matchingItems[i]['_values']['sort-7bs']);
        ccf += parseFloat(userList.matchingItems[i]['_values']['sort-cc']);
    }
    kpaf /= userList.matchingItems.length;
    dpaf /= userList.matchingItems.length;
    kaf /= userList.matchingItems.length;
    daf /= userList.matchingItems.length;
    aaf /= userList.matchingItems.length;
    dmgaf /= userList.matchingItems.length;
    goldaf /= userList.matchingItems.length;
    csaf /= userList.matchingItems.length;
    lengthaf /= userList.matchingItems.length;
    dmgmaf /= userList.matchingItems.length;
    goldmaf /= userList.matchingItems.length;
    csmaf /= userList.matchingItems.length;
    scoref /= userList.matchingItems.length;
    ccf /= userList.matchingItems.length;

    lengthatf = getTime(lengthaf);

    //console.log(userList.items.length);
    for(i=0; i<userList.items.length; i++) {
        //console.log(i);
        try {
            getClass(i, "sort-kills").className += getClassColor(i, "sort-kills", kaf);
            getClass(i, "sort-deaths").className += getClassColorI(i, "sort-deaths", daf);
            getClass(i, "sort-assists").className += getClassColor(i, "sort-assists", aaf);
            getClass(i, "sort-damage").className += getClassColor(i, "sort-damage", dmgaf);
            getClass(i, "sort-gold").className += getClassColor(i, "sort-gold", goldaf);
            getClass(i, "sort-cs").className += getClassColor(i, "sort-cs", csaf);
            getClass(i, "dmgm-color").className += getClassColor(i, "sort-damagem", dmgmaf);
            getClass(i, "goldm-color").className += getClassColor(i, "sort-goldm", goldmaf);
            getClass(i, "csm-color").className += getClassColor(i, "sort-csm", csmaf);
            getClass(i, "kp-color").className += getClassColor(i, "sort-kp", kpaf);
            getClass(i, "dp-color").className += getClassColorI(i, "sort-dp", dpaf);
            getClass(i, "7bs-color").className += getClassColor(i, "sort-7bs", scoref);
            getClass(i, "cc-color").className += getClassColor(i, "sort-cc", ccf);
        }catch(err){
            //console.log(i+" Failed");
        }
    }

    document.getElementById("avg-kp-f").innerHTML = kpaf.toFixed(2);
    document.getElementById("avg-dp-f").innerHTML = dpaf.toFixed(2);
    document.getElementById("avg-kills-f").innerHTML = kaf.toFixed(1);
    document.getElementById("avg-deaths-f").innerHTML = daf.toFixed(1);
    document.getElementById("avg-assists-f").innerHTML = aaf.toFixed(1);
    document.getElementById("avg-damage-f").innerHTML = dmgaf.toFixed(2);
    document.getElementById("avg-gold-f").innerHTML = goldaf.toFixed(2);
    document.getElementById("avg-cs-f").innerHTML = csaf.toFixed(2);
    document.getElementById("avg-length-f").innerHTML = lengthatf;
    document.getElementById("avg-damagem-f").innerHTML = dmgmaf.toFixed(2);
    document.getElementById("avg-goldm-f").innerHTML = goldmaf.toFixed(2);
    document.getElementById("avg-csm-f").innerHTML = csmaf.toFixed(2);
    document.getElementById("avg-7bs-f").innerHTML = scoref.toFixed(2);
    document.getElementById("avg-cc-f").innerHTML = ccf.toFixed(2);

    document.getElementById("avg-kda-f").innerHTML = ((kaf+aaf)/daf).toFixed(2);

    document.getElementById("total-games-f").innerHTML = userList.matchingItems.length;

    if(userList.items.length == userList.matchingItems.length) {
        $("#matchavg-f").hide();
    } else {
        $("#matchavg-f").show();
    }
});

//        document.getElementById("search-global").onchange=function(){
//            userList.search(document.getElementById("search-global").value);
//        };

//        $("#search-champion").onkeydown=function() {
////            console.log($("#search-champion").value);
//            userList.search($("#search-champion").value, ['sort-champion']);
//        };

//        document.getElementById("search-champion").onchange=function(){
//            console.log(document.getElementById("search-champion").value);
//            userList.search(document.getElementById("search-champion").value, ['sort-champion']);
//        };

document.getElementById("search-enemy").onkeyup=function(){
    userList.search(document.getElementById("search-enemy").value, ['sort-enemy']);
};
document.getElementById("search-champion").onkeyup=function(){
    userList.search(document.getElementById("search-champion").value, ['sort-champion']);
};
document.getElementById("search-lane").onkeyup=function(){
    userList.search(document.getElementById("search-lane").value, ['sort-lane']);
};

document.getElementById("pages").onchange=function(){
//            console.log(document.getElementById("pages").value);
    userList.page = document.getElementById("pages").value;
    userList.update();
};

$("[type='number']").keypress(function (evt) {
//            console.log('keypress');
    evt.preventDefault();
});

document.getElementById("pages").onkeydown=function(evt){
//            console.log(evt.valueOf()['code']);
    if(evt.valueOf()['code'] == 'Backspace') {
        evt.preventDefault();
    }
};

for(i=0; i<document.getElementById("pagination-div").getElementsByClassName("page").length; i++) {
    document.getElementById("pagination-div").getElementsByClassName("page")[i].onclick=function(){
        console.log('clicked on page '+i);
        userList.update();
    };
}

fullAvg();
userList.update();

console.log(ka);