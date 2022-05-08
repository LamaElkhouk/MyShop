/**********************js menu burger**************************************/
var burger=document.querySelector('.burger');

var menu= document.querySelector('.menu');

var div=document.querySelector('.overlay');

div.classList.remove('overlay');


burger.onclick=function (){

  menu.classList.add('menu_close');
  div.classList.add('overlay');

    div.onclick=function(){

      menu.classList.remove('menu_close');
      div.classList.remove('overlay');

    }
}


/*******************js galerie*********************************************/
var photos = document.getElementById('galerie_mini') ;

var liens = photos.getElementsByTagName('a') ;

var grande_photo = document.getElementById('photo') ;

for (var i = 0 ; i < liens.length ; ++i) {

  liens[i].onmouseover = function () {
    grande_photo.src = this.href;

    return false;
  };
}





