/* What does this script handle?
- Show/hide following tab
*/
var showFollowing = true;
var followingDiv;
var followingBackImg;

function followingVisible(){
    if(showFollowing){
        followingDiv.style.display = 'flex';
    }else{
        followingDiv.style.display = 'none';
    }
}

function changeFollowingVisibility(){
    if(showFollowing){
        showFollowing = false;
    }else if (!showFollowing){
        showFollowing = true;
    }
    followingVisible();
}


(function(window, document, undefined){

    // immidiate execution
    
    window.onload = init;
    
      function init(){
        // execute after DOM loads

        // Assign html emements
        followingDiv = document.getElementById('body_home_following_div');
        followingBackImg = document.getElementById('body_back_img');
      }
    
 })(window, document, undefined);
