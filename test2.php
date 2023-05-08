<?php
$path = 'data-new.json';
$json_array = [];
if ( (isset($_POST['willaya'])) && (isset($_POST['ville'])) && (isset($_POST['lat'])) && (isset($_POST['lng'])) ):
foreach($_POST['order'] as $key => $value) {
    if ( isset($_POST['status'][$key]) ) { $status = '1'; } 
    else { $status='0'; }
    $json_array[]  = [ 
        "order" => $value,
        "willaya" => strtoupper(htmlspecialchars($_POST['willaya'][$key])),
        "ville" => strtoupper(htmlspecialchars($_POST['ville'][$key])),
        "adresse" => htmlspecialchars($_POST['adresse'][$key]),
        "tel" => $_POST['tel'][$key],
        "lat" => $_POST['lat'][$key],
        "lng" => $_POST['lng'][$key],
        "client" => $_POST['client'][$key],
        "image" => $_POST['image'][$key],
        "status" => $status
    ];
    
}

$json_response = json_encode($json_array, JSON_PRETTY_PRINT);

$fp = fopen($path, 'w');
fwrite($fp, $json_response);
fclose($fp);
endif;

?>
<link rel="stylesheet" href="stylemaps.css">
<?php   
$json_string = file_get_contents($path);
$parsed_json = json_decode($json_string, true);
?>
<div class="datalistcontent">
    <div class="messageresponses">

    </div>

    <form class="listingdata" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <button type="submit">Enregistrer</button>  
         
            

        <div class="listingrepers">
            <div class="listheader">
                <div class="lhead orddv">V</div>
                <div class="lhead willdv">WILLAYA</div>
                <div class="lhead vldv">VILLE</div>
                <div class="lhead adrdv">ADRESSE</div>
                <div class="lhead teldv">TEL</div>
                <div class="lhead latdv">LAT</div>
                <div class="lhead lngdv">LNG</div>
                <div class="lhead cltdv">CLIENT</div>
                <div class="lhead imgdv">IMAGE</div>
                <div class="lhead actdv">PUB</div>
            </div>
            <div id="sortable" class="listwrap connectedSortable">
                <?php
                //$clients_array = [];
                foreach ($parsed_json as $data) :
                //$client = $data['client'][];
                if ($data['status']=='1') : $checkedstatus = 'checked'; else : $checkedstatus = ''; endif;

                if($data['client'] == "Particuliers") {
                        $selectlist = '<option value=""></option><option value="Professionnels">Professionnels</option><option value="Particuliers" Selected>Particuliers</option>';
                    }
                    if($data['client'] == "Professionnels") {
                        $selectlist = '<option value=""></option><option value="Professionnels" Selected>Professionnels</option><option value="Particuliers">Particuliers</option>';
                    }
                    if( ($data['client'] != "Particuliers") && ($data['client'] != "Professionnels")) {
                        $selectlist = '<option value="" Selected></option><option value="Professionnels">Professionnels</option><option value="Particuliers">Particuliers</option>';
                    }
                    
                    ?>
                    <div id="item<?=$data['order']?>" class="datalist">
                        <div class="listelement orddv"><input type="text" name="order[<?=$data['order']?>]" class="inptsustem orderelements" value="<?=$data['order']?>" readonly /></div>
                        <div class="listelement willdv"><input type="text" name="willaya[<?=$data['order']?>]" class="inptsustem" value="<?=stripslashes($data['willaya'])?>" /></div>
                        <div class="listelement vldv"><input type="text" name="ville[<?=$data['order']?>]" class="inptsustem" value="<?=stripslashes($data['ville'])?>" /></div>
                        <div class="listelement adrdv"><input type="text" name="adresse[<?=$data['order']?>]" class="inptsustem" value="<?= stripslashes($data['adresse']) ?>" /></div>
                        <div class="listelement teldv"><input type="text" name="tel[<?=$data['order']?>]" class="inptsustem" value="<?=$data['tel']?>" /></div>
                        <div class="listelement latdv"><input type="text" name="lat[<?=$data['order'];?>]" class="inptsustem" value="<?=$data['lat']?>" /></div>
                        <div class="listelement lngdv"><input type="text" name="lng[<?=$data['order'];?>]" class="inptsustem" value="<?=$data['lng']?>" /></div>
                        <div class="listelement cltdv"><select name="client[<?=$data['order'];?>]" id="client<?=$data['order'];?>" class="client"><?=$selectlist; ?></select></div>
                        <div class="listelement imgdv"><input type="text" name="image[<?=$data['order'];?>]" class="inptsustem" value="<?=$data['image']?>" /></div>
                        <div class="listelement actdv">
                            <label class="toggler-wrapper style-22">
                            <input type="checkbox" name="status[<?=$data['order'];?>]" value="1" <?=$checkedstatus;?>>
                            <div class="toggler-slider">
                                <div class="toggler-knob"></div>
                            </div>
                            </label>
                        </div>
                        <!--<div class="listelement actdv"><input type="text" name="status[<?=$data['order'];?>]" class="inptsustem" value="<?=$data['status']?>" /></div>-->
                    </div>
                    <?php
                endforeach;
                ?>
            </div>
        </div>
        <button id="add-field" class="add-field" type="button">Ajouter</button> 
    </form>
</div>

<?php


//header('Content-Type: application/json');

//echo $json_response;

