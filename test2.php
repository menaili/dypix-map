<?php
$path = './data-new.json';
?>
<link rel="stylesheet" href="style.css">
<?php   
$json_string = file_get_contents($path);
$parsed_json = json_decode($json_string, true);
?>
<div class="datalistcontent">
    <div class="messageresponses">

    </div>

    <form id="" class="listingdata" method="post" action="editjson.php">
        <button type="submit">Enregistrer</button>   
        <button id="add-field" class="add-field" type="button">Ajouter</button>    

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
            <div class="listwrap">
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
                    <div class="datalist">
                        <div class="listelement orddv"><input type="text" name="order[<?=$data['order']?>]" class="inptsustem" value="<?=$data['order']?>" readonly /></div>
                        <div class="listelement willdv"><input type="text" name="willaya[<?=$data['order']?>]" class="inptsustem" value="<?=$data['willaya']?>" /></div>
                        <div class="listelement vldv"><input type="text" name="ville[<?=$data['order']?>]" class="inptsustem" value="<?=$data['ville']?>" /></div>
                        <div class="listelement adrdv"><input type="text" name="adresse[<?=$data['order']?>]" class="inptsustem" value="<?=$data['adresse']?>" /></div>
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
    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="module" src="./index.js"></script>
<script>
    $('input.inptsustem').on('click', function(){
        $('.listelement').removeClass("activeclassbg");
        $(this).parent().addClass( "activeclassbg" );
    }); 
    $('#add-field').on('click', function(e){
        e.preventDefault();
        var itemnbr = $('.datalist').length+1;
        const itemnbrs = itemnbr++;
        var bigString = [
            '<div class="datalist">',
                    '<div class="listelement orddv"><input type="text" name="order['+ itemnbrs +']" class="inptsustem" value="'+ itemnbrs +'" readonly/></div>',
                    '<div class="listelement willdv"><input type="text" name="willaya['+ itemnbrs +']" class="inptsustem" value="" /></div>',
                    '<div class="listelement vldv"><input type="text" name="ville['+ itemnbrs +']" class="inptsustem" value="" /></div>',
                    '<div class="listelement adrdv"><input type="text" name="adresse['+ itemnbrs +']" class="inptsustem" value="" /></div>',
                    '<div class="listelement teldv"><input type="text" name="tel['+ itemnbrs +']" class="inptsustem" value="" /></div>',
                    '<div class="listelement latdv"><input type="text" name="lat['+ itemnbrs +']" class="inptsustem" value="" /></div>',
                    '<div class="listelement lngdv"><input type="text" name="lng['+ itemnbrs +']" class="inptsustem" value="" /></div>',
                    '<div class="listelement cltdv"><select name="client['+itemnbrs+']" id="client'+itemnbrs+'" class="client" onchange="selectedoption('+itemnbrs+');" onclick="jsfunction('+itemnbrs+');"></select></div>',
                    '<div class="listelement imgdv"><input type="text" name="image['+ itemnbrs +']" class="inptsustem" value="" /></div>',
                    '<div class="listelement actdv"><input type="text" name="status['+ itemnbrs +']" class="inptsustem" value="1" /></div>',
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
        console.log(defval+proval+partval);
        var liststring = [
            '<option value="" '+defval+'></option>',
            '<option value="Particuliers" '+partval+'>Particuliers</option>',
            '<option value="Professionnels"  '+proval+' >Professionnels</option>'
        ];        
        $("select#client"+ vr + "").find('option').remove().end().append(liststring.join(''));
    }

</script>
