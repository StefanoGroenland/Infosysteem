<!DOCTYPE html>
<html>
    <head>
        <title>Factuur</title>
        <?php include_once("includes/link.php");?>
        <style>
            table {
                width: 100%;
            }
            th:nth-child(1){
                width: 10%;
            }
            th:nth-child(2){
                width: 70%;
            }
            th:nth-child(3){
                width: 10%;
            }
            th:nth-child(4){
                width: 10px;
            }
        </style>
    </head>
    <body class="page-header-fixed bg-1">
        <!-- Begin Navigatie !-->
        <?php include_once("includes/topNavigatie.php");?>
        <!-- Einde Navigatie !-->
        <div class="container">
            <div class="widget-container fluid-height">
                <div class="widget-content padded clearfix">
                    <div class="widget-content clearfix">
        
            <h1>Factuur</h1>
            <div>
                <a href="./?control=admin&action=productenBeheer">
                    Producten lijst
                </a>
            </div>
            <form action="." method="post" class="pure-form pure-form-aligned">
                <input type='hidden' name="action" value="factuur">
                <input type='hidden' name="control" value="admin">
                <fieldset>
                    <div class="pure-control-group">
                        <label>Klant</label>
                        <select name="klant_id">
                            <?php foreach ($klanten as $klant):?>
                            <option value="<?php echo $klant->geefId()?>"><?php echo $klant->geefNaam();?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="pure-control-group">
                        <label>Soort</label>
                        <select name="soort">
                            <option value="factuur">Factuur</option>
                            <option value="offerte">Offerte</option>
                        </select>
                    </div>
                    <table class="table table-bordered table-striped dataTable">
                        <thead>
                            <th class="hidden-xs " style="color:white;"> Naam</th>
                            <th class="hidden-xs " style="color:white;"> Beschrijving</th>
                            <th class="hidden-xs " style="color:white;"> Prijs</th>
                            <th class="hidden-xs " style="color:white;"> Aantal</th>
                        </thead>
                        <tbody id="tabelbody">
                            <tr class="clone">
                                <td>
                                    <select class="selecteer" name="product_0" onclick="$(this).change(selecteer)">
                                        <?php foreach($producten as $product):?>
                                            <option value="<?php echo $product->geefId();?>">
                                                <?php echo $product->geefNaam();?>
                                            </option>
                                        <?php endforeach;?>
                                    </select>
                                </td>
                                <td>
                                    <span id="besch_0"><?php echo $producten[0]->geefBeschrijving();?></span>
                                </td>
                                <td>
                                    &#8364; <span id="prijs_0"><?php echo $producten[0]->geefPrijs();?></span>
                                </td>
                                <td>
                                    <input type="number" value="1" min="1" name="aantal_0" style="width: 100px;" required="required"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <input type="button" id="add" value="add"/>
                    <input type="hidden" name="teller" value="0"/>
                    
                    <div class="pure-control-group">
                        <label>Korting</label>
                        <input type="number" name="korting" min="0" max="100"/> %
                    </div>
                    
                    <div class="pure-controls">
                        <button type="submit" class="pure-button pure-button-primary">Maak PDF</button>
                    </div>
                </fieldset>
            </form>
            
            <script>
                var countarray = <?php echo count($producten)?>;
                var producten = new Array(countarray);
                for (var i = 0; i < countarray; i++) {
                  producten[i] = new Array(2);
                }
                
                <?php for($i=0;$i<count($producten);$i++):?>
                    producten[<?php echo $i?>][0] = <?php echo $producten[$i]->geefId();?>;
                    
                    <?php 
                    $t = $producten[$i]->geefBeschrijving();
                    $str=str_replace("\r\n"," ",$t);
                    ?>
                    producten[<?php echo $i?>][1] = '<?php echo $str;?>';
                        
                    producten[<?php echo $i?>][2] = <?php echo $producten[$i]->geefPrijs();?>;
                <?php endfor;?>
                    
                <?php for($i=0;$i<count($producten);$i++):?>
                    <?php $p[$i]['id'] = $producten[$i]->geefId();?>
                    <?php $p[$i]['besch'] = $producten[$i]->geefBeschrijving();?>
                    <?php $p[$i]['prijs'] = $producten[$i]->geefPrijs();?>
                <?php endfor;?>
                    
                var jsArray = <?php echo json_encode($p); ?>;
                var eenbool = true;
                $("#add").click(function() {
                    var t = parseInt($("input[name=teller]").val());
                    if(t === 6 && eenbool === true)
                    {
                        t = 0;
                        eenbool = false;
                    }
                    t = t+1;
                    var rij = $(".clone").clone().removeClass();
                    rij.find("select").attr('name', 'product_' + (t));
                    rij.find("input[type=number]").attr('name', 'aantal_' + (t));
                    rij.find("#besch_0").attr('id', 'besch_' + (t));
                    rij.find("#prijs_0").attr('id', 'prijs_' + (t));
                    rij.appendTo("#tabelbody");
                    $("#besch_"+t).text(producten[0][1]);
                    $("#prijs_"+t).text(producten[0][2]);
                    $("input[name=teller]").val(t);
                });

                function selecteer()
                {
                    var productid = parseInt($(this).val());
                    var productnm = parseInt($(this).attr("name").substring(8));//product nummer
                    for (var k=0;k<producten.length;k++) {
                        if (producten[k][0]=== productid) {
                            $("#besch_"+productnm).text(producten[k][1]);
                            $("#prijs_"+productnm).text(producten[k][2]);
                        }
                    }
                };
            </script>
                    </div>
                </div>
            </div>
        </div>  
    </body>
</html>