?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<!--<script type="module" src="./index.js"></script>-->
<script>
    var $ = jQuery.noConflict();
    (function( $ ) {
        //begin validation
        
        $('form.listingdata').on('submit', function(event){
           //event.preventDefault();
           
           //let ville = $('input[name="willaya"]').val();
           //if ( (ville=='') || (ville = null) ) {consolel.log('error ville'); return false;} else {console.log('ville = '+ville);}
           
           // willaya
            $( "div.listelement.willdv input" ).each(function( indexs ) {
                if ( $( this ).val()=='' ) { 
                    $( this ).css('border', 'solid 1px #FF0000');
                    event.preventDefault(); 
                    return false; 
                } else { return true; }
            });
            
            // ville
            $( "div.listelement.vldv input" ).each(function( indexs ) {
                if ( $( this ).val()=='' ) { 
                    $( this ).css('border', 'solid 1px #FF0000');
                    event.preventDefault(); 
                    return false; 
                } else { return true; }
            });
            
            // adresse
            $( "div.listelement.adrdv input" ).each(function( indexs ) {
                if ( $( this ).val()=='' ) { 
                    $( this ).css('border', 'solid 1px #FF0000');
                    event.preventDefault(); 
                    return false; 
                } else { return true; }
            });
            
            // telephone
            $( "div.listelement.teldv input" ).each(function( indexs ) {
                if ( $( this ).val()=='' ) { 
                    $( this ).css('border', 'solid 1px #FF0000');
                    event.preventDefault(); 
                    return false; 
                } else { return true; }
            });
            
            // lat
            $( "div.listelement.latdv input" ).each(function( indexs ) {
                if ( $( this ).val()=='' ) { 
                    $( this ).css('border', 'solid 1px #FF0000');
                    event.preventDefault(); 
                    return false; 
                } else { return true; }
            });
            
            // lng
            $( "div.listelement.lngdv input" ).each(function( indexs ) {
                if ( $( this ).val()=='' ) { 
                    $( this ).css('border', 'solid 1px #FF0000');
                    event.preventDefault(); 
                    return false; 
                } else { return true; }
            });
            
            // client
            $( "div.listelement.cltdv input" ).each(function( indexs ) {
                if ( $( this ).val()=='' ) { 
                    $( this ).css('border', 'solid 1px #FF0000');
                    event.preventDefault(); 
                    return false; 
                } else { return true; }
            });

        });
        
        
        //end validation
        $('input.inptsustem').on('click', function(){
            $('.listelement').removeClass("activeclassbg");
            $(this).parent().addClass( "activeclassbg" );
        });     
        $('#add-field').on('click', function(e){
            e.preventDefault();
            var itemnbr = $('.datalist').length+1;
            const itemnbrs = itemnbr++;
            var bigString = [                                                           
                '<div id ="item'+ itemnbrs +'" class="datalist">',
                    '<div class="listelement orddv"><input type="text" name="order['+ itemnbrs +']" class="inptsustem orderelements" value="'+ itemnbrs +'" readonly/></div>',
                    '<div class="listelement willdv"><input type="text" name="willaya['+ itemnbrs +']" class="inptsustem" value="" /></div>',
                    '<div class="listelement vldv"><input type="text" name="ville['+ itemnbrs +']" class="inptsustem" value="" /></div>',
                    '<div class="listelement adrdv"><input type="text" name="adresse['+ itemnbrs +']" class="inptsustem" value="" /></div>',
                    '<div class="listelement teldv"><input type="text" name="tel['+ itemnbrs +']" class="inptsustem" value="" /></div>',
                    '<div class="listelement latdv"><input type="text" name="lat['+ itemnbrs +']" class="inptsustem" value="" /></div>',
                    '<div class="listelement lngdv"><input type="text" name="lng['+ itemnbrs +']" class="inptsustem" value="" /></div>',
                    '<div class="listelement cltdv"><select name="client['+itemnbrs+']" id="client'+itemnbrs+'" class="client">',
                    '<option value="" selected></option>',
                    '<option value="Professionnels">Professionnels</option>',
                    '<option value="Particuliers">Particuliers</option>',
                    '</select></div>',
                    '<div class="listelement imgdv"><input type="text" name="image['+ itemnbrs +']" class="inptsustem" value="" /></div>',
                    '<div class="listelement actdv"><label class="toggler-wrapper style-22">',
                    '<input type="checkbox" name="status['+ itemnbrs +']" value="1" checked>',
                    '<div class="toggler-slider">',
                    '<div class="toggler-knob"></div>',
                    '</div>',
                    '</label>',
                    '</div>',
                '</div>' 
            ];
            $('.listwrap').append(bigString.join(''));
        });
        var defval = '';
        var partval = '';
        var proval = '';
        function selectedoption(n){
            
            var optval = $("select#client"+ n + "").find(":selected").val();
            if(optval==="Particuliers") { defval=''; proval=''; partval='selected'; }
            if(optval==="Professionnels") { defval=''; proval='selected'; partval=''; }
            if(optval==="") { defval='selected'; proval=''; partval=''; }
            return defval+proval+partval;
        }
        function jsfunction(vr){
            //selectedoption();
            //console.log(defval+proval+partval);
            var liststring = [
                '<option value="" '+defval+'></option>',
                '<option value="Particuliers" '+partval+'>Particuliers</option>',
                '<option value="Professionnels"  '+proval+' >Professionnels</option>'
            ];        
            $("select#client"+ vr + "").find('option').remove().end().append(liststring.join(''));
        }
        $( "#sortable" ).sortable({
            connectWith: ".connectedSortable",
            stop: function(event, ui) {
                $('.connectedSortable').each(function() {
                    result = "";
                    //alert($(this).sortable("toArray"));
                    $(this).find("div.datalist").each(function(){
                        result += $(this).text() + ",";
                    });
                    $("."+$(this).attr("id")+".list").html(result);
                    var orderlist = $('.datalist').length;
                    let t = 1;
                    $( "input.orderelements" ).each(function( index ) {
                        $( this ).val(t++);
                    });
                });
            }
        });
    })(jQuery);
</script>
