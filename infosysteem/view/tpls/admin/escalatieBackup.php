  <div class="col-lg-6">
                    <div class="widget-container fluid-height clearfix">
                        <div class="heading bgcolor1">
                            <i class="fa fa-table"></i>Escalatie
                        </div>


                        <div class="widget-content padded clearfix">
                            <div class="table-responsive">

                                <?php $escalatie = $ticket->geefEscalatie() ?>
                                <?php if (!empty($escalatie)): ?>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Escalatie</td>
                                                <td>
                                                    <?php echo $ticket->geefEscalatie(); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Antwoord</td>
                                                <td>
                                                    <?php
                                                    $i = $ticket->geefAntwoord_escalatie();
                                                    if (empty($i)):
                                                        ?>
                                                        <?php if ($ticket->geefGebruiker_id() === $_SESSION['gebruiker']->geefId()): ?>
                                                            Er is geen antwoord gegeven<br/>
                                                            <a href="./?control=admin&action=escalatieAntwoordToevoegen&ticket_id=<?php echo $ticket->geefId() ?>"> <img src="./img/toevoegen.png"/>Vul een antwoord in</a>
                                                        <?php endif; ?>
                                                        <?php if ($ticket->geefGebruiker_id() !== $_SESSION['gebruiker']->geefId()): ?>
                                                            Er is geen antwoord gegeven
                                                        <?php endif; ?>
                                                        <?php
                                                    endif;
                                                    if (!empty($i)) {
                                                        echo $i;
                                                    }
                                                    ?>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br/>
                                    <a href="./?control=admin&action=escalatieWijzigen&ticket_id=<?php echo $ticket->geefId() ?>">
                                        <!--<img src="./img/wijzig.png"/>-->Wijzig Escalatie
                                    </a>
                                <?php endif; ?>
                                <?php if (empty($escalatie)): ?>
                                    Geen escalatie gevonden<br/>
                                    <a href="./?control=admin&action=escalatieToevoegen&ticket_id=<?php echo $ticket->geefId() ?>">
                                        <!--<img src="./img/toevoegen.png"/>-->Escalatie aanmaken
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>