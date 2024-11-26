<!-- Modal Structure -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document" >
        <div class="modal-content" style="  background-color: rgb(255, 255, 255);border-radius:20px;">
            <div class="modal-header" style="background-color: rgb(255, 128, 0);color:rgb(255, 255, 255);border-radius:20px 20px  0px 0px;">
                <h5 class="modal-title" id="orderModalLabel">Passer une commande</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: rgb(255, 255, 255)">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Order Form -->
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            
                            <td><img src="" id="modalAutocarPhoto" alt="" style="width: 100px; heigth:150px;"></td>
                           <td>
                            <p id="modalAutocarName"> </li>
                            <p id="modalHeure"></li> 
                            <p id="modalVille"></li>
                            <p id="modalPrix"></li>
                           </td>
                      
                       
                    </tbody>
                </table>
                <form action="{{ route('commandes.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_ticket" id="modalIdTicket" value="">
                    <div class="form-group">
                        <label for="adults">Adultes :</label>
                        <input type="number" class="form-control" name="adults" min="1" value="1" required>
                    </div>
                    <div class="form-group">
                        <label for="children">Enfants :</label>
                        <input type="number" class="form-control" name="children" min="0" value="0" required>
                    </div>
                    
                    <button type="submit" class="btn btn-warning" class="btn btn-warning" style="color: rgb(255, 255, 255);background-color:rgb(255, 128, 0); border-radius:50px; padding:10px 50px;">Acheter</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    $('.order-btn').on('click', function() {
        var ticket = $(this).data('ticket');
        $('#modalAutocarName').text(ticket.autocar.nom);
        $('#modalAutocarPhoto').attr('src', '/images/' + ticket.autocar.photo);
        $('#modalHeure').text(ticket.heure_depart + ' --> ' + ticket.heure_arrivee);
        $('#modalVille').text(ticket.ville_depart + ' --> ' + ticket.ville_arrivee);
        $('#modalPrix').text(ticket.prix + ' Dhs');
        $('#modalIdTicket').val(ticket.id_ticket);
        $('#orderModal').modal('show');
    });
</script>
