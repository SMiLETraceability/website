    function getLocation(){
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(showPosition);
        }else{
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position){
        //console.log(position.coords.longitude+ " " + position.coords.latitude);
        document.getElementById('longitude').value = position.coords.longitude;
        document.getElementById('latitude').value = position.coords.latitude;
    }
