
<?php
use yii\helpers\{Html, Url};
use yii\bootstrap\ActiveForm;
use dosamigos\google\maps\{
    LatLng, 
    DirectionsWayPoint, 
    TravelMode,
    PolylineOptions,
    DirectionsRenderer,
    DirectionsService,
    InfoWindow,
    Marker,
    Map,
    DirectionsRequest,
    Polygon,
    BicyclingLayer
};
$this->title = 'My Yii Application';
?>
<style>
    #map {
            width: 50%;
            height: 300px;
        }
    </style>
    
<div class="site-index">
<?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig'=>[
            'template'=>"{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}"
        ],
        'options'=>[
            'enctype'=>'multipart/form-data'
        ]
    ]
    ); 
    
    ?>

<?= $form->field($model, 'country_id')->dropDownList($arrCountry, [
        'prompt'=>'Выберите страну',
        'onchange' =>'
            $.post("/city/lists?id='.'"+$(this).val(), function(data){
                    $("select#cityaddrmodel-city_id").html(data);
                });'     
        ])?>

    <?= $form->field($model, 'city_id')->dropDownList($arrCity, [
        'prompt'=>'',
        'onchange' =>'
        $.ajax({
            type: "POST",
            url: "/cityaddr/lists2?id='.'"+$(this).val(),
            data: $(this).serialize(),
            success: function(response)
            {
                
                var jsonData = JSON.parse(response);
                var loc = [];
                var ind = 0; 
               $.each(jsonData, function () {
                    $.each(this, function (name, value) {
                        loc[ind]=value["city_addr_full"];
                        ind++;
                        //console.log(value["city_addr_full"]);
                    });
                });          
                MyfuncGeo(loc);
   
           }
       });'
        
        ])?>

    
    <?php ActiveForm::end(); ?>

    <?php 
        /*$ind = 0;
        $arrCityaddrFull=[];
        foreach($cityaddrs as $cityaddr){
            $arrCityaddrFull[$ind] = $cityaddr->city_addr_full;
            $ind++;
        }*/
    ?>

    <div id="map"></div>
<script type="text/javascript">
var nextAddress = 0;
var locations = [];
var map;
var geocoder;
var bounds;
var infowindow;
function MyfuncGeo(loc){
    locations=loc;
    nextAddress = 0;
    console.log(locations);
    initMap();
    theNext();
}

function theNext(){
    if (nextAddress < locations.length) {
        setTimeout('geocodeAddress("'+locations[nextAddress]+'",theNext)', 200);
        nextAddress++;
    } else {
        map.fitBounds(bounds);
    }
}


function initMap() {
    var latlng = new google.maps.LatLng(47.0750, 37.3350);
    infowindow = new google.maps.InfoWindow();
	var mapOptions = {
        zoom: 8,
        center: latlng,//{lat: -34.397, lng: 150.644},
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    geocoder = new google.maps.Geocoder(); 
    map = new google.maps.Map(document.getElementById("map"), mapOptions);
    bounds = new google.maps.LatLngBounds();
    
    //theNext(); 
}

function geocodeAddress(address, next) {
	  
      geocoder.geocode({address:address}, function (results,status)
        { 
           console.log(status); 
           if (status == google.maps.GeocoderStatus.OK) {
            var p = results[0].geometry.location;
            var lat=p.lat();
            var lng=p.lng();
            createMarker(address,lat,lng);
          }
          else {
             if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
              nextAddress--;
              delay++;
            } else {
                          }   
          }
          next();
        }
      );
    }

function createMarker(add,lat,lng) {
   var contentString = add;
   var marker = new google.maps.Marker({
     position: new google.maps.LatLng(lat,lng),
     map: map,
    title: contentString
           });
    google.maps.event.addListener(marker, 'click', function() {
     infowindow.setContent(contentString); 
     infowindow.open(map,marker);
   });
   bounds.extend(marker.position);

 }
 //var locations = [];
 /*var nextAddress = 0;
function theNext(locations) {
    if (nextAddress < locations.length) {
        setTimeout('geocodeAddress("'+locations[nextAddress]+'",theNext)', 100);
        nextAddress++;
    } else {
        map.fitBounds(bounds);
    }
}
*/
</script>


<script async defer src="https://maps.googleapis.com/maps/api/js?"></script>
          

        
        
      

</div>
