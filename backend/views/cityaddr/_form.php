
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

/* @var $this yii\web\View */
/* @var $model common\models\CityaddrModel */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    #map {
            width: 50%;
            height: 300px;
        }
    </style>
<div class="cityaddr-model-form">

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
                    $("#cityaddrmodel-city_addr_full").val($("#cityaddrmodel-country_id option:selected").text()+", ");
                });'
            
        
        ])?>
        

    <?= $form->field($model, 'city_id')->dropDownList($arrCity, [
        'prompt'=>'',
        'onchange'=>'$("#cityaddrmodel-city_addr_full").val(
            $("#cityaddrmodel-country_id option:selected").text()+", "+ 
            $("#cityaddrmodel-city_id option:selected").text()+", "+
            $("#cityaddrmodel-city_addr").val());'
        ])?>

    <?= $form->field($model, 'city_addr')->textInput([
        'maxlength' => true
        ]) ?>
<?php
$this->registerJs('

    jQuery(document).on("change" ,"#'. Html::getInputId($model ,'city_addr') .'" ,function(){
        $("#'. Html::getInputId($model ,'city_addr_full') .'").val();
        var first = $("#cityaddrmodel-country_id option:selected").text()+", ";
        var second = $("#cityaddrmodel-city_id option:selected").text()+", ";
        var third = $("#'. Html::getInputId($model ,'city_addr') .'").val();
        var forth = first + second + third;
        $("#'. Html::getInputId($model ,'city_addr_full') .'").val(forth);

    });

');

?>
    
    <?= $form->field($model, 'city_addr_full')->textInput([
        'maxlength' => true,
        'readonly' => true
        ]) ?>

    
     
    <div class="form-group">
        <?=  Html::submitButton(Yii::t('app', 'Сохранить'), [
            'class' => !$view ? 'btn btn-success active' : 'btn btn-success disabled'
            ]);?>
    </div>
    
    <?php ActiveForm::end(); ?>

    <div id="map"></div>
<script>


var map;
var infowindow;

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -34.397, lng: 150.644},
    zoom: 15
    });
    infowindow = new google.maps.InfoWindow();
    var geocoder = new google.maps.Geocoder();
    var addr = '<?= $address ?>';
    geocoder.geocode({'address': addr}, function(results, status) {
          if (status === 'OK') {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: map,
              position: results[0].geometry.location,
              title: '<?= $address ?>'
            });
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
}


</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbNSNnyzCZhfN57aV-UBVN-RLZjhh4uQ0&callback=initMap"></script>
          

        
        
        
</div>




